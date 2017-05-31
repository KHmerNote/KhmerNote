<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../public/css/StyleProfile.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<h2 style="text-align:center">User Profile</h2>

<div class="card">
    <?php
    $username = $_SESSION['username'];
    require_once ('../vendors/config/dbconfig.php');
    $sql = "select * from users where username='$username'";
    $result = $conn->query($sql);
    $row = $result->fetch_object();
//        echo "<div class=\"container\">
        echo "<div>
                <div class=\"hovereffect\">";
        echo "<img class='img img-responsive full-width' src='$row->photo' alt='$row->username'>";
        echo "<div class=\"overlay1\">
            <h2>$row->username</h2>
            <form action='updateProfile.php' enctype='multipart/form-data' method='post' id='updatePro'>
                <input type='hidden' value=$row->id id='userId' name='userId'>
                <input type='file' name='photo' style='visibility: hidden;' id='newPhoto'>
                <label for='newPhoto' class='info btn' style='text-align: center;'>Select a new profile image</label>
            </form>
            </div>
            </div>";
//        echo "<div class='container'>";
        echo "<h1 style='text-transform: uppercase;'>$row->username</h1>";
        echo "<p class='title'>useraccount</p>";
        echo "<p><a class='btn btn-primary' href=\"../loged_in.php\" name='btn' id='btn'>Return</a></p>";
        echo "<p><a class='btn btn-primary' href=\"Logout.php\" name='btn' id='btn'>Logout</a></p>
                <p>@KH-note</p>";
        echo "</div>";
//    }
    ?>
<!--    <img src="../public/img/male.jpg" alt="John" style="width:100%;">-->
</div>
<script>
    $(document).ready(function(){
        $('#updatePro').on('change', "input#newPhoto", function (e) {
            e.preventDefault();
            $("#updatePro").submit();
        });
    });
</script>
</body>
</html>

<?php
/**
 * Created by PhpStorm.
 * User: puthn
 * Date: 5/23/2017
 * Time: 9:05 PM
 */