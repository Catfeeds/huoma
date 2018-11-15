/**
 * Created by feng on 2016/1/7.
 */
//全局开启ajax缓存
$.ajaxSetup({cache: true});
//定义AjaxGet列表函数
function getListData(node, url) {

    var d = $.Deferred();
    $.get(url)
        .done(function (data) {
            var list = $('.' + node);
            list.append(data);
            //刷新list样式
            if (list.data('role') == 'listview') {
                list.listview('refresh');
            }
            //修改Deferred状态为成功
            d.resolve();

        })
        .fail(function (e) {
            console.log('错误信息：' + e);
            //修改Deferred状态为失败
            d.reject();
        });
    //返回
    return d.promise();
}
//错误信息加载器(通用)
function showError(error, timer) {
    $.mobile.loading('show', {
        text: error,
        textonly: true,
        textVisible: true
    });
    setTimeout(function () {
        //$.mobile.loading('hide');
    }, timer);
}

//index事件

/**
 * 实现一个IScroll
 * 强制为主线程插入了一个script，用来解决以下的依赖问题，暂时还没有想到好的办法，除了requireJs
 * 但考虑到目前项目依赖较为简单，引入requireJs性价比不高，暂未处理
 * （IScroll.js）
 */
function newScroll(obj) {
    var iScrollFile = 'js/iscroll-lite.js';
    //var s = document.createElement('script');
    //s.src = iScrollFile;
    //$(obj).append(s);
    $.getScript(iScrollFile).done(function (script, textStatus) {
        //获取到iScroll后将loadScroll插入主线程
        setTimeout(loadScroll, 0);
    }).fail(function (e) {
        console.log('导航iscroll异常加载' + e);
    });
    //IScroll滑动导航
    var navscroll = '';

    function loadScroll() {
        //设置容器宽度自适应
        var widthI = $(obj).find('#scroller');
        widthI.width(widthI.find('li').length * widthI.find('li').outerWidth() + 10);
        if (navscroll == '') {
            navscroll = new IScroll('#navWrapper', {
                eventPassthrough: true,
                scrollX: true,
                scrollY: false,
                preventDefault: false
            });
        }
    }

}
$(document).on('pagecreate','#pageIndex', function () {
    newScroll(this);
});

$(document).on('pageshow', '#pageIndex', function () {
    console.log('pageIndex');
    //轮播
    var tempWrap = $('#indexFocus').children('.tempWrap');
    if (tempWrap.size() == 0) {
        TouchSlide({
            slideCell: "#indexFocus",
            titCell: ".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
            mainCell: ".bd ul",
            effect: "left",
            autoPlay: false,//自动播放
            autoPage: true, //自动分页
            switchLoad: "_src" //切换加载，真实图片路径为"_src"
        });
    }

    //推荐内容加载
    var listCon = $(this).data('mylist-con');
    var listSrc = $(this).data('mylist-src');

    $(document).on('scroll', function () {
        if ($(document).scrollTop() >= $(document).height() - $(window).height()) {
            $.when(getListData(listCon, listSrc)).done(function () {
                //渲染成功
            }).fail(function () {
                //渲染失败
            });
        }
    });
});
//factory.user.offer 工厂报价页事件
$(document).on('pageshow', '#pageUserFactoryOffer', function () {
    console.log('pageUserFactoryOffer');
    //异步处理点击更多按钮
    $('.offer-list-more').on('tap', function () {
        var listBtn = $(this), listC = $(this).parent(), listUrl = listC.data('offerlist-url');

        //显示loading 动画
        $.mobile.loading('show');

        //开始获取数据
        $.get(listUrl).done(function (data) {
            listC.append(data); //先追加新获取列表
            listBtn.appendTo(listC); //再将按钮移到底部
            listC.listview('refresh');  //刷新列表
            var setIcon = listBtn.find('span').hasClass('icon-more');
            if (!setIcon) {
                listBtn.find('span').removeClass('icon-refresh').addClass('icon-more').empty();
            }
            //结束loading动画
            $.mobile.loading('hide');
        }).fail(function (e) {
            console.log(e);
            //结束loading动画
            $.mobile.loading('hide');
            showError('列表加载失败,请刷新重试', 3000);
            listBtn.find('span').removeClass('icon-more').addClass('icon-refresh').html('加载失败，刷新重试');
        });
    });
});
//pageArticle3 pageArticle4事件
$(document).on('pageshow', '#pageArticle3', function () {
    console.log('pageArticle3');
    //轮播图
    var tempWrap = $('#article3Focus').children('.tempWrap');
    if (tempWrap.size() == 0) {
        TouchSlide({
            slideCell: "#article3Focus",
            titCell: ".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
            mainCell: ".bd ul",
            effect: "left",
            autoPlay: true,//自动播放
            autoPage: true, //自动分页
            switchLoad: "_src" //切换加载，真实图片路径为"_src"
        });
    }
});
//pageFactoryMain 事件
$(document).on('pageshow', '#pageFactoryMain', function () {
    console.log('pageFactoryMain');
    //轮播图
    var tempWrap = $('#factoryFocus').children('.tempWrap');
    if (tempWrap.size() == 0) {
        TouchSlide({
            slideCell: "#factoryFocus",
            titCell: ".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
            mainCell: ".bd ul",
            effect: "left",
            autoPlay: true,//自动播放
            autoPage: true, //自动分页
            switchLoad: "_src" //切换加载，真实图片路径为"_src"
        });
    }

});
//login事件
$(document).on('pageshow', '#pageLogin', function () {
    console.log('pageLogin');
    var tempWrap = $('#loginTab').children('.tempWrap');
    if (tempWrap.size() == 0) {
        TouchSlide({slideCell: "#loginTab", effect: "leftLoop"});
    }
});
//register事件
$(document).on('pageshow', '#pageRegister', function () {
    console.log('pageRegister');
    //添加表单验证依赖函数库
    var srciptUrl = 'js/regLogin.js';
    $.getScript(srciptUrl).fail(function (xhr, status) {
        console.log(status);
    });
    //开始绑定验证事件
    //绑定动态验证
    $('#uname').change(function () {
        cheakFormOnline('uname');
    });
    $('#mobile').change(function () {
        cheakFormOnline('mobile');
    });

    $('#mail').change(function () {
        cheakFormOnline('mail');
    });

    //获取手机注册
    $('#loginGetCode').on('tap', function () {
        getRegCode();
    });
    //立即注册
    $('#regSubmit').on('tap', function () {
        regSubmit();
    });
});

