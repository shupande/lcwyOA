<?php 
    //数据库连接
require_once '../include.php';

            //查询
            $sql = "SELECT count(order_status) FROM `orders` where `order_status`=0 ";
            $result = mysql_query($sql);
            
            // echo mysql_fetch_assoc($result);
            echo mysql_result($result, 0);
?>