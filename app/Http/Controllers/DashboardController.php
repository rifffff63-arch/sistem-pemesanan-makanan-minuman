<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MenuItem;
use App\Models\FoodOrder;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik Dashboard
        $totalMenu = MenuItem::count();
        $totalUser = User::where('role', 'user')->count();
        $totalPesanan = FoodOrder::count();

        // Pendapatan dari pesanan yang selesai
        $totalPendapatan = FoodOrder::where('status', 'Selesai')
            ->sum('total_price');

        // Jumlah pesanan berdasarkan status (opsional)
        $pesananDiproses = FoodOrder::where('status', 'Diproses')->count();
        $pesananSelesai = FoodOrder::where('status', 'Selesai')->count();
        $pesananDibatalkan = FoodOrder::where('status', 'Dibatalkan')->count();

        return view('dashboard', compact(
            'totalMenu',
            'totalUser',
            'totalPesanan',
            'totalPendapatan',
            'pesananDiproses',
            'pesananSelesai',
            'pesananDibatalkan'
        ));
    }
}