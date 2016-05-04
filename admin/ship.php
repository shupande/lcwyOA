<?php 
require_once '../include.php';

    //数据库连接
      $order_id=$_GET["order_id"];
      $express_company=$_GET["express_company"];
      $express_no=$_GET["express_no"];

            //SQL
            // $sql = "DELETE FROM `notification` WHERE id ={$id}";
            // 设定为删除状态
            $sql = "UPDATE `orders` set `express_company` ='".$express_company."',`express_no` ='".$express_no."',`order_status`=2 WHERE `order_id` ={$order_id}";
            $result = mysql_query($sql);

            echo mysql_affected_rows();

?>