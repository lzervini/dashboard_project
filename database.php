<?php
define('DATABASE', 'dashboard_project');
define('USER', 'root ');
define('PWD' , '');
define('HOST', 'localhost');

try {
    $dbh = new PDO('mysql:host='.HOST.';dbname='.DATABASE, USER, PWD);
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    $this->connexion = NULL;
}
