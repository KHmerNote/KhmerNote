<!DOCTYPE html>
<html>
<head>
    <title>Register New Account</title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../public/css/StyleLogin.css">
</head>
<body>
<div id="wrapper1">
    <form enctype="multipart/form-data" name="registerForm" method="post" action="processRegister.php" id="login" class="front box">
        <div class="default"><i class="icon-briefcase"></i><h1>Press Register</h1></div>
        <input type="text" placeholder="username" name="username" autocomplete="off" required/>
        <input type="password" placeholder="password" name="password" id="password" autocomplete="off" required/>
        <input type="password" placeholder="confirm password" name="confirm_password" id="confirm_password" autocomplete="off" required/>
        <select name="gender" id="gender" required>
            <option value="">Sex</option>
            <option value="female">&nbsp;&nbsp;Female</option>
            <option value="male">&nbsp;&nbsp;Male</option>
        </select>
        <label for="name" class="btn" style="text-align: left;">Select a profile image</label>
        <input type="file" id="name" name="photo" style="visibility:hidden;">
        <button type="submit" class="login" name="submit" id="submit"><i class="icon-ok"></i></button>
        <a href="../index.php" style="margin-top: 20px; float: right;">I have an account</a>
    </form>
</div>
<script>
    var password = document.getElementById("password")
        , confirm_password = document.getElementById("confirm_password");

    function validatePassword(){
        if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords not confirmed");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>
<!--<script>
    var numUser = 0;
    numUser =
<?php
/*if (isset($_POST['username'])) {
    $username = $_POST['username'];
    require_once('../vendors/config/dbconfig.php');
    $sqlTest = "select * from users where username='$username'";
    $result = $conn->query($sqlTest);
//    echo $result->num_rows;
    if ($result->num_rows > 0) {
        echo $result->num_rows;
    }
}
*/?>;
    if (numUser > 0){
        var username = document.getElementById('username');
        function validateUsername(){
            username.setCustomValidity('This username existed!');
        }
        username.onkeyup = validateUsername;
    }
    alert("khos");
</script>-->
<script type="text/javascript" src="../public/vendors/jquery/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../public/vendors/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>