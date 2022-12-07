<table id="Content_ID">
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
    $sql = "SELECT product.ID,product.Name as Name1,product.Price, product.Quantity, product.Image, product.Descrip, catalog.Name as Name2 FROM product,catalog WHERE product.Catalog_ID=catalog.ID ORDER BY product.ID";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <tr>
            <td><?php echo $row["ID"]; ?></td>
            <td><?php echo $row["Name2"]; ?></td>
            <td><?php echo $row["Name1"]; ?></td>
            <td><?php echo number_format($row["Price"], 0, ",", "."); ?></td>
            <td><?php echo $row["Quantity"]; ?></td>
            <td> <img class="simg" src="<?php echo $row["Image"]; ?>" alt=""></td>
            <td><?php echo $row["Descrip"]; ?></td>
            <td><a href="update_cake.php?ID=<?php echo $row['ID']; ?>">Sửa</a> |<a id="btxoa" href="del_cake.php?ID=<?php echo $row['ID']; ?>" onclick="return confirm('Are you sure you want to delete?')"> Xóa </a> </td>
        </tr>
    <?php
    }
    ?>
</table>