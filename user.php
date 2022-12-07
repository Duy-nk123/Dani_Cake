<?php
require "connect.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Trang của người dùng</h1>
    <a href="index.php"></a>
    <input type="button" onclick="location.href='logout.php'" class="user-btn" value="Đăng Xuất">

</body>

</html>