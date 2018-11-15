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

    var form_login = $('#form_login');
    form_login.submit(function(e){
        var data = {};
        data.mobile = $("#mobile").val();
        data.passwd = $("#password").val();
        if(data.mobile == ''){
            $("body").append("<div class='alert_div'><h1>提示</h1>" +
"<span>请输入手机号码</span></div>");
$('.alert_div').show ().delay (1000).fadeOut ();
            return false;
        }
        if(data.passwd == ''){
             $("body").append("<div class='alert_div'><h1>提示</h1>" +
"<span>请输入密码</span></div>");
$('.alert_div').show ().delay (1000).fadeOut ();
            return false;
        }

        e.preventDefault();
        var link = getParam('link');
        link = link?link:'member.html';
        $.ajax({
            url:LOCAL_URL+'/user-login_ajax.html',
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
                }
                window.location.href=link;
            },
            error:function(){
            }
        })
    });

});


function getParam(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null){
        return decodeURI(r[2]);   //对参数进行decodeURI解码
    }
    return null;
}
