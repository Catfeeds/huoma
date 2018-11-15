$(function () {

    var load_detail = function(){
        var $url = $.url();
        var project_class = $url.param('id');
        var data = {};
        data.id = project_class;
        $panelLoading.fadeIn();
        $.ajax({
            type: 'POST',
            url: LOCAL_URL+"/detail-"+project_class+".html",
            data: data,
            dataType: 'JSON',
            success: function (res) {
                $("#detail_img").attr('src',res.attachurl+"/"+res.xiangmu.thumb);
                $("#detail_title").html(res.xiangmu.title);
                $("#detail_desc").html(res.xiangmu.desc);
                $("#detail_views").html(res.xiangmu.views + "<p>浏览</p>");
                $("#detail_comments").html(res.xiangmu.comments + "<p>约谈</p>");
                $("#detail_favorites").html(res.xiangmu.favorites + "<p>粉丝</p>");
                $("#detail_yuyan").html(res.xiangmu.yuyan);
                $("#cat_title").html(res.xiangmu.cat_title);
                $("#detail_gurl").html('<a href="'+res.xiangmu.gurl+'">'+res.xiangmu.gurl+'</a>');
                $("#detail_access_gurl").attr('href',res.xiangmu.gurl);
                $("#div1").html(res.xiangmu.desc);
                $("#project_content").html(res.xiangmu.project_content);
                $("#xiangmu_id").val(res.xiangmu.xiangmu_id);
                // $("#business_plan").attr('href','detail.html?id='+res.xiangmu.xiangmu_id);
                var str = "";
                // 项目团队
                if(res.team){
                    str = "";
                    $.each(res.team, function (val, index, arr) {
                        str += '<div class="list_1"><a href="designer_info.html?id='+index.team_id+'"> <div class="list1_1">';
                        if(index.team_img){
                            str += '<img src="'+res.attachurl+"/"+index.team_img+'">';
                        }else{
                            str += '<img src="/img/user_photo.jpg">';
                        }
                        str += '</div> <div class="list1_2"> <span>'+index.team_name+'</span> <span> </span> </div></a> </div>';
                    });
                    $("#team_list").append(str);
                }
                // 技术人员
                if(res.tjjishu){
                    str = "";
                    $.each(res.tjjishu, function (val, index, arr) {
                        str += '<a href="designer_info.html?id='+index.uid+'"><div class="list_1"> <div class="list1_1">';
                        if(index.face){
                            str += '<img src="'+res.attachurl+"/"+index.face+'">';
                        }else{
                            str += '<img src="/img/user_photo.jpg">';
                        }
                        str += '</div> <div class="list1_2"> <span>'+index.name+'</span> <span> </span> </div> </div></a>';
                    });
                    $("#tjjishu_list").append(str);
                }
                // 相似项目
                if(res.items){
                    str = "";
                    $.each(res.items, function (val, index, arr) {
                        str += '<div class="list_1"> <a href="designer_info.html?id='+index.id+'"><div class="list1_1">';
                        if(index.thumb){
                            str += '<img src="'+res.attachurl+"/"+index.thumb+'">';
                        }else{
                            str += '<img src="/img/user_photo.jpg">';
                        }
                        str += '</div> <div class="list1_2"> <span>'+index.title+'</span> <span>'+index.cat_title+' </span> </div></a> </div>';
                    });
                    $("#items_list").append(str);
                }
            },
            error: function (res) {
            }

        });
    };

    //滚动到底部加载更多
    $(window).bind('scroll', function () {
        var $window = $(window);
        var $document = $(document);
        var winHeight = $window.height();
        var docHeight = $document.height();
        var scrollTop = $window.scrollTop();
        if (scrollTop>100){
            $('.toTop').css("display","inline-block");
        }else{
            $('.toTop').fadeOut(200);
        }
        if ( winHeight+scrollTop+50 >= docHeight){
            load_comment();
        }
    });
    var $panelLoading = $('div.loading');
    var page = 1;
    var isLoadingMore = false;
    var finishedLoadingMore = function () {
        isLoadingMore = false;
    };
    var load_comment = function(){
        return ;
        if(isLoadingMore || page < 0){
            return;
        }
        var data = {};
        var xiangmu_id = $("#xiangmu_id").val();
        if(xiangmu_id == ''){
            return;
        }
        data.id = xiangmu_id;
        data.page = page;
        isLoadingMore = true;
        $.ajax({
            type: 'POST',
            url: LOCAL_URL+"/project-comment.html",
            data: data,
            dataType: 'JSON',
            success: function (res) {
                if (!res || res.length == 0) {
                    page = -1;
                    finishedLoadingMore();
                    $panelLoading.fadeOut();
                    return;
                }
                var str = "";
                $.each(res, function (val, index, arr) {
                    str += '<div class="comment-show-con clearfix"><div class="comment-show-con-list pull-left clearfix"><div class="pl-text clearfix"> <a href="#" class="comment-size-name">' + index.uname + ' : </a> <span class="my-pl-con">&nbsp;' + index.content + '</span> </div> <div class="date-dz"> <span class="date-dz-left pull-left comment-time">' + index.date + '</span> <div class="date-dz-right pull-right comment-pl-block"><a href="javascript:;" class="removeBlock">删除</a> <a href="javascript:;" class="date-dz-pl pl-hf hf-con-block pull-left">回复</a> </div> </div><div class="hf-list-con"></div></div> </div>';
                });
                $(".comment-show").append(str);
                page++;
                finishedLoadingMore();
            },
            error: function (res) {
                alert(111);
                finishedLoadingMore();
            }

        });
    };
    load_detail();

});

function follow(){
    var xiangmu_id = $("#xiangmu_id").val();
    if(xiangmu_id == ''){
        return false;
    }
    var data = {};
    data.xiangmu_id = xiangmu_id;
    $.ajax({
        type: 'POST',
        url: LOCAL_URL+"/detail-xmsheji-"+xiangmu_id+"-1.html",
        data: data,
        dataType: 'JSON',
        success: function (res) {
            alert(res.message);
        },
        error: function (res) {
        }

    });
}

