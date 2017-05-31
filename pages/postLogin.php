<?php
if(isset($_POST['username']) && $_POST['username']!= ''){
    $username = $_POST['username'];
    $password = $_POST['password'];

    require_once ('../vendors/config/dbconfig.php');

    require_once('salt.php');
    $password = crypt($password, KEY_SALT);
    $sql = "select * from users where username='$username' and password='$password'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_object();
        $id = $row->id;
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $id;
//        if($_POST['rememberMe'] == 'r'){
//            setcookie('id', $id, time()+60*60*24);
//            setcookie('username', $username, time()+60*60*24);
//        }
        header('Location: ../loged_in.php');
//        echo "trov";
    }else{
        header('Location: ../index.php');
//        echo "khos";
    }
}else{
    header('Location: ../index.php');
}
?>