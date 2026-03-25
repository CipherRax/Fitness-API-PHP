<?php
// app/Http/Controllers/Api/BookingController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Services\BookingService;
use Exception;

class BookingController extends Controller
{
    public function __construct(
        protected BookingService $bookingService
    ) {}

    public function store(StoreBookingRequest $request)
    {
        try {
            $booking = $this->bookingService->processBooking(
                $request->user()->id,
                $request->validated('class_schedule_id')
            );

            return response()->json([
                'success' => true,
                'message' => $booking->status === 'waitlisted'
                             ? 'Class is full. You have been added to the waitlist.'
                             : 'Booking confirmed successfully!',
                'data' => $booking
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }
}
