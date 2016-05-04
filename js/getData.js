
//获取手机库存列表
function getData(page) {
            $.ajax({
                type: "GET",
                url: "getUserStock.php?page="+page,
                dataType: "json",
                success: function (data) {
                     $.each(data,function (i,n) {
                        var tbBody="";
                        var num=n.stock-n.un_stock;//显示的数量
                        //大于0的显示，否则不显示
                        if(num>0){
                            tbBody +="<tr><td>"+(i+1)+"</td><td>"+n.good_name+"</td><td>"+n.model+"</td><td>"+n.color+"</td><td>"+n.capacity+"</td><td>"+num+"</td><td><input type='checkbox' name='ck_product' onclick='Check();' value='"+n.gjp_id+"'></td></tr>";
                        }
                        $("#grid").append(tbBody);
                     });
                    //数据加载完后开启搜索支持
                     $('table').filterTable({ // apply filterTable to all tables on this page
                        inputSelector: '#input-filter',//自带搜索框支持
                        filterExpression: 'filterTableFindAll',//模糊查询
                        minRows:1//一行起搜索
                    });
                },
                error: function  (jqXHR) {
                    alert("出错啦！"+jqXHR.status);
                }
            });
    }