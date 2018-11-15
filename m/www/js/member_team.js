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
        var id = $url.param('id');
        var sort = $url.param('sort');
        var data = {};
        data.act = 'ajax';
        data.page = page;

        var url = $url.data.attr.file?$url.data.attr.file:LOCAL_URL+'/index.html?ajax=1';
        url = LOCAL_URL+'/member/sheji/team.html';
        if(keywords && keywords.length > 0){
            data.keywords = encodeURIComponent(keywords);
        }
        if(sort && sort.length > 0){
            data.sort = encodeURIComponent(sort);
        }
        if(id && id.length > 0){
            data.id = encodeURIComponent(id);
            $("#member_team_add").attr('href','member_team_list.html?xiangmu_id='+id);
            url = LOCAL_URL+'/member/sheji/team-teamlist-'+id+'.html';
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
                    if(id){
                        str += '<li> <a href="javascript:void(0);"> <img src="'+index.team_img+'"> <h4>'+index.team_name+'</h4> <h5>'+index.team_task+'</h5> </a> </li>';
                    }else{
                        str += '<li> <a href="member_team_info.html?id='+val+'"> <img src="'+index.team_img+'"> <h4>'+index.team_name+'</h4> <h5>'+index.team_task+'</h5> </a> <a class="xiugai" href="member_team_info.html?id='+val+'">修改</a><a class="xiugai2" href="javascript:delete_team('+val+')">删除</a> </li>';
                    }
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


function delete_team(id){
    if(!confirm('确定要删除这个团队吗?')){
        return false;
    }
    var data = {};
    data.act="delete";
    $.ajax({
        type: 'POST',
        url: LOCAL_URL+"/member/sheji/team-delete-"+id+".html",
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