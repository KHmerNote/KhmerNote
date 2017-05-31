<?php
define("HOST_NAME", "localhost");
define("USER_NAME", "root");
define("PASSWORD", "");
define("DB_NAME", "note_taking");

$connect = new mysqli(HOST_NAME, USER_NAME, PASSWORD, DB_NAME);
$id = $_POST["id"];
$text = $_POST["text"];
$column_name = $_POST["column_name"];
$sql = "UPDATE note SET ".$column_name."='".$text."' WHERE id='".$id."'";
if(mysqli_query($connect, $sql))
{
    echo 'Data Updated';
}
?>