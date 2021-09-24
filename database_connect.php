<?php

//Łączenie z bazą
$mysqli = new mysqli("localhost","root","","task");

if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
  }

?>