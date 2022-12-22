 <?php
    ////////////////////////////////////////////////////////////////////////////
    // Kiểm tra SESSION + Login
    require "connect.php";
    session_start();
    error_reporting(E_ERROR | E_PARSE);
  
    if ($_SESSION['online'] == '') {
        if (isset($_POST['LGsubmit'])) {
            $tk = $_POST['LGusername'];
            $mk = $_POST['LGpassword'];
            $sql = "SELECT * FROM account WHERE Username = '$tk' AND Password='$mk'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            $count = mysqli_num_rows($result);
            if ($count == 1) {
                $_SESSION["online"] = $row['ID'];
                if ($row['Role'] == 0)
                    header("location:indexcustomer.php");
                else header("location:admin.php");
            } else {
                echo '<script>alert("Tài khoản hoặc mật khẩu không đúng !")</script>';
            }
        }
    } else {
        $sql = "SELECT Role FROM account WHERE ID=" . $_SESSION['online'];
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        if ($row['Role'] == 0) {
            header("location:user.php");
        } elseif ($row['Role'] == 1) {
            header("location:admin.php");
        } else header("location:index.php");
    }
    ////////////////////////////////////////////////////////////////////////////
    // Register
    if (isset($_POST["RGsubmit"])) {
        $Username = $_POST["RGusername"];
        $Email = $_POST["RGemail"];
        $pass1 = $_POST["RGpassword1"];
        $pass2 = $_POST["RGpassword2"];

        $sql = "SELECT * FROM account WHERE Username = '$Username' OR Email='$Email' ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $count = mysqli_num_rows($result);
        if ($count != 0) {
            echo '<script>alert("Tên tài khoản hoặc email đã được đăng ký")</script>';
        } else {
            if ($pass1 != $pass2) {
                echo '<script>alert("Đăng ký không thành công, xác nhận mật khẩu không đúng")</script>';
            } else {
                $pass = $pass1;
                $sql2 = "INSERT INTO account VALUES ('','$Username','$pass','','','$Email','','')";
                $result2 = mysqli_query($conn, $sql2);
                $sql3 = "SELECT ID FROM account WHERE Email='$Email' ";
                $result3 = mysqli_query($conn, $sql3);
                $row3 = mysqli_fetch_array($result3);
                $ID = $row3['ID'];;
                // echo '<script>alert("Đăng ký thành công")</script>';
                header('location:mailwelcome.php?ID=' . $ID);
            }
        }
    }
    ?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Trang Chủ</title>
     <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
     <link rel="stylesheet" href="./CSS/index.css">
 </head>

 <body>
     <div class="main">
         <div class="header">
             <button class="button-71 js-login-register "> Đăng Nhập / Đăng Ký </button>
         </div>
     </div>
     <!-- /////////////////LOGIN///////////////// -->
     <div class="login">
         <div class="login-container">
             <div class="login-close">
                 <i class='bx bx-exit'></i>
             </div>
             <header class="login-header">
                 Đăng Nhập
             </header>
             <div class="login-body">
                 <form action="" method="POST">
                     <label for="login-username" class="login-label">
                         <i class='bx bx-user'></i>
                         Tài Khoản</label>
                     <input type="text" name="LGusername" class="login-input" id="login-username" placeholder="Tên Đăng Nhập" required />
                     <label for="login-password" class="login-label">
                         <i class='bx bx-lock-alt'></i>
                         Mật Khẩu</label>
                     <input type="password" name="LGpassword" class="login-input" id="login-password" placeholder="Mật Khẩu" required />
                     <button id="btn-login" type="submit" name="LGsubmit">Đăng Nhập</button>
                 </form>
             </div>
             <footer class="login-footer">
                 <button class="login-register">Đăng Ký</button>
             </footer>
         </div>
     </div>
     <!-- /////////////////REGISTER///////////////// -->
     <div class="register">
         <div class="register-container">
             <div class="register-close">
                 <i class='bx bx-exit'></i>
             </div>
             <header class="register-header">
                 Đăng Ký
             </header>
             <div class="register-body">
                 <form action="" method="POST">
                     <label for="register-username" class="register-label">
                         <i class='bx bx-user'></i>
                         Tài Khoản</label>
                     <input name="RGusername" type="text" class="register-input" id="register-username" placeholder="Tên Đăng Nhập" minlength="6" required />
                     <label for="register-password" class="register-label">
                         <i class='bx bx-lock-alt'></i>
                         Mật Khẩu</label>
                     <input name="RGpassword1" type="password" class="register-input" id="register-password" placeholder="Mật Khẩu" minlength="6" required />
                     <label for="register-password2" class="register-label">
                         <i class='bx bx-lock-alt'></i>
                         Nhập Lại Mật Khẩu</label>
                     <input name="RGpassword2" type="password" class="register-input" id="register-password2" placeholder="Mật Khẩu" minlength="6" required />
                     <label for="register-email" class="register-label">
                         <i class='bx bx-envelope'></i>
                         Email</label>
                     <input name="RGemail" type="email" class="register-input" id="register-email" placeholder="Email" required />
                     <button id="btn-register" name="RGsubmit" type="submit">Đăng Ký</button>
                 </form>
             </div>
             <footer class="register-footer">
                 <button class="register-login">Đăng Nhập</button>
             </footer>
         </div>
     </div>
     <!-- /////////////////JS///////////////// -->
     <script>
         const swaptoLogin = document.querySelector(".register-login");
         const swaptoRegister = document.querySelector(".login-register");
         // Chia ra cho dễ nhìn
         const loginBtn = document.querySelector(".js-login-register");
         const login = document.querySelector(".login");
         const container = document.querySelector(".login-container");
         const closeX = document.querySelector(".login-close");
         // Chia ra cho dễ nhìn
         const register = document.querySelector(".register");
         const container2 = document.querySelector(".register-container");
         const closeX2 = document.querySelector(".register-close");
         // Chia ra cho dễ nhìn
         function showLogin() {
             login.classList.add("openLG");
         }

         function closeLogin() {
             login.classList.remove("openLG");
         }
         loginBtn.addEventListener("click", showLogin);
         closeX.addEventListener("click", closeLogin);
         login.addEventListener("click", closeLogin);
         container.addEventListener("click", function(event) {
             event.stopPropagation();
         });
         /// Chia ra cho dễ nhìn
         function showRegister() {
             register.classList.add("openRG");
         }

         function closeRegister() {
             register.classList.remove("openRG");
         }
         closeX2.addEventListener("click", closeRegister);
         register.addEventListener("click", closeRegister);
         container2.addEventListener("click", function(event) {
             event.stopPropagation();
         });
         /// Chia ra cho dễ nhìn
         swaptoLogin.addEventListener("click", function() {
             login.classList.add("openLG");
             register.classList.remove("openRG");
         })
         swaptoRegister.addEventListener("click", function() {
             register.classList.add("openRG");
             login.classList.remove("openLG");
         })
     </script>
 </body>

 </html>