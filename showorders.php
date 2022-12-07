<?php include_once 'db.php' ?>
<table id="Content_ID">
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
    // $sql = "SELECT user.ID,user.Username,user.Password, user.Email, user.Status, user.Fullname, user.Birthday, user.Gender, User.Address, class.Class_name FROM user,class WHERE user.Class_id=class.ID ORDER BY user.ID";
    $sql = "SELECT * FROM orders";
    $result = query($sql);
    foreach ($result as $row) {
    ?>
        <tr>
        <tr>
            <td><?php echo $row[0] ?></td>
            <td><?php echo $row[3] ?></td>
            <td><?php echo $row[5]?></td>
            <td><?php echo $row[6] ?></td>
            <td><?php echo $row[8]?></td>
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
    <?php
    }
    ?>
</table>