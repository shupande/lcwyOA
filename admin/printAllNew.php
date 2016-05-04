<?php
    require_once '../include.php';
    checkSession();
    adminCheck();

    //获取所有新订单的订单号，用户，
    $orderResult=mysql_query("select order_id,order_user from orders where order_status=0");
    
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>五洲联鑫办公系统——全部新订单打印</title>
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
    <!-- 日历插件 -->
    <script type="text/javascript" src="../js/daterangepicker/moment.js"></script>
    <style>
        body{
            text-align: center;
        }
        h4{
            font-family: 微软雅黑;
        }
        #printBtn{
            margin-top: 20px;
            margin-bottom: 20px;
        }
        table.gridtable {
            font-family: verdana,arial,sans-serif;
            font-size:11px;
            margin:0 auto;
            color:#333333;
            border-width: 1px;
            border-color: #666666;
            border-collapse: collapse;
        }
        table.gridtable th {
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #666666;
            background-color: #dedede;
        }
        table.gridtable td {
            border-width: 1px;
            padding: 8px;
            border-style: solid;
            border-color: #666666;
            background-color: #ffffff;
        }
    </style>
    <script type="text/javascript">
        function print () {
           $("#all").print();
           //设定为已经打印
            $.ajax({
            type: "GET",
            url: "setPrinted.php",
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

        //插入当前时间
        $(document).ready(function() {
            $("#currentTime").text(moment().format("YYYY-MM-DD HH:mm:ss"));
        })
    </script>
</head>
<body>
    <div class="text-center" id="printBtn">
    <button class="btn btn-success" onclick="print();">打印</button>
    </div>
    <div id="all">
        <label>新订单总和</label>
        <br/>
         <table class="gridtable">
             <thead>
                 <th>管家婆编号</th>
                 <th>品名</th>
                 <th>型号</th>
                 <th>颜色</th>
                 <th>容量</th>
                 <th>总数</th>
             </thead>
             <tbody>
                 <?php 
                 //获取新订单详情
                 $sql="select gjp_id,good_name,model,color,capacity,sum(order_num) as num from orders_detail where order_id in(select order_id from orders where order_status=0)group by gjp_id order by good_name;";
                 $result = mysql_query($sql);
                    while($row = mysql_fetch_array($result)){
                        echo "<tr>";
                        echo "<td>".$row['gjp_id']."</td>";
                        echo "<td>".$row['good_name']."</td>";
                        echo "<td>".$row['model']."</td>";
                        echo "<td>".$row['color']."</td>";
                        echo "<td>".$row['capacity']."</td>";
                        echo "<td>".$row['num']."</td>";
                        echo "</tr>";
                    }
                 ?>
             </tbody>
         </table>
         <hr/>
         <br/>
    
        <label>订单详情</label>
         <?php
                // 打印出表头
                    while ($order = mysql_fetch_array($orderResult)) {
                        echo "<div><div><h4>".$order['order_user']."：".$order['order_id']."</h4></div><div><table class='gridtable'><thead><th>#</th><th>管家婆编号</th><th>品名</th><th>型号</th><th>颜色</th><th>容量</th><th>数量</th></thead><tbody>";
                        $order_id=$order['order_id'];
                        $i=1;   
                        $case="";   

                    //获取订单详情
                    $detail=mysql_query("select * from orders_detail where order_id ='".$order_id."'"); 
                    while($rowDetail = mysql_fetch_array($detail)){
                            echo "<tr><td>".$i."</td><td name='gjp_id'>".$rowDetail['gjp_id']."</td><td>".$rowDetail['good_name']."</td><td>".$rowDetail['model']."</td><td>".$rowDetail['color']."</td><td>".$rowDetail['capacity']."</td><td>".$rowDetail['order_num']."</td></tr>";
                            $i++;
                            $case=$rowDetail['case_tips'];
                      }
                    //打印表尾
                    echo "</tbody></table><div><li>配件/留言：</li><li>".$case."</li></div></div></div>"; 
                    };
         ?>
         <br/>
         <label>打印时间：<div id="currentTime"></div></label>
    </div>
</body>
</html>