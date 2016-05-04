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
    <!-- 搜索支持 -->
    <script src="../js/jquery.filtertable.min.js"></script>
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
    .badge {
        background-color: red;
        font-size: 0.5em;
    }
    td.alt { background-color: #ffc; background-color: rgba(255, 255, 0, 0.2); }

    /* special filter field styling for this example */
    .input-filter-container { position: fixed; top: 1em; right: 1em; border: 2px solid #f60; background-color: #fed; padding: 0.5em; border-radius: 4px; }

    
    .pagination {
        margin-top: -15px;
        float: left;
    }
    
    .list-group-item-text {
        font-size: 10px;
        color: #9F9F9F;
    }
    
    .badge,
    .search,
    .btn {
        float: right;
    }
    
    .search {
        max-width: 100px;
    }
    
    #modifypwd {
        max-width: 350px;
        /*right: 30%;*/
    }

    small {
        font-size: 1em;
    }
    </style>

    <script type="text/javascript">
    var total;
    init();
    function init() {
       total = 0;
    }

    function Check() {
        var boxArray = document.getElementsByName('ck_product');
        init();
        for (var i = 0; i < boxArray.length; i++) {
            if (boxArray[i].checked) {
                total++;
            }
        }
        if (total > 5) {
            alert('最多一次查询5种商品，请重新选择！');
            return false;
        }

    }

    function checkAll() {
        if (total > 5 || total<1) {
            alert('选择错误，请重新选择！');
        } else {
            window.location.href = "statisticsChooseStore.html";
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
        <h1 class="page-header">报表统计<small>选择商品</small></h1>
    <input type="search" class="form-control" placeholder="搜索商品..." id="input-filter">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>商品名称</th>
                <th>选择</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>魅族MX5 公开版32G银翼</td>
                <td>
                    <input type="checkbox" name="ck_product" onclick="Check();" value="魅族MX5 公开版32G银翼">
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>魅族MX5 联通版32G银黑</td>
                <td>
                    <input type="checkbox" name="ck_product" onclick="Check();" value="魅族MX5 联通版32G银黑">
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>魅族Pro5 公开版64G银黑</td>
                <td>
                    <input type="checkbox" name="ck_product" onclick="Check();" value="魅族Pro5 公开版64G银黑">
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td>魅族Pro5 公开版64G金色</td>
                <td>
                    <input type="checkbox" name="ck_product" onclick="Check();" value="魅族Pro5 公开版64G金色">
                </td>
            </tr>
            <tr>
                <td>5</td>
                <td>魅蓝metal 电信版16G白色</td>
                <td>
                    <input type="checkbox" name="ck_product" onclick="Check();" value="魅蓝metal 电信版16G白色">
                </td>
            </tr>
            <tr>
                <td>6</td>
                <td>魅蓝metal 电信版16G白色</td>
                <td>
                    <input type="checkbox" name="ck_product" onclick="Check();" value="魅蓝metal 电信版16G白色">
                </td>
            </tr>
        </tbody>
    </table>
        <a class="btn btn-success" href="#" role="button">下一步</a>
        </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
        $('table').filterTable({ // apply filterTable to all tables on this page
            inputSelector: '#input-filter',
            minRows:1
        });
    });
    </script>
</body>

</html>
