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
    .label{
        margin-left: 5px;
    }
    #editbuttons {
        float: right;
    }
    small {
        font-size: 1em;
    }
    </style>
    <script type="text/javascript">

    $(document).ready(function () {
            //取出cookie里面的json数据并解析
            var goodData=JSON.parse(readCookie("goodInfo"));
            var storeData=JSON.parse(readCookie("storeInfo"));
            $.each(goodData,function (i,n) {
                var tabTitle="";
                var tabContent="";
                tabTitle +="<li><a href='#"+n.Gjp_id+"' data-toggle='tab'>"+n.Gjp_id+"</a></li>";
                tabContent +="<div class='tab-pane fade' id='"+n.Gjp_id+"' name='gjp_id'><br/><span class='label label-danger' name='good_name'>品名："+n.Good_name+"</span><span class='label label-success' name='model'>型号："+n.Model+"</span><span class='label label-info' name='color'>颜色："+n.Color+"</span><span class='label label-warning' name='capacity'>容量："+n.Capacity+"</span><span class='label label-primary'>数量："+n.Num+"</span><br/><br/><table class='table table-striped'><thead><tr><th>#</th><th>店名</th><th>数量</th><th>操作</th></tr></thead><tbody id='tr"+n.Gjp_id+"''></tbody></table></div>";
                // tbBody +="<tr><td class='hidden-xs'>"+(i+1)+"</td><td name='gjp_id' class='hidden-xs'>"+n.Gjp_id+"</td><td name='good_name' class='hidden-xs'>"+n.Good_name+"</td><td name='model'>"+n.Model+"</td><td name='color'>"+n.Color+"</td><td name='capacity'>"+n.Capacity+"</td><td name='num' class='hidden-xs'>"+n.Num+"</td><td><input type='number' class='form-control' name='order_num' value='"+1+"' style='width:80px'></td><td><a class='btn btn-danger hidden-xs' onclick='del(this)'' role='button'>删除</a></td></tr>";
                $("#tabTitle").append(tabTitle);
                $("#tabContent").append(tabContent);
                    //添加表格内容
                    $.each(storeData,function (j,k) {
                     var trBody="";
                     trBody +="<tr><td>"+(j+1)+"</td><td name='username'>"+k.Username+"</td><td><input type='number' class='form-control' min='1'  placeholder='这里填写分配数量' style='width:200px' required name='assign_num'></td><td><a class='btn btn-danger hidden-xs' onclick='del(this)' role='button'>删除</a></td></tr>";
                     $("#tr"+n.Gjp_id).append(trBody);
                 });
             });
            
            //默认激活第一个TAB
            $("#tabTitle li:first").addClass("active");
            //激活第一个TAB的内容
            $(".tab-pane:first").addClass("in active");
            
    })

    //读取cooike方法
    function readCookie(cname) {
            // console.log(document.cookie);
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for(var i=0; i<ca.length; i++) 
              {
              var c = ca[i].trim();
              if (c.indexOf(name)==0) return c.substring(name.length,c.length);
              }
            return "";
    }

    //删除行
    function del(row) {
        var $this = $(row);
        $this.parents("tr").remove();
    }

    function check () {
        var count=0;
        var total=0;
        $("input").each(function () {
            var vl=$(this).val().trim();
            if(vl==="") {
                count++;
            }else{
                var nvl=parseInt(vl);
                total+=nvl;
            }
         });

        if(count>0){
            alert("有专卖店未分配数量，请填写后再提交！");
        }else{
            //统计并提交数据库操作
            var data=[];
            var username;
            var goodData=JSON.parse(readCookie("goodInfo"));

            //商品信息
            $.each(goodData,function (i,n) {
                var gjp_id=n.Gjp_id;
                var good_name=n.Good_name;
                var model=n.Model;
                var color=n.Color;
                var capacity=n.Capacity;
                //取每个ID表的详细信息
                $("#tr"+gjp_id+">tr").each(function() {
                    // alert("1111");
                    var row=$(this);
                    username=row.find("[name='username']").text();
                    var assign_num=row.find("[name='assign_num']").val();
                    data.push({Good_name:good_name,Model:model,Color:color,Capacity:capacity,Num:assign_num,Gjp_id:gjp_id,Username:username});
                });
                
            });


            console.log(JSON.stringify(data));

             // 操作数据库
            writeOrder(JSON.stringify(data));
           
        }
       
    }

    
    //操作数据库
        function writeOrder(jsonData) {
            $.ajax({
                type:"POST",
                data:{'jsonData':jsonData},
                url:"adminOrder.php",
                success: function (msg) {
                    window.location.href="finish.php";
                    // if(msg>0){
                    //     console.log(msg);
                    // }
                },
                error: function(jqXHR) {
                    alert("提交失败！");
                    console.log(jqXHR.status);
                }

            });

        }



    //TAB JS启用
    $('#myTab a').click(function (e) {
      e.preventDefault()
      $(this).tab('show')
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
        <h1 class="page-header">分货<small>分配数量</small></h1>
        <ul class="nav nav-tabs" id="tabTitle">
          <!-- <li class="active"><a href="#home" data-toggle="tab">10298763</a></li>
          <li><a href="#svn" data-toggle="tab">Tab 2</a></li>
          <li><a href="#ios" data-toggle="tab">Tab 3</a></li>
          <li><a href="#java" data-toggle="tab">Tab 4</a></li> -->
        </ul>
        <div class="tab-content" id="tabContent">
        </div>

    
    <div class="btn-group" role="group" aria-label="..." id="editbuttons">
        <a class="btn btn-primary" href="chooseStore.php" role="button">上一步</a>
        <a class="btn btn-success" href="javascript:check();" role="button">提交</a>
    </div>
    </div>
        </div>
    </div>
</body>

</html>
