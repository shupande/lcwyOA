<?php
require_once 'include.php';
checkSession();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>五洲联鑫订货系统</title>
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
    
    #modifypwd {
        max-width: 350px;
        /*right: 30%;*/
    }
    
    #warning {
        color: red;
        /*position: relative;*/
        /*top: 150px;*/
        /*left: 355px;*/
        /*margin-left: 100px;*/
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
    
    .badge {
        float: right;
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
    </style>
    <script type="text/javascript">
    function check() {
        var userStr = $("#userpassword").val().trim();
        var pwdStr = $("#newpassword").val().trim();
        var reStr = $("#repassword").val().trim();

        if (pwdStr != reStr) {
            // $("#warning").text("两次密码输入不一致，请修改！");
            alert("两次密码输入不一致，请修改！");
            return false;
        }
    }
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
    <div>
        <h1 class="page-header">修改密码</h1>
        <form id="modifypwd" method="post" action="doModifypwd.php" onsubmit="return check();">
            <div class="form-group">
                <input type="password" class="form-control" id="userpassword" placeholder="原始密码" name="password" required autofocus>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="newpassword" placeholder="新密码" name="newpassword" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="repassword" placeholder="新密码" name="repassword" required>
            </div>
            <!-- <span id="warning"></span> -->
    <button class="btn btn-success btn-block" type="submit">确定</button>
    </form>
    </div>
      </div>
    </div>
    </div>
</body>

</html>
