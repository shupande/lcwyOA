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

    <link href="../lib/ligerUI/skins/Aqua/css/ligerui-all.css" rel="stylesheet" type="text/css" />
    <link href="../lib/ligerUI/skins/gray2014/css/all.css" rel="stylesheet" type="text/css" />
    <link href="../lib/ligerUI/skins/ligerui-icons.css" rel="stylesheet" type="text/css" />
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
    <!-- 表格插件 -->
    <script src="../lib/ligerUI/js/ligerui.all.js" type="text/javascript"></script>
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
    .l-dialog{
        top: 250px !important;
    }
    </style>
</head>
<script type="text/javascript">
//扩展currency类型的对比函数 
$.ligerDefaults.Grid.sorters['currency'] = function(val1, val2) {
    return parseFloat(val1) < parseFloat(val2) ? -1 : parseFloat(val1) > parseFloat(val2) ? 1 : 0;
};

var capacityData = [{
    Capacity: '8G',
    text: '8G'
}, {
    Capacity: '16G',
    text: '16G'
}, {
    Capacity: '32G',
    text: '32G'
}, {
    Capacity: '64G',
    text: '64G'
}, {
    Capacity: '128G',
    text: '128G'
}];

$(f_initGrid);
var manager, g;

function f_initGrid() {
    g = manager = $("#mainGrid").ligerGrid({
        columns: [{
            display: '管家婆编号',
            name: 'gjp_id',
            // width: 50,
            type: 'text',
            editor: {
                type: 'text',
            }
        }, {
            display: '商品名称',
            name: 'good_name',
            width: 300,
            editor: {
                type: 'text'
            }
        }, {
            display: '型号',
            name: 'model',
            editor: {
                type: 'text'
            }
        }, {
            display: '颜色',
            name: 'color',
            width: 80,
            type: 'text',
            editor: {
                type: 'text'
            }
        }, {
            display: '容量',
            name: 'capacity',
            type: 'text',
            width: 90,
            editor: {
                type: 'select',
                data: capacityData,
                valueField: 'Capacity'
            },
            render: function(item) {
                if (item.capacity == '8G') return '8G';
                if (item.capacity == '16G') return '16G';
                if (item.capacity == '32G') return '32G';
                if (item.capacity == '64G') return '64G';
                if (item.capacity == '128G') return '128G';
            }
        }, {
            display: '库存',
            name: 'stock',
            width: 80,
            type: 'int',
            editor: {
                type: 'int'
            }
        }, {
            display: '不可下单库存',
            name: 'un_stock',
            editor: {
                type: 'int'
            },
            align: 'left'
                // width: 300
        }],
        onSelectRow: function(rowdata, rowindex) {
            $("#txtrowindex").val(rowindex);
        },
        // usePager:true,
        pageSize: 20,
        width: '98%',
        height: '98%',
        rownumbers: true,
        fixedCellHeight: false,
        enabledEdit: true,
        clickToEdit: false,
        isScroll: true,
        url:'getStocks.php',
        dataAction: 'local',
        toolbar: {
            items: [{
                text: '增加',
                click: addNewRow,
                icon: 'add'
            }, {
                line: true
            }, {
                text: '删除',
                click: deleteRow,
                icon: 'delete'
            }, {
                line: true
            }, {
                text: '修改',
                click: beginEdit,
                icon: 'edit'
            }, {
                line: true
            }, {
                text: '取消',
                click: cancelAllEdit,
                img: '../lib/ligerUI/skins/icons/candle.gif'
            }, {
                line: true
            }, {
                text: '保存',
                click: submitGrid,
                icon: 'save'
            }
        ]},
        autoFilter:true,
        //ligerUi要求的json格式{"Rows":[{},{}],"Total:num"},Rows和Total一定要有双引号
    });
    $("#pageloading").hide();
    //监控键盘事件，按ESC取消编辑
    $("body").keydown(function(e) {
        var ev = document.all ? window.event : e;
        if (ev.keyCode == 27) {
            cancelAllEdit();
        }
        if (ev.keyCode == 13){
            submitGrid();
        }
    });
}


// $(function() {
//     $("#toptoolbar").ligerToolBar({
//         items: [{
//                 text: '增加',
//                 click: addNewRow,
//                 icon: 'add'
//             }, {
//                 line: true
//             }, {
//                 text: '删除',
//                 click: deleteRow,
//                 icon: 'delete'
//             }, {
//                 line: true
//             }, {
//                 text: '修改',
//                 click: beginEdit,
//                 icon: 'edit'
//             }, {
//                 line: true
//             }, {
//                 text: '取消',
//                 click: cancelAllEdit,
//                 img: '../lib/ligerUI/skins/icons/candle.gif'
//             }, {
//                 line: true
//             }, {
//                 text: '保存',
//                 click: submitEdit,
//                 icon: 'save'
//             }

