<?php
    require_once 'include.php';

	//获取值
	$password=$_POST['password'];
	$repassword=$_POST['repassword'];
	$username=$_SESSION['username'];


	//sql查询是否正确
	$sql="select * from user where password='{$password}' and username='{$username}'";
	$result = mysql_query($sql);
	$row=mysql_fetch_array($result,MYSQL_ASSOC);


	if($row){
		$sql="update user set password='$repassword' where username='$username'";
		$result=mysql_query($sql);
		if($_SESSION['loginFlag']==1){
			echo "<script>window.location='admin/finish.php';</script>";
		}else{
			echo "<script>window.location='finish.php';</script>";
		}
	}else{
		echo "<script>alert('原始密码输入错误，请重新输入！');</script>";
		echo "<script>window.location='modifypwd.php';</script>";
	}
	

?>