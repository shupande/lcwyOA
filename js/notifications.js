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
        //定时操作通知栏
    });

    setInterval(function () {
                //下单时间限制
                var currentTime=moment().format("HH:mm");
                // alert(currentTime);
                if(currentTime>"17:00" || currentTime < "09:30"){
                    $("#tips").text("提示：17:00-09:30本时间段不允许下单！").css("color","red");
                    $("#nextbutton").addClass("disabled");
                }else{
                    $("#tips").text("");
                    $("#nextbutton").removeClass("disabled");
                }
                //再获取新的数据添加进滚动栏
                getNotify();
            },7000);

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
                        liBody +="<li><a href='javascript:;'>通知："+n.content+"&nbsp&nbsp&nbsp"+n.create_time+"</a></li>";
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
            window.location="doQuit.php";
        }
    }