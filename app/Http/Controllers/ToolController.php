<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ToolController extends Controller
{
    public function cleanAllTables(){
        $dbName = env('DB_DATABASE');
        DB::statement("SET FOREIGN_KEY_CHECKS = 0");
        $tables = DB::select('SHOW TABLES');
        print_r($tables);
        foreach($tables as $table){
            Schema::drop($table->{'Tables_in_'. $dbName});
            echo 'Table '.$table->{'Tables_in_'. $dbName}.' Droped. <br>';
        }
        DB::statement("SET FOREIGN_KEY_CHECKS = 1");
    }
}
