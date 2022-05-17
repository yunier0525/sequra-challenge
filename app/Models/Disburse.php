<?php

namespace App\Models;

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
}
