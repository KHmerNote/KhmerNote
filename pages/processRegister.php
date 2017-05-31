<?php
require_once ('../vendors/config/dbconfig.php');
if(isset($_POST['username']) && $_POST['username']!= ''){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sex = $_POST['gender'];
    $photo = '';

    if(filesize($_FILES['photo']['tmp_name'])>0){
        $uploadDir = "upload/";
        $fileTmpName = $_FILES['photo']['tmp_name'];
        $fileExtension = pathinfo($_FILES['photo']['name'])['extension'];
        $fileName = time().".$fileExtension";
        $target = $uploadDir.$fileName;
        $fileSize = filesize($fileTmpName);
        //if file is bigger than 5M, reject the file
        if($fileSize <= 5242880){
            if(in_array($fileExtension, ['jpg', 'JPG', 'png', 'PNG'])){
                if(move_uploaded_file($fileTmpName, $target)){
                    $photo = $target;
                }else{
                    echo "can't upload";
                }
            }else{
                echo "Only jpg/png are allowed";
            }
        }else{
            echo "File is bigger thant 5M - file size is ".number_format($fileSize/1024/1024, 2)."MB";
        }
    }else{
        $target = "../public/img/".$sex.".jpg";
        $photo = $target;
    }

    require_once ('salt.php');
    $password = crypt($password, KEY_SALT);
    $sqlTest = "select * from users where username='$username'";
    $result = $conn->query($sqlTest);
    if($result->num_rows == 0){
        $sql = "insert into users (username, sex, password, photo) values ('$username', '$sex', '$password', '$photo')";
        $result = $conn->query($sql);
        if($result){
            header('Location: ../index.php');
        }else{
//            echo "khos";
            header('Location: singup.php');
        }
    }else{
//        echo "have";
        header("Location: singup.php");
    }
}else{
    header('Location: singup.php');
}?>