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

    /**
     * Execute the calculation of the disburse per each order
     *
     * @param integer|null $batch
     * @return void
     */
    public function calculateDisbursements(int $batch = null)
    {
        // Get orders completed and not processed to calculate disburse
        $orders = $this->orderRepository->findCompletedNotProcessedOrders($batch);

        foreach ($orders as $order) {
            // Calculate the disburse
            $disburse = DisburseCalculator::calculateDisburse($order->amount);

            // Update or create disburse for merchant
            $this->disburseRepository->updateDisbursement(
                $order->merchant_id,
                $disburse,
                DateTime::createFromFormat('Y-m-d H:i:s', $order->completed_at)
            );

            // Update the order
            $this->orderRepository->update($order->id, ['processed' => true]);
        }
    }
}
