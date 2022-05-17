<?php

namespace App\Repositories;

use App\Models\Disburse;
use DateTime;

class DisburseRepository
{
    public function updateDisbursement(int $merchantId, float $amount, DateTime $date)
    {
        $week = intval($date->format('W'));
        $year = intval($date->format('Y'));

        $disburse = $this->find($merchantId, $week, $year);

        if (empty($disburse->id)) {
            $this->create($merchantId, $amount, $week, $year);
        } else {
            $disburse->disburse += $amount;
            $disburse->save();
        }
    }

    public function baseQuery(int $week, int $merchantId = null, int $year = null)
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

    public function find(int $merchantId, int $week, int $year = null)
    {
        $query = $this->baseQuery($week, $merchantId, $year);

        return $query->first();
    }

    public function getAll(int $week, int $merchantId = null, int $year = null)
    {
        $query = $this->baseQuery($week, $merchantId, $year);

        return $query->get();
    }

    public function create(int $merchantId, float $amount, int $week, int $year): void
    {
        $disburse = new Disburse;
        $disburse->merchant_id = $merchantId;
        $disburse->disburse = $amount;
        $disburse->week = $week;
        $disburse->year = $year;

        $disburse->save();
    }
}
