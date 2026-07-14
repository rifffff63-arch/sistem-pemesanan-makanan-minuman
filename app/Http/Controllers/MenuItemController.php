<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\FoodOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MenuItemController extends Controller
{
    /**
     * Menampilkan daftar menu
     */
    public function index()
    {
        $menuItems = MenuItem::latest()->get();

        // Menu Terlaris
        $terlaris = FoodOrder::select('menu_id', DB::raw('SUM(quantity) as total_qty'))
            ->groupBy('menu_id')
            ->orderByDesc('total_qty')
            ->first();

        $topMenu = 'Belum ada';
        $topValue = 0;

        if ($terlaris && $terlaris->menu) {
            $topMenu = $terlaris->menu->name;
            $topValue = $terlaris->total_qty * $terlaris->menu->price;
        }

        return view('menu-items.index', compact(
            'menuItems',
            'topMenu',
            'topValue'
        ));
    }

   
    public function showQr()
    {
        
        $url = "http://192.168.72.221:8000/menu-items";

        return view('qr-menu', compact('url'));
    }
}