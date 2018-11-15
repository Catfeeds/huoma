$(function () {

    var load_detail = function(){
        var $url = $.url();
        var project_class = $url.param('id');
        var data = {};
        data.id = project_class;
        $panelLoading.fadeIn();
        $.ajax({
            type: 'POST',
            url: LOCAL_URL+"/project-detail-"+project_class+".html",
            data: data,
            dataType: 'JSON',
            success: function (res) {
                $("#detail_img").attr('src',res.attachurl+"/"+res.thumb);
                $("#detail_title").html(res.title);
                $("#detail_desc").html(res.desc_desc);
                $("#detail_views").html(res.views + "<p>浏览</p>");
                $("#detail_favorites").html(res.favorites + "<p>关注</p>");
                $("#detail_comments").html(res.comments + "<p>约谈</p>");
                $("#div1").html(res.desc);
                $("#project_content").html(res.project_content);
                $("#xiangmu_id").val(res.xiangmu_id);
                $("#business_plan").attr('href','detail.html?id='+res.xiangmu_id);
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

