<?php
    require_once '../include.php';
    checkSession();
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
    .badge {
        float: right;
        background-color: red;
        font-size: 0.5em;
    }
    </style>
    <script type="text/javascript">
    // 格式验证
    function check() {
        var str = $("#notifiDetail").val().trim();
        //防止JS注入
        var caseText=$("#notifiDetail").val();
        var status1=caseText.indexOf("javascript");
        var status2=caseText.indexOf("script");
        if(status1>-1 || status2>-1){
            $("#warning").text("非法输入！");
            return false;
        }
        
        //长度检查
        if (str.length > 30 || str.length < 2) {
            $("#warning").text("长度错误，请修改！");
            return false;
        }else{
            getData();
        }
        
        

    }
    //提示信息
    function clearSpan() {
        $("#warning").text("");
    }

    //表格操作
    // function del(row) {
    //     var $this = $(row);
    //     var id=$this.parents("tr").children("td:first").text();
    //     // alert(id);
    //     $this.parents("tr").remove();
    //     delNotify(id);
    // }


    function getData() {
        $.ajax({
            type: "GET",
            url: "../getNotifications.php?number="+50+"&str=*",
            // dataType: "json",
            success: function (data) {
                $("#grid").html("");
                 var string=$.parseJSON(data);
                 $.each(string,function (i,n) {
                    // alert(n.content);
                    var tbBody="";
                    if(n.is_delete==0){
                        tbBody +="<tr><td>"+n.id+"</td><td>"+n.create_time+"</td><td>"+n.content+"</td><td>"+n.sender+"</td><td><a class='btn btn-danger' onclick='delNotify(this)' role='button'>删除</a></td></tr>";
                        $("#grid").append(tbBody);
                    }
                 });
            },
            error: function  (jqXHR) {
                alert("出错啦！"+jqXHR.status);
            }
        });
    }

    function delNotify(row) {
        var $this = $(row);
        var id=$this.parents("tr").children("td:first").text();
        $.ajax({
            type: "GET",
            url: "delNotify.php?id="+id,
            // dataType: "json",
            success: function (data) {
                // alert("成功！");
                window.location='notification.php';
            },
            error: function  (jqXHR) {
                alert("出错啦！"+jqXHR.status);
            }
        });
    }

    $(document).ready(function () {
        getData();
    })

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
        <h1 class="page-header">发送通知</h1>
        <form class="form-inline" method="post" action="../addNotification.php" onsubmit="return check();">
            <div class="form-group">
                <label for="notifiDetail" class="sr-only">请输入通知:</label>
                <!-- 盲人读屏幕软件专用 不会显示出来-->
                <input type="text" class="form-control" name="notification" id="notifiDetail" placeholder="不得少于1个或超过30个字" required autofocus onclick="clearSpan()"  style="width:450px;">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">发送</button>
            </div>
        </form>
    <span id="warning"></span>
    <hr/>
     <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>时间</th>
                <th>内容</th>
                <th>发送人</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody id="grid">
            <!-- Ajax插入数据 -->
        </tbody>
    </table> 
    </div>
        </div>
    </div>
</body>

</html>
