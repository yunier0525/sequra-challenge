<?php

namespace App\Repositories;

use App\Models\Disburse;
use App\Models\Merchant;
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

    public function find(int $merchantId, int $week, int $year)
    {
        return Disburse::query()
            ->where('merchant_id', $merchantId)
            ->where('week', $week)
            ->where('year', $year)
            ->first();
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
