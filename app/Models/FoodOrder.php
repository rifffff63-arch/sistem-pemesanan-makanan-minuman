<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodOrder extends Model

{
    protected $fillable = [
        'menu_id',
        'customer_name',
        'table_number',
        'quantity',
        'special_request',
        'status',
        'total_price'
    ];

    public function menu()
    {
        return $this->belongsTo(MenuItem::class, 'menu_id');
    }
}