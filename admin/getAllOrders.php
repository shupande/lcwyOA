<?php
require_once '../include.php';


	//根据查找最新的100个订单,根据时间顺序，最新的在前面 limit 0,4
	$sql="select * from orders order by create_time desc limit 80";

	$result = mysql_query($sql);

	while( $orders = mysql_fetch_assoc($result) ){
              $list[]=$orders;
            }

    echo json_encode($list,JSON_UNESCAPED_UNICODE);

?>