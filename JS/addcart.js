
function adcart(ID){ 
    numbe=1;
numbe =$('#numbe').val();
//alert(ID);
//alert(numbe);
$.post("addcart.php", {"ID": ID, "numbe": numbe}, function(data){
    
 });
}

function updatecart(ID){
   
   
numbe =$('#quanlyti_'+ID).val();
$.post("updatecart.php", {"ID": ID, "numbe": numbe}, function(data){
    //afterupdate cart
    $("#listcart").load("http://localhost:8080/project/addcart.php #cartx");
});

}

