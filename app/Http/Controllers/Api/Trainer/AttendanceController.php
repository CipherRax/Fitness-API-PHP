<?php
namespace App\Http\Controllers\Api\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\ClassSchedule;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    // Get the roster for a specific class schedule
    public function getRoster(Request $request, int $scheduleId)
    {
        $schedule = ClassSchedule::with('fitnessClass')->findOrFail($scheduleId);

        // Security: Ensure this trainer actually teaches this class
        if ($schedule->fitnessClass->trainer_id !== $request->user()->id && $request->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized. You do not teach this class.'], 403);
        }

        $bookings = Booking::with('user:id,name,email')
            ->where('class_schedule_id', $scheduleId)
            ->whereIn('status', ['active', 'attended']) // Don't show cancelled
            ->get();

        return response()->json([
            'class' => $schedule->fitnessClass->name,
            'time' => $schedule->start_time,
            'roster' => $bookings
        ]);
    }

    // Mark a specific booking as attended
    public function markAttendance(Request $request, int $bookingId)
    {
        $booking = Booking::with('schedule.fitnessClass')->findOrFail($bookingId);

        // Security check
        if ($booking->schedule->fitnessClass->trainer_id !== $request->user()->id && $request->user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        if ($booking->status !== 'active') {
            return response()->json(['message' => "Cannot mark attendance. Current status is {$booking->status}"], 400);
        }

        $booking->update(['status' => 'attended']);

        return response()->json([
            'message' => 'Attendance marked successfully.',
            'data' => $booking
        ]);
    }
}
