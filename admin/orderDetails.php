<?php
    require_once '../include.php';
    adminCheck();
    $order_id=$_GET['order_id'];

    //获取订单详情
    $sql="select * from orders_detail where order_id='".$order_id."'";

    $result = mysql_query($sql);
    $userResult=mysql_query("select order_user,order_status,express_company,express_no from orders where order_id='".$order_id."'");
    
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
    <!-- 打印插件 -->
    <script src="../js/jquery.print.js"></script>
    <style>
    body {
        padding-top: 50px;
        padding-bottom: 40px;
        color: #5a5a5a;
        font-family: 微软雅黑;
    }
    
    .pagination {
        margin-top: -10px;
        float: left;
    }
    
    .well {
        color: red;
    }
    
    .badge {
        float: right;
        background-color: red;
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
    #nextbutton {
        float: right;
    }
    /*    .form {
        margin-top: 10px;
    }*/
    
    #editbuttons {
        margin-bottom: 10px;
    }
    #ship{
        float: right;
    }
    </style>
    <script type="text/javascript">

    function modify(order_id) {

        var btn = $("#modifyButton");
        if (btn.text() == "修改订单") {
            $("td input").removeAttr("readonly");
            btn.attr("class", "btn btn-success");
            btn.text("保存订单");
        } else {
            var orderId=order_id;
            //执行保存操作
            $("tbody>tr").each(function() {
                var row=$(this);
                var num=row.find("[name='order_num']").val();
                var gjp_id=row.find("[name='gjp_id']").text();
                var order_id=$("#");
                //调用修改库存方法
                modifyOrderNum(orderId,gjp_id,num);
            });
            //将按钮修改回去
            $("td input").attr("readonly", "true");
            btn.attr("class", "btn btn-warning");
            btn.text("修改订单");
        }
    }


    function modifyOrderNum(orderId,gjp_id,num){
        $.ajax({
            type: "GET",
            url: "modifyOrderNum.php?order_id="+orderId+"&gjp_id="+gjp_id+"&num="+num,
            success: function (data) {
                 if(data>0){
                    console.log("修改成功！");
                 }
            },
            error: function  (jqXHR) {
                console.log("出错啦！"+jqXHR.status);
            }
        });
    }


    function send(order_id) {
        //获得快递公司和快递单号
        var express_company=$("#express_company").find("option:selected").text(); 
        var express_no=$("#express_no").val().trim();
        // alert(express_no);
        if(express_no==""){
            alert("快递单号不得为空，自提请输入：自提");
            return;
        }
        //操作数据库
        $.ajax({
            type: "GET",
            url: "ship.php?order_id="+order_id+"&express_company="+express_company+"&express_no="+express_no,
            success: function (data) {
                 if(data>0){
                    window.location="orderManage.php";
                    console.log("修改成功！");
                 }
            },
            error: function  (jqXHR) {
                console.log("出错啦！"+jqXHR.status);
            }
        });

    }

    function del(row,order_id) {
        if (confirm("确定要删除吗!")) {
            //数据库更新
            $.ajax({
            type: "GET",
            url: "delOrders.php?order_id="+order_id,
            success: function (data) {
                 if(data>0){
                    document.location.href = "finish.php";
                    console.log("删除成功！");
                 }
            },
            error: function  (jqXHR) {
                console.log("出错啦！"+jqXHR.status);
            }
        });
        }
    }

    //获取快递详情
        function express_detail (express_company,express_no) {
            var ecompany="";
            if(express_company=="顺丰") ecompany="shunfeng";
            if(express_company=="圆通") ecompany="yuantong";
            if(express_company=="跨越") ecompany="kuayue";
            $("#express_detail").html("正在查询物流信息，请稍后……");
            $.ajax({
                    type:"get",
                    url:"../getExpressCallback.php?com="+ecompany+"&nu="+express_no,
                    success:function (data) {
                        $("#express_detail").html("<iframe src="+data+" width='580' height='252' frameborder='0' scrolling='no'>");
                    },
                    error:function(jqXHR) {
                        $("#express_detail").html("查询物流信息失败，请稍后再试。");
                    }
                })

        }



    function print(order_id) {
        $(".panel-info").print();
        //设定为已经打印
            $.ajax({
            type: "GET",
            url: "setPrinted.php?order_id="+order_id,
            success: function (data) {
                 if(data>0){
                    console.log("设定已打印成功！");
                 }
            },
            error: function  (jqXHR) {
                console.log("出错啦！"+jqXHR.status);
            }
        });
    }

    function back() {
        history.back();
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
        <h1 class="page-header">订单详情</h1>
        <!-- 订单详细 -->
            <div id="content">
                <?php
                    $user = mysql_fetch_array($userResult);
                    //判断订单号是否存在，避免get方式修改
                    if($user['order_user']==null){
                        echo "<div style='text-align:center'><span class='glyphicon glyphicon-remove' id='error' aria-hidden='true'></span><p>警告，订单号不存在！</p></div>";
                        return;
                    }
                    // 打印出表头
                    echo "<div class='panel panel-info'><div class='panel-heading'><h3 class='panel-title'>".$user['order_user']."：".$order_id."</h3></div><div class='panel-body'><table class='table table-striped'><thead><th>#</th><th class='hidden-xs'>管家婆编号</th><th class='hidden-xs'>品名</th><th>型号</th><th>颜色</th><th>容量</th><th>数量</th></thead><tbody>";
                    $i=1;   
                    $case="";     
                    while($row = mysql_fetch_array($result)){
                            echo "<tr><td>".$i."</td><td name='gjp_id' class='hidden-xs'>".$row['gjp_id']."</td><td class='hidden-xs'>".$row['good_name']."</td><td>".$row['model']."</td><td>".$row['color']."</td><td>".$row['capacity']."</td><td><input class='form-control' type='number' name='order_num' value='".$row['order_num']."' min='1' readonly='true' required style='width:100px;'></td></tr>";
                            $i++;
                            $case=$row['case_tips'];
                      }
                    //打印表尾
                    echo "</tbody></table><div><li>配件/留言：</li><br/><li>".$case."</li><br/></div></div></div>";
                    if($user['order_status']==2){
                        echo "<label>快递单号：".$user['express_company']."</label><div class='well text-center'>".$user['express_no']."<br><div id='express_detail' class='hidden-xs'></div><div class='visible-xs'>手机暂不支持自动跟踪快递记录，请登录电脑查看。</div></div>";
                        echo "<script> $(document).ready(function()
                        {
                        $('#btns').hide();
                        }) </script>"; 
                    }
                ?>
            </div>
        <div id="btns">
            <div class="btn-group" role="group" aria-label="..." id="editbuttons">
                <button type="button" class="btn btn-danger" onclick="del(this,'<?php echo $order_id ?>');">删除</button>
                <button type="button" id="modifyButton" class="btn btn-warning" onclick="modify('<?php echo $order_id ?>');">修改</button>
                <button type="button" class="btn btn-info" onclick="print('<?php echo $order_id ?>');">打印</button>
                <button type="button" class="btn btn-primary" onclick="back();">返回</button>
            </div>
            <div class="form-inline" id="ship">
                <div class="form-group">
                    <select class="form-control" id="express_company" >
                    <option>顺丰</option>
                    <option>圆通</option>
                    <option>跨越</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="请输入快递单号" required id="express_no">
                </div>
                <button type="submit" class="btn btn-success" onclick="send(<?php echo $order_id ?>);">发货</button>
            </div>
        </div>
        </div>
        </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
               express_detail(<?php echo "'".$user['express_company']."'"?>,<?php echo "'".$user['express_no']."'"?>);
            })
        </script>
</body>

</html>
