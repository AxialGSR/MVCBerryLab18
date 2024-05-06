<?php
// variable de connection globale //
require_once('../../config.php');
trait PDOtrait {
    public function connexionBdd()
    {   
        $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST;
        $dbh = new PDO($dsn,DB_USER,DB_PASSWORD);
        return $dbh;
    }
}
?>