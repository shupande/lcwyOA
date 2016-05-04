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
    <!-- cookie支持 -->
    <script src="js/jquery.cookie.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="js/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- 获取时间 -->
    <script type="text/javascript" src="js/daterangepicker/moment.js"></script>
    <!-- 通知获取 -->
    <script src="js/notifications.js"></script>
    <!-- 主样式 -->
    <link rel="stylesheet" href="style/main.css">
    <style>
    body {
        padding-top: 50px;
        color: #5a5a5a;
        font-family: 微软雅黑;
    }
    
    
    #editbuttons {
        float: right;
        margin-top: 10px;
    }
    
    

    </style>
    <script type="text/javascript">
        var flag=true;

        //读取cooike方法
        function readCookie(cname) {
                return $.cookie(cname);
        }

        $(document).ready(function () {
            //取出cookie里面的json数据并解析
            var data=JSON.parse(readCookie("goodInfo"));
            $.each(data,function (i,n) {
                var tbBody="";
                tbBody +="<tr><td class='hidden-xs'>"+(i+1)+"</td><td name='gjp_id' class='hidden-xs'>"+n.Gjp_id+"</td><td name='good_name' class='hidden-xs'>"+n.Good_name+"</td><td name='model'>"+n.Model+"</td><td name='color'>"+n.Color+"</td><td name='capacity'>"+n.Capacity+"</td><td name='num' class='hidden-xs'>"+n.Num+"</td><td><input type='number' class='form-control' name='order_num' value='1' style='width:80px'></td><td><a class='btn btn-danger hidden-xs' onclick='del(this)' role='button'>删除</a></td></tr>";
                $("#grid").append(tbBody);
             });
            //格式验证
           validate(); 
        })

        //删除行
        function del(row) {
        var $this = $(row);
        $this.parents("tr").remove();
        }

        //数据验证
        function validate() {
            //监控输入框
            $("input[name='order_num']").bind('input propertychange',function () {
                var orderNum=$(this).val();
                var row=$(this).parent("td").parent("tr");
                var num=row.find("[name='num']").text();
                if(parseInt(orderNum)>parseInt(num)){
                    $("#tips").text("下单数量超出库存！").addClass("text-danger");
                    //控制不得跳转
                    flag=false;
                }else{
                    flag=true;
                    if(orderNum<1){
                        //控制数量不得少于1
                        $(this).val("1");
                    }else{
                       $("#tips").text(""); 
                    } 
                }
            });

            //text框限制
            $("#case_tips").bind('input propertychange',function () {
                var caseText=$(this).val();
                var status1=caseText.indexOf("javascript");
                var status2=caseText.indexOf("script");
                if(status1>-1||status2>-1){
                    $("#tips").text("非法输入！").addClass("text-danger");
                    flag=false;
                }else{
                    $("#tips").text(""); 
                    flag=true;
                }

            });
            
            //下单时间限制
            var currentTime=moment().format("HH:mm");
            // alert(currentTime);
            if(currentTime>"17:00" || currentTime < "09:30"){
                alert("提示：17:00-09:30本时间段不允许下单！");
                flag=false;
            }

        }

        //获取下单数据
        function order() {
            if(!flag) return false;
            var data=[];
            $("tbody>tr").each(function() {
            var row=$(this);
            var gjp_id=row.find("[name='gjp_id']").text();
            var good_name=row.find("[name='good_name']").text();
            var model=row.find("[name='model']").text();
            var color=row.find("[name='color']").text();
            var capacity=row.find("[name='capacity']").text();
            var num=row.find("[name='order_num']").val();
            var tips=$("#case_tips").val();
            data.push({Good_name:good_name,Model:model,Color:color,Capacity:capacity,Num:num,Gjp_id:gjp_id,Case_tips:tips});
            
        });
            
            // 操作数据库
           writeOrder(JSON.stringify(data));

        }

        //操作数据库
        function writeOrder(jsonData) {
            $.ajax({
                type:"POST",
                data:{'jsonData':jsonData},
                url:"order.php",
                success: function (msg) {
                    if(msg>0){
                        location.href="finish.php";
                        console.log(msg);
                    }else{
                        alert("库存数量不足！下单失败，请返回重新选择！");
                        location.href="phoneOrder.php";
                    }
                },
                error: function(jqXHR) {
                    alert("提交失败！");
                    console.log(jqXHR.status);
                }

            });

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
                <div class="navbar-brand">五洲联鑫内部订货系统</div>
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
                                    <th class="hidden-xs">库存数量</th>
                                    <th>下单数量</th>
                                    <th class="hidden-xs">操作</th>
                                </tr>
                            </thead>
                            <tbody id="grid">
                            </tbody>
                        </table>
                        <form>
                                <textarea class="form-control" rows="5"  id="case_tips" placeholder="配件或备注信息填这里，配件较多的时候在每行的后面加上关键字:<br>，含尖括号。非中文《》。没有需要请留空，直接进入下一步"></textarea>
                            
                        </form>
                        <div class="btn-group" role="group" aria-label="..." id="editbuttons">
                            <a class="btn btn-primary" href="phoneOrder.php" role="button">上一步</a>
                            <a class="btn btn-success" onclick="return order();" role="button">确认下单</a>
                        </div>
                    </div>
                    </div>
                    </div>
 
</body>

</html>
