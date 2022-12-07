<?php
require "connect.php";
session_start();

if (isset($_GET["ID"])) {
    $ID = $_GET["ID"];
    $sql = "SELECT * FROM account WHERE ID = '$ID'";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);
} else {
    $ID = $_SESSION['online'];
    $sql = "SELECT * FROM account WHERE ID = " . $_SESSION['online'];
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);
}
if (isset($_POST['updateuser'])) {
    $Username = $_POST["username"];
    $Fullname = $_POST["fullname"];
    $Password = $_POST["password"];
    $Role = $_POST["role"];
    $Address = $_POST["address"];
    $Email = $_POST["email"];
    $Phone = $_POST["phone"];

    $sql = "UPDATE account SET Fullname='$Fullname',Email='$Email', Address='$Address' ,Username='$Username', Password='$Password', Role='$Role', Phone ='$Phone' WHERE ID=" . $ID;
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script type='text/javascript'>alert('Sửa thành công!')</script>";
        header("location:ad_user.php");
    } else {
        echo "Failed";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa đổi thông tin tài khoản trực tiếp bởi Admin !!!</title>
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
                    <li><a href="ad_orders.php"><i class='bx bx-cart'></i>Cart</a></li>
                    <li><a href="logout.php"><i class='bx bx-log-out'></i>Logout</a></li>
                </ul>
            </div>
            <div class="content">
                <h1>Sửa đổi thông tin tài khoản trực tiếp bởi Admin !!!</h1>
                <div class="form">
                    <form action="" method="POST">
                        <script>
                            function showPwd() {
                                var x = document.getElementById("password");
                                if (x.type === "password") {
                                    x.type = "text";
                                } else {
                                    x.type = "password";
                                }
                            }
                        </script>
                        <label for="username">Tên Tài Khoản</label>
                        <input type="text" id="username" name="username" value="<?php echo $rows['Username']; ?>" readonly>
                        <label for="password">Mật Khẩu</label>
                        <input type="password" name="password" id="password" value="<?php echo $rows['Password']; ?>" minlength="6" required>
                        <i onclick="showPwd()" style="user-select: none;font-size:12px"> Hiển thị mật khẩu </i>
                        <label for="role">Phân Quyền</label>
                        <input class="radio" type="radio" name="role" value="0" <?php if ($rows["Role"] == 0) echo "checked"; ?> /> Người Dùng <br /><br />
                        <input class="radio" type="radio" name="role" value="1" <?php if ($rows["Role"] == 1) echo "checked"; ?> /> Admin<br /><br />
                        <label for="fullname">Họ Tên</label>
                        <input type="text" id="fullname" name="fullname" value="<?php echo $rows['Fullname']; ?>" required>
                        <label for="email">Địa Chỉ Email</label>
                        <input type="text" id="email" name="email" value="<?php echo $rows['Email']; ?>" required>
                        <label for="phone">Số điện thoại</label>
                        <input type="text" id="phone" name="phone" value="<?php echo $rows['Phone']; ?>" minlength="10" required>
                        <label for="address">Địa chỉ</label>
                        <input type="text" id="address" name="address" value="<?php echo $rows['Address']; ?>" required>
                        <br>
                        <br><input class="btn" type="submit" id="updateuser" name="updateuser" value=" Thêm ">
                        <input class="btn" type="button" onclick="location.href='ad_user.php'" id="submit" name="submit" value=" Quay Lại ">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>