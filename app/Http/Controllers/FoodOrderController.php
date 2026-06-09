<?php

namespace App\Http\Controllers;

use App\Models\FoodOrder;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class FoodOrderController extends Controller
{
    public function index()
    {
        $orders = FoodOrder::with('menu')->latest()->get();

        return view('food-orders.index', compact('orders'));
    }

    public function create()
    {
        $menus = MenuItem::all();

        return view('food-orders.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $menu = MenuItem::findOrFail($request->menu_id);

        FoodOrder::create([
            'menu_id' => $request->menu_id,
            'customer_name' => $request->customer_name,
            'table_number' => $request->table_number,
            'quantity' => $request->quantity,
            'special_request' => $request->special_request,
            'status' => 'pending',
            'total_price' => $menu->price * $request->quantity,
        ]);

        return redirect()->route('food-orders.index')
            ->with('success', 'Pesanan berhasil ditambahkan');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $order = FoodOrder::findOrFail($id);
        $menus = MenuItem::all();

        return view('food-orders.edit', compact('order', 'menus'));
    }

    public function update(Request $request, string $id)
    {
        $order = FoodOrder::findOrFail($id);

        $menu = MenuItem::findOrFail($request->menu_id);

        $order->update([
            'menu_id' => $request->menu_id,
            'customer_name' => $request->customer_name,
            'table_number' => $request->table_number,
            'quantity' => $request->quantity,
            'special_request' => $request->special_request,
            'status' => $request->status,
            'total_price' => $menu->price * $request->quantity,
        ]);

        return redirect()->route('food-orders.index')
            ->with('success', 'Pesanan berhasil diupdate');
    }

    public function destroy(string $id)
    {
        FoodOrder::findOrFail($id)->delete();

        return redirect()->route('food-orders.index')
            ->with('success', 'Pesanan berhasil dihapus');
    }
}