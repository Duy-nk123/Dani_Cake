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
    <title>Catalog</title>
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
                <li class="choose"><a href="ad_catalog.php"><i class='bx bx-food-menu'></i>Catalog</a></li>
                <li><a href="ad_cake.php"><i class='bx bx-cake'></i>Cake</a></li>
                <li><a href="ad_orders.php"><i class='bx bx-cart'></i>Orders</a></li>
                <li><a href="logout.php"><i class='bx bx-log-out'></i>Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <h1>Quản Lý Catalog</h1>
            <div class="search">
                <form action="" method="POST">
                    <input type="text" name="searchbar" placeholder="Name....">
                    <input class="btn" type="submit" value="Tìm kiếm" name="search">
                    <input class="btn" type="button" onclick="tableToExcel('Content_ID')" value="Xuất ra excel">
                </form>
            </div>
            <?php
            if (isset($_POST["search"])) {
                $s = $_POST["searchbar"];
                if ($s == '') $sql = "SELECT * FROM catalog ";
                else $sql = "SELECT * FROM catalog WHERE Name LIKE '%$s%'";
                $result = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($result);
                if ($count <= 0) {
                    echo "<br>Không tìm thấy kết quả phù hợp <br> <br>";
                    echo "<a href='adminset.php';>Refesh  </a>";
                } else {
                    echo "Tìm thấy " . $count . " kết quả : ";
            ?>
                    <form action="" method="POST">
                        <table id="Content_ID">
                            <tbody>
                                <tr>
                                    <th>ID</td>
                                    <th>Name</td>
                                    <th><a href="add_catalog.php">Thêm</a></th>
                                </tr>
                                <?php
                                while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row["ID"]; ?></td>
                                        <td><?php echo $row["Name"]; ?></td>
                                        <td><a id="btxoa" href="del_catalog.php" onclick="return confirm('Are you sure you want to delete?')"> Xóa </a> </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                <?php echo "<a href='ad_catalog.php';>Refesh  </a>";
                }
            } else require "showcatalog.php"; ?>
        </div>
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
    <script src="https:ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">
    </script>
</body>

</html>