<?php
require "connect.php";
session_start();

//$sessionSql="SELECT Status FROM user WHERE ID=".$_SESSION["online"];
//$sessionResult=mysqli_query($conn,$sessionResult);
//$sessionRow=mysqli_fetch_array($sessionResult);

if (isset($_POST["adduser"])) {
    $Username = $_POST["username"];
    $Email = $_POST["email"];
    $pass = $_POST["password1"];

    $sql = "SELECT * FROM account WHERE Username = '$Username' OR Email='$Email' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $count = mysqli_num_rows($result);
    if ($count != 0) {
        echo '<script>alert("Tên tài khoản hoặc email đã được đăng ký")</script>';
    } else {
        $sql2 = "INSERT INTO account VALUES ('','$Username','$pass',0,'','$Email','','')";
        $result2 = mysqli_query($conn, $sql2);
        header('location:ad_user.php?ID=' . $ID);
        // $sql3 = "SELECT ID FROM user WHERE Email='$Email' ";
        // $result3 = mysqli_query($conn, $sql3);
        // $row3 = mysqli_fetch_array($result3);
        // $ID = $row3['ID'];
        // header('location:confirmActive.php?ID=' . $ID);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm tài khoản trực tiếp bởi Admin !!!</title>
    <link rel="stylesheet" href="./CSS/slidebar.css">
    <link rel="stylesheet" href="./CSS/content.css">
</head>

<body>
    <div class="page">
        <div class="container">
            <div class="slidebar">
                <header><a href="admin.php" style="color: white;">Dashboard</a></header>
                <ul>
                    <li class="choose"><a href="ad_user.php"><i class='bx bx-user'></i>User</a></li>
                    <li><a href="ad_catalog.php"><i class='bx bx-food-menu'></i>Catalog</a></li>
                    <li><a href="ad_cake.php"><i class='bx bx-cake'></i>Cake</a></li>
                    <li><a href="ad_orders.php"><i class='bx bx-cart'></i>Orders</a></li>
                    <li><a href="logout.php"><i class='bx bx-log-out'></i>Logout</a></li>
                </ul>
            </div>
            <div class="content">
                <h1>Thêm tài khoản trực tiếp bởi Admin !!!</h1>
                <div class="form">
                    <form action="" method="POST">
                        <label for="username">Tên Tài Khoản</label>
                        <input type="text" id="username" name="username" required>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                        <label for="password1">Mật Khẩu</label>
                        <input type="password" name="password1" id="password1" required>
                        <br>
                        <br><input class="btn" type="submit" id="adduser" name="adduser" value=" Thêm ">
                        <input class="btn" type="button" onclick="location.href='ad_user.php'" id="submit" name="submit" value=" Quay Lại ">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>