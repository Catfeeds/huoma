$(document).ready(function(){
    var panelFilter = $('.p_panel_filter');

    //防止双击，在ios上内容自动向上滚动。
    var lastTouch = 0;
    panelFilter.bind('touchstart',function(e){
        if((e.timeStamp - lastTouch) < 500){
            hideFilterPanel();
        }
        lastTouch = e.timeStamp;
    });

    panelFilter.on('click',null,null,function(e){
        e.preventDefault();
        hideFilterPanel();
    });
    panelFilter.on('click','.srh-box',null,function(e){
        e.stopImmediatePropagation();
    });
    //--------筛选
    {
        var disabledScroll = false;
        $(window).scroll(function(){
            if(disabledScroll){
                window.scroll(0,0);
            }
        });

        $(document).on('touchmove',null,null,function(e){
            if(disabledScroll){
                window.scroll(0,0);
                e.preventDefault();
                e.stopImmediatePropagation();
            }
        });


        var showFilterPanel = function(){
            window.scroll(0,0);
            disabledScroll = true;

            var panelBody = panelFilter.find('.p_panel_body');
            panelBody.hide();
            panelFilter.fadeIn(300);
            setTimeout(function(){
                panelBody.slideDown(200);
            },100);
        };

        var hideFilterPanel = function(){
            disabledScroll = false;
            var panelBody = panelFilter.find('.p_panel_body');
            panelBody.slideUp(200);
            setTimeout(function(){
                panelFilter.fadeOut(100);
            },100);
        };



        $('.p_btn_header_filter').click(function(e){
            e.preventDefault();

            if(panelFilter.css('display') == 'none'){
                showFilterPanel();
            } else {
                hideFilterPanel();
            }

        });

        panelFilter.find('.p_btn_cancel').click(function(e){
            e.preventDefault();
            panelFilter.fadeOut(200);
        });

        panelFilter.on('click','.p_btn_back',function(e){
            e.preventDefault();
            panelFilter.fadeOut(200);
        });

    }

    var formPhone = $('#formPhone');
    formPhone.submit(function(e){
        var data = {};
        data.mobile = $("#mobile").val();
        data.regCode = $("#regCode").val();
        data.passwd = $("#passwd").val();
        data.passwd_check = $("#passwd_check").val();
        if(data.mobile == ''){
            $("body").append("<div class='alert_div'><h1>提示</h1>" +
"<span>请输入手机号码</span></div>");
$('.alert_div').show ().delay (1000).fadeOut ();
            return false;
        }
        if(data.regCode == ''){
            $("body").append("<div class='alert_div'><h1>提示</h1>" +
"<span>请输入验证码</span></div>");
$('.alert_div').show ().delay (1000).fadeOut ();
            return false;
        }
        if(data.passwd == ''){
            $("body").append("<div class='alert_div'><h1>提示</h1>" +
"<span>请输入密码</span></div>");
$('.alert_div').show ().delay (1000).fadeOut ();
            return false;
        }
        if(data.passwd.length < 6){
           $("body").append("<div class='alert_div'><h1>提示</h1>" +
"<span>密码最低长度6位</span></div>");
$('.alert_div').show ().delay (1000).fadeOut ();
            return false;
        }
        if(data.passwd_check == ''){
            $("body").append("<div class='alert_div'><h1>提示</h1>" +
"<span>请输入确认密码</span></div>");
$('.alert_div').show ().delay (1000).fadeOut ();
            return false;
        }
        if(data.passwd_check != data.passwd){
           $("body").append("<div class='alert_div'><h1>提示</h1>" +
"<span>两次输入的密码不一致</span></div>");
$('.alert_div').show ().delay (1000).fadeOut ();
            return false;
        }
        if(!$('input[name="isAllow"]').is(':checked')){
            
            $("body").append("<div class='alert_div'><h1>提示</h1>" +
"<span>请阅读并同意《干点活服务协议》</span></div>");
$('.alert_div').show ().delay (1000).fadeOut ();
            e.preventDefault();
            return false;
        }

        e.preventDefault();
        $.ajax({
            url:LOCAL_URL+'/user-create_user_ajax-designer.html',
            type:'POST',
            data:{ylz:data},
            async:false,
            dataType:'JSON',
            success:function(res){
                if(res.error > 0){
                    $("body").append("<div class='alert_div'><h1>提示</h1>" +
                        "<span>" + res.message + "</span></div>");
                    $('.alert_div').show ().delay (1000).fadeOut ();
                    return false;
                }else{
                    $("body").append("<div class='alert_div'><h1>提示</h1>" +
                        "<span>" + res.message + "</span></div>");
                    $('.alert_div').show ().delay (2000).fadeOut ();
                    setTimeout(function(){
                        window.location.href='member.html';
                    },2000);
                }
            },
            error:function(){
            }
        })
    });

});


function getRegCode() {
    var a = document.getElementById("mobile");
    var b = document.getElementById("code");
    var c = $("#loginGetCode");
    if ("" == a.value){
        a.focus();
        $("body").append("<div class='alert_div'><h1>提示</h1>" +
    "<span>手机号不能为空</span></div>");
    $('.alert_div').show ().delay (1000).fadeOut ();
        return false;
    }
    if(!isPoneAvailable(a.value)){
        $("body").append("<div class='alert_div'><h1>提示</h1>" +
            "<span>手机号格式不正确</span></div>");
        $('.alert_div').show ().delay (1000).fadeOut ();
        return false;
    }
    if ("" == b.value){
        b.focus();
        $("body").append("<div class='alert_div'><h1>提示</h1>" +
            "<span>验证码不能为空</span></div>");
        $('.alert_div').show ().delay (1000).fadeOut ();
        return false;
    }
    var e = "ylz[mobile]=" + a.value + "&ylz[act]=register&ylz[code]=" + b.value;
    $.ajax({
        url: LOCAL_URL+"/user-send.html",
        type: "get",
        async: !0,
        data: e,
        cache: !1,
        success: function (a) {
            if(a.error>0){
                $("body").append("<div class='alert_div'><h1>提示</h1>" +
                    "<span>"+a.message+"</span></div>");
                $('.alert_div').show ().delay (1000).fadeOut ();
            }else{
                c.addClass("disabled").attr("disabled", !0);
                n(c,60);
            }
        },
        error: function (a) {
        }
    })
}
function n(t, o) {
    t.text(o + ' s 后重新获取'),
        setTimeout(function () {
            o -= 1,
                o >= 0 ? n(t, o)  : t.removeClass("disabled").attr("disabled", false).text('获取验证码');
        }, 1000)
}
function isPoneAvailable(phone_number) {
    var myreg=/^[1][3,4,5,7,8][0-9]{9}$/;
    if (!myreg.test(phone_number)) {
        return false;
    } else {
        return true;
    }
}