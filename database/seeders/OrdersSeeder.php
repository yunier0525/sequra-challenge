<?php

namespace Database\Seeders;

use App\Models\Order;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->delete();

        $json = File::get("database/data/orders.json");
        $data = json_decode($json);

        foreach ($data->RECORDS as $obj) {
            $row = [
                'id' => $obj->id,
                'merchant_id' => $obj->merchant_id,
                'shopper_id' => $obj->shopper_id,
                'amount' => $obj->amount,
                'created_at' => (!empty($obj->created_at) && $obj->created_at !== ""
                    ? DateTime::createFromFormat('d/m/Y H:i:s', $obj->created_at)
                    : null
                ),
                'completed_at' => (!empty($obj->completed_at) && $obj->completed_at !== ""
                    ? DateTime::createFromFormat('d/m/Y H:i:s', $obj->completed_at)
                    : null
                ),
            ];

            Order::create($row);
        }
    }
}
