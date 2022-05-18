<?php

namespace App\Repositories;

use App\Models\Disburse;
use Brick\Money\Money;
use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class DisburseRepository
{
    /**
     * Update or create disbursement per merchant and week of year
     *
     * @param integer $merchantId
     * @param Money $amount
     * @param DateTime $date
     * @return void
     */
    public function updateDisbursement(int $merchantId, Money $amount, DateTime $date): void
    {
        $week = intval($date->format('W'));
        $year = intval($date->format('Y'));

        $disburse = $this->find($merchantId, $week, $year);

        if (empty($disburse->id)) {
            // If the merchant don't have disburse registered on the given week and year, proceed to create it
            $this->create($merchantId, (string) $amount->getAmount(), $week, $year);
        } else {
            // Update disburse if exists
            // @var Money $total
            $total = $disburse->disburse;
            $total->plus($amount);
            $disburse->disburse = (string) $total->getAmount();
            $disburse->save();
        }
    }

    /**
     * Base query to find disbursements
     *
     * @param integer $week
     * @param integer|null $merchantId
     * @param integer|null $year
     * @return Builder
     */
    public function baseQuery(int $week, int $merchantId = null, int $year = null): Builder
    {
        $query = Disburse::query()
            ->where('week', $week);

        if (!empty($merchantId)) {
            $query->where('merchant_id', $merchantId);
        }

        if (!empty($year)) {
            $query->where('year', $year);
        } else {
            $query->orderBy('year', 'desc');
        }

        return $query;
    }

    /**
     * Find specific disburse per merchant and week of year
     *
     * @param integer $merchantId
     * @param integer $week
     * @param integer|null $year
     * @return Disburse|null
     */
    public function find(int $merchantId, int $week, int $year = null)
    {
        $query = $this->baseQuery($week, $merchantId, $year);

        return $query->first();
    }

    /**
     * Get all disbursements by merchan, week and year
     *
     * @param integer $week
     * @param integer|null $merchantId
     * @param integer|null $year
     * @return Collection
     */
    public function getAll(int $week, int $merchantId = null, int $year = null): Collection
    {
        $query = $this->baseQuery($week, $merchantId, $year);

        return $query->get();
    }

    /**
     * Create disburse for a merchant
     *
     * @param integer $merchantId
     * @param string $amount
     * @param integer $week
     * @param integer $year
     * @return void
     */
    public function create(int $merchantId, string $amount, int $week, int $year): void
    {
        $disburse = new Disburse;
        $disburse->merchant_id = $merchantId;
        $disburse->disburse = $amount;
        $disburse->week = $week;
        $disburse->year = $year;

        $disburse->save();
    }
}
