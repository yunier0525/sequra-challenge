<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Brick\Money\Money;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'merchant_id',
        'shopper_id',
        'amount',
        'created_at',
        'completed_at'
    ];

    /**
     * Get the amount of money.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function amount(): Attribute
    {
        return Attribute::make(
            // Cast value of amount to Brick/Money
            get: fn ($value) => Money::of($value, 'EUR')
        );
    }
}
