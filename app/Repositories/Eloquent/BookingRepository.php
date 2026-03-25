<?// app/Repositories/Eloquent/BookingRepository.php

namespace App\Repositories\Eloquent;

use App\Models\Booking;
use App\Repositories\Contracts\BookingRepositoryInterface;

class BookingRepository implements BookingRepositoryInterface
{
    public function getActiveBookingsForSchedule(int $scheduleId): int
    {
        return Booking::where('class_schedule_id', $scheduleId)
            ->whereIn('status', ['active', 'attended'])
            ->count();
    }

    public function createBooking(array $data): Booking
    {
        return Booking::create($data);
    }

    public function hasUserAlreadyBooked(int $userId, int $scheduleId): bool
    {
        return Booking::where('user_id', $userId)
            ->where('class_schedule_id', $scheduleId)
            ->whereIn('status', ['active', 'waitlisted'])
            ->exists();
    }
}