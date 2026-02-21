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
            'has_own_skates' => 'boolean',
            'skate_id' => 'nullable|exists:skates,id',
            'skate_size' => 'nullable|integer|min:30|max:47',
        ]);

        $totalAmount = 300; // Входной билет
        
        if (!$request->has_own_skates && $request->skate_id) {
            $totalAmount += 150 * $request->hours;
            
            // Уменьшаем количество коньков
            $skate = Skate::find($request->skate_id);
            $skate->quantity -= 1;
            $skate->save();
        }

        $booking = Booking::create([
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'hours' => $request->hours,
            'skate_id' => $request->has_own_skates ? null : $request->skate_id,
            'has_own_skates' => $request->has_own_skates,
            'total_amount' => $totalAmount,
            'is_paid' => false,
        ]);

        // Здесь можно добавить интеграцию с платежной системой
        
        return response()->json([
            'success' => true,
            'booking_id' => $booking->id,
            'amount' => $totalAmount
        ]);
    }

    public function payment(Request $request, Booking $booking)
    {
        // Имитация оплаты
        $booking->update([
            'is_paid' => true,
            'payment_id' => 'PAY-' . uniqid()
        ]);

        return response()->json(['success' => true]);
    }
}