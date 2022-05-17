<?php

namespace Database\Seeders;

use App\Models\Merchant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MerchantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('merchants')->delete();

        $json = File::get("database/data/merchants.json");
        $data = json_decode($json);

        foreach ($data->RECORDS as $obj) {
            Merchant::create(array(
                'id' => $obj->id,
                'name' => $obj->name,
                'email' => $obj->email,
                'cif' => $obj->cif,
            ));
        }
    }
}
