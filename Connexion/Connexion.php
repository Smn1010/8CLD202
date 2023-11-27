<?php
function connectToDatabase() {
    $serverLink = null;

    /** Define connexion datas */
    if (!defined('DBHOST')) define('DBHOST', 'localhost');
    if (!defined('DBUSER')) define('DBUSER', 'root');
    if (!defined('DBPASSWORD')) define('DBPASSWORD', '');
    if (!defined('DBNAME')) define('DBNAME', '8cld202');

    /** Set connexion */
    $dsn = "mysql:dbname=" . DBNAME . ";host=" . DBHOST;

    try {
        /** PDO instanciation */
        $serverLink = new PDO($dsn, DBUSER, DBPASSWORD);
        $serverLink->exec("set names utf8mb4"); // Check UTF8 request
    } catch (PDOException $e) {
        die("Error : " . $e->getMessage());
    }

    return $serverLink;
}



?>
