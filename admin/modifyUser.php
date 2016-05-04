<?php 
    //数据库连接
    require_once '../include.php';

    $id=$_GET["id"];
    $username=$_GET["username"];
    $password=$_GET["password"];
    $permission=$_GET["permission"];

      
            //查询
            $sql = "update user set username='$username',password='$password',permission='$permission' where id='$id'";
            $result = mysql_query($sql);
            
            // echo $username;
            echo mysql_affected_rows();

?>                            