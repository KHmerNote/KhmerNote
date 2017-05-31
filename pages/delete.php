<?php
define("HOST_NAME", "localhost");
define("USER_NAME", "root");
define("PASSWORD", "");
define("DB_NAME", "note_taking");

$connect = new mysqli(HOST_NAME, USER_NAME, PASSWORD, DB_NAME);
$sql = "DELETE FROM note WHERE id = '".$_POST["id"]."'";
if(mysqli_query($connect, $sql))
{
    echo 'Data Deleted';
}
?>