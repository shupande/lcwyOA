<?php
require_once 'include.php';

	//获取当前用户
	$username=$_SESSION['username'];

	//获取日期
	$date=$_GET['date'];

	//根据当前用户和日期查找所有符合的订单,根据时间顺序，最新的在前面
	$sql="select * from orders where order_user='".$username."' and create_time like '".$date."%' order by create_time desc";

	$result = mysql_query($sql);

	while( $orders = mysql_fetch_assoc($result) ){
              $list[]=$orders;
            }

    echo json_encode($list,JSON_UNESCAPED_UNICODE);

?>