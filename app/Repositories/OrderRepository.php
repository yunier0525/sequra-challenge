<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository
{
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

    public function update(int $orderId, array $data)
    {
        Order::query()
            ->where('id', $orderId)
            ->update($data);
    }
}
