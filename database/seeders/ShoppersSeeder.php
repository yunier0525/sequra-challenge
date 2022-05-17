<?php

namespace Database\Seeders;

use App\Models\Shopper;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ShoppersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shoppers')->delete();

        $json = File::get("database/data/shoppers.json");
        $data = json_decode($json);

        foreach ($data->RECORDS as $obj) {
            Shopper::create(array(
                'id' => $obj->id,
                'name' => $obj->name,
                'email' => $obj->email,
                'nif' => $obj->nif,
            ));
        }
    }
}
