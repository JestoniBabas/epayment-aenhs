<?php
require '../model/Users.php';

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$uname = $_POST['uname'];
$pwd = $_POST['pwd'];
$utype = $_POST['utype'];
$section = $_POST['section'];
$avatar = "avatar.png";

$user = new Users();


$user->createUser($fullname, $email, $uname, $pwd, $utype, $section, $avatar);

header("Location:../controllers/add_user_account.php?signup=success");



