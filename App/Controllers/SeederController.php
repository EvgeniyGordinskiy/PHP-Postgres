<?php
namespace App\Controllers;

use App\Models\Connect;
use App\Filters\SeedFilter;

class SeederController
{
    public function run()
    {
        $connect =  new Connect();
        $pg = $connect->connect();

        $default = config('default');

        $zips = SeedFilter::filterCSV($default['zip_file']);

        $nameFile = substr(md5(microtime(true)), -5);

        $fp = fopen(__DIR__."/$nameFile.csv", 'w');

        foreach($zips as $zip){
            fputcsv($fp, [$zip]);
        }

        pg_query($pg,"COPY zip(number) FROM '".__DIR__."/$nameFile.csv' WITH (FORMAT csv)");

        $fp = fopen(__DIR__."/$nameFile.csv", 'w');

        for ($i=0; $i < 100; $i++) {
            fputcsv($fp, [array_rand($default['lat']), array_rand($zips), array_rand($default['weekDay'])]);
        }

        pg_query($pg,"COPY ".$default['users_table']['january']."(lat,zip_number,week_day) FROM '".__DIR__."/$nameFile.csv' WITH (FORMAT csv)");

        unlink(__DIR__."/$nameFile.csv");

    }

}