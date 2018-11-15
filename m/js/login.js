$(document).ready(function () {
    var page=2;
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
        var sort = $url.param('sort');
        var data = {};
        data.act = 'ajax';
        data.page = page;

        var url = $url.data.attr.file?$url.data.attr.file:'/index.html';
        if(keywords && keywords.length > 0){
            data.keywords = encodeURIComponent(keywords);
        }
        if(sort && sort.length > 0){
            data.sort = encodeURIComponent(sort);
        }

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
                    str += "<div class=\"main2\"> <a href=\"/detail-"+index['xiangmu_id']+".html\"> <dl> <dt><img src=\""+res.attachurl+"/"+index['thumb']+"\"></dt> <dd> <p class=\"p4\">"+index['title']+"</p><span class=\"s1\">名企</span><span class=\"s2\">名校</span> <p class=\"p5\">"+index['desc']+"</p> </dd> </dl> </a> <div class=\"rongzi\"> <a href=\"/detail-"+index['xiangmu_id']+".html\" style=\"display: none;\"><p class=\"p6\">  </p></a> <div class=\"xin\"> <div class=\"left\"> <i class=\"iconfont\">&#xe608;</i><span>"+index['favorites']+"</span> </div> <div class=\"center\"><i class=\"iconfont\">&#xe64b;</i><span>"+index['comments']+"</span></div> <div class=\"right\"><a href=\"/detail-"+index['xiangmu_id']+".html\" class=\"iconfont\">&#xe679;</a></div> </div> </div> </div>";
                });
                $(".item-card").append(res);
                page++;
                finishedLoadingMore();
            },
            error:function(){
                finishedLoadingMore();
            }

        });
    };
});