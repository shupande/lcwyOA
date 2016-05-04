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
    <script src="../js/list.min.js"></script>
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
    

    .pagination{
        margin-top: -10px;
        float: left;
    }
    
    .list-group-item-text {
        font-size: 10px;
        color: #9F9F9F;
    }

    .badge {
        background-color: red;
        font-size: 0.5em;
    }
    
    #nextButton {
        float: right;
    }
    
    
    #modifypwd {
        max-width: 350px;
        /*right: 30%;*/
    }
    
    #printAll {
        margin-top: 5px;
        margin-left: 5px;
    }
    
    small {
        font-size: 1em;
    }
    
    #addbutton {
        margin-top: 5px;
        margin-left: 5px;
    }
    </style>
</head>
<script type="text/javascript">
function modify(row) {
    var $this = $(row);
    if ($this.text() == "修改") {
        //添加编辑框
        $this.parents("td").prevAll("td").children().removeAttr("readonly");
        $this.parents("td").prevAll("td").children().removeAttr("disabled");
        $this.attr("class", "btn btn-success");
        $this.text("保存");
    } else {
        $this.parents("td").prevAll("td").children().attr("readonly","true");
        $this.parents("td").prev("td").children().attr("disabled","true");
        $this.attr("class", "btn btn-warning");
        $this.text("修改");
        //获得数据
        var id=$this.parents("tr").find("td:eq(0)").text();
        var username=$this.parents("tr").find("td:eq(1)").find("input").val();
        var password=$this.parents("tr").find("td:eq(2)").find("input").val();
        var pType=$this.parents("tr").find("td:eq(3)").find("select option:selected").text();
        var permission;
        (pType=="管理员")? permission=1:permission=2;
        //调用修改函数
        modifyUser(id,username,password,permission);
    }
}


function del(row) {
    var $this = $(row);
    if ($this.parents("table").find("tr").length <= 2) {
        alert("无法删除最后一个账号！");
        return false;
    }
    if (confirm("确定要删除吗!")) {
        //获得用户名
        $userRow=$this.parents("tr").find("td:eq(1)");
        var str=$userRow.find("input").val();
        $this.parents("tr").remove();
        //调用删除账号函数
        delUser(str);

    } 
}
 
function delUser(username) {
        $.ajax({
            type: "GET",
            url: "delUser.php?username="+username,
            success: function (data) {
                if(data>0) console.log("删除用户名成功！");
            },
            error: function  (jqXHR) {
                console.log("出错啦！"+jqXHR.status);
            }
        });

}

function modifyUser(id,username,password,permission) {
        $.ajax({
            type: "GET",
            url: "modifyUser.php?username="+username+"&password="+password+"&id="+id+"&permission="+permission,
            success: function (data) {
                if(data>0) console.log("修改成功！");
            },
            error: function  (jqXHR) {
                console.log("出错啦！"+jqXHR.status);
            }
        });
}

var curPage;

function getData() {
        //清空表数据
        $("#grid").html("");
        //判断当前页码
        $.ajax({
            type: "GET",
            url: "getUserList.php",
            dataType: "json",
            success: function (data) {
                //设定了dataType就不需要$.parseJSON了
                 // var string=$.parseJSON(data);
                 $.each(data,function (i,n) {
                    var tbBody="";
                    if(n.permission==1){
                        tbBody +="<tr><td>"+n.id+"</td><td class='userName'><input class='form-control' type='text' value='"+n.username+"' readonly='true' required></td><td><input class='form-control' type='text' value='"+n.password+"' readonly='true' required></td><td><select class='form-control' disabled='true'><option>管理员</option><option>专卖店</option></select></td><td><div class='btn-group' role='group' aria-label='...' id='editbuttons'><a class='btn btn-warning' onclick='modify(this)' role='button'>修改</a><a class='btn btn-danger' onclick='del(this)' role='button'>删除</a></div></td></tr>";
                    }else{
                       tbBody +="<tr><td>"+n.id+"</td><td class='userName'><input class='form-control' type='text' value='"+n.username+"' readonly='true' required></td><td><input class='form-control' type='text' value='"+n.password+"' readonly='true' required></td><td><select class='form-control' disabled='true'><option>专卖店</option><option>管理员</option></select></td><td><div class='btn-group' role='group' aria-label='...' id='editbuttons'><a class='btn btn-warning' onclick='modify(this)' role='button'>修改</a><a class='btn btn-danger' onclick='del(this)' role='button'>删除</a></div></td></tr>";
                    }
                    $("#grid").append(tbBody);
                 });
                    
                    //数据加载完后开启搜索支持
                    var options={
                        valueNames:['userName']
                    };

                    var goodList=new List('accounts',options);


                    //  $('table').filterTable({ // apply filterTable to all tables on this page
                    //     inputSelector: '#input-filter',//自带搜索框支持
                    //     filterExpression: 'filterTableFindAll',//模糊查询
                    //     minRows:1//一行起搜索
                    // });
            },
            // complete:function () {
            //     getPageBar();
            // }
            error: function  (jqXHR) {
                alert("出错啦！"+jqXHR.status);
            }
        });
        // alert(page);
    }

    function getPageBar (num) {
        var pages=$(".li_num").size();
        
        var pageNum=parseInt(curPage);
        // var culNum=parseInt(num);
        // alert(curPage);
        curPage =pageNum+num;
        
        if(curPage>=pages){
            curPage=pages;
            $(".next_li").addClass("disabled");
        }else{
            $(".prev_li").removeClass("disabled");
        }
        if (curPage<1){
            curPage=1;
            $(".prev_li").addClass("disabled");
        }else if(curPage>1 && curPage !== pages){
            $(".next_li").removeClass("disabled");
        }
        // 调用ajax获取数据
        getData(curPage);
    }

    function doPage (row) {
        
        var $this = $(row);
        $("li").removeClass("active");
        $this.parents("li").addClass("active");
        var num=$this.text();
        getData(num);
    }



    $(document).ready(function () {
        getData();
        // $(".prev_li").addClass("disabled");
    });

    // $(row).parent().parent().parent().remove();
    // var rowNum = $(row).parent().prev().prev().text();
    // var temRows = $("#accountList tr").size();
    // //i=parseInt(rowNum)+1    ： 从下一行(即被删除行的后面一行)开始逐行修改编号  
    // //前面的行编号不动，但后面的编号需要减1
    // //pareseInt方法将字符串数据变为int类型
    // for(i=parseInt(rowNum)+1;i<=temRows;i++){
    //     //通过id选择器获取到具体的哪一行的第一列，并将第一列，即行编号这个单元格中的数据减1
    //     $("#"+i).text(i-1);
    //     //同时通过attr("属性名",属性值)方法将其id属性也减1
    //     $("#"+i).attr("id",i-1);
    // }

</script>

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
    <h1 class="page-header">账号管理</h1>
    <div id="accounts">
    <input type="search" class="form-control search" placeholder="搜索帐号..." >
    <p id="addbutton"><a href="addAccount.php">新增账号</a></p>
    <table class="table table-striped" id="accountList">
        <thead>
            <tr>
                <th>#</th>
                <th>账号名称</th>
                <th>密码</th>
                <th>账号类型</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody id="grid" class="list">
        </tbody>
    </table>
    </div>
        </div>
    </div>
    </div>
</body>

</html>
