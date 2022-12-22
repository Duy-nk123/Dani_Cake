
<section class="get-in-touch dp-none" id="thongtin">
    <h1 class="title">Thông Tin Khách Hàng</h1>
    <?php
      if(isset($_POST["addNew"])){
         $total2 = 0;
         $as =  $_SESSION['online'];
         $curentdate = date("Y-m-d H:i:s");
         $_POST["user_id"]=$as;
         $_POST["status"]=0;
         $_POST["datecreate"]=$curentdate;
         if($_SESSION['cart']==0){
            echo ('<h3 class="">Không có sản phẩm nào trong giỏ hàng</h3>');
         }else{
         foreach($_SESSION['cart'] as $key => $value){
            $total2 += (int)$value["numbe"] * (int)$value["price"];
         }
         $_POST["total"]=$total2;
         $table = 'orders';
         $id = addNew($table,$_POST);
         foreach($_SESSION['cart'] as $key => $value){
            $price = $value["price"];
            $numbe = $value["numbe"];
            // $sql= "insert into (order_id,pro_id,pro_price,pro_number,status,datecreate)";
            // $sql .= "VALUES('$id','$key','$price','$numbe','1','$curentdate')";// .= la noi chuoi
             $sql = "INSERT INTO order_detail( `order_id`, `pro_id`, `pro_price`, `pro_number`, `status`, `datecreate`) VALUES ('$id','$key','$price','$numbe','1','$curentdate')";
            //$sql = "Insert Into orderdetail ('".$id."','".$key."',".$price.",".$numbe.",".1.",'".$curentdate."')";
            execsql1($sql);
            $sql="SELECT * FROM `product` WHERE id= ".$key;
            $pr=query($sql); 
            $quantityupdate= ($pr[0][4]-$numbe);
            $sql= "UPDATE `product` SET `Quantity`='$quantityupdate' WHERE id=$key";
            execsql1($sql);
      
              
         }

         $_SESSION['cart'] =0;
      }
      // $_SESSION['cart'] =0;
       header("Refresh:0");
      }
     
    ?>
    <form class="contact-form  row" action="" method="post"  >
       <div class="form-field col-lg-6">
          <input style="padding-left: 3rem;" id="name" name="name" class="input-text js-input" type="text" required>
          <label class="label" for="name">Name</label>
       </div>
       <div class="form-field col-lg-6 ">
          <input style="padding-left: 3rem;" id="email" name="email" class="input-text js-input" type="email" required>
          <label class="label" for="email">E-mail</label>
       </div>
       <div class="form-field col-lg-6 ">
          <input style="padding-left: 3rem;"  id="address" name="address" class="input-text js-input" type="text" required>
          <label class="label" for="address">Address</label>
       </div>
        <div class="form-field col-lg-6 ">
          <input style="padding-left: 3rem;" id="phone" name="phone" class="input-text js-input" type="text" required>
          <label class="label" for="phone">phone</label>
       </div>
       <div class="form-field col-lg-12">
          <input style="padding-left: 3rem;" id="message" name="message" class="input-text js-input" type="text" required>
          <label class="label" for="message">Message</label>
       </div>
       <div class="form-field col-lg-12">
          <input  name="addNew" class="submit-btn" type="submit" value="Mua Hàng"  onclick="Function1()"   >
       </div>
    </form>
   
 </section>
 <script >
   function Function1(){
     // alert(" Bạn đã mua hàng thành công!");

      
      

   }

   
   
   

   
</script>