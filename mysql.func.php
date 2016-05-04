<?php
	$link=mysql_connect("localhost","root","111111") or die("数据库连接失败Error:".mysql_errno().":".mysql_error());
	mysql_set_charset("UTF-8");
	mysql_select_db("lcwy_oa",$link) or die("指定数据库打开失败");
?>