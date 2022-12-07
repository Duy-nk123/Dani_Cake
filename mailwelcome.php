<?php
if (isset($_GET["ID"]))
    $ID = $_GET["ID"];
require 'connect.php';
$sql = "SELECT Email FROM account WHERE ID ='$ID'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'sn9920021@gmail.com';
$mail->Password = 'gycxywxgpyvtcyal';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('sn9920021@gmail.com', 'Dani Cake');
$mail->addReplyTo('sn9920021@gmail.com', 'Dani Cake');

$mail->addAddress($row['Email']);

$mail->isHTML(true);

$mail->Subject = 'Welcome to Dani Cake ^^ ';

$bodyContent = '<table border="1" align="center" ><tbody>
<tr>
<td>
<p align="left">Xin chào</p>
<p align="left">Cám ơn bạn đã đăng kí sử dụng Dani Cake</p>
<p align="left">Chúc bạn có những phút giây mua sắm vui vẻ và chọn được cho mình những sản phẩm thích hợp</p>
<p align="center" ><a  href="localhost/admin_function/index.php"><input type="button" value="Bấm vào đây để di chuyển tới trang chủ" ></a><p>

</td>
</tr>
</tbody></table>';
$bodyContent .= '';
$mail->Body    = $bodyContent;
if (!$mail->send()) {
    $deleteSql = "DELETE FROM account WHERE ID ='$ID'";
    $deleteQuery = mysqli_query($conn, $deleteSql);
    if ($deleteQuery)
        echo "<script>window.location.href='index.php';</script>";
} else {
    echo "<script> window.location.href='index.php';</script>";
}
