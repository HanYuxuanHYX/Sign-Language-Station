<?php
$link = mysqli_connect("mysql.comp.polyu.edu.hk", "18012633x","sqgqcbvd", "18012633x");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
?>
