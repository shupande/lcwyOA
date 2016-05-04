<?php 
    //数据库连接
require_once '../include.php';

      $number=$_GET["number"];
      $str=$_GET["str"];

            //查询
            $sql = "SELECT {$str} FROM `notification` where `is_delete`=0 order by `id` desc limit 0,{$number}";
            $result = mysql_query($sql);
            //换成数组
            $list=array();
            // $i=0;
            while( $notify = mysql_fetch_assoc($result) ){
              $list[]=$notify;
            }
            //返回JSON中文格式
            echo json_encode($list,JSON_UNESCAPED_UNICODE);
            
    //    echo "<table class='table table-striped'>
    //    <thead>
    //         <tr>
    //             <th>#</th>
    //             <th>时间</th>
    //             <th>内容</th>
    //             <th>发送人</th>
    //             <th>操作</th>
    //         </tr>
    //     </thead>
    //     <tbody>";
 
    //         // 数据库连接
    //         $link=mysql_connect("localhost","root","111111") or die("数据库连接失败Error:".mysql_errno().":".mysql_error());
    //         mysql_set_charset("UTF-8");
    //         mysql_select_db("lcwy_oa",$link) or die("指定数据库打开失败");
    //         //查询
    //         $sql = "SELECT * FROM `notification` order by id desc limit 0,{$number}";
    //         $result = mysql_query($sql);
    //         $i=1;
    //         while( $notify = mysql_fetch_array($result) ){
    //           echo "<tr>";
    //           echo "<td>".$i."</td>";
    //           echo "<td>".$notify['create_time']."</td>";
    //           echo "<td>".$notify['content']."</td>";
    //           echo "<td>".$notify['sender']."</td>";
    //           echo "<td><a class='btn btn-danger' onclick='del(this)' role='button'>删除</a></td>";
    //           echo "</tr>";
    //           $i++;
    //             }

    //    echo "</tbody>
    // </table>"; 
?>