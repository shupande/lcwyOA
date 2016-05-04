<?php
	require_once 'include.php';

	//获取值
	$content=$_POST['notification'];
	$sender=$_SESSION['username'];

	//执行操作
	//插入表
	$sql="insert into notification(content,sender) values('$content','$sender')";
	$result=mysql_query($sql);
		 

	if($result==1){
		echo "<script>window.location='admin/notification.php';</script>";
	}else{
		echo "<script>alert('发送失败！请重试！');</script>";
		echo "<script>window.location='admin/notification.php';</script>";
	}

?>