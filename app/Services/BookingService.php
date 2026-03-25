<?php
// app/Services/BookingService.php

namespace App\Services;

use App\Models\ClassSchedule;
use App\Repositories\Contracts\BookingRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Exception;

class BookingService
{
    public function __construct(
        protected BookingRepositoryInterface $bookingRepo
    ) {}

    public function processBooking(int $userId, int $scheduleId)
    {
        // 1. Check if user already booked (fast fail outside transaction)
        if ($this->bookingRepo->hasUserAlreadyBooked($userId, $scheduleId)) {
            throw new Exception("You have already booked or waitlisted this class.");
        }

        // 2. Open transaction for atomic booking
        return DB::transaction(function () use ($userId, $scheduleId) {

            // Lock the schedule row. Supabase/Postgres handles this perfectly.
            $schedule = ClassSchedule::with('fitnessClass')
                ->where('id', $scheduleId)
                ->lockForUpdate()
                ->firstOrFail();

            // Check how many people are currently active in this class
            $currentBookingsCount = $this->bookingRepo->getActiveBookingsForSchedule($scheduleId);

            // Determine status based on capacity
            $status = ($currentBookingsCount < $schedule->fitnessClass->capacity)
                        ? 'active'
                        : 'waitlisted';

            // Create the record
            return $this->bookingRepo->createBooking([
                'user_id' => $userId,
                'class_schedule_id' => $scheduleId,
                'status' => $status
            ]);
        });
    }
}
