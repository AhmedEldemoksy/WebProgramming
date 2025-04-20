<?php
$link = mysqli_connect("localhost", "root", "", "mydb");
if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    exit;
}
