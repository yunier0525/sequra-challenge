<?php

namespace Tests\Unit;

use App\Helpers\DisburseCalculator;
use Brick\Money\Money;
use PHPUnit\Framework\TestCase;

class CalculateDisburseTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        // 1% fee for amounts smaller than 50 €
        $amountLessThan50 = Money::of(39.69, 'EUR');
        $disburseLessThan50 = Money::of(39.30, 'EUR');
        $calculatedLessThan50 = DisburseCalculator::calculateDisburse($amountLessThan50);
        $this->assertTrue($disburseLessThan50->isEqualTo($calculatedLessThan50));

        // 0.95% for amounts between 50€ - 300€
        $amountBetween50_300 = Money::of(139.69, 'EUR');
        $disburseBetween50_300 = Money::of(138.37, 'EUR');
        $calculatedBetween50_300 = DisburseCalculator::calculateDisburse($amountBetween50_300);
        $this->assertTrue($disburseBetween50_300->isEqualTo($calculatedBetween50_300));

        // 0.85% for amounts over 300€
        $amountMoreThan300 = Money::of(654.52, 'EUR');
        $disburseMoreThan300 = Money::of(648.96, 'EUR');
        $calculatedMoreThan300 = DisburseCalculator::calculateDisburse($amountMoreThan300);
        $this->assertTrue($disburseMoreThan300->isEqualTo($calculatedMoreThan300));
    }
}
