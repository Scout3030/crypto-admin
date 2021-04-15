<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countrySql = 'sql/data_country.sql';
        $countries = Country::all();
        if(count($countries) == 0){
            if(Storage::disk('local')->exists($countrySql)) {
                DB::unprepared(Storage::disk('local')->get($countrySql));
            }
        }
    }
}
