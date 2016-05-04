<?php
require_once 'include.php';
checkSession();
userCheck();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>五洲联鑫办公系统</title>
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="js/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="js/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="js/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- 通知获取 -->
    <script src="js/notifications.js"></script>
    <style>
    body {
        padding-top: 50px;
        /*padding-bottom: 40px;*/
        color: #5a5a5a;
        font-family: 微软雅黑;
    }
    pan{
        font-size: 100%;
        margin-right: 10px;
    }
    #time{
        margin-top:10px;
        font-size: 100%;
    }
    strong{
        color: red;
    }
    
    /* 下面是左侧导航栏的代码 */
    
    .sidebar {
        position: fixed;
        top: 51px;
        bottom: 0;
        left: 0;
        z-index: 1000;
        display: block;
        padding: 5px;
        overflow-x: hidden;
        overflow-y: auto;
        background-color: #ddd;
        border-right: 1px solid #eee;
    }
    
    .nav-sidebar {
        margin-right: -21px;
        margin-bottom: 20px;
        margin-left: -20px;
    }
    
    .nav-sidebar > li > a {
        padding-right: 20px;
        padding-left: 20px;
    }
    
    .nav-sidebar > .active > a,
    .nav-sidebar > .active > a:hover,
    .nav-sidebar > .active > a:focus {
        color: #fff;
        background-color: #428bca;
    }
    
    .main {
        padding: 20px;
    }
    
    .main .page-header {
        margin-top: 0;
    }
    
    .list-group-item-text {
        font-size: 10px;
        color: #9F9F9F;
    }

    img{
        max-width: 320px;
        clear: both;
        display: block;
        margin: auto;
    }
    /*滚动消息*/
    
    .list,
    li {
        list-style: none;
    }
    
    .scroll {
        height: 25px;
        overflow: hidden;
    }
    
    .scroll li {
        overflow: hidden;
    }
    
    .scroll li a {
        font-size: 14px;
        color: #1DEA9A;
        text-decoration: none;
    }
    
    .scroll li a:hover {
        text-decoration: underline;
    }

    /*加载动画样式*/

    .wrapper{
    width:54px;
    height:25px;
    position:absolute;
    top:50%;
    left:50%;
    margin-left:-27px;
    margin-top:50px;
    }

    #preloader_4{
        position:relative;
    }
    #preloader_4 span{
        position:absolute;
        width:20px;
        height:20px;
        background:#3498db;
        opacity:0.5;
    border-radius:20px;
        -webkit-animation: preloader_4 1s infinite ease-in-out;
        -moz-animation: preloader_4 1s infinite ease-in-out;
        -ms-animation: preloader_4 1s infinite ease-in-out;
        -animation: preloader_4 1s infinite ease-in-out;

    }
    #preloader_4 span:nth-child(2){
        left:20px;
        -webkit-animation-delay: .2s;
        -moz-animation-delay: .2s;
        -ms-animation-delay: .2s;
        animation-delay: .2s;
    }
    #preloader_4 span:nth-child(3){
        left:40px;
        -webkit-animation-delay: .4s;
        -moz-animation-delay: .4s;
        -ms-animation-delay: .4s;
        animation-delay: .4s;
    }
    #preloader_4 span:nth-child(4){
        left:60px;
        -webkit-animation-delay: .6s;
        -moz-animation-delay: .6s;
        -ms-animation-delay: .6s;
        animation-delay: .6s;
    }
    #preloader_4 span:nth-child(5){
        left:80px;
        -webkit-animation-delay: .8s;
        -moz-animation-delay: .8s;
        -ms-animation-delay: .8s;
        animation-delay: .8s;
    }

    @-webkit-keyframes preloader_4 {
        0% {opacity: 0.3; -webkit-transform:translateY(0px);    box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.1);}
        50% {opacity: 1; -webkit-transform: translateY(-10px); background:#f1c40f;  box-shadow: 0px 20px 3px rgba(0, 0, 0, 0.05);}
        100%  {opacity: 0.3; -webkit-transform:translateY(0px); box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.1);}
    }
    @-moz-keyframes preloader_4 {
        0% {opacity: 0.3; -moz-transform:translateY(0px);   box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.1);}
        50% {opacity: 1; -moz-transform: translateY(-10px); background:#f1c40f; box-shadow: 0px 20px 3px rgba(0, 0, 0, 0.05);}
        100%  {opacity: 0.3; -moz-transform:translateY(0px);    box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.1);}
    }
    @-ms-keyframes preloader_4 {
        0% {opacity: 0.3; -ms-transform:translateY(0px);    box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.1);}
        50% {opacity: 1; -ms-transform: translateY(-10px); background:#f1c40f;  box-shadow: 0px 20px 3px rgba(0, 0, 0, 0.05);}
        100%  {opacity: 0.3; -ms-transform:translateY(0px); box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.1);}
    }
    @keyframes preloader_4 {
        0% {opacity: 0.3; transform:translateY(0px);    box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.1);}
        50% {opacity: 1; transform: translateY(-10px); background:#f1c40f;  box-shadow: 0px 20px 3px rgba(0, 0, 0, 0.05);}
        100%  {opacity: 0.3; transform:translateY(0px); box-shadow: 0px 0px 3px rgba(0, 0, 0, 0.1);}
    }

    </style>
    <script type="text/javascript">


    //获取数据
    function getCode() {
       $.ajax({
            type: "GET",
            url: "getCode.php",
            dataType: "json",
            success: function (data) {
                $("#content").html("");
                 var tbody="";
                 $.each(data,function (i,n) {
                    tbody +="<div class='well' style='text-align:center;'><span class='badge' style='font-size:1.3em;'>"+n.code+"</span><p id='time' style='font-size:1em;'><kbd>验证码接收于："+n.create_time+" 五分钟内有效</kbd></p></div>";
                 });
                 $("#content").append(tbody);
            },
            error: function  (jqXHR) {
                console.log("获取验证码出错啦！"+jqXHR.status);
            }
        });
    }





    $(document).ready(function() {
        getCode();
    });

    setInterval(function () {
                //先清空
                $("#content").html();
                //再获取新的数据添加进页面
                getCode();
            },7000);
    </script>
