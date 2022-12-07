
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
    <link rel="stylesheet" href="cart.css">
         
    <?php
      

            $sql= "SELECT * FROM `catalog`";
            $cata = query($sql);
            foreach($cata as $c){

    ?>
    
    
        <div class=" mt-5 textwidget">
            <h2 class=" mt-5 custom-title"> <span class=" mt-5 red"> <?php echo $c[1] ?></span></h2>
         </div>
        

         <!-- product-detail -->
         <div class=" container mt-5">
         <div class="row mt-5 flex-wrap d-flex">
             
             
             <?php 
                        
                       // =====================//=====================
                        $sql = "SELECT * FROM product WHERE Catalog_ID = $c[0]";
            			$product = query($sql);   
                        
						foreach ($product as $pro) {
                            
			    	?>
          
            <div class="product col-3 mt-5 ">
                <div class="product-img">
                    <a href="#">
                        <img height="300px" width="100%" src="<?=$pro[5]?>">
                    </a>
                </div>
                <div class="cart-buttom">
                    <span class="cart-item"><a href="facebook.com"><i class='bx bx-search'></i></a></span>
                    <span class="cart-item"><a href="#"><i class='bx bx-analyse'></i></a></span>
                </div>
                <div class="product-details ">
                    <a class="product-name " href="facebook.com"> <?=$pro[2]?></a><br>
                    <p>Giá: <span class="gia"><?=$pro[3]?></span> <sup>$</sup> </p>
                    <button> <a href="pro.php?ID=<?=$pro[0]?>"> <i class='bx bx-basket'></i>Đọc Tiếp</a></button>
                </div>
               
               
            </div>
            <?php  
                            
	                }
                ?>
            </div>
        </div>   
    <?php }?>
        
            