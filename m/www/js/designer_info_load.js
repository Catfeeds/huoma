$(function () {

    var $panelLoading = $('div.loading');
    var load_detail = function(){
        var $url = $.url();
        var project_class = $url.param('id');
        var data = {};
        data.id = project_class;
        $panelLoading.fadeIn();
        $.ajax({
            type: 'POST',
            url: LOCAL_URL+"/designer-detail-"+project_class+".html",
            data: data,
            dataType: 'JSON',
            success: function (res) {
                if(res.designer.face){$("#detail_img").attr('src',res.attachurl+"/"+res.designer.face);}
                $("#detail_title").html(res.designer.uname);
                $("#designer_id").val(res.designer.designer_id);

                if(res.designer.group_name){$("#about_list").append('<p class="pgone">职位：'+res.designer.group_name+'</p>');}
                if(res.designer.qq){$("#about_list").append('<p class="pgone">QQ号码：'+res.designer.qq+'</p>');}
                if(res.designer.school){$("#about_list").append('<p class="pgone">毕业院校：'+res.designer.school+'</p>');}
                if(res.designer.mobile){$("#about_list").append('<p class="pgone">电话：'+res.designer.mobile+'</p>');}
                if(res.designer.mail){$("#about_list").append('<p class="pgone">邮箱：'+res.designer.mail+'</p>');}
                if(res.designer.group_id){$("#about_list").append('<p class="pgone">经验：'+res.designer.group_id+'年</p>');}
                if(res.designer.group_name){$("#about_list").append('<p class="pgone">项目：'+res.designer.group_name+'</p>');}
                if(res.designer.slogan){$("#about_list").append('<p class="pgone">设计理念：'+res.designer.slogan+'</p>');}

                $("#div1").html(res.designer.about+'<a class="teshu" href="javascript:void(0);">收起</a>');
                $("#detail_views").html(res.designer.views + "<p>浏览</p>");
                $("#detail_comments").html(res.designer.comments + "<p>约谈</p>");
                $("#detail_favorites").html(res.designer.favorites + "<p>粉丝</p>");
                $("#detail_yuyan").html(res.designer.yuyan);
                $("#detail_size").html(res.designer.size);
                $("#detail_gurl").html(res.designer.gurl);
                $("#project_content").html(res.designer.project_content);
                $("#xiangmu_id").val(res.designer.xiangmu_id);
                // $("#business_plan").attr('href','detail.html?id='+res.designer.xiangmu_id);
                var str = "";
                // 项目经验
                if(res.items){
                    str = "";
                    $.each(res.items, function (val, index, arr) {
                        str += '<div class="list_1"> <div class="list1_1">';
                        if(index.thumb){
                            str += '<img src="'+res.attachurl+"/"+index.thumb+'">';
                        }else{
                            str += '<img src="/img/user_photo.jpg">';
                        }
                        str += '</div> <div class="list1_2"> <span>'+index.title+'</span> <span> '+index.cat_title+' </span> </div> </div>';
                    });
                    $("#item_list").append(str);
                }
                $("#fans_num").html(res.fans_num);
                $("#follow_num").html(res.follow_num);

            },
            error: function (res) {
            }

        });
    };
    load_detail();

});

function follow(){
    var designer_id = $("#designer_id").val();
    if(designer_id == ''){
        return false;
    }
    var data = {};
    data.designer_id = designer_id;
    $.ajax({
        type: 'POST',
        url: LOCAL_URL+"/detail-xmsheji-"+designer_id+"-2.html",
        data: data,
        dataType: 'JSON',
        success: function (res) {
            alert(res.message);
        },
        error: function (res) {
        }

    });
}

