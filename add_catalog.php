<?php
require "connect.php";
session_start();


if (isset($_POST["addcata"])) {
    $name = $_POST["name"];


    $sql = "SELECT * FROM catalog WHERE Name = '$name' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $count = mysqli_num_rows($result);
    if ($count != 0) {
        echo '<script>alert("Danh mục sản phẩm này đã tồn tại ")</script>';
    } else {
        $sql2 = "INSERT INTO catalog VALUES ('','$name')";
        $result2 = mysqli_query($conn, $sql2);
        header('location:ad_catalog.php?ID=' . $ID);
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
                    <li><a href="ad_user.php"><i class='bx bx-user'></i>User</a></li>
                    <li><a href="ad_catalog.php"><i class='bx bx-food-menu'></i>Catalog</a></li>
                    <li class="choose"><a href="ad_cake.php"><i class='bx bx-cake'></i>Cake</a></li>
                    <li><a href="ad_orders.php"><i class='bx bx-cart'></i>Orders</a></li>
                    <li><a href="logout.php"><i class='bx bx-log-out'></i>Logout</a></li>
                </ul>
            </div>
            <div class="content">
                <h1>Thêm danh mục sản phẩm !!!</h1>
                <div class="form">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="name">Tên Danh Mục</label>
                        <input type="text" id="name" name="name" required>
                        <br>
                        <br><input class="btn" type="submit" id="addcata" name="addcata" value=" Thêm ">
                        <input class="btn" type="button" onclick="location.href='ad_catalog.php'" id="submit" name="submit" value=" Quay Lại ">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>