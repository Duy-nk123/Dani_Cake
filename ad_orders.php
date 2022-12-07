<?php
require "db.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./CSS/slidebar.css">
    <link rel="stylesheet" href="./CSS/content.css">
</head>

<body>
    <div class="container">
        <div class="slidebar">
            <header><a href="admin.php" style="color: white;">Dashboard</a></header>
            <ul>
                <li><a href="ad_user.php"><i class='bx bx-user'></i>User</a></li>
                <li><a href="ad_catalog.php"><i class='bx bx-food-menu'></i>Catalog</a></li>
                <li><a href="ad_cake.php"><i class='bx bx-cake'></i>Cake</a></li>
                <li class="choose"><a href="ad_orders.php"><i class='bx bx-cart'></i>Orders</a></li>
                <li><a href="logout.php"><i class='bx bx-log-out'></i>Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <h1>Quản Lý Đơn Hàng</h1>
            <div class="search">
                <form action="" method="POST">
                    <input type="text" name="searchbar" placeholder="Tên Người Nhận">
                    <select name="cbostt" id="cbostt">
                        <option value="">Tất Cả</option>
                        <option value="0">Chưa Xử Lý</option>
                        <option value="1">Đang Giao</option>
                        <option value="2">Đã Giao</option>
                        <option value="3">Đã Hủy</option>
                    </select>
                    <input class="btn" type="submit" value=" Tìm kiếm " name="search">
                    <input class="btn" type="button" onclick="tableToExcel('Content_ID')" value="Xuất ra excel">
                </form>
            </div>
            <?php
            if (isset($_POST["search"])) {
                $s = $_POST["searchbar"];
                $stt = $_POST["cbostt"];
                if ($s == '' && $stt == '') {
                    $sql = "SELECT * FROM orders ";
                } elseif ($s == '' && $stt != '') {
                    $sql = "SELECT * FROM orders WHERE Status = $stt ";
                } elseif ($s != '' && $stt == '') {
                    $sql = "SELECT * FROM orders WHERE Name like '%$s%' ";
                } else $sql = "SELECT * FROM orders WHERE Name like '%$s%' AND Status = $stt";
                $result = query($sql);
                $count = count($result);
               // echo $sql;
                if ($count <= 0) {
                    echo "<br>Không tìm thấy kết quả phù hợp <br> <br>";
                    echo "<a class='btn' href='ad_orders.php';>Refesh  </a>";
                } else {
                    echo "Tìm thấy " . $count . " kết quả : ";
            ?>
                    <form action="" method="POST">
                        <table id="Content_ID">
                            <tbody>
                                <tr>
                                    <th>ID</td>
                                    <th>Tên Người Nhận</td>
                                    <th>Địa Chỉ</td>
                                    <th>Số Điện Thoại</td>
                                    <th>Thời Gian Đặt Hàng</td>
                                    <th>Trạng Thái</td>
                                    <th>Thao Tác</td>
                                </tr>
                                <?php
                                foreach ($result as $row) {
                                ?>
                                    <tr>
                                        <td><?php echo $row[0]; ?></td>
                                        <td><?php echo $row[3]; ?></td>
                                        <td><?php echo $row[5]; ?></td>
                                        <td><?php echo $row[8]; ?></td>
                                        <td><?php echo $row[6]; ?></td>
                                        <td><?php switch ($row[9]) {
                                                case 0:
                                                    echo "Chưa Xử Lý";
                                                    break;
                                                case 1:
                                                    echo "Đang Giao";
                                                    break;
                                                case 2:
                                                    echo "Đã Giao";
                                                    break;
                                                    break;
                                                case 3:
                                                    echo "Đã Hủy";
                                                    break;
                                                default:
                                                    break;
                                            }
                                            ?></td>
                                        <td>
                                            <a href="orderdetail.php?ID=<?php echo $row[0]; ?>" target="_blank">Chi tiết / </a>
                                            <a href="order_print.php?ID=<?php echo $row[0]; ?>" target="_blank">Xuất Đơn</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                <?php echo "<a class='btn' href='ad_orders.php';> Refesh  </a>";
                }
            } else require "showorders.php"; ?>
        </div>
    </div>
    <script type="text/javascript">
        var tableToExcel = (function() {
            var uri = 'data:application/vnd.ms-excel;base64,',
                template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http:www.w3.org/TR/REC-html40"><meta http-equiv="content-type" content="application/vnd.ms-excel; charset=UTF-8"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>',
                base64 = function(s) {
                    return window.btoa(unescape(encodeURIComponent(s)))
                },
                format = function(s, c) {
                    return s.replace(/{(\w+)}/g, function(m, p) {
                        return c[p];
                    })
                }
            return function(table, name) {
                if (!table.nodeType) table = document.getElementById(table)
                var ctx = {
                    worksheet: name || 'Worksheet',
                    table: table.innerHTML
                }
                window.location.href = uri + base64(format(template, ctx))
            }
        })()
    </script>

</body>

</html>