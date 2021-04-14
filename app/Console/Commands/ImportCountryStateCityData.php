<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImportCountryStateCityData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:country-state-city-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import the data about Countries, States and Cities from SQL files on storage/app/sql folder AFTER truncating tables';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $countrySql = 'sql/data_country.sql';
        $stateSql = 'sql/data_state.sql';
        $citySql = 'sql/data_city.sql';
        
        if(Storage::disk('local')->exists($countrySql)) {
            DB::unprepared(Storage::disk('local')->get($countrySql));
        }

        if(Storage::disk('local')->exists($stateSql)) {
            DB::unprepared(Storage::disk('local')->get($stateSql));
        }

        if(Storage::disk('local')->exists($citySql)) {
            DB::unprepared(Storage::disk('local')->get($citySql));
        }

    }
}
