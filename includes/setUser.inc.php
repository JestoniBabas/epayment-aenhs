<?php

require '../model/Users.php';

$uid = $_POST['uid'];
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$uname = $_POST['uname'];
$utype = $_POST['utype'];
$pwd = $_POST['pwd'];
$section = $_POST['section'];
$avatar = $_FILES['pic']['name'];

$db = new Users();

$db->setUser($uid, $fullname, $email, $uname, $pwd, $utype, $section, $avatar);

header("Location:../controllers/preview_user.php?uid=$uid");
