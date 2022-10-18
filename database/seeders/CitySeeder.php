<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        City::truncate();
        Schema::enableForeignKeyConstraints();
        $json = File::get("database/data/ir.json");
        $province = json_decode($json);
        foreach ($province as $key => $value) {
            City::create([
                "name" => $value->city,
                "lat" => $value->lat,
                "lon" => $value->lng,

            ]);

        }
    }
}
