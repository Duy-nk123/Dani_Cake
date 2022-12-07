
    <?php
    require "connect.php";
    if (isset($_GET["ID"])) {
        $ID = $_GET["ID"];
        $sql = "DELETE FROM product WHERE  ID =' $ID'";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        if ($result) {
            echo "<script>
           var confirm = confirm('Xóa thành công');
           if (confirm) {
               window.location.href='ad_cake.php';
           }
       </script>";
        }
    }
    ?>