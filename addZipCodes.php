<?php

require 'vendor/autoload.php';

use Faker\Factory;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 9000);
require 'Сonnect.php';

//$connect = new Connect();
//
//$pg = $connect->connect();
//
//$file = file('free-zipcode-database.csv', FILE_SKIP_EMPTY_LINES);
//$lines = count(file('free-zipcode-database.csv', FILE_SKIP_EMPTY_LINES));
//$zips = [];
//
//$fp = fopen(__DIR__.'/zip.csv', 'w');
//for($i=1; $i < $lines; $i++){
//    $item = explode(',',$file[$i]);
//    if(isset($item[1])){
//        $item = trim($item[1],'"');
//            $zips[] = $item;
//    }
//}
//$zips = array_unique($zips);
//foreach($zips as $zip){
//    fputcsv($fp, [intval($zip)]);
//}
//$query = pg_query($pg,"COPY zip(number) FROM '".__DIR__."/zip.csv' WITH (FORMAT csv)");
//if($query){
//    unlink(__DIR__.'/zip.csv');
//}
$connect = new Connect();

$pg = $connect->connect();
$lines = count(file('free-zipcode-database.csv', FILE_SKIP_EMPTY_LINES));
$file = file('free-zipcode-database.csv', FILE_SKIP_EMPTY_LINES);
for($i=1; $i < $lines; $i++){
    $item = explode(',',$file[$i]);
    if(isset($item[1])){
        $item = trim($item[1],'"');
            $zips[] = $item;
    }
}
$zips = array_unique($zips);
$lat = range(56.65,4484.00);
$faker = Factory::create();
$fp = fopen(__DIR__.'/users.csv', 'w');
for ($i=0; $i < 10000000; $i++) {
    fputcsv($fp, [intval(array_rand($lat)), intval(array_rand($zips))]);
}

$query = pg_query($pg,"COPY users(number,zip_id) FROM '".__DIR__."/users.csv' WITH (FORMAT csv)");