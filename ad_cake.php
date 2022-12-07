<?php
require "connect.php";
include_once 'db.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake</title>
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
                <li class="choose"><a href="ad_cake.php"><i class='bx bx-cake'></i>Cake</a></li>
                <li><a href="ad_orders.php"><i class='bx bx-cart'></i>Orders</a></li>
                <li><a href="logout.php"><i class='bx bx-log-out'></i>Logout</a></li>
            </ul>
        </div>
        <div class="content">
            <h1>Quản Lý Sản Phẩm</h1>
            <div class="search">
                <form action="" method="POST">
                    <input type="text" name="searchbar" placeholder="Tên Sản Phẩm....">
                    <select name="cboCata" id="cboCata">

                        <?php
                        // $conn = mysqli_connect("localhost", "root", "", "bakery");
                        // if (!$conn) {
                        //     echo "Ket noi khong thanh cong";
                        //     exit();
                        // } else {
                        //     $sql2 = "select * from catalog";
                        //     $result2 = mysqli_query($conn, $sql2);
                        //     if (mysqli_num_rows($result2) > 0) {
                        //         echo "<option value = ''> Tất cả </option>";
                        //         while ($row = mysqli_fetch_assoc($result2)) {
                        //             echo "<option value = '" . $row["ID"] . "'>" . $row["Name"] . "</option>";
                        //         }
                        //     }
                        // }

                        $sql = "Select * From catalog";
                            $r = query($sql);
                            for($i=0; $i<count($r); $i++)
                            {
                            ?>
                        <option value="<?=$r[$i][0]?>"><?=$r[$i][1]?></option>
                                
                            <?php } ?>
                    </select>
                    <input class="btn" type="submit" value="Tìm kiếm" name="search">
                    <input class="btn" type="button" onclick="tableToExcel('Content_ID')" value="Xuất ra excel">
                </form>
            </div>
            <?php
            if (isset($_POST["search"])) {
                $s = $_POST["searchbar"];
                $Cata = $_POST["cboCata"];

                if ($s == '' && $Cata == '') {
                    $sql = "SELECT product.ID ,product.Name as Name1,product.Price, product.Quantity, product.Image, product.Descrip, catalog.Name as Name2 FROM product,catalog WHERE product.Catalog_ID=catalog.ID  ORDER BY product.ID";
                } elseif ($s == '' && $Cata != '') {
                    $sql = "SELECT product.ID ,product.Name as Name1,product.Price, product.Quantity, product.Image, product.Descrip, catalog.Name as Name2 FROM product,catalog WHERE product.Catalog_ID=catalog.ID and catalog.ID = $Cata ORDER BY product.ID";
                } elseif ($s != '' && $Cata != '') {
                    $sql = "SELECT product.ID ,product.Name as Name1,product.Price, product.Quantity, product.Image, product.Descrip, catalog.Name as Name2 FROM product,catalog WHERE (product.Name LIKE '%$s%' AND product.Catalog_ID = $Cata) AND product.Catalog_ID=catalog.ID ORDER BY product.ID";
                } else {
                    $sql = "SELECT product.ID ,product.Name as Name1,product.Price, product.Quantity, product.Image, product.Descrip, catalog.Name as Name2 FROM product,catalog WHERE  product.Name LIKE '%$s%' AND product.Catalog_ID=catalog.ID  ORDER BY product.ID";
                }
                //echo $sql;
                $result = query( $sql);
                $count = count($result);
                if ($count <= 0) {
                    echo "<br>Không tìm thấy kết quả phù hợp <br> <br>";
                    echo "<a href='ad_cake.php';>Refesh  </a>";
                } else {
                    echo "Tìm thấy " . $count . " kết quả : ";
            ?>
                    <form action="" method="POST">
                        <table id="Content_ID">
                            <tbody>
                                <tr>
                                    <th>ID</td>
                                    <th>Catalog</td>
                                    <th>Name</td>
                                    <th>Price</td>
                                    <th>Quantity</td>
                                    <th>Image</td>
                                    <th>Descrip</td>
                                    <th><a href="add_cake.php">Thêm</a></th>
                                </tr>
                                <?php
                               foreach ($result as $row) {
                                ?>
                                    <tr>
                                        <td><?php echo $row[0]; ?></td>
                                        <td><?php echo $row[6]; ?></td>
                                        <td><?php echo $row[1]; ?></td>
                                        <td><?php echo number_format($row[2], 0, ",", "."); ?></td>
                                        <td><?php echo $row[3]; ?></td>
                                        <td> <img class="simg" src="<?php echo $row[4]; ?>" alt=""></td>
                                        <td><?php echo $row[5]; ?></td>
                                        <td><a href="update_cake.php?ID=<?php echo $row[0]; ?>">Sửa</a> |<a href="del_cake.php?ID=<?php echo $row[0]; ?>" onclick="return confirm('Are you sure you want to delete?')"> Xóa </a> </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                <?php echo "<a class='btn' href='ad_cake.php';>Refesh  </a>";
                }
            } else require "showcake.php"; ?>
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