<?php

define('HOST', 'sql311.epizy.com');
define('USER', 'epiz_29222218');
define('PASSWORD', 'XFBb2yWY0P06W');
define('DATABASE_NAME', 'epiz_29222218_hms_3');

$servername = HOST;
$username = USER;
$password = PASSWORD;
$db = DATABASE_NAME;

// Create connection
$con = mysqli_connect($servername, $username, $password,$db);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

?>