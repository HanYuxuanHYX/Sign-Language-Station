<?php
$db = mysqli_connect("mysql.comp.polyu.edu.hk", "17056093d","zbphhfiw", "17056093d");
$dbName="17056093d";
if (!$db) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
?>