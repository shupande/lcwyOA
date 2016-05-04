<?php
require_once 'include.php';

	//获取日期
	$order_id=$_GET['order_id'];

	//根据当前用户和日期查找所有符合的订单
	$sql="select * from orders_detail where order_id='".$order_id."'";

	$result = mysql_query($sql);

	while( $orders = mysql_fetch_assoc($result) ){
              $list[]=$orders;
            }

    echo json_encode($list,JSON_UNESCAPED_UNICODE);

?>