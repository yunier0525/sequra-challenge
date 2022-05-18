<?php

namespace App\Models;

use Brick\Money\Money;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disburse extends Model
{
    use HasFactory;

    public $table = 'disbursements';

    protected $fillable = [
        'merchant_id',
        'disburse',
        'week',
        'year'
    ];

    /**
     * Get the amount of money.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function disburse(): Attribute
    {
        return Attribute::make(
            // Cast value of disburse to Brick/Money
            get: fn ($value) => Money::of($value, 'EUR')
        );
    }
}
