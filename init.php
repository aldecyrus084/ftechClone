<?php
define('base_url', $_SERVER['SERVER_NAME'] . '/admin');
define('hostname', 'localhost');
define('username', 'ftech');
define('password', 'ftech');
define('dbname', 'ftech');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
?>