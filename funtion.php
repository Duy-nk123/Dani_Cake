 <?php
 function addNew($table,$data){
    global $conn;
    $field = "";
    $values = "";
    if(is_array($data )){
        $i=0;
        foreach($data as $key=>$val){
        if($key !="addNew"){
            $i++;
            if($i==1){
                $field .=$key;
                $values .= "'".$val."'";

            }else{
                $field .=",".$key;
                $values .= ",'".$val."'";
            }
        }
    }
    $sql = "insert into $table ($field)";
    $sql .="values($values)";
    execsql($sql,$conn);
     $id = $conn->insert_id;// tra ve id gan nhat
    return($id);
}

}