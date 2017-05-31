<?php
define("HOST_NAME", "localhost");
define("USER_NAME", "root");
define("PASSWORD", "");
define("DB_NAME", "note_taking");

$connect = new mysqli(HOST_NAME, USER_NAME, PASSWORD, DB_NAME);
//2001-01-14 08:45
date_default_timezone_set("Asia/Bangkok");
$dateEtTime = date("Y-m-d h:i:s");
$sql = "INSERT INTO note(title, content, dateEtTime, username)
      VALUES('".$_POST["title"]."', '".$_POST["content"]."', '".$dateEtTime."', '".$_POST['username']."')";
if(mysqli_query($connect, $sql))
{
    echo 'Data Inserted';
}
