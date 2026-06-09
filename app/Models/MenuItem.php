<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category',
        'price',
        'image',
        'is_available',
        'preparation_time',
        'calories',
        'is_recommended'
    ];

    public function orders()
    {
        return $this->hasMany(FoodOrder::class, 'menu_id');
    }
}