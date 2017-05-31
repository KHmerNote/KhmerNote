<?php
session_start();
if(isset($_COOKIE['username'])){
    header('Location: index.php');
}

define("HOST_NAME", "localhost");
define("USER_NAME", "root");
define("PASSWORD", "");
define("DB_NAME", "note_taking");

$connect = new mysqli(HOST_NAME, USER_NAME, PASSWORD, DB_NAME);

$username = $_SESSION['username'];

if(isset($_POST["query"]))
{
    $search = mysqli_real_escape_string($connect, $_POST["query"]);
    $query = "SELECT * FROM note WHERE title LIKE '%".$search."%' AND username='$username'";
}
else
{
    $query = "SELECT * FROM note WHERE username='$username' ORDER BY id DESC";
}
$result = $connect->query($query);
if(mysqli_num_rows($result) > 0)
{
    while($row = $result->fetch_object()){
        $i = $row->id % 5 + 1;
        switch ($i){
            case 1:
                echo "<div class='panel panel-primary'>";
                break;
            case 2:
                echo "<div class='panel panel-success'>";
                break;
            case 3:
                echo "<div class='panel panel-info'>";
                break;
            case 4:
                echo "<div class='panel panel-warning'>";
                break;
            case 5:
                echo "<div class='panel panel-danger'>";
                break;
            }
        echo "<div class='panel-heading'>";
        echo "<strong>$row->title</strong></div>";
        echo "<div class='panel-body'><strong>Content: </strong>$row->content</div>";
        echo "<form>";
//        echo "<input class='active' type='hidden' name='btn_edit' value='$row->id'>";
        echo "<div class='delete'>
                <input type='hidden' name='edit' value='$row->id'>
                <a class='btn' data-toggle='modal' data-target='#note' data-whatever='@mdo' name='btn_edit'>Edit</a>";
        echo "<button class='btn glyphicon glyphicon-trash btn_delete' name='delete_btn' data-id3='$row->id' value='$row->id' style='margin-left: 10px;'></button></div>";
        echo "</form>";
        echo "<div class='panel-footer'><strong>Date: </strong><span class='date'>$row->dateEtTime</span></div>";
        echo "</div>";
    }
}
else
{
    echo "<div class='info'>";
    echo '<h2><center>Data Not Found</center></h2>';
    echo '</div>';
}

?>