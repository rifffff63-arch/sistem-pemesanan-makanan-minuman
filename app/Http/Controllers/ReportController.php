<?php

namespace App\Http\Controllers;

use App\Models\FoodOrder;

class ReportController extends Controller
{
    public function index()
    {
        $orders = FoodOrder::with('menu')->get();

        return view('reports.index', compact('orders'));
    }
}