<?php
include_once 'db.php';
include_once 'header.php';
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <!-- link icon boxicon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="js.js"></script>
<div class="container" style="margin-top: 6rem;">
    <div class="row">
        <div class="col-3">
        <ol class="gradient-list">
                    <?php
                         $sql = "SELECT * FROM `catalog`";
                         $menu = query($sql);   
                        foreach ($menu as $m) {
                    ?>
                        <li style="width: 200px;"><?=$m[1]?></li>
                        <?php } ?>
                        <li style="width: 200px;"><i class='bx bx-phone-call'></i>Đặt Hàng: 0967622613</li>
                        <li style="width: 200px;"><i class='bx bxs-shopping-bags'></i>Free Ship từ 100.000<small>vnd</small></li>
                    </ol>
        </div>
        <div class="col-9">
            <div class=" d-flex toolbar justify-content-between text-center" style="font-size: 1rem; margin: 1rem;">
                <!-- <div class="">
                    <a style="font-size: 1.5rem;" href="#"><i class='toolbar_icon bx bxs-grid-alt'></i></a>
                    <a style="font-size: 1.5rem;" href="#"><i class='toolbar_icon bx bx-list-ul'></i></a>
                    <select name="" id="">
                        <option value="">Thứ Tự Mặc Định</option>
                        <option value="">2</option>
                        <option value="">3</option>
                        <option value="">4</option>
                        <option value="">5</option>
                    </select>
                </div>
                <div class="">
                    <span>Xem</span>
                    <a href="#">10/</a>
                    <a href="#">30</a>
                    <a href="#">tất cả</a>
                </div>
               </div> -->
               <div class="d-flex flex-wrap row ">
                <?php
                   
                    if(isset($_GET['Search'])) {
                        $search = $_GET['Search'];
                        $sql = "SELECT * FROM `product` WHERE Name  like '%$search%'";
                    }else{
                        $sql = " SELECT * FROM `product` WHERE Catalog_ID = ".$_GET["ID"];
                    }
                    $detail = query($sql);  
                    if(count($detail)==0){
                        echo '<h3 class="TT"> Không Có Sản Phẩm Nào!</h3>';
                    }
                    foreach ($detail as $d) {
                    
                ?>
                <div class="product col-4 mb-5">
                    <div class="product-img">
                        <a href="#">
                            <img height="300px" width="100%" src="<?=$d[5]?>" alt="">
                        </a>
                    </div>
                    <div class="cart-buttom">
                        <span class="cart-item"><a href="facebook.com"><i class='bx bx-search'></i></a></span>
                        <span class="cart-item"><i class='bx bx-analyse'></i></span>
                    </div>
                    <div class="product-details ">
                        <a class="product-name " href="facebook.com"> <?=$d[2]?></a><br>
                        <button> <a href="pro.php?ID=<?=$d[0]?>"> <i class='bx bx-basket'></i>Đọc Tiếp</a> </button>
                    </div>
                </div>
                
               <?php
               }
               ?>
               
                    
            
               </div>


        </div>
        
    </div>
   </div>

   </div>  
   <?php
   include_once 'footer.php'
   ?>