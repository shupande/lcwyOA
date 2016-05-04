<?php
require_once 'include.php';
checkSession();
userCheck();
/*
将订单状态设定为删除
*/

	//获取日期
	$order_id=$_GET['order_id'];

	//获取当前用户
	$username=$_SESSION['username'];

	

	//回滚数据
	$stockData = mysql_query("select gjp_id,order_num from orders_detail where order_id='".$order_id."'");
	while($row = mysql_fetch_array($stockData)){
		$stockRusult=mysql_query("update stocks set stock=stock+".$row['order_num']." where gjp_id=".$row['gjp_id']."");
	}

	$del_detail=mysql_query("delete from orders_detail where order_id='".$order_id."'");
	//删除订单
	$sql="delete from orders where order_id='".$order_id."'";
	$result = mysql_query($sql);

	
	echo mysql_affected_rows();
	



?>