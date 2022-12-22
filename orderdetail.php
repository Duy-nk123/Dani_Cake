<?php
include_once 'db.php';
session_start();

if (isset($_GET["ID"])) {
    $ID = $_GET["ID"];
    $sql = "SELECT * FROM orders WHERE id = ".$ID ;
   
    $result =query($sql);
} else {
    $ID = $_SESSION['online'];
    $sql = "SELECT * FROM orders WHERE id = " . $_SESSION['online'];
    $result =query($sql);
}
if (isset($_POST['updateorder'])) {
    $Status = $_POST["status"];
    $sql = "UPDATE orders SET Status='$Status' WHERE id=" . $ID;
    $result1 = query($sql);
    if ($result1) {
        echo "<script type='text/javascript'>alert('Sửa thành công!')</script>";
        header("location:orderdetail.php?ID=" . $ID);
    } else {
        echo "Failed";
    }
}
    
    foreach ($result as $rows){
        
        
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./CSS/slidebar.css">
    <link rel="stylesheet" href="./CSS/content.css">
</head>

<body>
    <div class="content">
        <h1>Chi Tiết Đơn Hàng !!!</h1>
        <div class="form" style="max-width:30%">
            <form action="" method="POST">
                <label for="username">Tên Người Nhận Hàng</label>
                <input value="<?php echo $rows[3]; ?>" readonly>
                <label for="username">Địa Chỉ</label>
                <input value="<?php echo $rows[5]; ?>" readonly>
                <label for="username">Số Điện Thoại</label>
                <input value="<?php echo $rows[6]; ?>" readonly>
                <label for="username">Ghi Chú</label>
                <input value="<?php echo $rows[7]; ?>" readonly>
                <label for="catalog">Trạng Thái Đơn Hàng</label>
                <select name="status" id="status">
                    <?php
                    if ($rows[9] == 0) {
                        echo "<option selected value='0'>Chưa Xử Lý</option>";
                    } else {
                        echo "<option value='0'>Chưa Xử Lý</option>";
                    }
                    if ($rows[9] == 1) {
                        echo "<option selected value='1'>Đang Giao</option>";
                    } else {
                        echo "<option value='1'>Đang Giao</option>";
                    }
                    if ($rows[9] == 2) {
                        echo "<option selected value='2'>Đã Giao</option>";
                    } else {
                        echo "<option value='2'>Đã Giao </option>";
                    }
                    if ($rows[9] == 3) {
                        echo "<option selected value='3'>Đã Hủy/option>";
                    } else {
                        echo "<option value='3'>Đã Hủy</option>";
                    }
                }
                    ?>
                </select>
                <br>
                <br><input class="btn" type="submit" id="updateorder" name="updateorder" value=" Cập Nhật ">
                <input class="btn" type="button" onclick="location.href='ad_orders.php'" id="submit" name="submit" value=" Quay Lại ">
            </form>
        </div>
        <div class="infor">
            <table id="Content_ID">
                <tr>
                    <th>Tên Sản Phẩm</td>
                    <th>Số Lượng</td>
                    <th>Giá</td>
                </tr>
                <?php
               // $sql = "SELECT product.Name,order_detail.Quantity,order_detail.Price,orders.Total FROM product,orders,order_detail WHERE orders.ID=order_detail.Order_ID AND order_detail.Product_ID = product.ID  ORDER BY order_detail.Product_ID";
               $sql = "SELECT product.Name,order_detail.pro_number,order_detail.pro_price,.orders.total FROM product,orders,order_detail WHERE orders.id=order_detail.order_id AND order_detail.pro_id=product.ID AND orders.id= ".$ID." ORDER BY order_detail.pro_id;";
               $result = query($sql);
               echo $sql;
                foreach ($result as $row) {
                ?>
                    <tr>
                        <td><?php echo $row[0]; ?></td>
                        <td><?php echo $row[1]; ?></td>
                        <td><?php echo number_format($row[2], 0, ",", "."); ?></td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td>Tổng tiền :</td>
                    <td><?php echo $row[3]; ?></td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>