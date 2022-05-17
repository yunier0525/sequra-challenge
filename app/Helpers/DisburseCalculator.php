<?php

namespace App\Helpers;

class DisburseCalculator
{
    /**
     * Calculate disburse of a given amount of money
     *
     * @param float $amount
     * @return float
     */
    public static function calculateDisburse(float $amount): float
    {
        if ($amount < 50) {
            return $amount - ($amount * 0.01);
        }

        if ($amount >= 50 && $amount <= 300) {
            return $amount - ($amount * 0.0095);
        }

        if ($amount > 300) {
            return $amount - ($amount * 0.0085);
        }
    }
}
