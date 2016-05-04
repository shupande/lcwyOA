<?php
	require_once 'include.php';
	// 取得用户名和密码
	$username=$_POST['username'];
	$password=$_POST['password'];
	$autoFlag=$_POST['ck_rmbUser'];


	//sql查询
	$sql="select * from user where username='{$username}' and password='{$password}'";
	$result = mysql_query($sql);
	$row=mysql_fetch_array($result,MYSQL_ASSOC);

	//跳转判断
	if($row && $row['permission']==1){
		rmb_status($autoFlag);
		$_SESSION['loginFlag']=$row['permission'];
		$_SESSION['username']=$row['username'];
		echo "<script>window.location='admin/orderManage.php';</script>";
	}else if($row && $row['permission']==2){
		rmb_status($autoFlag);
		//将用户名存入session
		$_SESSION['loginFlag']=$row['permission'];
		$_SESSION['username']=$row['username'];
		echo "<script>window.location='phoneOrder.php';</script>";
	}else{
		echo"<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>";
		echo "<script>alert('登录失败');</script>";
		echo "<script>window.location='login.html';</script>";
	}

 function rmb_status($autoFlag)
{
	if($autoFlag){
			setcookie("adminId",$row['id'],time()+7*24*3600);
			setcookie("adminName",$row['username'],time()+7*24*3600);
		}
		$_SESSION['adminName']=$row['username'];
		$_SESSION['adminId']=$row['id'];
}
	
?>