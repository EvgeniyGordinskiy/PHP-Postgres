<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 9000);

require 'vendor/autoload.php';

$GLOBALS['config']['default'] = include 'config/defaultValues.php';
$GLOBALS['config']['db'] = include 'config/ConfigDB.php';

$s = <<<EOL
<form action="addZipCodes.php" method="get">
  <input type="hidden" value="seeder">
  <input type="submit" value="Run seeder!">
</form>
EOL;

echo $s;

function config($param){
    if(isset($GLOBALS['config'][$param])){
        return $GLOBALS['config'][$param];
    }
    return false;
}

// create table users_january (id bigserial check (id > 0), lat decimal check(lat > 0), zip_number bigint references zip (number), created_at bigint default (extract(epoch from now()) * 1000), week_day SMALLINT not null);
