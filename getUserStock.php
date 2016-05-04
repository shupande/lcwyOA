<?php
require_once 'include.php';
//$pageSize=8;

            //记录总数
            // $rs=mysql_query("select count(*) from `stock`");
            // $myrow=mysql_fetch_array($rs);
            // $total=$myrow[0];
            //计算总页数ceil天花板取完整
            // $pages=ceil($total/$pageSize);
            //|| ($_GET['page']) > $pages
            // if(!isset($_GET['page'])|| !intval($_GET['page']) ) $page=1;
            // else $page=$_GET['page'];

            // $startNum=($page-1)*$pageSize;

            //查询
            //$sql = "SELECT * FROM `stocks` limit {$startNum},{$pageSize}";
            $sql = "SELECT * FROM `stocks` order by gjp_id";
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