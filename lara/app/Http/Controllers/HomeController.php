<?php

namespace App\Http\Controllers;

use App\Models\Skate;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $skates = Skate::where('quantity', '>', 0)
                      ->orderBy('brand')
                      ->orderBy('model')
                      ->get();
        
        // Также получаем все коньки для модального окна (включая те, что в наличии)
        $allSkates = Skate::where('quantity', '>', 0)->get();
        
        return view('home', compact('skates', 'allSkates'));
    }
}