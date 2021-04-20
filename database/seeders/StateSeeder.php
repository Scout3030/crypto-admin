<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stateSql = 'sql/data_state.sql';
        $states = State::count();
        if (($states === 0) && Storage::disk('local')->exists($stateSql)) {
            DB::unprepared(Storage::disk('local')->get($stateSql));
        }
    }
}