</head>

<body>
    <!--下面是顶部导航栏的代码-->
    <nav class="navbar navbar-default navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-brand">五洲联鑫办公系统</div>
                <div class="navbar-brand">
                    <div class="scroll visible-md-block visible-lg-block visible-lg-block">
                        <ul class="list">
                            <div id="roll_li"></div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <div class="visible-xs-block">
                    <div class="nav navbar-nav navbar-right">
                        <li><a href="phoneOrder.php">订货</a></li>
                        <li><a href="myOrders.php">我的订单</a></li>
                        <li><a href="#">报表</a></li>
                        <li><a href="receivedCode.php">验证码</a></li>
                        <li><a href="download.php">资料下载</a></li>
                        <li><a href="modifyPwd.php">修改密码</a></li>
                        <li class="divider"></li>
                    </div>
                </div>
                <div class="nav navbar-nav navbar-right">
                    <li><a href="modifyPwd.php"><?php echo $_SESSION['username'];?></a></li>
                    <li><a href="javascript:quit();">退出</a></li>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <!--左侧导航栏-->
            <div class="col-sm-3 col-md-2 sidebar hidden-xs">
                <div class="list-group">
                    <a href="phoneOrder.php" class="list-group-item">
                        <h4 class="list-group-item-heading">订货</h4>
                        <p class="list-group-item-text">向仓库订货</p>
                    </a>
                    <a href="myOrders.php" class="list-group-item">
                        <h4 class="list-group-item-heading">我的订单</h4>
                        <p class="list-group-item-text">查看订单及状态和物流信息</p>
                    </a>
                    <a href="#" class="list-group-item">
                        <h4 class="list-group-item-heading">报表</h4>
                        <p class="list-group-item-text">填写发送每日销售报表</p>
                    </a>
                    <a href="receivedCode.php" class="list-group-item">
                        <h4 class="list-group-item-heading">验证码</h4>
                        <p class="list-group-item-text">查收运营商开户验证码</p>
                    </a>
                    <a href="download.php" class="list-group-item">
                        <h4 class="list-group-item-heading">资源下载</h4>
                        <p class="list-group-item-text">下载相关资料</p>
                    </a>
                    <a href="modifyPwd.php" class="list-group-item">
                        <h4 class="list-group-item-heading">修改密码</h4>
                        <p class="list-group-item-text">修改登录密码</p>
                    </a>
                </div>
            </div>
    <!--右侧管理控制台-->
    <div class="col-sm-9  col-xs-12 col-sm-offset-3 col-md-10 col-md-offset-2 col-lg-10 main">
    
        <h1 class="page-header">运营商开户验证码</h1>
            <div id="content">
                <!-- 加载中 -->
                <div class="wrapper">
                    <div id="preloader_4">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                    </div>
                </div>
            </div>
      </div>
    </div>
    </div>
</body>

</html>
