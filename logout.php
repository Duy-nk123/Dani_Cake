<?php
session_start();
$_SESSION["online"] = "";
header("location:index.php");
