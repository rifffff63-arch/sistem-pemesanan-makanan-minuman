<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::latest()->get();

        return view('menu-items.index', compact('menuItems'));
    }

    public function create()
    {
        return view('menu-items.create');
    }

    public function store(Request $request)
    {
        MenuItem::create([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'price' => $request->price,
            'image' => $request->image,
            'is_available' => $request->is_available ?? 1,
            'preparation_time' => $request->preparation_time,
            'calories' => $request->calories,
            'is_recommended' => $request->is_recommended ?? 0,
        ]);

        return redirect()->route('menu-items.index')
            ->with('success', 'Menu berhasil ditambahkan');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $menuItem = MenuItem::findOrFail($id);

        return view('menu-items.edit', compact('menuItem'));
    }

    public function update(Request $request, string $id)
    {
        $menuItem = MenuItem::findOrFail($id);

        $menuItem->update([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'price' => $request->price,
            'image' => $request->image,
            'is_available' => $request->is_available ?? 1,
            'preparation_time' => $request->preparation_time,
            'calories' => $request->calories,
            'is_recommended' => $request->is_recommended ?? 0,
        ]);

        return redirect()->route('menu-items.index')
            ->with('success', 'Menu berhasil diupdate');
    }

    public function destroy(string $id)
    {
        MenuItem::findOrFail($id)->delete();

        return redirect()->route('menu-items.index')
            ->with('success', 'Menu berhasil dihapus');
    }
}