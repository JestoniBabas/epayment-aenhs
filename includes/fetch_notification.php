<?php
session_start();
require '../model/Dbh.php';
require '../model/Notifications.php';

$notifications = new Notifications();

$notifications->fetch_notif_counter($_SESSION['uid']);
