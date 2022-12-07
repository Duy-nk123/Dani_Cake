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

<?php
session_start();
include_once 'db.php';
include 'funtion.php';
?>
<body onload="Function()">
<?php

        if(isset($_POST["ID"]) && isset($_POST["numbe"])){
            $ID =$_POST['ID'];
            $numbe =$_POST["numbe"];
            $sql= "SELECT * FROM `product` WHERE id = ".$ID;
            $a =query($sql); 
            foreach ($a as $b)
            {   
            if(!isset($_SESSION['cart'])||$_SESSION['cart']==0){
                $cart = array();
                $cart[$ID]= array(
                    'name'=>$b[2],
                    'numbe'=>$numbe,
                    'price'=>$b[3],
                    'img'=>$b[5]
                );
            }else{
                $cart = $_SESSION['cart'];
                if(array_key_exists($ID, $cart)){
                    $cart[$ID]= array(
                        'name'=>$b[2],
                        'numbe'=>(int)$cart[$ID]['numbe']+ $numbe,
                        'price'=>$b[3],
                        'img'=>$b[5] 
                    );
                }else{
                    $cart[$ID]= array(
                        'name'=>$b[2],
                        'numbe'=>$numbe,
                        'price'=>$b[3],
                        'img'=>$b[5]
                    );
                }
    
            }
            $_SESSION['cart'] = $cart;
            $numbecart = 0;
            foreach($cart as $key => $value){
               $numbecart ++;
            }
           echo $numbecart;
    }
}   




    // if(isset($_GET['action'])){
    //   var_dump($_POST);exit;
    // }
    // ?>
    
    
    <section class="container" id="listcart" style="z-index: 1" >
    <div  id="cartx">
        <div >
            <h1 class="title_cart"style="padding-top: 40px;"><span>Giỏ hàng của tôi</span></h1>
            <div class="steps clearfix">
                <ul class="clearfix row ml-1 mr-1 " style="padding-right: 40px;" >
                    <li class="cart active col-4"><span><i class='bx bxs-cart'></i></span><span>Giỏ hàng của tôi</span><span class="step-number"><a>1</a></span></li>
                    <li class="payment  col-4" id="thanhtoan"><span><i class='bx bx-dollar'></i></span><span>Thanh toán</span><span class="step-number"><a>2</a></span></li>
                    <li class="finish col-4" id="HoanTat"><span><i class='bx bx-check'></i></span><span>Hoàn tất</span><span class="step-number"><a>3</a></span></li>
                </ul>
            </div>
            <table id ="myTable">
                <thead>
                <tr>
                   
                    <th>Tên Sản Phẩm</th>
                    <th>Số Lượng</th>
                    <th>ảnh</th>
                    <th>Giá</th>
                    <th>Thành Tiền</th>
                    <th>chọn</th>
                </tr>
             </thead>
             <tbody>
                <?php
                $sum=0;
                $sum1=0;
                if(isset($_SESSION['cart'])&&$_SESSION['cart']!=0){
                    foreach($_SESSION['cart'] as $key => $value){
                    $sum  = $value['price']*$value['numbe'];
                    $sum1+=$sum;
                      
                     $sql="SELECT * FROM `product` WHERE id=".$key;
                     $pr=query($sql); 
                    

                     
                ?>

                 <tr> 
                
                    <td><span class= name><?php echo $value['name'] ?></span></td>
                    <td><input onkeypress="return isNumberKey(event)" class="numbe" id="quanlyti_<?php echo $key?>" type="number" value="<?php echo $value['numbe'] ?>" min="1" max="<?=$pr[0][4]?>" onchange="updatecart(<?php echo $key?>)" ></td>
                    <td><img class="img" height="100px" width="100px" src="<?php echo $value['img'] ?>" alt=""></td>
                    <td><p><span  class= price ><?php echo $value["price"] ?></span><sup>đ</sup></p></td>
                    <td><span><?php echo $sum?> </span><sup>đ</sup> </td>
                    <td><input  onclick="deletee(<?php echo $key?>)"   class="deletecart" type="button" id="delPOIbutton" value="Delete" /></td>
                    
                </tr> 
                <?php
                }
            }else{
                echo "<h2> Giỏ Hàng Trống</h2>";
            }
                ?>
                
            </tbody>
            </table>
                        <div class="price-total">
                            <h3 > Tổng Tiền:<span><?php echo $sum1?></span><sup>đ</sup> </h3>
                        </div>
                        
                        <div class="button text-right" style="text-align: right;">
                            <a  style="color: #fff;" class="btn btn-primary"  href="indexcustomer.php">Tiếp tục mua hàng</a>
                            <a  id="thanh1" style="color: #fff;" class="btn btn-primary " onclick="thanhtoan()" disabled="disabled">Tiến hành thanh toán</a>
                            <!-- <a  style="color: #fff;" class="btn btn-primary " href="./order.php">Tiến hành thanh toán</a> -->
                        </div>
        </div>
    </div>
       
    </section>

    <!-- ================================thanh toan================================ -->
    
    <?php
    include "order.php";
    ?>

</body>
<script >
    function Function(){
        // document.getElementById("thanh1").disabled = true;
        // rowCount=0;
        // var rowCount = $('#myTable tr').length;
        // alert (rowCount);
        // alert("Hello! I am an alert box!!");
        // if(rowCount ==1){
        //     document.getElementById("thanh").disabled = true;
        // }else{
        //     document.getElementById("thanh").disabled = false;
        // }
        
    //     document.getElementById("thanhtoan11").disabled = true;
    //    var x = ($('table').columnCount());
    //    alert x;
    //    if(x==1){
    //     document.getElementById("thanhtoan11").disabled = fall;
    //    }
    }
    function thanhtoan(){
        let thanhtoan = document.getElementById('thanhtoan')
        let thongtin = document.getElementById('thongtin')
        thongtin.classList.add('display-blookk');
        thanhtoan.classList.add('active');
        thanhtoan();
    }
    function updatecart(ID){
        numbe =$('#quanlyti_'+ID).val();
        $.post("updatecart.php", {"ID": ID, "numbe": numbe}, function(data){
            //afterupdate cart
            $("#listcart").load("http://localhost:8080/DaniCake/addcart.php #cartx");
        });
      
   
   }
   function deletee(ID) {
    $.post("updatecart.php", {"ID": ID, "numbe": 0}, function(data){
            //afterupdate cart
            $("#listcart").load("http://localhost:8080/DaniCake/addcart.php #cartx");
        });
        
   }
</script>
