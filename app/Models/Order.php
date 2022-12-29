<?php

namespace App\Models;


use App\Enums\OrderState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'payment_id',
        'payment_status'
    ];

    /**
     * Write code on Method
     *
     * @return response()
     */
    protected $casts = [
        'payment_status' => OrderState::class
    ];
}
