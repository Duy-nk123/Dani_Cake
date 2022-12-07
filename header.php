<?php
include_once 'db.php';
?>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/cartsty.css">
    <!-- link icon boxicon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="js.js"></script>

            <div class="header mb-5" >
                <div class="header-link">
                    <ul class="d-flex flex-row-reverse bd-highlight mb-0 ">
                        <li class=" boder-left-1px pl-1 mr-5 "><a href="#"><i class='bx bx-rss'></i></a></li>
                        <li class=" boder-left-1px pl-1 pr-1"><a href="#"><i class='bx bxs-camera'></i></a></li>
                        <li class=" boder-left-1px pl-1 pr-1"><a href="https://www.google.com.vn/?hl=vi"><i class='bx bxl-google'></i></a></li>
                        <li class=" boder-left-1px pl-1 pr-1"><a href="https://www.facebook.com/"><i class='bx bxl-facebook'></i></a></li>
                        <li class="pl-1 pr-1"><a href="https://twitter.com/?lang=vi"> <i class='bx bxl-twitter'></i></a></li>
                    </ul>
                </div>
                <div class="container" >
                    <div class="row logo">
                        <div class="col-4 logo-img d-flex ">
                            <a href="index.php"><img class="img-logo-cake" itemprop="logo" src="./IMG/logo-cake.png" alt="logo"></a>
                            <h3 class="mt-3">DANI CAKE</h3>
                        </div>
                        <div class="col-4 mt-4 ">
                            <form action="product-detail.php">
                                <input  class="pl"  type="text" name="Search" value="  Search..." onfocus="this.value = '';"
                                    onblur="if (this.value == '') {this.value = 'Search';}">
                                <button style="height:2rem;"  class = "button-17" type="submit"> search </button>
                             </form>
                        </div>
                        <div class=" logo-button  col-4 d-flex flex-row-reverse bd-highlight text-center">
                           <div class="logo-bt .d-none .d-sm-block">
                            <?php
                             $numbecart = 0;
                            if(isset($_SESSION['cart'])){
                                foreach($_SESSION['cart'] as $key => $value){
                                    $numbecart ++;
                                 }
                            }
                            ?>
                               <a href="addcart.php"><i  class='bx bx-basket boder-left-1px'></i></a>
                               
                               <p>Giỏ Hàng</p>
                        </div>
                        <div class="logo-bt .d-none .d-sm-block">
                            <a   href="logout.php"><i class='bx bx-shuffle'></i></a>
                            <p>Đăng Xuất</p>
                           </div>
                        </div>
                    </div>
                </div>
                <!-- ======================================= -->
                <div>
                    <header>
                        <div class="d-flex justify-content-center">
                            <nav>
                                <div class="navbar container">
                                    <ul class="nav-list">
                                        <li class="active"><a href="./gioithieu.php">Giới Thiệu</a>
                                        </li>
                                        <li><a href="#">Sản Phẩm
                                            <i class='bx bxs-down-arrow'></i>
                                        </a>
                                            <ul class="sub-menu">
                                                <?php
                                                 $sql = "SELECT * FROM `catalog`";
                                                 $menu = query($sql);   
                                                 foreach ($menu as $m) {
                                                ?>
                                                <li>
                                                    <a href="product-detail.php?ID=<?=$m[0]?>"><?=$m[1]?>
                                                   
                                                    </a>
                                                </li>
                                                <?php } ?>
                                                
                                            </ul>
                                        </li>
                                        <li><a href="#">Hộp Quà</a>
                                        </li>
                                        <li><a href="./danhsach.php">Danh Sách</a>
                                        </li>
                                        <li><a href="#">Tin Tức</a>
                                        </li>
                                        <li><a href="#">Tuyển Dụng</a>
                                        </li>
                                        <li class=""><a href="#">Liên Hệ</a>
                                        </li>
                                        
                                    </ul>
            
                                </div>
                            </nav>
                        </div>
                    </header>
                </div>
            </div>