<?php 
    //数据库连接
    require_once '../include.php';

    $username=$_GET["username"];

      
            //查询
            $sql = "delete FROM user where username='$username'";
            $result = mysql_query($sql);
            
            // echo $username;
            echo mysql_affected_rows();

?>                            