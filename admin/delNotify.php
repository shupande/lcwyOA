<?php 
require_once '../include.php';

    //数据库连接
      $id=$_GET["id"];

            //SQL
            // $sql = "DELETE FROM `notification` WHERE id ={$id}";
            // 设定为删除状态
            $sql = "UPDATE `notification` set `is_delete` =1 WHERE `id` ={$id}";
            $result = mysql_query($sql);

            echo mysql_affected_rows();

?>