var xiangmu_id = 0;
$(document).ready(function () {
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
    var $panelLoading = $('a.loading');
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
        var id = $url.param('xiangmu_id');
        var sort = $url.param('sort');
        var data = {};
        data.act = 'ajax';
        data.page = page;

        var url = $url.data.attr.file?$url.data.attr.file:LOCAL_URL+'/index.html?ajax=1';
        url = LOCAL_URL+'/member/sheji/team-lists-'+id+'.html';
        if(keywords && keywords.length > 0){
            data.keywords = encodeURIComponent(keywords);
        }
        if(sort && sort.length > 0){
            data.sort = encodeURIComponent(sort);
        }
        if(id && id.length > 0){
            data.id = encodeURIComponent(id);
            xiangmu_id = id;
            $("#member_team_add").attr('href','member_team_list.html?xiangmu_id='+id);
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
                    //str += '<li><a href="member_team_info.html?id='+val+'"> <img src="'+index.team_img+'"> <h4>'+index.team_name+'</h4> <h5>'+index.team_task+'</h5></a> </li>';
                    str += '<li> <a href="member_team_info.html?id='+val+'"> <img src="'+index.team_img+'"> <h4>'+index.team_name+'</h4> <h5>'+index.team_task+'</h5> </a> <a class="xiugai2" href="javascript:add_team('+val+')">添加</a> </li>';
                });
                $(".item-card").append(str);
                page++;
                finishedLoadingMore();
            },
            error:function(){
                finishedLoadingMore();
            }

        });
    };
    loadMore();

    $(".switch-filter").click(function(e){
        e.preventDefault();
        $(".filter-wrap").fadeIn();
    });

    $(".filter-wrap .cancel").click(function(e){
        e.preventDefault();
        $(".filter-wrap").fadeOut();
    });

    $(".filter-group ul li").click(function(e){
        // e.preventDefault();
        $(this).siblings().removeClass("current");
        $(this).addClass("current");
    });

    $(".filter-wrap .reset").click(function(e){
        e.preventDefault();
        $(".filter-group ul li").removeClass("current");
        $(".filter-cates li:first, .filter-locs li:first, .filter-stages li:first").addClass("current");
    });

    $(".filter-wrap .confirm").click(function(e){
        e.preventDefault();


        var url = '/fundings?page=1';

        var $url = $.url();
        var keywords = $url.param('keywords');
        if(keywords && keywords.length > 0){
            url = url + "&keywords="+ encodeURIComponent(keywords);
        }

        var cates = $(".filter-cates li.current").attr("data-value");
        if(cates && cates.length > 0){
            url = url + "&cates="+ encodeURIComponent(cates);
        }

        var locs = $(".filter-locs li.current").attr("data-value");
        if(locs && locs.length > 0){
            url = url + "&residences="+ encodeURIComponent(locs);
        }

        var stages = $(".filter-stages li.current").attr("data-value");
        if(stages && stages.length > 0){
            url = url + "&fundStages="+ encodeURIComponent(stages);
        }

        location.href=url;
    });

    $("li.sort-name a").click(function(e){
        e.preventDefault();
        var url = $(this).attr("href");

        var $url = $.url();

        location.href=url;
    })
});


function add_team(id){
    var data = {};
    data.act="delete";
    data.teamid=[id];
    $.ajax({
        type: 'POST',
        url: LOCAL_URL+"/member/sheji/team-lists-"+xiangmu_id+".html",
        data: data,
        dataType: 'JSON',
        success: function (res) {
            if(res.error == 0){
                window.location.reload();
            }else{
                alert(res.message);
            }
        },
        error: function (res) {
        }
    });
}