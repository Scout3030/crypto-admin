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
    protected $signature = 'import:country-state-city';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import the data_country_state_city.sql file with information for each country, state and city.';

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
        DB::unprepared(Storage::get('sql/data_country.sql'));
        DB::unprepared(Storage::get('sql/data_state.sql'));
        DB::unprepared(Storage::get('sql/data_city.sql'));
    }
}
