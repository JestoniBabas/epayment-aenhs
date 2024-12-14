<?php
session_start();
require '../model/Users.php';
require '../model/Settings.php';

$email = $_POST['email'];
$pwd = $_POST['pwd'];

//get pwd to log in vie email input 

$user = new Users();

$userPwd = $user->loginEmail($email);


//verify pwd

 if(password_verify($pwd, $userPwd['pwd'])){

    $_SESSION['uid'] = $userPwd['uid'];
    $_SESSION['fullname'] = $userPwd['fullname'];
    $_SESSION['email'] = $userPwd['email'];
    $_SESSION['uname'] = $userPwd['uname'];
    $_SESSION['utype'] = $userPwd['utype'];
    $_SESSION['section'] = $userPwd['section'];
    $_SESSION['avatar'] = $userPwd['avatar'];


    header("Location:../index.php?login=success");


} else {
    header("Location:../index.php?login=failed");
}





