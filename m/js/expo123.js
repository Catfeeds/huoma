/**
 * Created by feng on 2016/1/7.
 */

(function ($, window, document) {
    "use strict";
    //定义AjaxGet列表函数
    function getListData(node, url) {
        //声明
        var d = $.Deferred();
        //page判断
        var list = $('#' + node);
        var page = list.data('pageNum');
        if (typeof(page) == 'undefined' || page <= 1) {
            page = 2;
        } else {
            page = page + 1;
        }
        //设置dom标记
        list.data('pageNum', page);
        var pageUrl = url + '?page=' + page;

        console.log(node + ' | ' + pageUrl);
        var loadLabel = $('.listLoadLabel');
        $.get(pageUrl)
            .done(function (data) {
                console.log(data.length + ' | ' + data.replace(/^\s\s*/, '').replace(/\s\s*$/, '').length);
                //为空判断
                if (data.replace(/^\s\s*/, '').replace(/\s\s*$/, '').length == 0) {

                    //检测是否有loadLabel
                    if (loadLabel.length > 0) {
                        loadLabel.html('没有更多内容了');
                    } else {
                        showError('没有更多内容了', 2000);
                    }
                } else {

                    list.append(data);
                    loadLabel.html('上拉加载更多');
                    //刷新list样式
                    if (list.data('role') == 'listview') {
                        list.listview('refresh');
                    }
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
            $.mobile.loading('hide');
        }, timer);
    }

//定义TouchSlide加载更多时自适应高度
    function setHeight(conId, innerCls) {
        console.log(conId);
        var uTab = $('#' + conId);
        var conH = uTab.find('.' + innerCls).parent().height();
        console.log(conH);
        uTab.find('.tempWrap').height(conH);

    }

//全局退出方法，依赖a标签属性：data-myQuit="true"
    function myQuit(thisPage) {
        thisPage.find('[data-myquit="true"]').on('tap', function (e) {
            e.preventDefault();
            $.mobile.loading('show');   //显示加载器
            var quitUrl = $(this).attr('href');
            $.get(quitUrl).done(function (data) {
                data = $.parseJSON(data);
                if (data.error == 0) {
                    $.mobile.loading('hide');   //隐藏加载器
                    //退出成功，刷新当前页面
                    //location.reload(true);
                    var forward = data.forward || '/member/member-index.html';
                    $.mobile.changePage(forward, {transition: 'slide', reloadPage: true});
                } else {
                    $.mobile.loading('hide');   //隐藏加载器
                    showError(data.message, 1000);
                }
            }).fail(function () {
                $.mobile.loading('hide');   //隐藏加载器
                showError('网络错误,重试', 1000);
            });
        });
    }

//点赞方法
    function setSupport(obj) {
        $(obj).find('[data-setsupport="true"]').on('tap', function (e) {
            e.preventDefault();
            if (!$(this).hasClass('active') && !$(this).hasClass('hover')) {
                $(this).addClass('hover');
                setSup(this);
            }
        });
        //数据方法
        function setSup(obj) {
            var link = $(obj).find('a').attr('href');
            $.get(link).done(function (data) {
                console.log(data);
                try {
                    data = $.parseJSON(data);
                } catch (e) {
                    console.log(e.status);
                }
                showError(data.message, 1000);
                if (data.error === 0) {
                    $(obj).removeClass('hover').addClass('active');
                } else {
                    $(obj).removeClass('hover');
                }
            }).fail(function () {
                console.log($(obj));
                $(obj).removeClass('hover');
                showError('网络错误，请重试', 1000);
            });
        }
    }

    /**
     * 服务器地址,成功返回,失败返回参数格式依照jquery.ajax习惯;
     * 其他参数同WebUploader
     * @param thisPage  页面主jquery对象
     * @param mainId    upload主容器id (factorylogo)
     * @param picId     存放图片路径的hidden Input id  (factoryLogoPath)
     */
    function myDiyUpload(thisPage, mainId, picId) {
        var mainDom = thisPage.find('#' + mainId), url = mainDom.data('upurl'), num = mainDom.data('mutpic'), photoUrl, d = new $.Deferred();
        console.log(url + ' | ' + num);

        var webUploader = '/js/upload/webuploader.html5only.min.js';
        var newUploader = '/js/upload/diyUpload.js';
        $.getScript(webUploader).done(function () {
            $.getScript(newUploader).done(function () {
                console.log('webUploader加载完了');

                //工厂信息页
                mainDom.diyUpload({
                    url: url,
                    fileNumLimit: num,
                    success: function (response) {
                        console.info("单个上传成功");
                        response = eval(response);
                        if (typeof photoUrl === 'undefined') {
                            photoUrl = response.photo;
                        } else {
                            photoUrl = photoUrl + ',' + response.photo;
                        }

                        $(thisPage.find('#' + picId)).val(photoUrl);

                    },
                    error: function (err) {
                        console.info("上传失败");
                        console.info(err);
                    },
                    uploadFinished: function () {
                        console.info('全部上传成功！');
                        //返回form提交指令
                        d.resolve();
                    },
                    buttonText: " "
                });

                //配置 End


            }).fail(function () {
                console.log('上传功能加载失败');
                d.reject();
            });
        }).fail(function () {
            console.log('上传主控件加载失败');
            d.reject();
        });

        return d.promise();

    }

    //设置cookies
    function setCookies(name, value, time) {
        if (!time) {
            document.cookie = name + '=' + value;
        } else {
            console.log(time);
        }
    }

    //获取cookies
    function getCookies(name) {
        var arr, reg = new RegExp("(^| )" + name + "=([^;]*)(;|$)");
        if (arr = document.cookie.match(reg))
            return arr[2];
        else
            return null;
    }


    $(document).on('pageshow', function () {
        //全局开启ajax缓存
        $.ajaxSetup({cache: true});
        //注入goto Top 按钮
        var pages = $(this).find('[data-role="page"]'), thisPage, content = '<div class=\"goToTop iconfont icon-up\"></div>';
        if (pages.length > 1) {
            thisPage = $(pages[pages.length - 1]);
        } else {
            thisPage = pages;
        }
        var gTop = thisPage.find('.goToTop');
        if (gTop.length === 0) {
            thisPage.append(content);
            gTop = thisPage.find('.goToTop');
        }
        var htmlDom = $(this).find('html,body');
        //绑定top事件
        $(document).scroll(function () {
            if ($(document).scrollTop() > 500) {
                gTop.stop(true, true).show(500);
            } else {
                gTop.stop(true, true).hide(500);
            }

        });
        gTop.on('tap', function (e) {
            e.preventDefault();
            e.stopPropagation();
            htmlDom.animate({scrollTop: 0}, 500);
        });
        //触摸标题返回顶部
        $('.header').on('tap', function () {
            htmlDom.animate({scrollTop: 0}, 500);
        });

        //全局绑定ajax link方法
        var customlink = $('[data-customlink="ajax"]');
        if(customlink.length !== 0){
            customlink.on('tap', function (e) {
                e.stopPropagation();
                e.preventDefault();
                var linkurl = customlink.attr('href');
                $.get(linkurl).done(function (data) {
                    try {
                        data = $.parseJSON(data);
                    } catch (e) {}
                    console.log(data);
                    showError(data.message,1000);
                    setTimeout(function () {
                        $.mobile.changePage(data.forward,{transition: 'slide'});
                    },1000);
                });
            });
        }


    });
//全局解绑
    $(document).on('pagehide', function () {
        console.log('全局解绑scroll');
        $(document).off('scroll');

    });


//index事件
    $(document).on('pageshow', '#pageIndex', function () {
        console.log('pageIndex');
        var thisPage = $(this);
        //轮播
        var tempWrapId = thisPage.find('[data-slideid="indexFocus"]').attr('id');
        var tempWrap = $('#' + tempWrapId).children('.tempWrap');
        if (tempWrap.size() == 0) {
            var bd = $('#' + tempWrapId).find('.bd');
            TouchSlide({
                slideCell: "#" + tempWrapId,
                titCell: ".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
                mainCell: ".bd ul",
                effect: "left",
                autoPlay: false,//自动播放
                autoPage: true, //自动分页
                switchLoad: "_src" //切换加载，真实图片路径为"_src"

            });

        }

        //加载IScroll导航
        //newScroll(this);
        //推荐内容加载
        //推荐内容加载
        var listCon = $(this).data('mylist-con');
        var listSrc = $(this).data('mylist-src');
        var listNode = $(this).find('.' + listCon).attr('id');
        console.log(listNode);

        $(document).scroll(function () {
            console.log('scroll');
            if ($(document).scrollTop() >= $(document).height() - $(window).height()) {
                $.when(getListData(listNode, listSrc)).done(function () {
                    //渲染成功
                    console.log('渲染成功');
                }).fail(function () {
                    //渲染失败
                    showError('加载失败，请刷新重试', 2000);
                });
            }
        });


    });


//工厂首页，用户登录主页
    $(document).on('pageshow', '#pageUserFactory', function () {
        console.log('pageUserFactory');
        //调用退出方法
        myQuit($(this));
    });


//factory.user.offer 工厂报价页事件
    $(document).on('pageshow', '#pageUserFactoryOffer', function () {
        console.log('pageUserFactoryOffer');

        //TouchSlide 效果
        var tempWrapId = $(this).find('[data-slideid="fOfferList"]').attr('id'), tempWrap = $('#' + tempWrapId).children('.tempWrap'), listSlide = new $.Deferred(), listC, listLoading = $(this).find('.listLoading');
        if (tempWrap.size() == 0) {
            TouchSlide({
                slideCell: "#" + tempWrapId, endFun: function (i) { //高度自适应
                    var bd = document.getElementById($('#' + tempWrapId).find('.bd').attr('id'));
                    bd.parentNode.style.height = bd.children[i].children[0].offsetHeight + "px";
                    if (i > 0)bd.parentNode.style.transition = "200ms";//添加动画效果
                    listC = bd.children[i];
                    listSlide.resolve();
                }
            });
        }
        //动态设置touchSlide内容器宽度
        $('.fOffer3-list-item').width($(document).width());

        listSlide.then(function () {
            getOfferList(listC);
            $(document).off('scroll').scroll(function () {
                if ($(document).scrollTop() >= $(document).height() - $(window).height()) {
                    getOfferList(listC);
                }
            });
        });

        //异步处理点击更多按钮
        function getOfferList(listC) {
            var page = $(listC).find('.fOffer3-list-item').data('pageNum');
            if (typeof(page) == 'undefined' || page <= 1) {
                page = 2;
            } else {
                page = page + 1;
            }
            var listUrl = $(listC).find('.fOffer3-list-item').data('offerlist-url') + '?page=' + page;
            console.log(listUrl);
            //设置dom标记
            $(listC).find('.fOffer3-list-item').data('pageNum', page);

            //开始获取数据
            $.get(listUrl).done(function (data) {
                //判断为空
                if (data.replace(/^\s\s*/, '').replace(/\s\s*$/, '').length == 0) {
                    listLoading.find('.listLoadLabel').text('没有内容了');
                } else {
                    $(listC).find('.fOffer3-list-item').append(data); //先追加新获取列表
                    listLoading.find('.listLoadLabel').text('更新完成');
                }
                //TouchSlide自适应高度
                setHeight(tempWrapId, 'fOffer3-list-item');

            }).fail(function (e) {
                console.log('获取列表失败' + e.status);
                //结束loading动画
                listLoading.find('.listLoadLabel').text('列表刷新失败，请重试');
            });
        }

    });
//pageArticle2字体放大事件
    $(document).on('pageshow', '#pageArticle2', function () {
        console.log('pageArticle2');
        var thisPage = $(this);
        //字体放大
        $('.article2-size').on('tap', function () {
            if (!$(this).hasClass('active')) {
                $(this).addClass('active');
                $('.article2-details').css('fontSize', '1.2em');
            } else {
                $(this).removeClass('active');
                $('.article2-details').css('fontSize', '1em');
            }
        });


    });
//pageArticle3 pageArticle4事件
    $(document).on('pageshow', '#pageArticle3', function () {
        console.log('pageArticle3');
        var thisPage = $(this);
        //轮播图
        var tempWrapId = $(this).find('[data-slideid="article3Focus"]').attr('id');
        var tempWrap = $('#' + tempWrapId).children('.tempWrap');
        if (tempWrap.size() == 0) {
            TouchSlide({
                slideCell: "#" + tempWrapId,
                titCell: ".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
                mainCell: ".bd ul",
                effect: "left",
                autoPlay: true,//自动播放
                autoPage: true, //自动分页
                switchLoad: "_src", //切换加载，真实图片路径为"_src"
                endFun: function (i) {
                    var bd = $('#' + tempWrapId).find('.bd');
                    bd.children().height($((bd.find('li'))[i]).find('img').height());
                }
            });
        }

    });
//pageFactoryMain 事件
    $(document).on('pageshow', '#pageFactoryMain', function () {
        console.log('pageFactoryMain');
        //轮播图
        var tempWrapId = $(this).find('[data-slideid="factoryFocus"]').attr('id');
        var tempWrap = $('#' + tempWrapId).children('.tempWrap');
        if (tempWrap.size() == 0) {
            TouchSlide({
                slideCell: "#" + tempWrapId,
                titCell: ".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
                mainCell: ".bd ul",
                effect: "left",
                autoPlay: true,//自动播放
                autoPage: true, //自动分页
                switchLoad: "_src", //切换加载，真实图片路径为"_src"
                endFun: function (i) {
                    var bd = $('#' + tempWrapId).find('.bd');
                    bd.children().height($((bd.find('li'))[i]).find('img').height());
                }
            });
        }

    });
//login事件
    $(document).on('pageshow', '#pageLogin', function () {
        console.log('pageLogin');
        var thisPage = $(this);

        var tempWrapId = $(this).find('[data-slideid="loginTab"]').attr('id');
        var tempWrap = $('#' + tempWrapId).children('.tempWrap');
        if (tempWrap.size() == 0) {
            TouchSlide({slideCell: "#" + tempWrapId, effect: "leftLoop"});
        }

        //login ajax 处理
        var loginForm = $(this).find('#loginForm');
        var loginUserName = loginForm.find('#loginUserName');
        var loginUserPwd = loginForm.find('#loginUserPwd');
        //获取焦点或失去焦点刷新swiper
        function resizeH() {
            thisPage.height($(window).height());
        }

        //console.log(focusH);
        $(loginUserName).on({
            focus: function () {
                resizeH();
            },
            blur: function () {
                resizeH();
            }
        });
        $(loginUserPwd).on({
            focus: function () {
                resizeH();
                //this.type='password';
            },
            blur: function () {
                resizeH();
            }
        });

        //监听tap事件
        $(loginForm).on('submit', function () {
            console.log('loginForm tap' + loginForm + ' | uname=' + loginUserName.val() + ' | pwd=' + loginUserPwd.val());
            if (loginUserName.val().length == 0) {
                showError('请输入用户名', 1000);
                return false;
            }
            if (loginUserPwd.val().length == 0) {
                showError('请输入密码', 1000);
                return false;
            }
            //显示系统加载框
            $.mobile.loading('show');
            //ajax请求登录
            $.ajax({
                type: 'post',
                url: loginForm.attr('action'),
                data: loginForm.serialize()
            }).done(function (data) {
                try {
                    data = $.parseJSON(data);
                } catch (e) {
                    console.log(e);
                    showError('内部错误', 1000);
                    return false;
                }
                var error = data.error, message = data.message, forward = data.forward, appendJs = data.appendjs;
                console.log(error + ' | ' + forward + ' | ' + appendJs);
                //隐藏加载框
                $.mobile.loading('hide');
                if (error != 0) {
                    showError(message, 2000);
                } else {
                    //showError(message, 1000);
                    loginForm.parent().append(appendJs);    //ucenter同步
                    //因返回的连接需要二次跳转，changepage不能获取最终页面，改为js直接跳转
                    $.mobile.changePage(forward, {transition: 'slide', reloadPage: true});
                    //location.href = forward;
                    //location.reload(true);
                }
            }).fail(function (status) {
                //隐藏加载框
                $.mobile.loading('hide');
                console.log('登录错误：' + status);
                showError('内部错误，请刷新重试', 1000);
            });
            return false;
        });
    });
//register事件
    $(document).on('pageshow', '#pageRegister', function () {
        console.log('pageRegister');
        var thisPage = $(this);
        //添加表单验证依赖函数库
        var srciptUrl = '/js/regLogin.js';
        $.getScript(srciptUrl).done(function () {
            //开始绑定验证事件
            //绑定动态验证
            thisPage.find('#uname').change(function () {
                cheakFormOnline('uname');
            });
            thisPage.find('#mobile').change(function () {
                cheakFormOnline('mobile');
            });

            thisPage.find('#mail').change(function () {
                cheakFormOnline('mail');
            });

            //获取手机注册
            thisPage.find('#loginGetCode').on('tap', function () {
                getRegCode();
                //thisPage.find('#regCode').val('123456');

            });
            //立即注册
            thisPage.find('#loginForm').on('submit', function () {
                regSubmit();
                return false;
            });
        }).fail(function (xhr, status) {
            console.log(status);
        });

    });

//list事件

//页面显示，执行绑定事件
    $(document).on("pageshow", "#pageList", function () {
        console.log('pageList');
        //绑定滑动到底部
        var thisPage = $(this);
        var listCon = $(this).data('mylist-con');
        var listSrc = $(this).data('mylist-src');
        var listNode = $(this).find('.' + listCon).attr('id');

        //内容列表不足够一屏，无法滚动(判断可视窗口高度大于等于总文档高度 则说明不够一屏)
        if ($(window).height() >= $(document).height()) {
            $('.listLoadLabel').html('加载完成！');
        } else {
            $(document).scroll(function () {
                //判断到底
                if ($(document).scrollTop() >= $(document).height() - $(window).height()) {
                    $.when(getListData(listNode, listSrc)).done(function () {
                        // TODO 成功载入执行

                    }).fail(function () {
                        // TODO 若列表载入失败
                        showError('列表加载失败，请刷新后重试', 2000);
                    });

                }
            });
        }

    });

    //$(document).on('pagehide', '#pageList', function () {
    //    console.log('开始解绑');
    //    $(document).off('scroll');
    //});

//pageSearch事件
    $(document).on('pageshow', '#pageSearch', function () {
        console.log('pageSearch');
        var tempwrapId = $(this).find('[data-slideid="searchTab"]').attr('id');
        var tempWrap = $('#' + tempwrapId).children('.tempWrap');
        if (tempWrap.size() == 0) {
            TouchSlide({slideCell: "#" + tempwrapId, effect: "leftLoop"});
        }
    });

//userCenter 事件

//渲染方法
    $(document).on('pageshow', '#pageDesignerCenter', function () {
        console.log('pageDesignerCenter');

        //渲染列表
        var d = new $.Deferred(), thisPage = $(this);
        var caseCon = thisPage.data('mycase-con'), artCon = thisPage.data('myart-con'), disCon = thisPage.data('mydis-con'), actionCon;


        var listConId, listSrc;
        //TouchSlide配置
        var tempWrap1id = $(this).find('[data-slideid="userCenterDes"]').attr('id');
        var tempWrap2id = $(this).find('[data-slideid="userCenterTab"]').attr('id');
        console.log(tempWrap1id + ' | ' + tempWrap2id);

        var tempWrap1 = $('#' + tempWrap1id).children('.tempWrap');
        var tempWrap2 = $('#' + tempWrap2id).children('.tempWrap');
        console.log(tempWrap1.length + ' | ' + tempWrap2.length);
        if (tempWrap1.size() == 0) {
            TouchSlide({
                slideCell: "#" + tempWrap1id, endFun: function (i) { //高度自适应
                    var bd = document.getElementById($('#' + tempWrap1id).find('.bd').attr('id'));
                    bd.parentNode.style.height = bd.children[i].children[0].offsetHeight + "px";
                    if (i > 0)bd.parentNode.style.transition = "200ms";//添加动画效果
                }
            });
        }
        if (tempWrap2.size() == 0) {
            TouchSlide({
                slideCell: "#" + tempWrap2id, endFun: function (i) { //高度自适应
                    var bd = document.getElementById($('#' + tempWrap2id).find('.bd').attr('id'));
                    bd.parentNode.style.height = bd.children[i].children[0].offsetHeight + "px";
                    if (i > 0)bd.parentNode.style.transition = "200ms";//添加动画效果
                    if (i === 0) {
                        listConId = thisPage.find('.' + caseCon).attr('id');
                        listSrc = thisPage.data('mycase-src');
                    }
                    if (i === 1) {
                        listConId = thisPage.find('.' + artCon).attr('id');
                        listSrc = thisPage.data('myart-src');
                    }
                    if (i === 2) {
                        listConId = thisPage.find('.' + disCon).attr('id');
                        listSrc = thisPage.data('mydis-src');
                    }
                    console.log(listConId + ' | ' + listSrc);
                    actionCon = i;
                    d.resolve();
                }
            });
        }

        //绑定scroll事件
        d.then(function () {
            getNewList(actionCon, listConId, listSrc);
            $(document).scroll(function () {
                if ($(document).scrollTop() >= $(document).height() - $(window).height()) {
                    getNewList(actionCon, listConId, listSrc);
                }
            });
        });


        function getNewList(i, listConId, listSrc) {
            console.log(i + ' | ' + listConId + listSrc);

            $.when(getListData(listConId, listSrc)).done(function () {
                //自适应高度
                if (i === 0) {
                    setHeight(tempWrap2id, caseCon);
                    //img载入后会改变容器高度，每次载入img都重新setHeight
                    $('.' + caseCon).find('img').load(function () {
                        setHeight(tempWrap2id, caseCon);
                    });
                }
                if (i === 1) {
                    setHeight(tempWrap2id, artCon);
                }
                if (i === 2) {
                    setHeight(tempWrap2id, 'bd-discuss-con1');
                }
            }).fail(function () {
                console.log('列表加载失败');
            });

        }

    });

//工厂个人信息提交页面事件相应
    $(document).on('pageshow', '#pageFactoryInfo', function () {
        console.log('pageFactoryInfo');
        var thisPage = $(this), form = thisPage.find('#factoryInfoForm'), action = form.attr('action');
        //处理位置信息：
        //var getLo = getLocation(this);
        //getLo.done(function (data) {
        //
        //    var province = data.regeocode.addressComponent.province;
        //    var city = data.regeocode.addressComponent.city;
        //    var address = data.regeocode.formattedAddress;
        //
        //    thisPage.find('#factoryArea').val(province + ' ' + city);
        //    thisPage.find('#factoryAdd').val(address);
        //
        //}).fail(function (e) {
        //    console.log('外面的：' + e);
        //    thisPage.find('#factoryArea').val(e);
        //});


        //定义form提交方法
        function submitInfo() {
            var formdata = $(form).serialize();
            $.ajax({
                url: action,
                type: "POST",
                async: false,
                data: formdata,
                cache: false
            }).done(function (data) {
                data = $.parseJSON(data);
                console.log(data);
                //提交成功或错误均显示
                $.mobile.loading('hide');
                showError(data.message, 2000);
                var forward = data.forward || '/member/member-index.html';
                if (data.error == 0) {
                    //location.href = '/member/member-index.html';
                    $.mobile.changePage(forward, {transition: 'slide'});
                }

            }).fail(function (e) {
                $.mobile.loading('hide');
                console.log('表单提交错误：' + e.status);

            });

        }

        //upLoad插件异步加载依赖并初始化上传控件
        var uploadPic = myDiyUpload(thisPage, 'factorylogo', 'factoryLogoPath');

        //绑定事件
        $(form).on('submit', function (e) {
            e.preventDefault();
            $.mobile.loading('show');
            if (thisPage.find('.parentFileBox').length > 0) {

                thisPage.find(".diyStart").tap();

                uploadPic.done(function () {
                    submitInfo();
                });

            } else {
                //没图片，直接提交表单
                submitInfo();
            }

        });


    });

//工厂设备列表，带删除按钮的列表
    $(document).on('pagehide', '#pageUserFactoryMachine', function () {
        //解绑事件
        $(this).find('.my-list-del').off('tap');
        $(this).find('.fList-del-btn').off('tap');
        $(this).find('.offer-list-more').off('tap');
    });

    $(document).on('pageshow', '#pageUserFactoryMachine', function () {
        console.log('pageUserFactoryMachine');
        var thispage = $(this), delSw = $(this).find('.my-list-del');
        //初始化列表
        if (delSw.hasClass('active')) {
            delSw.removeClass('active');
        }
        thispage.find('.fList-del-btn').parent().css({marginRight: '-2.5em'});

        //每个页面的刷新
        var loadLabel = thispage.find('.listLoading .listLoadLabel');

        $(document).scroll(function () {
            if ($(document).scrollTop() >= $(document).height() - $(window).height()) {
                console.log('滑动底部');
                getlist();
            }
        });

        var listCon = thispage.data('mylist-con');
        var listSrc = thispage.data('mylist-src');
        var listNode = thispage.find('.' + listCon).attr('id');
        //getlist
        function getlist() {
            $.when(getListData(listNode, listSrc)).done(function () {
                //渲染成功
                console.log('渲染成功');

            }).fail(function () {
                //渲染失败
                loadLabel.html('刷新失败');
                showError('加载失败，请刷新重试', 2000);
            });
        }


        //处理显示隐藏删除按钮
        delSw.off('tap').on('tap', function () {
            if (delSw.hasClass('active')) {
                delSw.removeClass('active');
                thispage.find('.fList-del-btn').parent().animate({marginRight: '-2.5em'});
            } else {
                delSw.addClass('active');
                thispage.find('.fList-del-btn').parent().animate({marginRight: 0}, 100);
            }
        });
        //绑定删除事件
        thispage.find('.fList-del-btn').on('tap', function (e) {
            e.preventDefault();
            var delUrl = $(this).attr('href'), theNode = $(this).parent();
            //执行删除事件
            $.get(delUrl).done(function (data) {
                try {
                    data = $.parseJSON(data);
                } catch (e) {
                    console.log('解析错误');
                    showError('未知错误，刷新重试', 1000);
                }
                if (data.error == 0) {
                    //移除元素
                    theNode.remove();
                }
                //显示消息
                showError(data.message, 1000);
            }).fail(function () {
                showError('操作错误', 1000);
            });
        });
        //绑定动态加载
        //异步处理点击更多按钮
        //$(this).find('.offer-list-more').on('tap', function () {
        //    var listBtn = $(this), listC = $(this).parent(), listUrl = listC.data('offerlist-url');
        //
        //    //显示loading 动画
        //    $.mobile.loading('show');
        //
        //    //开始获取数据
        //    $.get(listUrl).done(function (data) {
        //        listC.append(data); //先追加新获取列表
        //        listBtn.appendTo(listC); //再将按钮移到底部
        //        listC.listview('refresh');  //刷新列表
        //        //初始化列表删除按钮
        //        if (!delSw.hasClass('active')) {
        //            thispage.find('.fList-del-btn').parent().css({marginRight: '-2.5em'});
        //        }
        //
        //        //设置图标
        //        var setIcon = listBtn.find('span').hasClass('icon-more');
        //        if (!setIcon) {
        //            listBtn.find('span').removeClass('icon-refresh').addClass('icon-more').empty();
        //        }
        //        //结束loading动画
        //        $.mobile.loading('hide');
        //    }).fail(function (e) {
        //        console.log(e);
        //        //结束loading动画
        //        $.mobile.loading('hide');
        //        showError('列表加载失败,请刷新重试', 3000);
        //        listBtn.find('span').removeClass('icon-more').addClass('icon-refresh').html('加载失败，刷新重试');
        //    });
        //});

    });

//工厂文档列表 带管理菜单的列表页
    $(document).on('pageshow', '#pageUserFactoryManageBtn', function () {
        console.log('pageUserFactoryManageBtn');
        var thispage = $(this), delSw = $(this).find('.my-list-del');

        //每个页面的刷新
        var loadLabel = thispage.find('.listLoading .listLoadLabel');

        $(document).scroll(function () {
            if ($(document).scrollTop() >= $(document).height() - $(window).height()) {
                console.log('滑动底部');
                getlist();
            }
        });

        var listCon = thispage.data('mylist-con');
        var listSrc = thispage.data('mylist-src');
        var listNode = thispage.find('.' + listCon).attr('id');
        //getlist
        function getlist() {
            $.when(getListData(listNode, listSrc)).done(function () {
                //渲染成功
                console.log('渲染成功');
                onSwipeLeft();
            }).fail(function () {
                //渲染失败
                loadLabel.html('刷新失败');
                showError('加载失败，请刷新重试', 2000);
            });
        }

        //初始化列表事件
        onSwipeLeft();
        //处理显示隐藏修改删除总按钮
        delSw.off('tap').on('tap', function () {
            console.log('tap');
            if (delSw.hasClass('active')) {
                delSw.removeClass('active');
                //noinspection JSValidateTypes
                thispage.find('.fList-manageBtn').parent().animate({left: 0}, 100);
            } else {
                delSw.addClass('active');
                //noinspection JSValidateTypes
                thispage.find('.fList-manageBtn').parent().animate({left: '-100px'}, 100);
            }
        });
        //处理侧滑显示单列编辑菜单
        function onSwipeLeft() {
            //noinspection JSValidateTypes
            thispage.find('.fList-manageBtn').parent().on({
                'swipeleft': function () {
                    $(this).animate({left: '-100px'}, 100);
                },
                'swiperight': function () {
                    if (delSw.hasClass('active')) {
                        //noinspection JSValidateTypes
                        thispage.find('.fList-manageBtn').parent().animate({left: 0}, 100);
                        delSw.removeClass('active');
                    } else {
                        $(this).animate({left: 0}, 100);
                    }
                }
            });
        }

        //绑定删除事件
        thispage.find('.fList-manage-btn.del').on('tap', function (e) {
            e.preventDefault();
            var delUrl = $(this).attr('href'), theNode = $(this).parent();
            //执行删除事件
            $.get(delUrl).done(function (data) {
                try {
                    data = $.parseJSON(data);
                } catch (e) {
                    console.log('解析错误');
                    showError('未知错误，刷新重试', 1000);
                }
                if (data.error == 0) {
                    //移除元素
                    theNode.remove();
                }
                //显示消息
                showError(data.message, 1000);
            }).fail(function () {
                showError('操作错误', 1000);
            });
        });
        //处理设为封面功能
        thispage.find('[data-mypiclist="true"]').on('tap', function (e) {
            e.preventDefault();
            var that = $(this);
            var setUrl = $(this).attr('href');
            $.mobile.loading('show');
            $.get(setUrl).done(function (data) {
                data = $.parseJSON(data);
                showError(data.message, 1000);
                if (data.error == 0) {
                    //成功处理
                    that.find('span').html('已设');
                    //处理其他“已设”标签为“封面”
                    that.parent().parent().siblings().find('[data-mypiclist="true"]').find('span').html('封面');
                }
            }).fail(function () {
                console.log('设封面，异步处理错误');
            });
        });

        //异步处理点击更多按钮
        //$(this).find('.offer-list-more').on('tap', function () {
        //    var listBtn = $(this), listC = $(this).parent(), page = listC.data('pageNum');
        //    if (typeof(page) == 'undefined' || page <= 1) {
        //        page = 2;
        //    } else {
        //        page = page + 1;
        //    }
        //    var listUrl = listC.data('offerlist-url') + '?page=' + page;
        //    //设置dom标记
        //    listC.data('pageNum', page);
        //    //显示loading 动画
        //    $.mobile.loading('show');
        //
        //    //开始获取数据
        //    $.get(listUrl).done(function (data) {
        //
        //        console.log(data);
        //
        //        if (data.replace(/^\s\s*/, '').replace(/\s\s*$/, '').length == 0) {
        //            var loadLabel = $('.offer-list-moreBtn');
        //            loadLabel.html('');
        //            showError('没有更多内容了', 2000);
        //
        //        } else {
        //            listC.append(data); //先追加新获取列表
        //            listBtn.appendTo(listC); //再将按钮移到底部
        //            listC.listview('refresh');  //刷新列表
        //            //初始化新增列表绑定的滑动事件
        //            onSwipeLeft();
        //
        //            //设置图标
        //            var setIcon = listBtn.find('span').hasClass('icon-more');
        //            if (!setIcon) {
        //                listBtn.find('span').removeClass('icon-refresh').addClass('icon-more').empty();
        //            }
        //            //结束loading动画
        //            $.mobile.loading('hide');
        //        }
        //
        //
        //    }).fail(function (e) {
        //        console.log(e);
        //        //结束loading动画
        //        $.mobile.loading('hide');
        //        showError('列表加载失败,请刷新重试', 3000);
        //        listBtn.find('span').removeClass('icon-more').addClass('icon-refresh').html('加载失败，刷新重试');
        //    });
        //});
    });
//展商订单列表
    $(document).on('pageshow', '#pageUserOrderList', function () {
        console.log('pageUserOrderList');
    });
//广告引导页
    $(document).on('pageshow', '#pageAd', function () {
        console.log('pageAd');

        //主内容 划屏
        //var tempWrapId = $(this).find('[data-slideid="mainConAd"]').attr('id');
        ////控制元素充满屏幕
        //$('#' + tempWrapId + ' .mainConAd-inner').css('height', $(document).height());
        ////初始化
        //var tempWrap = $('#' + tempWrapId).children('.tempWrap');
        //if (tempWrap.size() == 0) {
        //    TouchSlide({
        //        slideCell: "#" + tempWrapId,
        //        titCell: ".hd ul", //开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
        //        mainCell: ".bd ul",
        //        effect: "left",
        //        autoPlay: false,//自动播放
        //        autoPage: true, //自动分页
        //        switchLoad: "_src" //切换加载，真实图片路径为"_src"
        //    });
        //}
        function fixPagesHeight() {
            $('.swiper-slide,.swiper-container').css({
                height: $(window).height()
            })
        }

        $(window).on('resize', function () {
            fixPagesHeight();
        });
        fixPagesHeight();

        var swiperDesignerId = $(this).find('[data-myswiper="true"]').attr('id');
        var swiperDesigner = new Swiper('#' + swiperDesignerId, {
            initialSlide: 0,
            pagination: '.designerNum',
            paginationType: 'fraction',
            direction: 'vertical',
            effect: 'slide',
            parallax: true,
            longSwipesRatio: 0.1,
            //watchSlidesProgress: true,
            //onInit: function (swiper) {
            //    swiper.myactive = 0;
            //
            //},
            //onProgress: function (swiper) {
            //    for (var i = 0; i < swiper.slides.length; i++) {
            //        var slide = swiper.slides[i];
            //        var progress = slide.progress;
            //        var translate, es;
            //
            //        translate = progress * swiper.height * 0.8;
            //        var scale = 1 - Math.min(Math.abs(progress * 0.2), 1);
            //        var boxShadowOpacity = 0;
            //
            //        slide.style.boxShadow = '0px 0px 10px rgba(0,0,0,' + boxShadowOpacity + ')';
            //
            //        if (i == swiper.myactive) {
            //            es = slide.style;
            //            es.webkitTransform = es.MsTransform = es.msTransform = es.MozTransform = es.OTransform = es.transform = 'translate3d(0,' + (translate) + 'px,0) scale(' + scale + ')';
            //            es.zIndex = 0;
            //
            //
            //        } else {
            //            es = slide.style;
            //            es.webkitTransform = es.MsTransform = es.msTransform = es.MozTransform = es.OTransform = es.transform = '';
            //            es.zIndex = 1;
            //
            //        }
            //
            //    }
            //
            //},
            //
            //
            //onTransitionEnd: function (swiper, speed) {
            //    var es;
            //    for (var i = 0; i < swiper.slides.length; i++) {
            //        es = swiper.slides[i].style;
            //        es.webkitTransform = es.MsTransform = es.msTransform = es.MozTransform = es.OTransform = es.transform = '';
            //
            //        swiper.slides[i].style.zIndex = Math.abs(swiper.slides[i].progress);
            //
            //
            //    }
            //
            //    swiper.myactive = swiper.activeIndex;
            //
            //},
            //onSetTransition: function (swiper, speed) {
            //    var es;
            //    for (var i = 0; i < swiper.slides.length; i++) {
            //        //if (i == swiper.myactive) {
            //
            //        es = swiper.slides[i].style;
            //        es.webkitTransitionDuration = es.MsTransitionDuration = es.msTransitionDuration = es.MozTransitionDuration = es.OTransitionDuration = es.transitionDuration = speed + 'ms';
            //        //}
            //    }
            //
            //}

        });

    });
//带图片幻灯的文章详情页
    $(document).on('pageshow', '#pageArticleGallery', function () {
        console.log('pageArticleGallery');
        var thisPage = $(this);
        console.log(thisPage.find('.mainWrapper'));

        //调用点赞
        setSupport(this);
    });
    $(document).on('pageshow', '#pageOfferInput', function () {
        console.log('pageOfferInput');
        //定义基本方法
        var custom = $('.offerinput-custom-con'), customId = custom.data('customId') || 0, sumItems = $('.sumItem'), contC = $('.total .sumCont'), formId = 'offerInputForm';
        //添加项目方法
        function offerInputAdd(cls, customId) {
            var content = '', priceName = 'baojia[customprice][' + customId + ']', xiangmuName = 'baojia[customxiangmu][' + customId + ']';
            console.log(customId);
            content = content + '<div class=\"ui-grid-a OfferInput-item\"><div class=\"ui-block-a\"><input type=\"text\" name=\"' + xiangmuName + '\" placeholder=\"项目名称\"></div><div class=\"ui-block-b\"><input class=\"sumItem\" type=\"text\" name=\"' + priceName + '\" placeholder=\"0\"><div class=\"offerInput-item-cancel\">删除</div></div></div>';

            $('.' + cls).append(content).trigger("create");

        }

//删除项目方法
        function offerInputDel(e) {
            var d = new $.Deferred();

            $(e.target).parent().parent().addClass('offerHidden').animate({
                opacity: 0, background: '#000'
            }, 800, function () {
                $(this).remove();
                d.resolve();
            });
            return d.promise();
        }

//计算
        function offerSum(sumItems, contC) {
            var cont = 0;
            for (var i = 0; i < sumItems.length; i++) {

                var itemText = $(sumItems[i]).val();
                //校验是否为数字
                if (!isNaN(itemText) && itemText != '') {
                    var itemValue = parseFloat(itemText);
                    cont = cont + itemValue;
                }
            }
            contC.val(cont);
        }

//验证输入
        function checkValue(obj) {
            var theValue = $(obj).val();
            if (isNaN(theValue)) {
                $(obj).val('').attr('placeholder', '请输入数字');
            }
            if (theValue == '') {
                $(obj).attr('placeholder', '请填写报价');
            }
        }

        //开始绑定各类事件
        //绑定添加事件
        $('.offerInput-custom-add').on('tap', function () {
            offerInputAdd('offerinput-custom-con', customId);
            //绑定检测事件
            sumItems = $('.sumItem');
            sumItems.on('change', function () {
                checkValue(this);
                offerSum(sumItems, contC);
            });
            //绑定计算事件
            sumItems.on('input', function () {
                offerSum(sumItems, contC);
            });
            //添加完成后
            customId++;
            custom.data('customId', customId);
        });
        //委托删除事件到外层容器
        custom.on('tap', '.offerInput-item-cancel', function (e) {
            //调用删除方法
            var inputDel = offerInputDel(e);
            inputDel.done(function () {
                //重新计算
                sumItems = $('.sumItem');
                offerSum(sumItems, contC);
            });

        });
        //绑定编辑默认项目名称事件
        $('.readonly').on('tap', function () {
            $(this).removeClass('readonly').find('input').prop('readonly', false);
        });
        //绑定计算事件
        sumItems.on('input', function () {
            offerSum(sumItems, contC);
        });
        //绑定检测事件
        sumItems.on('change', function () {
            checkValue(this);
            offerSum(sumItems, contC);
        });
        //绑定提交事件
        $('#offerInput-btn').on('tap', function () {
            //显示加载器
            $.mobile.loading('show');
            //开始异步提交
            var data = $('#' + formId).serialize(), url = document.getElementById(formId).action;
            $.ajax({
                type: 'post',
                url: url,
                data: data
            }).done(function (data) {
                data = $.parseJSON(data);
                var forward = data.forward;
                if (data.error === 0) {
                    //成功报价
                    showError(data.message, 1000);
                    if (typeof forward !== "undefined") {
                        $.mobile.changePage(forward, {transition: 'slide'});
                    }
                } else {
                    showError(data.message, 1000);
                }
            });
        });


    });

//pageHammer相册页面，可手势缩放
    $(document).on('pageshow', '#pageHammer', function () {
        console.log('pageHammer');
        var width, height, left = 1, top = 1, marginL, marginT, deviceWidth = $(document).width();
        //swiper
        var swiperId = $('[data-conswiper="true"]').attr('id');
        var swiper = new Swiper('#' + swiperId, {
            pagination: '.hammerNum',
            paginationType: 'fraction',
            onTap: function () {
                var hammerFoot = $('.hammerFooter');
                if (hammerFoot.hasClass('hammerHidden')) {
                    hammerFoot.stop(true, true).slideDown(200).removeClass('hammerHidden');
                } else {
                    hammerFoot.stop(true, true).slideUp(200).addClass('hammerHidden');
                }
            }
        });

        $(window).on('resize', function () {
            swiper.update();
        });

        /**
         * getScript方法获取hammer
         */
        var myElements = document.getElementsByClassName('hammerGallery'), slides = document.getElementsByClassName('swiper-slide');
        console.log(myElements);
        console.log(slides);

        //设置slide宽度
        //slide.width(slideItems.length * deviceWidth);
        //slideItems.width(deviceWidth);

        $.getScript('/js/hammer.min.js').then(function () {
            //绑定图片放大
            $(myElements).each(function () {
                setHammer(this);
            });

        });


        //设置图片放大缩小事件
        function setHammer(myElement) {
            var mc = new Hammer(myElement, {domEvents: true});
            var pinchImg = $(myElement).find('img');

            pinchImg.load(function () {
                console.log('图片载入');
                width = pinchImg.width();
                height = pinchImg.height();
                console.log(width + " | " + height);
            });


            mc.get('pinch').set({enable: true});

            mc.on("pinchstart", function () {
                width = pinchImg.width();
                height = pinchImg.height();
                //锁住swiper
                swiper.lockSwipes();
            });
            mc.on("pinch", function (e) {
                console.log("pinch");
                console.log(e);
                if (e.scale < 3) {
                    pinchImg.css({
                        width: width * e.scale,
                        "margin-left": -left * e.scale,
                        'transform': '',
                        height: height * e.scale,
                        "margin-top": -top * e.scale
                    });
                }
            });
            mc.on("pinchend", function (e) {
                width = pinchImg.width();
                height = pinchImg.height();
                //$($('.log p')[1]).html("图片宽：" + width + " | " + height);
                if (e.scale < 1) {
                    pinchImg.css({width: '100%', height: 'auto', 'margin-left': '0', 'margin-top': '0'});
                    //解锁swiper
                    swiper.unlockSwipes();
                    //解绑pan三个事件
                    mc.off('panstart pan panend');
                } else {
                    //绑定pan事件
                    mc.on("panstart", function (e) {
                        marginL = parseInt(pinchImg.css("margin-left"), 10);
                        marginT = parseInt(pinchImg.css("margin-top"), 10);
                        //锁住swiper
                        swiper.lockSwipes();
                    });
                    mc.on("pan", function (e) {
                        console.log(e);
                        pinchImg.css({
                            //                "margin-left": margin + e.originalEvent.gesture.deltaX
                            "margin-left": marginL + e.deltaX,
                            "margin-top": marginT + e.deltaY
                        });
                        //$($('.log p')[0]).html('marginLeft:' + (marginL + e.deltaX) + ' | marginRight:' + (marginT + e.deltaY));
                    });
                    mc.on('panend', function (e) {
                        if ((marginL + e.deltaX) < 0 && Math.abs(marginL + e.deltaX) + deviceWidth - width > 0) {
                            if (deviceWidth / 2 > Math.abs(marginL + e.deltaX) + deviceWidth - width) {
                                //滑动到最右侧边界
                                pinchImg.css({"margin-left": (deviceWidth - width - 20)});
                            } else {
                                //解锁swiper
                                if (!swiper.isEnd) {
                                    pinchImg.css({
                                        width: '100%',
                                        height: 'auto',
                                        'margin-left': '0',
                                        'margin-top': '0'
                                    });
                                    //解绑pan事件
                                    mc.off('panstart pan panend');
                                    swiper.unlockSwipes();
                                    swiper.slideNext();
                                }
                            }

                            //$($('.log p')[4]).html('右边界:' + index);
                        }
                        if ((marginL + e.deltaX) > 20) {
                            if ((marginL + e.deltaX) < deviceWidth / 2) {
                                //滑动到最左侧边界
                                pinchImg.css({"margin-left": '20px'});
                            } else {
                                //解锁swiper
                                if (!swiper.isBeginning) {
                                    pinchImg.css({
                                        width: '100%',
                                        height: 'auto',
                                        'margin-left': '0',
                                        'margin-top': '0'
                                    });
                                    //解绑pan事件
                                    mc.off('panstart pan panend');
                                    swiper.unlockSwipes();
                                    swiper.slidePrev();
                                }
                            }

                            //$($('.log p')[4]).html('左边界:' + index);
                        }

                        //$($('.log p')[3]).html("mleft加设备宽：" + (Math.abs(marginL + e.deltaX) + deviceWidth) + ' | ' + width);
                    });
                }

            });
            //$($('.log p')[2]).html('设备宽度：' + deviceWidth);
        }
    });

//OEM引导页

    $(document).on('pageshow', '#pageoem', function () {
        console.log('pageoem');

        //oem用swiper
        var swiperOemId = $(this).find('[data-myswiper="true"]').attr('id');
        var swiperOem = new Swiper('#' + swiperOemId, {
            initialSlide: 0,
            pagination: '.oemNum',
            paginationType: 'fraction',
            effect: 'slide',
            parallax: true,
            longSwipesRatio: 0.1,
            onTransitionEnd: function () {
                oemAnimatateIn();
            }
        });


        //oem动画控制
        function oemAnimatateIn() {

            $('.swiper-slide-active').find('.ani').each(function () {
                $(this).addClass($(this).data('animate'));
                console.log($(this).data('animate'));
            });

            $('.swiper-slide').not('.swiper-slide-active').find('.ani').each(function () {
                $(this).removeClass($(this).data('animate'));
            });
        }

    });

    $(document).on('pageshow', '#pageReg', function () {
        var timer = '';
        var contime = 60;
        var thisPage = $(this), describe = thisPage.find('.describe');
        var timeCon = thisPage.find('#loginGetCode');
//倒计时

        function overtime() {
            contime--;
//        console.log(contime);
            timeCon.addClass('disabled').prop('disabled', true);
            if (contime == 1) {
                timeCon.html("重新获取").removeClass('disabled').removeAttr("disabled");
                clearTimeout(timer);
                contime = 60;
                return;
            }

            timeCon.html(contime + "秒后重新获取");
            setTimeout(overtime, 1000);

        }

        function cheakFormOnline(checkId) {
            //处理参数
//        console.log(checkId);
            var clientid = checkId, cheakdata = '', mobileVal = '', unameVal = '', mailVal = '';
            var mobile = document.getElementById('mobile');
            var uname = document.getElementById('uname');
            var mail = document.getElementById('mail');
            var d = new $.Deferred();

            if (mobile) {
                mobileVal = mobile.value;
            }
            if (uname) {
                unameVal = uname.value;
                //对中文进行转码，兼容老IE
                unameVal = encodeURIComponent(unameVal);
            }
            if (mail) {
                mailVal = mail.value;
            }

            cheakdata = '&clientid=' + clientid + '&ylz[mobile]=' + mobileVal + '&ylz[uname]=' + unameVal + '&ylz[mail]=' + mailVal;

            console.log(cheakdata);
            //var tipid = document.getElementById(tipId);
            $.ajax({
                url: "/user-check.html",
                type: "get",
                async: true,
                data: cheakdata,
                cache: false,
                success: function (data) {
                    console.log(data);
                    try {
                        var jsondata = $.parseJSON(data);
                    } catch (e) {
                        console.log(e);
                    }
                    //处理json
                    var message = jsondata.message; //信息
                    //显示错误信息
                    if (data.error !== 0) {
                        describe.html(message);
                    }
                    d.resolve();

                },
                error: function (e) {
                    describe.html('网络错误');
                    console.log('异步提交错误信息：' + e);
                    d.reject();
                }

            });

            return d.promise();
        }

        //定义手机验证码
        function getRegCode(mobiNum) {
            var d = new $.Deferred();
            var userdata;
            if (!mobiNum) {
                //处理参数
                var mobile = document.getElementById('mobile');
                if (mobile.value == '') {
                    showError('手机号不能为空', 1000);
                    mobile.focus();
                    return false;
                }
                userdata = 'ylz[mobile]=' + mobile.value;
            }else{
                userdata = 'ylz[mobile]=' + mobiNum;
            }


            $.ajax({
                url: "/user-mobile.html",
                type: "get",
                async: true,
                data: userdata,
                cache: false,
                success: function (data) {
                    //成功
                    d.resolve(data);
                },
                error: function (e) {
                    d.reject();
                    console.log('异步提交错误信息：' + e);
                }

            });

            return d.promise();
        }

        console.log('pageReg');
        var regBtnNext = $('.regBtnNext'), regNextUrl = regBtnNext.attr('href');
        //注册第二步
        var checkbox = thisPage.find('.regCheckbox'), mobile = thisPage.find('input#mobile'), regCode = thisPage.find('#regCode'), loginForm = thisPage.find('#loginForm');

        if (mobile.length !== 0) {
            console.log('mobile');
            $('.regCheck').on('tap', function () {
                console.log('tap');
                if (checkbox.hasClass('checked')) {
                    checkbox.removeClass('checked');
                } else {
                    checkbox.addClass('checked');
                }

            });
            mobile.on('change', function () {
                console.log('mobileChange');
                cheakFormOnline('mobile');
            });

            regBtnNext.off('tap').on('tap', function (e) {
                console.log('regBtnNext tap');
                e.preventDefault();
                if (typeof checkbox !== 'undefined' && checkbox.hasClass('checked') && mobile.val() !== '') {
                    console.log('checkboxChecked');
                    //在线验证手机号
                    if (cheakFormOnline('mobile')) {
                        //设置cookie
                        setCookies('mobile', mobile.val());
                        //获取手机验证码
                        getRegCode().done(function () {
                            //成功跳转页面
                            console.log('getregcode done');
                            $.mobile.changePage(regNextUrl, {transition: 'slide', reloadPage: true});
                        });
                    }
                }
                //错误处理
                if (!checkbox.hasClass('checked')) {
                    describe.html('请同意一路展《服务条款》');
                }
                if (mobile.val() === '') {
                    describe.html('输入电话号码');
                }

            });
        }

        //注册第三步
        if (regCode.length !== 0) {
            console.log('regCode on');
            var mobileNum = getCookies('mobile');
            describe.find('span').html(mobileNum);
            overtime();
            timeCon.on('tap', function () {
                console.log('timeCon');
                getRegCode(mobileNum).done(function () {
                    overtime();
                });
            });

            regBtnNext.off('tap').on('tap', function (e) {
                e.preventDefault();
                console.log('regBtnNext tap');
                var data = regCode.val();
                $.ajax({
                    url: '/12312',
                    type: 'post',
                    data: data
                }).done(function (data) {
                    try {
                        data = $.parseJSON(data);
                    } catch (e) {
                        console.log(e);
                    }
                    if (data.error === 0) {
                        $.mobile.changePage(regNextUrl, {transition: 'slide', reloadPage: true});
                    } else {
                        showError(data.message, 1000);
                    }

                }).fail(function () {
                    showError('网络错误', 1000);
                });
            });
        }
        //注册第四步
        if (loginForm.length !== 0) {
            console.log('loginForm');
            loginForm.find('#uname').change(function () {
                cheakFormOnline('uname');
            });

            loginForm.on('submit', function (e) {
                e.preventDefault();
                cheakFormOnline('uname').done(function () {
                    //显示加载框
                    $.mobile.loading('show');
                    var data = loginForm.serialize();
                    console.log(data);
                    $.ajax({
                        type: 'post',
                        url: loginForm.attr('action'),
                        data: data,
                        async: true
                    }).done(function (data) {
                        console.log('收到数据：' + data);
                        try {
                            data = $.parseJSON(data);
                        } catch (e) {
                            console.log('数据转换错误：' + e);
                        }
                        //解析json
                        var errorCode = data.error, message = data.message, appendjs = data.appendjs, forward = data.forward;
                        //隐藏加载框
                        $.mobile.loading('hide');
                        if (errorCode !== 0) {
                            showError(message, 2000);
                        } else {
                            thisPage.append(appendjs);
                            $.mobile.changePage(forward);
                        }
                    }).fail(function (e) {
                        console.log('ajax错误：' + e);
                    });

                });

            });
        }

    });

    //pageYqxAd 易企秀页面
    $(document).on('pagecreate', '#pageYqxAd', function () {
        console.log('pageYqxAd pagecreate');
        var thisPage = $(this), cssLink = '<link rel=\"stylesheet\" href=\"../css/yqx.css\"/>';
        $('head').append(cssLink);
        $.getScript('../js/yqx.js').done(function () {
            thisPage.yqx(thisPage);
            var madia = thisPage.find('#media')[0], audioBtn = thisPage.find('#audioBtn');
            audioBtn.on('tap', function () {
                if (audioBtn.hasClass('rotate')) {
                    madia.pause();
                    audioBtn.removeClass('rotate');
                } else {
                    madia.play();
                    audioBtn.addClass('rotate');
                }

            });

        });
    });

})($, window, document);