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
        float: right;
        background-color: red;
        font-size: 0.5em;
    }
    #nextbutton{
        float: right;
    }

    /*搜索样式*/
    .filter-table .quick { margin-left: 0.5em; font-size: 0.8em; text-decoration: none; }
    .fitler-table .quick:hover { text-decoration: underline; }
    td.alt { background-color: #ffc; background-color: rgba(255, 255, 0, 0.2); }

    </style>
    <script type="text/javascript">
    //获取手机库存列表
        function getData() {
            $.ajax({
                type: "GET",
                url: "getUserList.php",
                dataType: "json",
                success: function (data) {
                    $("#grid").html("");
                    var tbBody="";
                    var j=1;
                     $.each(data,function (i,n) {
                        console.log("......");
                        //大于0的显示，否则不显示
                        if(n.permission==2){
                            tbBody +="<tr><td>"+j+"</td><td name='username'>"+n.username+"</td><td><input type='checkbox' name='ck_product'></td></tr>";
                            j++;
                        }
                     });
                     $("#grid").append(tbBody);
                    //数据加载完后开启搜索支持
                     $('table').filterTable({ // apply filterTable to all tables on this page
                        inputSelector: '#input-filter',//自带搜索框支持
                        filterExpression: 'filterTableFindAll',//模糊查询
                        minRows:1//一行起搜索
                    });
                },
                error: function  (jqXHR) {
                    alert("获取库存失败，请刷新重试。错误代码："+jqXHR.status);
                }
            });
    }

    //写入cookie，不设定时间，关闭浏览器即销毁，path=/ 全站有效
    function writeCookie (name,value) {

        document.cookie = name + "=" +value +"; path=/";
    }

    // 判定是否选择了商品
    var flag=false;

    function addCar() {
        //空数组
        var selectedData=[];
        //获取选中行的数据
        $(":checkbox:checked").each(function() {
            var gjp_id=$(this).val();
            var row=$(this).parent("td").parent("tr");
            var username=row.find("[name='username']").text();
            selectedData.push({Username:username});
        });
        
        if(selectedData==""){
            $("#tips").text("请先勾选！").css("color","red");
            setTimeout(function () {
                $("#tips").text("");
            }, 800);
        }else{
            // $("#tips").text("添加成功！").css("color","green");
            flag=true;
            // setTimeout(function () {
            //     $("#tips").text("");
            // }, 800);
            // console.log(JSON.stringify(selectedData));
            //转换成JSON格式，再调用写入cookie方法
            writeCookie("storeInfo",JSON.stringify(selectedData));
        }
        
    }

    //全选控制
    function selectAll () {
        var str=$("#selectAll").text();
        if(str=="全选"){
            $(":checkbox").prop("checked", true);
            $("#selectAll").text("取消全选");
        }else{
            $(":checkbox").prop("checked", false);
            $("#selectAll").text("全选");
        }
    }

    function next () {
        addCar();
        if(flag){
            location.href="assignDetail.php";
        }else{
            $("#tips").text("请选择专卖店！").css("color","red");
            setTimeout(function () {
                $("#tips").text("");
            }, 800);
            return false;
        }
    }


    $(document).ready(function () {
            getData();
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
        <h1 class="page-header">分货<small>选择专卖店</small></h1>
    <input type="search" class="form-control" id="input-filter" placeholder="搜索当前页...">
    <span id="tips"></span>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>专卖店</th>
                <th>选择</th>
            </tr>
        </thead>
        <tbody id="grid">
        </tbody>
    </table>
    <div><a href="javascript:selectAll();" id="selectAll">全选</a></div>
    <div class="btn-group" role="group" aria-label="..." id="nextbutton">
        <a class="btn btn-primary" href="assign.php" role="button">上一步</a>
        <a class="btn btn-success" onclick="return next();"  role="button">下一步</a>
    </div>
        </div>
        </div>
    </div>
</body>

</html>

    

