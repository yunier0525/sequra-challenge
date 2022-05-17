<?php

namespace App\Services;

use App\Helpers\DisburseCalculator;
use App\Repositories\DisburseRepository;
use App\Repositories\OrderRepository;
use DateTime;

class DisburseService
{
    public function __construct(
        private DisburseRepository $disburseRepository,
        private OrderRepository $orderRepository
    ) {
    }

    public function calculateDisbursements(int $batch = null)
    {
        $orders = $this->orderRepository->findCompletedNotProcessedOrders($batch);

        foreach ($orders as $order) {
            $disburse = DisburseCalculator::calculateDisburse($order->amount);

            $this->disburseRepository->updateDisbursement(
                $order->merchant_id,
                $disburse,
                DateTime::createFromFormat('Y-m-d H:i:s', $order->completed_at)
            );

            $this->orderRepository->update($order->id, ['processed' => true]);
        }
    }
}
