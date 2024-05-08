<?php
session_start(); // start (or resume) session

if (! isset($_SESSION["username"])) {
  header("Location: login.php?redirect=".$_SERVER["PHP_SELF"]);
}