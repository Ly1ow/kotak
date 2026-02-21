<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Skate;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $skates = Skate::all();
        $bookings = Booking::with('skate')->orderBy('created_at', 'desc')->get();
        $totalRevenue = Booking::where('is_paid', true)->sum('total_amount');
        
        return view('admin.dashboard', compact('skates', 'bookings', 'totalRevenue'));
    }

    public function storeSkate(Request $request)
    {
        $validated = $request->validate([
            'model' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'size' => 'required|integer|min:30|max:47',
            'quantity' => 'required|integer|min:1',
            'image' => 'nullable|url'
        ]);

        Skate::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Коньки добавлены');
    }

    public function updateSkate(Request $request, Skate $skate)
    {
        $validated = $request->validate([
            'model' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'size' => 'required|integer|min:30|max:47',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|url'
        ]);

        $skate->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Коньки обновлены');
    }

    public function deleteSkate(Skate $skate)
    {
        $skate->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Коньки удалены');
    }
}