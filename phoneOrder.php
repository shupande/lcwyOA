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
    <!-- 搜索支持 -->
    <script src="js/jquery.filtertable.min.js"></script>
    <!-- cookie支持 -->
    <script src="js/jquery.cookie.js"></script>
    <!-- 通知获取 -->
    <script src="js/notifications.js"></script>
    <!-- 获取时间 -->
    <script type="text/javascript" src="js/daterangepicker/moment.js"></script>
    <!-- 主样式 -->
    <link rel="stylesheet" href="style/main.css">
    <style>
    body {
        padding-top: 50px;
        color: #5a5a5a;
        font-family: 微软雅黑;
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
    
    .badge,.search {
        float: right;
    }
    .few td {
        color: red;
    }
    
    #nextbutton {
        margin-top: -15px;
        float: right;
    }

    /*加载动画样式*/

    .wrapper{
    width:54px;
    height:25px;
    position:absolute;
    top:50%;
    left:50%;
    /*margin-left:-27px;*/
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

    </style>
    <script type="text/javascript">
        //获取手机库存列表
        function getData(page) {
            $.ajax({
                type: "GET",
                url: "getUserStock.php?page="+page,
                dataType: "json",
                success: function (data) {
                    $("#loading").hide();
                    $("#grid").html("");
                    var tbBody="";
                    //序号
                    var seq=0;
                     $.each(data,function (i,n) {
                        var num=n.stock-n.un_stock;//显示的数量
                        //大于0的显示，否则不显示
                        if(num>0){
                            seq++;
                            tbBody +="<tr><td class='hidden-xs'>"+(seq)+"</td><td class='hidden-xs'>"+n.gjp_id+"</td><td name='good_name' class='hidden-xs'>"+n.good_name+"</td><td name='model'>"+n.model+"</td><td name='color'>"+n.color+"</td><td name='capacity'>"+n.capacity+"</td><td name='num'>"+num+"</td><td><input type='checkbox' name='ck_product' value='"+n.gjp_id+"'></td></tr>";
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
                    alert("获取库存失败，请点击订货菜单重试。错误代码："+jqXHR.status);
                }
            });
    }

    $(document).ready(function () {
            getData();
            if(!navigator.cookieEnabled){
                alert("你的浏览器没有开启cookie,将无法正常下单！请开启后再使用！");
            }
            //下单时间限制
            var currentTime=moment().format("HH:mm");
            // alert(currentTime);
            if(currentTime>"17:00" || currentTime < "09:30"){
                $("#tips").text("提示：17:00-09:30本时间段不允许下单！").css("color","red");
                $("#nextbutton").addClass("disabled");
            }else{
                $("#tips").text("");
                $("#nextbutton").removeClass("disabled");
            }
     });

    //写入cookie，不设定时间，关闭浏览器即销毁，path=/ 全站有效
    function writeCookie (name,value) {

        $.cookie(name,value);
        // document.cookie = name + "=" +value +"; path=/";
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
            var good_name=row.find("[name='good_name']").text();
            var model=row.find("[name='model']").text();
            var color=row.find("[name='color']").text();
            var capacity=row.find("[name='capacity']").text();
            var num=row.find("[name='num']").text();
            selectedData.push({Good_name:good_name,Model:model,Color:color,Capacity:capacity,Num:num,Gjp_id:gjp_id});
            
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
            writeCookie("goodInfo",JSON.stringify(selectedData));
        }
        
    }

    function next () {
        addCar();
        if(flag){
            location.href="caseOrder.php";
        }else{
            $("#tips").text("请先添加需要的商品！").css("color","red");
            setTimeout(function () {
                $("#tips").text("");
            }, 800);
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
    <h1 class="page-header">订货</h1>
    <input type="search" class="form-control" id="input-filter" placeholder="搜索当前页...">
    <span id="tips"></span>
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="hidden-xs">#</th>
                <th class="hidden-xs">管家婆编号</th>
                <th class="hidden-xs">商品名称</th>
                <th>型号</th>
                <th>颜色</th>
                <th>容量</th>
                <th>数量</th>
                <th>选择</th>
            </tr>
        </thead>
        <tbody id="grid">
        </tbody>
    </table>
        <a class="btn btn-success" onclick="return next();"  role="button" id="nextbutton">下一步</a>
    <!-- 加载动画 -->
        <div id="loading">
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
