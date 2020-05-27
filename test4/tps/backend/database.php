<?php 
ini_set('default_charset', 'utf-8');

$servername = "localhost";
$dbname = "moodle";
$username = "moodle";
$password = "GotoXX64-";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND , 'SET NAMES "UTF8"');

$userId = (array_key_exists("userId", $_GET)) ? $_GET["userId"] : null;
$groupId = (array_key_exists("groupId", $_GET)) ? $_GET["groupId"] : null;
