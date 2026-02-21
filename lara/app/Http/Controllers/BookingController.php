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
        $selectedSkate = null;
        
        if (!$hasOwnSkates && $request->skate_id) {
            $selectedSkate = Skate::find($request->skate_id);
            
            if ($selectedSkate && $selectedSkate->quantity > 0) {
                $totalAmount += 150 * $request->hours;
                
                // Уменьшаем количество коньков
                $selectedSkate->quantity -= 1;
                $selectedSkate->save();
            } else {
                return back()->withErrors(['skate_id' => 'Выбранные коньки отсутствуют в наличии'])->withInput();
            }
        }

        $booking = Booking::create([
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'hours' => $request->hours,
            'skate_id' => $hasOwnSkates ? null : ($selectedSkate ? $selectedSkate->id : null),
            'skate_model' => $selectedSkate ? ($selectedSkate->brand . ' ' . $selectedSkate->model) : null,
            'skate_size' => $request->skate_size ?? ($selectedSkate ? $selectedSkate->size : null),
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
        // Загружаем связанные данные
        $booking->load('skate');
        
        return view('booking-success', compact('booking'));
    }
}