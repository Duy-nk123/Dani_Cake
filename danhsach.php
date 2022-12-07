<?php
include_once 'header.php'
?>
   <link rel="stylesheet" href="style.css">
        <div class="container">
        <h3 class="title-danhsach">Hệ Thống Cửa Hàng Dani Cake Toàn Quốc</h3>
            <div class="row">
            
                <div class="col-5">
                    <ol class="gradient-list">
                    <?php
                         $sql = "SELECT * FROM `catalog`";
                         $menu = query($sql);   
                        foreach ($menu as $m) {
                    ?>
                        <li><a class= "danhsach-a"  href="product-detail.php?ID=<?=$m[0]?>"><?=$m[1]?></a></li>

                        <?php } ?>
                        <li><i class='bx bx-phone-call'></i>Đặt Hàng: 0967622613</li>
                        <li><i class='bx bxs-shopping-bags'></i>Free Ship từ 100.000<small>vnd</small></li>
                    </ol>
                </div>
                <div class="col-7">
                <div class="card1 ">
                        <div class="imgds">
                            <img style="height: 200px; width: 280px;" src="./img/banh-cupcake-kem-bo-mau-vang-trang-tri-trai-cay-tuoi.png" alt=" ảnh giày ">
                            <h3>DANI CAKE TRIEU KHUC<br><span >Cơ Sở-01</span></h3>
                        </div>
                        <div class="details1">
                            <h3>DANI CAKE TRIEU KHUC<br> <span >Cs-01</span></h3>
                            <h4 class="claa">54 Triều Khúc, Q.Thanh Xuân, Hà Nội</h4>
                            <p  class="claa"> Giờ mở cửa: 7h30-22h00</p>
                                <h4  class="claa">Tiện Ích</h4>
                                <ul  class="size" style="padding-left: 0" >
                                    <li><i class='bx bxs-car-garage'></i> Có chỗ đỗ xe hơi </li>
                                    <li> <i class='bx bx-home'></i>Phục Vụ Tại chỗ</li>
                                    <li> <i class='bx bxs-shopping-bag-alt'></i>Mang đi</li>
                                
                                </ul>
                                <div class="group1">
                                    <!-- <h2><sup>$</sup>499<small>.99</small></h2> -->
                                
                                    <a  href="https://www.google.com/maps/place/54+P.+Tri%E1%BB%81u+Kh%C3%BAc,+Thanh+Xu%C3%A2n+Nam,+Thanh+Xu%C3%A2n,+H%C3%A0+N%E1%BB%99i,+Vi%E1%BB%87t+Nam/@20.9844871,105.7959694,17z/data=!3m1!4b1!4m5!3m4!1s0x3135acc696073dd9:0x6dce4502afe3e1!8m2!3d20.9844821!4d105.7981635" >Xem Bản ĐỒ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>
                
            </div>
        </div>
<?php
include_once 'footer.php'
?>