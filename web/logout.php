<?php
session_start();
session_destroy();
$location = "select_op.php";
header("Location: ".$location);