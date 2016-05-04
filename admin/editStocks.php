<?php 
require_once '../include.php';

      //接收数据
      $data=$_POST['jsonData'];
      $str=$_POST['action'];
      //转换成数组
      $array=json_decode($data,true);




      if($str==="add") add($array);
      if($str==="del") del($array);
      if($str==="modify") modify($array);


      // $sql="INSERT INTO stock VALUES ".$values;
      // $result=mysql_query($sql);
      echo mysql_affected_rows();
      echo $str;
      // $sql="UPDATE stock SET {$str.id}="

      // //插入数据库

      // $sql="UPDATE stock SET {$keys} = CASE id"; 
      // foreach ($keys as $id => $value) {
      //        $sql .= sprintf("WHEN %d THEN %d",$id,$value);
      //  } 
      // $sql .="END WHERE id in ($ids)";
      // echo $sql;
      // mysql_query($sql);

      
      // return mysql_insert_id();
      // if($result){
      //       return mysql_affected_rows();
      // }else{
      //       return false;
      // }
      

            //增加
      function add($array)
      {
            foreach($array as $key){
                  mysql_query("INSERT INTO `stocks` (gjp_id,good_name,model,color,capacity,stock,un_stock) VALUES ('".$key['gjp_id']."','".$key['good_name']."','".$key['model']."','".$key['color']."','".$key['capacity']."','".$key['stock']."','".$key['un_stock']."')"); 
            }    

      }

      //修改,使用不变的id来作为查找
      function modify($array)
      {
            foreach($array as $key){
                   mysql_query("UPDATE `stocks` SET gjp_id='".$key['gjp_id']."',good_name='".$key['good_name']."',model='".$key['model']."',color='".$key['color']."',capacity='".$key['capacity']."',stock=".$key['stock'].",un_stock=".$key['un_stock']." WHERE id='".$key['id']."'"); 
             }

      }
      

      //删除
      function del($array)
      {
            foreach ($array as $key ) {
                  mysql_query("DELETE from `stocks` WHERE id=".$key['id']."");
            }
            
      }


?>