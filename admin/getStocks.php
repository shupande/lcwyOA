<?php 
    //数据库连接
    require_once '../include.php';

      // $pageSize=7;

      
            //查询
            $sql = "SELECT * FROM `stocks` order by good_name desc,model";
            $result = mysql_query($sql);
            //换成数组
            $list=array();
            //记录总数
            $rs=mysql_query("select count(*) from `stocks`");
            $myrow=mysql_fetch_array($rs);
            $total=$myrow[0];
            //转换成数组
            while( $users = mysql_fetch_assoc($result) ){
              $list[]=$users;
            }

            //返回JSON中文格式
            echo "{\"Rows\":";
            echo json_encode($list);//,JSON_UNESCAPED_UNICODE 加这个参数的话就直接显示中文
            echo ",\"Total\":".$total."}";

?>