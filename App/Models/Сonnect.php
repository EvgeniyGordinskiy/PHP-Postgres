<?php
namespace App\Models;

class Connect {

    private $parameters;

    public function __construct(){
        $this->parameters = config('db');
    }

    public function connect(){
        $host = $this->parameters['host'];
        $db = $this->parameters['db'];
        $user = $this->parameters['user'];
        $passwd = $this->parameters['passwd'];

          $pg = pg_pconnect(
              "host    = $host
              dbname   = $db 
              user     = $user 
              password = $passwd"
          );

        return $pg;
    }
}