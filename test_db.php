<?php
require 'config.php';

$conn = getDBConnection();
echo "Successfully connected to MySQL!";
$conn->close();