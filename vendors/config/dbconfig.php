<?php
$hostname = 'localhost';
$usernameDB = 'root';
$passwordDB = '';
$dbname = 'userAccount';
//Create connection to mysql database
$conn = new mysqli($hostname, $usernameDB, $passwordDB, $dbname);