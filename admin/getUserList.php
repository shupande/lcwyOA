<?php 
    //数据库连接
    require_once '../include.php';

      // $pageSize=7;

            //记录总数
            // $rs=mysql_query("select count(*) from `user`");
            // $myrow=mysql_fetch_array($rs);
            // $total=$myrow[0];
            //计算总页数ceil天花板取完整
            // $pages=ceil($total/$pageSize);
            //|| ($_GET['page']) > $pages
            // if(!isset($_GET['page'])|| !intval($_GET['page']) ) $page=1;
            // else $page=$_GET['page'];

            // $startNum=($page-1)*$pageSize;

            //查询
            $sql = "SELECT * FROM `user`";
            $result = mysql_query($sql);
            //换成数组
            $list=array();
            // $i=0;
            while( $users = mysql_fetch_assoc($result) ){
              $list[]=$users;
            }

            //返回JSON中文格式
            echo json_encode($list,JSON_UNESCAPED_UNICODE);
            // echo $pages;
             // $_SERVER['PHP_SELF'] 

?>