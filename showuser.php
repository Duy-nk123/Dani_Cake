<table id="Content_ID">
    <tr>
        <th>ID</td>
        <th>Username</td>
        <th>Password</td>
        <th>Role</td>
        <th>Fullname</td>
        <th>Email</td>
        <th>Phone</td>
        <th>Adress</td>
        <th><a href="add_user.php">Thêm</a></th>
    </tr>
    <?php
    // $sql = "SELECT user.ID,user.Username,user.Password, user.Email, user.Status, user.Fullname, user.Birthday, user.Gender, User.Address, class.Class_name FROM user,class WHERE user.Class_id=class.ID ORDER BY user.ID";
    $sql = "SELECT * FROM account";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <tr>
            <td><?php echo $row["ID"]; ?></td>
            <td><?php echo $row["Username"]; ?></td>
            <td><?php echo $row["Password"]; ?></td>
            <td><?php switch ($row["Role"]) {
                    case 0:
                        echo "Người Dùng";
                        break;
                    case 1:
                        echo "Admin";
                        break;
                    default:
                        break;
                }
                ?></td>
            <td><?php echo $row["Fullname"]; ?></td>
            <td><?php echo $row["Email"]; ?></td>
            <td><?php echo $row["Phone"]; ?></td>
            <td><?php echo $row["Address"]; ?></td>
            <td><a href="update_user.php?ID=<?php echo $row['ID']; ?>">Sửa</a> |<a id="btxoa" href="del_user.php?ID=<?php echo $row['ID']; ?>" onclick="return confirm('Are you sure you want to delete?')"> Xóa </a> </td>
        </tr>
    <?php
    }
    ?>
</table>