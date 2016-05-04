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
    <link rel="stylesheet" href="js/daterangepicker/daterangepicker.css">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="js/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="js/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- 通知获取 -->
    <script src="js/notifications.js"></script>
    <!-- 主样式 -->
    <link rel="stylesheet" href="style/main.css">
    <!-- 日历插件 -->
    <script type="text/javascript" src="js/daterangepicker/moment.js"></script>
    <script type="text/javascript" src="js/daterangepicker/daterangepicker.js"></script>
    <style>
    body {
        padding-top: 50px;
        color: #5a5a5a;
        font-family: 微软雅黑;
    }
    .well{
        color: red;
    }
    .badge{
        float: right;
    }
    #editbuttons {
        float: right;
        /*margin-bottom: 20px;*/
        margin-top: 20px;
    }
    .demo {
        position: relative;
        max-width: 350px;
    }
    
    #config-demo{
        max-width: 350px;
    }
    .demo i {
        position: absolute;
        bottom: 10px;
        right: 5px;
        top: auto;
        cursor: pointer;
    }
    #error {
        margin-top: 100px;
        font-size: 10em;
        color: #EE000B;
    }
    #content p{
        font-size: 2em;
        color: gray;
        margin-top: 10px;
    }
    .case{
        font-size: 1.1em;
        color: gray;
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
    <script type="text/javascript">

        function getOrders (date) {
            $.ajax({
                type:"get",
                url:"getOrders.php?date="+date,
                dataType: "json",
                success:function (data) {
                    $("#content").html("");
                    var tbTitle="";
                    if(data==null){
                        tbTitle="<span class='glyphicon glyphicon-remove' id='error' aria-hidden='true'></span><p>无当前日期订单，请选择其他日期。</p>";
                        $("#content").append(tbTitle);
                        $("#content").css("text-align", "center");
                        return;
                    }
                    //添加数据到页面
                    $.each(data,function (i,n) {
                            if(n.order_status==2){
                                tbTitle+="<div class='panel panel-success'><div class='panel-heading'><h3 class='panel-title'>订单："+n.order_id+"<span class='badge'>已发货</span></h3></div><div class='panel-body'><table class='table table-striped'><thead><th>#</th><th class='hidden-xs'>品名</th><th>型号</th><th>颜色</th><th>容量</th><th>数量</th></thead><tbody id='"+n.order_id+"confirm'></tbody></table><div><li>配件/留言：</li><br/><li class='case' id='"+n.order_id+"case_tips'></li><br/></div><label>快递单号："+n.express_company+"</label><div class='well text-center'>"+n.express_no+"<br><div id='express_detail' class='hidden-xs'></div><div class='visible-xs'>手机暂不支持自动跟踪快递记录，请登录电脑查看。</div></div></div></div>";
                                express_detail(n.express_company,n.express_no);
                            }
                            if(n.order_status==0){
                                tbTitle+='<div class="panel panel-danger" id="'+n.order_id+'"><div class="panel-heading"><h3 class="panel-title">订单：'+n.order_id+'<span class="badge">未确认</span></h3></div><div class="panel-body"><table class="table table-striped"><thead><th>#</th><th class="hidden-xs">品名</th><th>型号</th><th>颜色</th><th>容量</th><th>数量</th></thead><tbody id="'+n.order_id+'confirm"></tbody></table><div><li>配件/留言：</li><br/><li class="case" id="'+n.order_id+'case_tips"></li><br/></div><button type="button" id="editbuttons" onclick="javascript:del(\''+n.order_id+'\');" class="btn btn-danger">删除订单</button></div></div>';
                            }
                            if(n.order_status==1){
                                tbTitle+="<div class='panel panel-primary'><div class='panel-heading'><h3 class='panel-title'>订单："+n.order_id+"<span class='badge'>正在处理</span></h3></div><div class='panel-body'><table class='table table-striped'><thead><th>#</th><th class='hidden-xs'>品名</th><th>型号</th><th>颜色</th><th>容量</th><th>数量</th></thead><tbody id='"+n.order_id+"confirm'></tbody></table><div><li>配件/留言：</li><br/><li class='case' id='"+n.order_id+"case_tips'></li><br/></div></div></div>";
                            }
                            getOrderDetail(n.order_id);
                     });
                    $("#content").append(tbTitle);
                    $("#content").removeAttr("style");
                },
                error:function(jqXHR) {
                    alert("获取订单失败，请重试。错误代码："+jqXHR.status);
                }
            })
        }

        function getOrderDetail(order_id) {
            $.ajax({
                type:"get",
                url:"getOrderDetail.php?order_id="+order_id,
                dataType: "json",
                success:function (data) {
                    var tbContent="";
                    var case_tips="";
                    var conSelector="#"+order_id+"confirm";
                    var casSelector="#"+order_id+"case_tips";

                    $.each(data,function (i,n) {
                        tbContent +="<tr><td>"+(i+1)+"</td><td class='hidden-xs'>"+n.good_name+"</td><td>"+n.model+"</td><td>"+n.color+"</td><td>"+n.capacity+"</td><td>"+n.order_num+"</td></tr>";
                        case_tips =n.case_tips;
                    });
                    $(conSelector).append(tbContent);
                    $(casSelector).append(case_tips);
                },
                error:function(jqXHR) {
                    alert("获取订单失败，请重试。错误代码："+jqXHR.status);
                }
            })
        }

        //删除订单
        function del(order_id) {
            console.log(order_id);
            if (confirm("确定要删除吗!")) {
                $.ajax({
                    type:"get",
                    url:"delOrder.php?order_id="+order_id,
                    success:function (data) {
                        if(data>0){
                            console.log("删除成功！"+data);
                            $("#"+order_id).remove();//dom操作删除
                        }
                    },
                    error:function(jqXHR) {
                        alert("删除失败！错误代码："+jqXHR.status);
                    }
                })


        }
    }



        $(document).ready(function () {
            var date=moment().format("YYYY-MM-DD");
            getOrders(date);
        })

        //获取快递详情
        function express_detail (express_company,express_no) {
            var ecompany="";
            if(express_company=="顺丰") ecompany="shunfeng";
            if(express_company=="圆通") ecompany="yuantong";
            if(express_company=="跨越") ecompany="kuayue";
            $("#express_detail").html("正在查询物流信息，请稍后……");
            $.ajax({
                    type:"get",
                    url:"getExpressCallback.php?com="+ecompany+"&nu="+express_no,
                    success:function (data) {
                        $("#express_detail").html("<iframe src="+data+" width='580' height='252' frameborder='0' scrolling='no'>");
                    },
                    error:function(jqXHR) {
                        $("#express_detail").html("查询物流信息失败，请稍后再试。");
                    }
                })

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
            <h1 class="page-header">我的订单</h1>
            <!-- 日期选择 -->
            <div class="demo form-group">
                <input type="text" name="daterange" id="config-demo" class="form-control">
                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
            </div>
            <!-- 订单详细 -->
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
    <script type="text/javascript">
    start();

    function start() {

        //通过moment.js获取今天的日期
        var today=moment();

        $('input[name="daterange"]').daterangepicker({
            singleDatePicker:true,
            maxDate: today,
            locale:{
                format:'YYYY-MM-DD'
            }
        },
        function(start,end,label) {
            var date=start.format('YYYY-MM-DD');
            getOrders(date);
        }
        );
        
    }

    $('.demo i').click(function() {
        $(this).parent().find('input').click();
        
    });

    </script>
</body>

</html>
