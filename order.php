<?php
require_once 'include.php';
	
	//时区设置
	date_default_timezone_set('Asia/Shanghai');

	//获取传递过来的值
	$data=$_POST['jsonData'];

	//获取当前用户
	$username=$_SESSION['username'];

	//订单号生成(根据当前时间精准到秒和2位随机数设定格式)
	$orderId=date('YmdHis').rand(10,99);

	//转换成数组
    $array=json_decode($data,true);


    //检查库存是否足够
    foreach($array as $key){
    	$currentStock=mysql_query("select stock,un_stock from stocks where gjp_id='".$key['Gjp_id']."'"); 
        while( $result = mysql_fetch_assoc($currentStock) ){
              if($result['stock']-$key['Num']<$result['un_stock']){
              	echo -2;
              	return;
              } 
            }

	} 

    //写入订单表
    mysql_query("INSERT INTO `orders` (order_id,order_status,order_user) VALUES ('".$orderId."','0','".$username."')"); 
    
    foreach($array as $key){
    			//写入订单详细表
              mysql_query("INSERT INTO `orders_detail` (gjp_id,good_name,model,color,capacity,order_num,order_id,case_tips) VALUES ('".$key['Gjp_id']."','".$key['Good_name']."','".$key['Model']."','".$key['Color']."','".$key['Capacity']."','".$key['Num']."','".$orderId."','".$key['Case_tips']."')"); 


              //操作减去库存数据库
              mysql_query("UPDATE `stocks` SET stock=(select a.stock-".$key['Num']." from((select stock from stocks where gjp_id=".$key['Gjp_id'].")as a))WHERE gjp_id='".$key['Gjp_id']."'"); 
        }  
	//update stocks set stock=(select a.stock-1 from((select stock from stocks where gjp_id=77777777)as a))where gjp_id=77777777;
    

    echo mysql_affected_rows();

?>