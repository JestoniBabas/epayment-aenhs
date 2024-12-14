<?php

require '../model/Dbh.php';
require '../model/Settings.php';

$syid = $_POST['syid'];
$sy = $_POST['sy'];

$db = new Settings();

$db->edit_sy($syid, $sy);
