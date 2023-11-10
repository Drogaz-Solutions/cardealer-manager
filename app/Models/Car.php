<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use CrudTrait;
    use HasFactory;

    public function cardealer() {
        // car
        return $this->belongsTo(Cardealer::class);
    }

    public function seller() {
        // car
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'name',
        'cardealer_id',
        'seller_id',
        'clean_price',
        'buy_price',
    ];
}
