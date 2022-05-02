<?php

class connexionValues {
    
    private $host = "localhost";
    private $user = 'root';
    private $dbname = "db_books";

    public function getValues(){
        $values = array("host"=>$this->host, "user"=>$this->user, "dbname"=>$this->dbname);
        return $values;
    }
}
?>