<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository
{
    /**
     * Find all orders completed and unprocessed (disburse not calculated)
     *
     * @param integer|null $limit
     * @return Collection
     */
    public function findCompletedNotProcessedOrders(int $limit = null): Collection
    {
        $orders = Order::query()
            ->whereNotNull('completed_at')
            ->where('processed', false);

        if (!empty($limit)) {
            $orders->limit($limit);
        }

        return $orders->get();
    }

    /**
     * Update Order
     *
     * @param integer $orderId
     * @param array $data
     * @return void
     */
    public function update(int $orderId, array $data)
    {
        Order::query()
            ->where('id', $orderId)
            ->update($data);
    }
}
