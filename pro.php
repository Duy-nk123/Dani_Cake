<?php
include_once "header.php";
include_once "db.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> 


</head>
<body>
    <div class="container">
    <?php  
   
     $sql="SELECT * FROM `product` WHERE id = ".$_GET["ID"];
     $detail=query($sql); 
	    foreach ($detail as $pro)
	{
	?>
        <div class=" col-12 border p-3 main-section bg-white">
            <div class="row hedding m-0 pl-3 pt-0 pb-3">
              <h3> Chi Tiết Sản Phẩm</h3>
            </div>
            <div class="row m-0">
                <div class="col-lg-4 left-side-product-box pb-3">
                    <img src="<?=$pro[5]?>" class="border p-3">
                    <span class="sub-img">
                        <!-- <img src="http://parisgateaux.vn/wp-content/uploads/2018/08/B22-Mexico-300x269.jpg" class="border p-2">
                        <img src="http://parisgateaux.vn/wp-content/uploads/2018/08/B22-Mexico-300x269.jpg" class="border p-2">
                        <img src="http://parisgateaux.vn/wp-content/uploads/2018/08/B22-Mexico-300x269.jpg" class="border p-2"> -->
                    </span>
                </div>
                <div class="col-lg-8">
   
                    <div class="right-side-pro-detail border p-3 m-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <span>Bánh Ngọt</span>
                                <p class="m-0 p-0"><?=$pro[2]?></p>
                            </div>
                            <div class="col-lg-12">
                                <p class="m-0 p-0 price-pro"><?=$pro[3]?> <sup>$</sup> </p>
                                <hr class="p-0 m-0">
                            </div>
                            <div class="col-lg-12 pt-2">
                                <h5>Product Detail</h5>
                                <span><?=$pro[6]?></span>
                                <hr class="m-0 pt-2 mt-2">
                            </div>
                            <div class="col-lg-12">
                                <p class="tag-section"><strong>Tag : </strong><a href="#">cake</a><a href="#">,drink</a></p>
                            </div>
                            <div class="col-lg-12">
                                <h6>Quantity : <?=$pro[4]?></h6>
                            </div>
                            <div class="col-lg-12">
                                <h6>Quantity :</h6>
                                <input type="number" class="form-control text-center w-100" id="numbe" name="numbe" value="1" min= "1" max="<?=$pro[4]?>">
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="row">
                                    <div class="col-lg-6 pb-2">
                                        <a onclick="adcart(<?php echo $pro[0]?>)"  class="btn btn-danger w-100"  >Add To Cart</a>
                                    </div>
                                    <div class="col-lg-6">
                                        <a href="indexcustomer.php" class="btn btn-success w-100">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php
    }
    ?>

            <!-- ============================sản phẩm liên quan ============================== -->

            <div class="row mt-5">
                <div class="col-lg-12 text-center pt-3">
                    <h4>More Product</h4>
                </div>
            </div>
            
            <div class="row mt-3 p-0 text-center pro-box-section">
            <?php
            
            $sql = "SELECT * FROM `product` WHERE Catalog_ID = $pro[1] "  ;
            $proA=query($sql);
            foreach ($proA as $a){
        ?>
                <div class="product col-3 pb-2 mb-5">
                    <div class="product-img">
                        <a href="#">
                            <img height="300px" width="100%" src="<?=$a[5]?>" alt="">
                        </a>
                    </div>
                   
                    <div class="product-details ">
                        <a class="product-name " href="facebook.com"> <?=$a[2]?></a><br>
                        <button> <a href="pro.php?ID=<?=$a[0]?>"> <i class='bx bx-basket'></i>Đọc Tiếp</a> </button>
                    </div>
                </div>
                <?php
                }
                ?>
                </div>
        </div>
        <br>
        <br>
        <br>
        
    </div>

            <script >
                function adcart(ID){ 
                numbe=1;
                numbe =$('#numbe').val();
                //alert(ID);
                //alert(numbe);
                $.post("addcart.php", {"ID": ID, "numbe": numbe}, function(data){
                   
                    $("#numbercart").text(data);
                });
                alert("Bạn đã thêm 1 sản phẩm vào giỏ hàng");
                }

            </script>
           
    



</body>
</html>
<?php
include_once 'footer.php'
?>