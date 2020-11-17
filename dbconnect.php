<?php

error_reporting( ~E_DEPRECATED & ~E_NOTICE);
// this will avoiud msql_connect() debrecation error.

define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME', 'session_db');

$conn = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);

if (!$conn) {
    die ("Connection failed : " . mysqli_error());
}