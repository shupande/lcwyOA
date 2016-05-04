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
        padding-bottom: 40px;
        color: #5a5a5a;
        font-family: 微软雅黑;
    }
    #new{
        float: right;
    }
    /*搜索样式*/
    .filter-table .quick { margin-left: 0.5em; font-size: 0.8em; text-decoration: none; }
    .fitler-table .quick:hover { text-decoration: underline; }
    td.alt { background-color: #ffc; background-color: rgba(255, 255, 0, 0.2); }

    .pagination{
        margin-top: -10px;
        float: left;
    }
    
    .list-group-item-text {
        font-size: 10px;
        color: #9F9F9F;
    }

    .badge {
        margin-left: 5px;
        background-color: red;
        font-size: 0.5em;
    }
    
    </style>
    <script type="text/javascript">
    getAllOrders();

    function getAllOrders () {
        //清空表数据
        $("#grid").html("");
        //判断当前页码
        $.ajax({
            type: "GET",
            url: "getAllOrders.php",
            dataType: "json",
            success: function (data) {
                 $.each(data,function (i,n) {
                    var tbBody="";
                    //var seq=0;
                    if(n.order_status<3){
                        //seq++;
                        if(n.order_status==0){
                            tbBody +='<tr><td>'+(i+1)+'</td><td><a href="orderDetails.php?order_id='+n.order_id+'">'+n.order_id+'<span class="badge">new</span></a></td><td>'+n.order_user+'</td><td><a href="orderDetails.php?order_id='+n.order_id+'" class="text-danger">未打印</a></td><td><a class="btn btn-danger" onclick="del(this,\''+n.order_id+'\')" role="button">删除</a></td></tr>';
                        }else if(n.order_status==1){
                            tbBody +='<tr><td>'+(i+1)+'</td><td><a href="orderDetails.php?order_id='+n.order_id+'">'+n.order_id+'</td><td>'+n.order_user+'</a></td><td><a href="orderDetails.php?order_id='+n.order_id+'">已打印</a></td><td><a class="btn btn-danger" onclick="del(this,\''+n.order_id+'\')" role="button">删除</a></td></tr>';
                        }else{
                            tbBody +='<tr><td>'+(i+1)+'</td><td><a href="orderDetails.php?order_id='+n.order_id+'">'+n.order_id+'</td><td>'+n.order_user+'</a></td><td><a href="orderDetails.php?order_id='+n.order_id+'" class="text-success">已发货</a></td><td><a class="btn btn-default disabled" onclick="del(this,\''+n.order_id+'\')" role="button">删除</a></td></tr>';
                        }
                    }
                    $("#grid").append(tbBody);
                 });
                    
                    //数据加载完后开启搜索支持
                     $('table').filterTable({ // apply filterTable to all tables on this page
                        inputSelector: '#input-filter',//自带搜索框支持
                        filterExpression: 'filterTableFindAll',//模糊查询
                        minRows:1//一行起搜索
                    });
            },
            error: function  (jqXHR) {
                console.log("出错啦！"+jqXHR.status);
            }
        });
    }

    function del(row,order_id) {
        var $this = $(row);
        if (confirm("确定要删除吗!")) {
            $this.parents("tr").remove();
            //数据库更新
            $.ajax({
            type: "GET",
            cache: false,
            url: "delOrders.php?order_id="+order_id,
            success: function (data) {
                 if(data>0){
                    console.log("删除成功！");
                 }
            },
            error: function  (jqXHR) {
                console.log("出错啦！"+jqXHR.status);
            }
        });
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
                <h1 class="page-header">订单管理</h1>
    <input type="search" class="form-control" placeholder="搜索订单..." id="input-filter">
    <p id="printAll"><a href="printAllNew.php" target="_blank">打印所有新订单总数</a></p>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>订单号</th>
                <th>下单人</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody id="grid">
        </tbody>
    </table>
            </div>

        </div>
    </div>
</body>

</html>
