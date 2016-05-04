<?php
require_once '../include.php';

	//获取值
	$username=$_POST['username'];
	$password=$_POST['repassword'];
	$permission=$_POST['ck_User'];

	// $permission=1;
	//判断账号类型
	if($permission){
		$permission=1;
	}else{
		$permission=2;
	}

	//执行操作
	//插入表
	$sql="insert into user(username,password,permission) values('$username','$password',$permission)";
	$result=mysql_query($sql);
		 



	if($result==1){
		echo "<script>window.location='finish.php';</script>";
	}else{
		echo"<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
		echo "<script>alert('账号重复，添加失败！');</script>";
		echo "<script>window.location='addAccount.php';</script>";
	}

?>