$(document).ready(function(){
    var form_passwd = $('#form_passwd');
    form_passwd.submit(function(e){
        var data = {};
        data.old_passwd = $("#old_passwd").val();
        data.passwd = $("#passwd").val();
        data.confirm_passwd = $("#confirm_passwd").val();
        if(data.old_passwd == ''){
            $("body").append("<div class='alert_div'><h1>提示</h1>" +
"<span>请输入原密码</span></div>");
$('.alert_div').show ().delay (1000).fadeOut ();
            return false;
        }
        if(data.passwd == ''){
            $("body").append("<div class='alert_div'><h1>提示</h1>" +
"<span>请输入新密码</span></div>");
$('.alert_div').show ().delay (1000).fadeOut ();
            return false;
        }
        if(data.passwd.length < 6){
            $("body").append("<div class='alert_div'><h1>提示</h1>" +
"<span>密码长度最低6位</span></div>");
$('.alert_div').show ().delay (1000).fadeOut ();
            return false;
        }
        if(data.confirm_passwd == ''){
            $("body").append("<div class='alert_div'><h1>提示</h1>" +
"<span>请输入确认密码</span></div>");
$('.alert_div').show ().delay (1000).fadeOut ();
            return false;
        }
        if(data.confirm_passwd != data.passwd){
           $("body").append("<div class='alert_div'><h1>提示</h1>" +
"<span>两次输入的密码不一致</span></div>");
$('.alert_div').show ().delay (1000).fadeOut ();
            return false;
        }

        e.preventDefault();
        $.ajax({
            url:LOCAL_URL+'/member/member-passwd.html',
            type:'POST',
            data:{account:data},
            async:false,
            dataType:'JSON',
            success:function(res){
                if(res.error > 0){
                    $("body").append("<div class='alert_div'><h1>提示</h1>" +
                        "<span>"+res.message+"</span></div>");
                    $('.alert_div').show ().delay (1000).fadeOut ();
                    return false;
                }
                $("body").append("<div class='alert_div'><h1>提示</h1>" +
                    "<span>修改成功</span></div>");
                $('.alert_div').show ().delay (1000).fadeOut ();
                setTimeout( function () {
                    window.location.href = "member.html";
                },1000);
            },
            error:function(){
            }
        })
    });

});