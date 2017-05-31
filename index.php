<?php
if(isset($_COOKIE['username'])){
    session_start();
    $_SESSION['username'] = $_COOKIE['username'];
    header('Location: loged_in.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="public/css/styleLogin.css">
</head>
<body>
<div id="wrapper">
    <form role="form" name="loginForm" method="post" action="pages/postLogin.php" id="login" class="front box">
        <div class="default"><i class="icon-briefcase"></i><h1>Press login</h1></div>
        <input type="text" placeholder="username" name="username" autocomplete="off" required/>
        <input type="password" placeholder="password" name="password" autocomplete="off" required/>
        <button type="submit" class="login"><i class="icon-ok"></i></button>
        <a href="pages/singup.php" style="margin-top: 20px; float: right;">Register New Account</a>
    </form>
</div>
<script type="text/javascript" src="/public/vendors/jquery/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="/public/vendors/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>