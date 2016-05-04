<?php

// function checkLogined(){
// 	if($_SESSION['adminId']==""&&$_COOKIE['adminId']==""){
// 		alertMes("请先登陆","login.php");
// 	}
// }

function userCheck()
{
	if($_SESSION['loginFlag']!=2){
		echo "<script>alert('不登录就想进去？你想的美！');</script>";
		echo "<script>window.location='login.html';</script>";
	}
}

function checkSession()
{
	if($_SESSION['username']==""&&$_COOKIE['username']==""){
		echo "<script>alert('不登录就想进去？你想的美！');</script>";
		echo "<script>window.location='login.html';</script>";
	}
	
}

function adminCheck()
{
	if($_SESSION['loginFlag']!=1 || ($_SESSION['username']==""&&$_COOKIE['username']=="")){
		echo "<script>alert('不登录就想进去？你想的美！');</script>";
		echo "<script>window.location='../login.html';</script>";
	}
}

?>