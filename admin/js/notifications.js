    function newOrdersCount () {
        $.ajax({
            type: "GET",
            url: "newOrdersCount.php",
            success: function (data) {
                if(data>0){
                    $("#new").show();
                    $("#new").text(data);
                }else{
                     $("#new").hide();
                }
            },
            error: function  (jqXHR) {
                console.log("获取新订单总数出错啦！"+jqXHR.status);
            }
        });
    }



    function autoScroll(obj) {
        $(obj).find(".list").animate({
            marginTop: "-25px"
        }, 500, function() {
            $(this).css({
                marginTop: "0px"
            }).find("li:first").appendTo(this);
        })
    }
    $(function() {

        setInterval('autoScroll(".scroll")', 7000);

    })

        $(document).ready(function() {
        getNotify();
        //定时操作通知栏和新的订单数
        newOrdersCount();
    });

    setInterval(function () {
                //先清空
                $("#roll_li").html("");
                //再获取新的数据添加进滚动栏
                getNotify();
                newOrdersCount();
            },14000);

    //获取通知
    function getNotify() {
        $.ajax({
            type: "GET",
            url: "getNotifications.php?number="+2+"&str=*",
            // dataType: "json",
            success: function (data) {
                 var string=$.parseJSON(data);
                 $.each(string,function (i,n) {
                    // alert(n.content);
                    var liBody="";
                    if(n.is_delete==0){
                        liBody +="<li><a href='notification.php'>通知："+n.content+"&nbsp&nbsp&nbsp"+n.create_time+"</a></li>";
                        $("#roll_li").append(liBody);
                    }
                 });
            },
            error: function  (jqXHR) {
                console.log("获取通知出错啦！"+jqXHR.status);
            }
        });
    }

    function quit () {
        if(window.confirm("确定要退出吗？")){
            window.location="../doQuit.php";
        }
    }