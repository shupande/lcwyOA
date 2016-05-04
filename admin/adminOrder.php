<?php
require_once '../include.php';
	
	//时区设置
	date_default_timezone_set('Asia/Shanghai');

	//获取传递过来的值
	$data=$_POST['jsonData'];

	//订单号生成(根据当前时间精准到秒和2位00设定管理员下单格式)
	$orderId=date('YmdHis')."00";

	//转换成数组
    $array=json_decode($data,true);

    //获取当前用户
	$username=$_SESSION['username'];

	//计算数组的长度
	$cnt = count($array);


	if($cnt==1){
	    foreach($array as $key){
	    		//写入订单表
	   			mysql_query("INSERT INTO `orders` (order_id,order_status,order_user) VALUES ('".$orderId."0','0','".$key['Username']."')"); 

    			//写入订单详细表
              mysql_query("INSERT INTO `orders_detail` (gjp_id,good_name,model,color,capacity,order_num,order_id,case_tips) VALUES ('".$key['Gjp_id']."','".$key['Good_name']."','".$key['Model']."','".$key['Color']."','".$key['Capacity']."','".$key['Num']."','".$orderId."0','系统管理员".$username."分配订单')"); 

              //操作减去库存数据库
              mysql_query("UPDATE `stocks` SET stock=(select a.stock-".$key['Num']." from((select stock from stocks where gjp_id=".$key['Gjp_id'].")as a))WHERE gjp_id='".$key['Gjp_id']."'"); 
	        } 
    }else{
    	$i=0;
    	//根据用户名来插入表
    	foreach($array as $key){

    		//写入订单表
	   			mysql_query("INSERT INTO `orders` (order_id,order_status,order_user) VALUES ('".$orderId.$i."','0','".$key['Username']."')"); 

    			//写入订单详细表
              mysql_query("INSERT INTO `orders_detail` (gjp_id,good_name,model,color,capacity,order_num,order_id,case_tips) VALUES ('".$key['Gjp_id']."','".$key['Good_name']."','".$key['Model']."','".$key['Color']."','".$key['Capacity']."','".$key['Num']."','".$orderId.$i."','系统管理员".$username."分配订单')"); 

              //操作减去库存数据库
              mysql_query("UPDATE `stocks` SET stock=(select a.stock-".$key['Num']." from((select stock from stocks where gjp_id=".$key['Gjp_id'].")as a))WHERE gjp_id='".$key['Gjp_id']."'"); 

              $i++;
    	} 
    	// for ($i=0; $i<$cnt ; $i++) { 
    	// 	for ($j=$cnt-1; $j >$i ; $j--) { 
    	// 		if($array[$j]['Username']==$array[$i]['Username']){
    	// 			echo $array[$j]['Gjp_id'].$array[$j]['Model'].$array[$j]['Color'].$array[$j]['Capacity'].$array[$j]['Num'].$array[$j]['Username'];
    	// 			echo "\n";
    	// 			echo $array[$i]['Gjp_id'].$array[$i]['Model'].$array[$i]['Color'].$array[$i]['Capacity'].$array[$i]['Num'].$array[$i]['Username'];;
    	// 			echo "\n";
    	// 		}
    	// 	}
    	// 	// break;
    	// }

    }
	
    // echo $cnt;

    echo mysql_affected_rows();

?>