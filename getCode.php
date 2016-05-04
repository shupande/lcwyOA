<?php 
require_once 'include.php';


		$sql = "SELECT `code`,`create_time` FROM `cmcc_code` order by id desc limit 0,4";
		$result = mysql_query($sql);

		while( $orders = mysql_fetch_assoc($result) ){
              $list[]=$orders;
            }

    	echo json_encode($list,256);

?>