//list事件

//页面显示，执行绑定事件
$(document).on("pageshow", "#pageList", function () {
    console.log('pageList');
    //绑定滑动到底部
    var listCon = $(this).data('mylist-con');
    var listSrc = $(this).data('mylist-src');

    $(document).unbind("scroll");
    $(document).bind("scroll", function () {
        //判断到底
        if ($(document).scrollTop() >= $(document).height() - $(window).height()) {
            $.when(getListData(listCon, listSrc)).done(function () {
                // TODO 成功载入执行

            }).fail(function () {
                // TODO 若列表载入失败

            });

        }
    });

});
//页面跳转后，解除绑定
$(document).on("pagehide", "#pageList", function () {
    $(document).unbind("scroll");
});

//pageSearch事件
$(document).on('pageinit', '#pageSearch', function () {
    console.log('pageSearch');
    //重设宽度
    var dWidth = $(document).width();
    $('.headerSearch').width(dWidth - 70);
});
$(document).on('pageshow', '#pageSearch', function () {
    var tempWrap = $('#searchTab').children('.tempWrap');
    if (tempWrap.size() == 0) {
        TouchSlide({slideCell: "#searchTab", effect: "leftLoop"});
    }
});


//userCenter 事件

//渲染方法
$(document).on('pageshow', '#pageDesignerCenter', function () {
    console.log('pageDesignerCenter');
    //定义TouchSlide自适应高度
    function setHeight(id) {
        var uTab = $('#userCenterTab');
        uTab.find('.tempWrap').height(uTab.find('.' + id).parent().height());
    }

    //显示头部
    var nameHeight = $('#userCenterName').offset().top;
    $(document).on('scroll', function () {
        var scrollHeight = $(document).scrollTop();
        //滚动头部固定
        if (scrollHeight > nameHeight + 30) {
//                    $('#userCenterTitle').html($('#userCenterName').html());
            $('#userCenterTitle').slideDown(200);
        } else {
            $('#userCenterTitle').slideUp(200);
        }
    });

    //TouchSlide配置
    var tempWrap1 = $('#userCenterDes').children('.tempWrap');
    var tempWrap2 = $('#userCenterTab').children('.tempWrap');
    if (tempWrap1.size() == 0) {
        TouchSlide({
            slideCell: "#userCenterDes", endFun: function (i) { //高度自适应
                var bd1 = document.getElementById("userCenterBd");
                bd1.parentNode.style.height = bd1.children[i].children[0].offsetHeight + "px";
                if (i > 0)bd1.parentNode.style.transition = "200ms";//添加动画效果
            }
        });
    }
    if (tempWrap2.size() == 0) {
        TouchSlide({
            slideCell: "#userCenterTab", endFun: function (i) { //高度自适应
                var bd = document.getElementById("userCenterTabBd");
                bd.parentNode.style.height = bd.children[i].children[0].offsetHeight + "px";
                if (i > 0)bd.parentNode.style.transition = "200ms";//添加动画效果
            }
        });
    }

    //渲染列表
    var caseCon = $(this).data('mycase-con');
    var caseSrc = $(this).data('mycase-src');
    var artCon = $(this).data('myart-con');
    var artSrc = $(this).data('myart-src');
    var disCon = $(this).data('mydis-con');
    var disSrc = $(this).data('mydis-src');
    console.log(caseCon + ' | ' + caseSrc);
    $('#caseMore').on('tap', function () {
        //使用Deferred确定执行完毕
        $.when(getListData(caseCon, caseSrc)).done(function () {
            //自适应高度
            setHeight(caseCon);
            //img载入后会改变容器高度，每次载入img都重新setHeight
            $('.' + caseCon).find('img').load(function () {
                setHeight(caseCon);
            });
        }).fail(function () {
            console.log('案例载入错误');
        });
    });
    $('#articleMore').on('tap', function () {
        //使用Deferred确定执行完毕
        $.when(getListData(artCon, artSrc)).done(function () {
            //自适应高度
            setHeight(artCon);
        }).fail(function () {
            console.log('文章载入错误');
        });
    });
    $('#disMore').on('tap', function () {
        //使用Deferred确定执行完毕
        $.when(getListData(disCon, disSrc)).done(function () {
            //自适应高度
            setHeight('bd-discuss-con1');
        }).fail(function () {
            console.log('评价载入错误');
        });
    });

});

