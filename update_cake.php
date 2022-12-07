<?php
require "connect.php";
session_start();

if (isset($_GET["ID"])) {
    $ID = $_GET["ID"];
    $sql = "SELECT * FROM product WHERE ID = '$ID'";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);
} else {
    $ID = $_SESSION['online'];
    $sql = "SELECT * FROM product WHERE ID = " . $_SESSION['online'];
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_assoc($result);
}
if (isset($_POST["updatecake"])) {
    $catalog = $_POST["catalog"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $quan = $_POST["quantity"];
    $img = $_POST["image"];
    $des = $_POST["des"];

    $sql = "SELECT * FROM product WHERE Name = '$name' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $count = mysqli_num_rows($result);
    $specPicture = $_FILES['image']['name'];
    $specFileType = strtolower(pathinfo($specPicture, PATHINFO_EXTENSION));
    if ($specFileType != "jpg" && $specFileType != "png" && $specFileType != "jpeg" && $specFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $specImportOK = 1;
    } else {
        $SpecPath = "./IMG/" . $specPicture;
        move_uploaded_file($_FILES['image']['tmp_name'], $SpecPath);
    }
    if ($SpecPath != '') {
        $sql2 = "UPDATE product SET Catalog_ID='$catalog',Name='$name',Price=$price,Quantity='$quan',Image='$SpecPath',Descrip='$des' WHERE ID=" . $ID;
    } else {
        $sql2 = "UPDATE product SET Catalog_ID='$catalog',Name='$name',Price=$price,Quantity='$quan',Descrip='$des' WHERE ID=" . $ID;
    }
    $result2 = mysqli_query($conn, $sql2);
    echo '<script>alert("Sản phẩm này đã được thêm thành công")</script>';
    header('location:ad_cake.php?ID=' . $ID);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin sản phẩm !!!</title>
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
                <h1>Sửa thông tin sản phẩm !!!</h1>
                <div class="form">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="catalog">Loại Sản Phẩm</label>
                        <select name="catalog" id="catalog">
                            <?php
                            $conn = mysqli_connect("localhost", "root", "", "bakery");
                            $sql2 = "select * from catalog";
                            $result2 = mysqli_query($conn, $sql2);
                            if (mysqli_num_rows($result2) > 0) {
                                while ($row = mysqli_fetch_assoc($result2)) {
                                    $select = "";
                                    if ($rows['Catalog_ID'] == $row['ID']) $select = "selected";
                                    echo "<option " . $select . " value = '" . $row["ID"] . "' >" . $row['Name'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                        <label for="name">Tên Sản Phẩm</label>
                        <input type="text" id="name" name="name" value="<?php echo $rows['Name']; ?>" required>
                        <label for="price">Giá </label>
                        <input type="number" min="0" id="price" name="price" value="<?php echo $rows['Price']; ?>" required>
                        <label for="quantity">Số lượng </label>
                        <input type="number" min="0" id="quantity" name="quantity" value="<?php echo $rows['Quantity']; ?>" required>
                        <label for="image">Ảnh sản phẩm</label>
                        <input type="file" name="image" id="image">
                        <label for="des">Mô Tả Sản Phẩm</label>
                        <textarea type="text" id="des" name="des" rows="4" value="<?php echo $rows['Descrip']; ?>"> </textarea>
                        <br>
                        <br><input class="btn" type="submit" id="updatecake" name="updatecake" value=" Sửa ">
                        <input class="btn" type="button" onclick="location.href='ad_cake.php'" id="submit" name="submit" value=" Quay Lại ">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>