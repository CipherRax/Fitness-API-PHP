<?php

// app/Repositories/Contracts/BookingRepositoryInterface.php

namespace App\Repositories\Contracts;

use App\Models\Booking;

interface BookingRepositoryInterface
{
    public function getActiveBookingsForSchedule(int $scheduleId): int;
    public function createBooking(array $data): Booking;
    public function hasUserAlreadyBooked(int $userId, int $scheduleId): bool;
}