<?php
define('DATABASE', 'dashboard_project');
define('USER', 'root');
define('PWD' , 'mariadb');
define('HOST', 'f9d527f80147');

try {
    $dbh = new PDO('mysql:host='.HOST.';dbname='.DATABASE, USER, PWD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>