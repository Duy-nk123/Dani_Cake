<table id="Content_ID">
    <tr>
        <th>ID</td>
        <th>Name</td>
        <th><a href="add_catalog.php">Thêm</a></th>
    </tr>
    <?php
    $sql = "SELECT * FROM catalog";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <tr>
            <td><?php echo $row["ID"]; ?></td>
            <td><?php echo $row["Name"]; ?></td>
            <td><a id="btxoa" href="del_catalog.php?ID=<?php echo $row['ID']; ?>" onclick="return confirm('Are you sure you want to delete?')"> Xóa </a> </td>
        </tr>
    <?php
    }
    ?>
</table>