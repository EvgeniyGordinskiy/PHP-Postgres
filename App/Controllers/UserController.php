<?php
namespace App\Controllers;

use App\Models\Connect;

class UserController
{
    public function getUser()
    {
        $connect =  new Connect();
        $pg = $connect->connect();
        $default = config('default');

        $query = "SELECT * FROM". $default['users_table']['january']
                  ."WHERE weekDay = 7
                  UNION ALL
                  SELECT * FROM ". $default['users_table']['february']
                  ."WHERE weekDay = 7
                  UNION ALL
                  SELECT * FROM ". $default['users_table']['march']
                  ."WHERE weekDay = 7
                  ORDER BY \"created_at\" DESC
                  LIMIT 1000";

        $users = pg_query($pg,$query);

        return $users;
    }
}