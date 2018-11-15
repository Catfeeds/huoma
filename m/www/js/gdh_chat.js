$(document).ready(function () {
    var host = window.location.host + '/www';
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
            loadMore();
        }
    });

    var page=1;
    var $panelLoading = $('div.loading');
    var isLoadingMore = false;
    var finishedLoadingMore = function(){
        isLoadingMore = false;
    };

    $panelLoading.click(function(e){
        e.preventDefault();
        loadMore();
    });

    var loadMore  = function(){

        if(isLoadingMore || page < 0){
            return;
        }

        var $url = $.url();
        var keywords = $url.param('keywords');
        if(keywords && keywords.length>0){
            $("#keywords").val(keywords);
        }
        var sort = $url.param('sort');
        var data = {};
        data.act = 'ajax';
        data.page = page;

        var url = $url.data.attr.file?$url.data.attr.file:LOCAL_URL+'/index.html?ajax=1';
        url = LOCAL_URL+'/index.html?ajax=1';
        if(keywords && keywords.length > 0){
            data.keywords = keywords;
        }
        if(sort && sort.length > 0){
            data.sort = encodeURIComponent(sort);
        }
        // console.log(data);
        // return false;

        $panelLoading.fadeIn();
        isLoadingMore = true;
        //加载更多中。。。;
        $.ajax(url,{
            type:'POST',
            data:data,
            dataType:'JSON',
            success:function(res){
                if(!res.info || res.info.length == 0){
                    page=-1;
                    finishedLoadingMore();
                    $panelLoading.fadeOut();
                    return;
                }
                var str = "";
                $.each(res.info,function(val,index,arr){
                    str += "<dl> <dt><a href=\"http://"+host+"/laychat/index.php/mobile/index/index/id/"+index['xiangmu_id']+".html\"><img src=\""+res.attachurl+"/"+index['thumb']+"\"></a></dt> <dd> <p class=\"p1\"><a href=\"http://"+host+"/laychat/index.php/mobile/index/index/id/"+index['xiangmu_id']+".html\">"+index['title']+"<span>"+index['dateline']+"</span></a></p> <p class=\"p2\"><a class=\"p2\" href=\"http://"+host+"/laychat/index.php/mobile/index/index/id/"+index['xiangmu_id']+".html\">"+index['desc']+"</a></p> </dd> </dl>";
                });
                $(".li_list_3").append(str);
                page++;
                finishedLoadingMore();
            },
            error:function(){
                finishedLoadingMore();
            }

        });
    };
    loadMore();

});

function search(){
    var keywords = $("#keywords").val();
    window.location.href='?keywords=' + keywords;
}
