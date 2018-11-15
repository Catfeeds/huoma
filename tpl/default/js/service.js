/**
 * Created by feng on 2016/1/7.
 *
 * 漂浮在线客服
 *
 */
$(function () {
    var serDom = $('.expoService');
    if (serDom.length != 0) {
        //初始化
        startSer();
        //计算高度
        var dheight = serDom.height(), dtop = serDom.data('top');
        if (dtop != '' && typeof(dtop) != 'undefined') {
            serDom.animate({'top': dtop}, 500);
        } else {
            serDom.animate({'top': '50%', marginTop: -dheight / 2}, 500);
        }
        $('.expoSer-item:last').slideUp();
        //绑定事件
        bindKf();
    }
});

//绑定客服事件
function bindKf() {
    $('.expoSer-item').hover(
        function () {
            $(this).find('.kfi').addClass('active').siblings('.expoSer-item-hover').stop().show(300);
        },
        function () {
            $(this).find('.kfi').removeClass('active').siblings('.expoSer-item-hover').stop().hide(300);
        }
    );
    $('.kftop').attr('onclick', 'return false').on('click', function () {
        $('html,body').animate({scrollTop: '0'}, 200);
    });

    $(document).on('scroll', function () {
        var sheight = $(window).scrollTop();
        if (sheight > 200) {
            $('.expoSer-item:last').slideDown(100);
        }else{
            $('.expoSer-item:last').slideUp(100);
        }
    });
}
//初始化客服UI
function startSer() {
    var content = '';
    content = content + '<div class=\"expoSer-item\"><a href=\"http://wpa.qq.com/msgrd?v=3&amp;uin=2850505064&amp;site=qq&amp;menu=yes\" target=\"_blank\" class=\"kfzx kfi\"><img src=\"/expo/expo/img/kf/zxicon.png\"><br>QQ咨询</a></div>';
    content = content + '<div class=\"expoSer-item\"><div class=\"expoSer-item-hover expoSer-Tel\">服务电话：<br>400-178-1616</div><a href=\"#\" class=\"kfkf kfi\"><img src=\"/expo/expo/img/kf/kficon.png\"> <br>服务热线</a></div>';
    content = content + '<div class=\"expoSer-item\"><div class=\"expoSer-item-hover expoSer-sq\"><a href=\"/shang.html\">参展商</a><a href=\"/shejishi.html\">设计师</a><a href=\"/gongchang.html\">搭建工厂</a> </div><a href=\"#\" class=\"kfkf kfi\">申请<br>入驻</a></div>';
    content = content + '<div class=\"expoSer-item\"><div class=\"expoSer-item-hover expoSer-qr\"><img src=\"/expo/expo/img/footqr.png\"></div><a href=\"#\" class=\"kfkf kfi\"><img src=\"/expo/expo/img/kf/erweima.png\"> <br>移动端</a></div>';
    content = content + '<div class=\"expoSer-item\"><a href=\"#\" class=\"kftop kfi\" onclick=\"return false\"><img src=\"/expo/expo/img/kf/fanhui.png\"><br>返回顶部</a></div>';
    $('.expoService').html(content);
}