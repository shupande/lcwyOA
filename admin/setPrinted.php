<?php 
require_once '../include.php';
checkSession();
adminCheck();
    //数据库连接
      $order_id=$_GET["order_id"];

      if($order_id==null){
      	$sql = "UPDATE `orders` set `order_status` =1 WHERE `order_status` =0";
      }else{
      	$sql = "UPDATE `orders` set `order_status` =1 WHERE `order_id` ={$order_id}";
      }
            //SQL
            // $sql = "DELETE FROM `notification` WHERE id ={$id}";
            // 设定为删除状态
            $result = mysql_query($sql);

            echo mysql_affected_rows();

?>