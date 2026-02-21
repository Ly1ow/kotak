<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Skate;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'hours' => 'required|in:1,2,3,4',
            'has_own_skates' => 'sometimes|boolean',
            'skate_id' => 'nullable|exists:skates,id',
            'skate_size' => 'nullable|integer|min:30|max:47',
        ]);

        $totalAmount = 300; // Входной билет
        
        $hasOwnSkates = $request->has('has_own_skates') ? true : false;
        
        if (!$hasOwnSkates && $request->skate_id) {
            $totalAmount += 150 * $request->hours;
            
            // Уменьшаем количество коньков
            $skate = Skate::find($request->skate_id);
            if ($skate && $skate->quantity > 0) {
                $skate->quantity -= 1;
                $skate->save();
            }
        }

        $booking = Booking::create([
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'hours' => $request->hours,
            'skate_id' => $hasOwnSkates ? null : $request->skate_id,
            'skate_size' => $request->skate_size,
            'has_own_skates' => $hasOwnSkates,
            'total_amount' => $totalAmount,
            'is_paid' => false,
        ]);

        // Имитация оплаты
        $booking->update([
            'is_paid' => true,
            'payment_id' => 'PAY-' . strtoupper(uniqid())
        ]);

        return redirect()->route('booking.success', $booking)->with('success', 'Билет успешно куплен!');
    }

    public function success(Booking $booking)
    {
        return view('booking-success', compact('booking'));
    }

    public function payment(Request $request, Booking $booking)
    {
        // Имитация оплаты
        $booking->update([
            'is_paid' => true,
            'payment_id' => 'PAY-' . strtoupper(uniqid())
        ]);

        return response()->json(['success' => true]);
    }
}