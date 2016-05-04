<?php 
require_once '../include.php';

    //数据库连接
      $order_id=$_GET["order_id"];
      $gjp_id=$_GET["gjp_id"];
      $num=$_GET["num"];

            //SQL
            // $sql = "DELETE FROM `notification` WHERE id ={$id}";
            // 设定为删除状态
            $sql = "UPDATE `orders_detail` set `order_num` ={$num} WHERE `order_id` ={$order_id} and `gjp_id` ={$gjp_id}";
            $result = mysql_query($sql);

            echo mysql_affected_rows();

?>