//         ]
//     });

    

// });


function beginEdit() {
    var row = manager.getSelectedRow();
    if (null === row) {
        $.ligerDialog.error('未选中任何数据！');
        return;
    }
    manager.beginEdit(row);
    
}

function delLastBlankRow() {
    //如果最后一行为空就删除
    var needDelLastRow = false;
    for (var i = 0; i < manager.getData().length; i++) {
        var rowData = manager.getData()[i];
        if (i === manager.rows.length - 1) {
            if (rowData.gjp_id === null || rowData.gjp_id === "" || rowData.gjp_id === undefined) {
                needDelLastRow = true;
                continue;
            }
        }
    }

    if (needDelLastRow) {
        manager.deleteRow(manager.rows.length - 1);
        return;
    }

}

function cancelAllEdit() {

    manager.cancelEdit();
    //如果最后一行为空就删除；放在cancelEdit后才能完美生效，否则会产生取消不了的BUG
    delLastBlankRow();
}

//验证数据是否有问题
function dataVlid() {
    for (var i = 0; i < manager.getData().length; i++) {
        var rowData = manager.getData()[i];
        if (rowData.gjp_id === 0 || rowData.gjp_id === null || rowData.gjp_id === undefined || rowData.gjp_id.toString().length != 8) {
                $.ligerDialog.error('正确的管家婆编号为8位，请更正');
            return true;
        }

        //验证不可下单库存的数量
        var un_stock=parseInt(rowData.un_stock);
        var stock=parseInt(rowData.stock);
        if (un_stock>stock ) {
                $.ligerDialog.error('错误！不可下单数量大于库存数量！未操作成功！请更正！');
            return true;
        }
    }

    return false;
}

function submitGrid() {

    console.log("jinlaile");
    //结束编辑
    manager.endEdit();

    //判断最后一行是否需要删除
    delLastBlankRow();

    //判断管家婆编号数据是否有误
    if (dataVlid()) return;

    if (manager.getData() === null || manager.getData().length === 0) {
        $.ligerDialog.error(不能为空);
        return;
    }



    manager.submitEdit();

    $.ligerDialog.waitting('正在保存中,请稍候...');
    setTimeout(function() {
        $.ligerDialog.closeWaitting();
    }, 500);

    control_sql();


}

function control_sql () {

    //获取数据
    var data;
    var action;
    //控制数据库操作
    if(manager.getAdded()!=""){
        // alert("过来添加了");
        data=manager.getAdded();
        action="add";
    }else if(manager.getUpdated()!=""){
        // alert("过来改了");
        data =manager.getUpdated();
        action="modify";
    }else if(manager.getDeleted()!=""){
        // alert("过来删了");
        data=manager.getDeleted();
        console.log(data);
        action="del";
    }
    var jsonData=JSON.stringify(data);
    //请求地址
    var url="editStocks.php";
    //服务器操作
    $.ajax({
        type: "POST",
        url: url,
        cache: false,
        data:{'jsonData':jsonData,'action':action},
        success: function (mes) {
            console.log(mes);
        },
        error: function  (jqXHR) {
            alert("出错啦！"+jqXHR.status);
        }
    });
}


function deleteRow() {
    if (manager.getSelectedRow() === null) {
        $.ligerDialog.error('未选中任何数据！');
    } else {
        $.ligerDialog.confirm('确定要删除吗？', function(yes) {
            if (yes){
                manager.deleteSelectedRow();
                //延时才能获取到删除的数据进行删除操作
                setTimeout(function() {
                    control_sql();
                }, 500);
            } 
        });
    }
}


// var newrowid = 100;

function addNewRow() {
    // var row = manager.getSelectedRow();
    //参数1:rowdata(非必填)
    //参数2:插入的位置 Row Data 
    //参数3:之前或者之后(非必填)
    manager.addEditRow();
    $.ligerDialog.success('添加了一个空白行，请填入数据');
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
    <h1 class="page-header">库存管理</h1>
    <div class="l-loading" style="display: block" id="pageloading">
    </div>
    <div id="toptoolbar" style="margin-top:20px;"></div>
    <div id="mainGrid" style="margin: 0; padding: 0">
    </div>
     <div style="display: none;">
    </div>
    </div>
        </div>
    </div>
</body>

</html>
