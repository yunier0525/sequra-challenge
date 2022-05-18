<?php

namespace App\Helpers;

use Brick\Math\RoundingMode;
use Brick\Money\Money;

class DisburseCalculator
{
    /**
     * Calculate disburse of a given amount of money
     *
     * @param Money $amount
     * @return Money
     */
    public static function calculateDisburse(Money $amount): Money
    {
        $reference50 = Money::of(50, 'EUR');
        $reference300 = Money::of(300, 'EUR');

        // 1% fee for amounts smaller than 50 €
        if ($amount->isLessThan($reference50)) {
            return $amount->minus($amount->multipliedBy(0.01, RoundingMode::DOWN), RoundingMode::DOWN);
        }

        // 0.95% for amounts between 50€ - 300€
        if ($amount->isGreaterThanOrEqualTo($reference50) && $amount->isLessThanOrEqualTo($reference300)) {
            return $amount->minus($amount->multipliedBy(0.0095, RoundingMode::DOWN), RoundingMode::DOWN);
        }

        // 0.85% for amounts over 300€
        if ($amount->isGreaterThan($reference300)) {
            return $amount->minus($amount->multipliedBy(0.0085, RoundingMode::DOWN), RoundingMode::DOWN);
        }
    }
}
