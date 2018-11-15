$(function () {
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
            load_more();
        }
    });
    var $panelLoading = $('div.loading');
    var page = 1;
    var isLoadingMore = false;
    var finishedLoadingMore = function () {
        isLoadingMore = false;
    };
    var load_more = function(){
        if(isLoadingMore || page < 0){
            return;
        }
        var $url = $.url();
        var keywords = $url.param('keywords');
        var project_class = $url.param('class');
        var data = {};
        data.act = 'ajax';
        data.page = page;
        var url = $url.data.attr.file?$url.data.attr.file:'/index.html?ajax=1';
        url = '/index.html?ajax=1';
        if(keywords && keywords.length > 0){
            data.keywords = encodeURIComponent(keywords);
        }
        if(project_class && project_class.length > 0){
            data.project_class = encodeURIComponent(project_class);
        }
        $panelLoading.fadeIn();
        isLoadingMore = true;
        $.ajax({
            type: 'POST',
            url: LOCAL_URL+"/project.html",
            data: data,
            dataType: 'JSON',
            success: function (res) {
                if (!res.info || res.info.length == 0) {
                    page = -1;
                    finishedLoadingMore();
                    $panelLoading.fadeOut();
                    return;
                }
                var str = "";
                $.each(res.info, function (val, index, arr) {
                    str += "<div class=\"main2\"><a href=\"project_detail.html?id="+index.project_id+"\"><dl><dt><img src=\""+res.attachurl+"/"+index.project_img+"\"></dt><dd><p class=\"p4\">"+index.project_title+"</p><p class=\"p5\">"+index.project_content+"</p></dd></dl></a><div class=\"rongzi\"><div class=\"xin\"><div class=\"left\"><i class=\"iconfont\">&#xe608;</i><span>"+index.favorites+"</span></div><div class=\"center\"><i class=\"iconfont\">&#xe64b;</i><span>"+index.comments+"</span></div><div class=\"right\"><i class=\"iconfont\">&#xe679;</i></div></div></div></div>";
                });
                $(".item-card").append(str);
                page++;
                finishedLoadingMore();
            },
            error: function (res) {
                finishedLoadingMore();
            }

        });
    };
    load_more();
});