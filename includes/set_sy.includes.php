<?php

require '../model/Dbh.php';
require '../model/Settings.php';

$sy = $_POST['sy'];

$db = new Settings();

$db->sy($sy);
