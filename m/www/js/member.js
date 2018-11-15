$(function () {
    var $panelLoading = $('div.loading');
    var load_member = function(){
        var data = {
            'act':'member_info'
        };
        $panelLoading.fadeIn();
        $.ajax({
            type: 'POST',
            url: LOCAL_URL+"/member/designer.html",
            data: data,
            dataType: 'JSON',
            success: function (res) {
                if(res.error&& res.error==1){
                    window.location.href="login.html";
                }
                if(res.member.face){$("#member_img").attr('src',res.attachurl+"/"+res.member.face);}
                $("#detail_title").html(res.member.uname);
                $("#member_id").val(res.member.designer_id);
                $("#xiangmu_count").html(res.count.xiangmu + "<p>项目</p>");
                $("#follow_count").html(res.count.fans + "<p>关注</p>");
                $("#fans_count").html(res.count.follow + "<p>粉丝</p>");
                var str = "";
                var count = 0;
                // 栏目列表
                if(res.menu_list){
                    $.each(res.menu_list, function (val, index, arr) {
                        str += '<div class="main">';
                        count = attributeCount(index.items);
                        var i = 0;
                        $.each(index.items, function (k, v) {
                            if(v.href){
                                str += '<a href="'+v.href+'">';
                            }else{
                                str += '<a href="javascript:void(0);">';
                            }
                            if(i == count -1 ){
                                str += '<div class="box1" style="border-bottom: none;">';
                            }else{
                                str += '<div class="box1">';
                            }
                            str += '<p class="p1">'+v.title+'</p><span class="sp1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div></a>';
                            i++;
                        });
                        str += '</div>';
                    });

                    str += '<div class="main"><a href="javascript:loginout();"><div class="box1" style="border-bottom: none;"><p class="p1">退出登录</p><span class="sp1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div></a></div>';
                    // $("#menu_list").append(str);
                }

            },
            error: function (res) {
            }

        });
    };
    load_member();
    var attributeCount = function(obj) {
        var count = 0;
        for(var i in obj) {
            if(obj.hasOwnProperty(i)) {  // 建议加上判断,如果没有扩展对象属性可以不加
                count++;
            }
        }
        return count;
    }

});

function loginout (){
    $.ajax({
        type: 'POST',
        url: LOCAL_URL+"/user-loginout.html",
        data: {logout:'logout'},
        dataType: 'JSON',
        success: function (res) {
            window.location.href="login.html";
        },
        error: function (res) {
            window.location.href="login.html";
        }

    });
}



