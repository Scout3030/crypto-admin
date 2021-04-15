<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $citySql = 'sql/data_city.sql';
        $cities = City::all();
        if(count($cities) == 0){
            if(Storage::disk('local')->exists($citySql)) {
                DB::unprepared(Storage::disk('local')->get($citySql));
            }
        }
    }
}
