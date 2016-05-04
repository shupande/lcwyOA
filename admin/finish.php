<?php
require_once '../include.php';
adminCheck();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>五洲联鑫办公系统</title>
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="../js/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="../js/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="../js/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- 通知获取 -->
    <script src="js/notifications.js"></script>
    <!-- 主样式 -->
    <link rel="stylesheet" href="../style/main.css">
    <style>
    body {
        padding-top: 50px;
        color: #5a5a5a;
        font-family: 微软雅黑;
    }
    
    #orderSuccess {
        text-align: center;
    }
    
    #orderSuccess p {
        font-size: 2em;
        color: gray;
        margin-top: 10px;
    }
    
    .glyphicon {
        font-size: 10em;
        color: green;
    }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            setTimeout(function () {
                location.href="orderManage.php"
            },1500);
        });
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
                    <div class="scroll visible-md-block visible-lg-block">
                        <ul class="list">
                            <div id="roll_li"></div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <div class="visible-xs-block">
                    <div class="nav navbar-nav navbar-right">
                        <li><a href="assign.php">分货</a></li>
                        <li><a href="adminStock.php">库存管理</a></li>
                        <li><a href="orderManage.php">查看订单</a></li>
                        <li><a href="statisticsChoose.php">报表统计</a></li>
                        <li><a href="notification.php">发送通知</a></li>
                        <li><a href="accountManage.php">账号管理</a></li>
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
    <!--自适应布局-->
    <div class="container-fluid">
        <div class="row">
            <!--左侧导航栏-->
            <div class="col-sm-3 col-md-2 sidebar hidden-xs">
                <div class="list-group">
                    <a href="assign.php" class="list-group-item">
                        <h4 class="list-group-item-heading">分货</h4>
                        <p class="list-group-item-text">指定货物给专卖店</p>
                    </a>
                    <a href="adminStock.php" class="list-group-item">
                        <h4 class="list-group-item-heading">库存管理</h4>
                        <p class="list-group-item-text">新增或修改商品及库存</p>
                    </a>
                    <a href="orderManage.php" class="list-group-item">
                        <h4 class="list-group-item-heading">查看订单<span class="badge" id="new">4</span></h4>
                        <p class="list-group-item-text">查看、管理、打印详细订单</p>
                    </a>
                    <a href="statisticsChoose.php" class="list-group-item">
                        <h4 class="list-group-item-heading">报表统计</h4>
                        <p class="list-group-item-text">指定查询某个专卖店在某个时段的某个商品或全部订货总量</p>
                    </a>
                    <a href="notification.php" class="list-group-item">
                        <h4 class="list-group-item-heading">发送通知</h4>
                        <p class="list-group-item-text">向专卖店发送通知信息</p>
                    </a>
                    <a href="accountManage.php" class="list-group-item">
                        <h4 class="list-group-item-heading">账号管理</h4>
                        <p class="list-group-item-text">添加管理专卖店账号和密码</p>
                    </a>
                    <a href="modifyPwd.php" class="list-group-item">
                        <h4 class="list-group-item-heading">修改密码</h4>
                        <p class="list-group-item-text">修改登录密码</p>
                    </a>
                </div>
            </div>
            <!--右侧管理控制台-->
            <div class="col-sm-9  col-xs-12 col-sm-offset-3 col-md-10 col-md-offset-2 col-lg-10 main">
    <h1 class="page-header">提醒</h1>
        <div class="center-block" id="orderSuccess">
            <span class="glyphicon glyphicon-ok text-success" aria-hidden="true"></span>
            <p>操作成功</p>
        </div>
        </div>
        </div>
        </div>
</body>
</html>
