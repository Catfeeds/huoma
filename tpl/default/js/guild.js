/**
 * Created by Feng on 2016/4/28.
 */

$(function () {
    setGuild();
});


function setGuild() {

    var repetFlag = false;
    var loadimgFlag = true;
    //元素
    var guildBgP = $('#guildBgP'), guildPerson = $('.guild-person'), loading = $('.guild-load');
    var $adGuildOut = $('.adGuildOut');
    var $adGuildSm = $('.adGuildSm');


    //载入loading
    //guildBgP.find('img').load(loadImg);
    //setTimeout(loadImg, 500);
    //消息区
    var messageA = $('#messageArea');
    guildBgP.on('guildStop', personOut);

    function loadImg() {
        if (loadimgFlag) {
            loading.animate(
                {opacity: 0},
                {
                    duration: 1000,
                    easing: 'linear',
                    complete: initAni
                }
            );
        }

        loadimgFlag = false;

    }


    //初始载入 小人走入画面
    function initAni() {
        //guildPerson.addClass('guild-start').animate(
        //    {left: '500px'},
        //    {
        //        duration: 2000,
        //        easing: 'linear',
        //        complete: step1
        //    }
        //);
        guildPerson.css({left: '500px'});
        setTimeout(function () {
            step1();
            guildPerson.addClass('guild-start');
        }, 300);
    }

    //显示消息框
    function showMessage() {
        messageA.animate(
            {top: '130px'},
            {
                duration: 500,
                easing: 'easeOutBounce'
            }
        );
    }

    //隐藏消息框
    function hideMessage() {
        messageA.animate(
            {top: '-300px'},
            {
                duration: 500,
                easing: 'easeOutBounce'
            }
        );
    }

    //小人走出可视区
    function personOut() {
        //guildPerson.animate(
        //    {left: '1300px'},
        //    {
        //        duration: 6000,
        //        easing: 'linear',
        //        complete: hideMessage
        //    }
        //);
        guildPerson.removeClass('guild-start');
        guildBgP.css({left: 0});
        repetFlag = true;
        //收起
        setTimeout(guildMain.hide, 500);

    }


    //进入flow
    function step1() {
        //继续走动
        var moveBgA = moveBg();
        moveBgA.startMove();
        //信息框
        showMessage();
        //停止小人摆动

        //messageA.find('h2').text('');
        showWord(['简单三步，轻松搞定展台搭建']);
        //展开消息区
        messageA.show(500);

        guildBgP.off('guildMove').on('guildMove', function (e, leftL) {
            switch (leftL) {
                case -200:
                    messageA.find('h2').text('第一步：提交需求');
                    messageA.find('.message-area').empty();
                    break;
                case -500:
                    //停止走动
                    moveBgA.stopMove();
                    messageA.find('h2').text('');
                    showWord(['专属执行经理与您对接', '提供一站式服务！'])
                        .then(function () {
                            moveBgA.startMove();
                        });
                    break;
                case -936:
                    messageA.find('h2').text('平台精准匹配设计师');
                    messageA.find('.message-area').empty();
                    break;
                case -1136:
                    messageA.find('h2').text('');
                    showWord(['全网专业大咖设为您提供服务','多名设计师同时定制出稿']);
                    break;
                case -1748:
                    messageA.find('h2').text('平台匹配多家工厂报价');
                    messageA.find('.message-area').empty();
                    break;
                case -1948:
                    messageA.find('h2').text('');
                    showWord(['严格工厂能力考核','工程组委会价格评估','比传统报价低25-50%']);
                    break;
                case -2500:
                    messageA.find('h2').text('第二步：确认定稿');
                    messageA.find('.message-area').empty();
                    break;
                case -2700:
                    //停止走动
                    moveBgA.stopMove();
                    messageA.find('h2').text('');
                    showWord(['带价选稿，多维度考评', '自主挑选 设计稿、工厂'])
                        .then(function () {
                            moveBgA.startMove();
                        });
                    break;
                case -3000:
                    messageA.find('h2').text('平台保障');
                    messageA.find('.message-area').empty();
                    break;
                case -3200:
                    messageA.find('h2').text('');
                    showWord(['专业监理严格把控搭建质量', '搭建进度实时查看，全程透明可监控', '资金保障，多重保险安心放心']);
                    break;
                case -4600:
                    messageA.find('h2').text('第三步：成功参展');
                    messageA.find('.message-area').empty();
                    break;
                case -4800:
                    //停止走动
                    moveBgA.stopMove();
                    messageA.find('h2').text('');
                    showWord(['省心、省钱、省力'])
                        .then(function () {
                            moveBgA.startMove();
                        });
                    break;
                case -5200:
                    messageA.find('h2').text('参展结束');
                    messageA.find('.message-area').empty();
                    break;
                case -5400:
                    messageA.find('h2').text('');
                    showWord(['快速撤展，无需展商操心']);
                    break;
                case -6000:
                    messageA.find('h2').text('期待与您一路同行！');
                    showWord([' ']);
                    break;
            }

        });


    }

    //打字机效果
    function showWord(words) {

        console.log(words);
        var d = $.Deferred();
        var arrLength = words.length;
        var con = messageA.find('.message-area');
        var i = 0;

        //清空容器
        con.empty();
        //显示方法
        function showW(word) {
            var dd = $.Deferred();
            var index = 0, timer;

            console.log(word.length);

            timer = setInterval(function () {

                if (index < word.length) {
                    con.append(word.charAt(index));
                    index++;
                } else {
                    clearInterval(timer);
                    index = 0;
                    dd.resolve();
                }

            }, 50);

            return dd.promise();

        }


        //循环words
        loopWords();
        function loopWords() {

            showW(words[i]).then(function () {

                if (i < arrLength - 1) {
                    con.append('<br/>');
                    i++;
                    loopWords();
                } else {
                    d.resolve();
                }

            });
        }

        return d.promise();
    }


    //幕布移动方法
    function moveBg() {
        var leftL = 0, timer, flag = true;

        function move() {
            leftL--;
            guildBgP.css('left', leftL);
            guildBgP.trigger('guildMove', [leftL]);
            if (leftL < -6102) {
                //停止小人走路
                //guildPerson.removeClass('guild-start');
                //清除定时器
                clearInterval(timer);
                //TODO 隐藏消息框
                //messageA.hide(300);
                //派发停止事件
                guildBgP.trigger('guildStop', [leftL]);
            }
        }

        timer = setInterval(function () {
            if (flag)move();
        }, 10);

        function startMove() {
            flag = true;
            guildPerson.addClass('guild-start');
        }

        function stopMove() {
            flag = false;
            guildPerson.removeClass('guild-start');
            //clearInterval(timer);
        }

        return {
            startMove: startMove,
            stopMove: stopMove
        }

    }

    //弹出隐藏整个框架
    var guildMain = {
        init: function () {
            //初始化


            //绑定关闭事件
            $adGuildOut.find('.guild-close').on('click', guildMain.hide);
            //重播事件
            $adGuildSm.on('click', guildClose.hide);
        },
        show: function () {
            //显示
            $adGuildOut.animate({top: 0, opacity: 1}, 500, loadImg);

        },
        hide: function () {
            //隐藏
            $adGuildOut.animate({top: '-200%', opacity: 0}, 500, guildClose.show);
        }
    };

    var guildClose = {
        show: function () {
            //显示
            //$adGuildSm.animate({left: 0}, 500);
        },
        hide: function () {
            if (repetFlag) {
                loadimgFlag = true;
            }
            //隐藏
            //$adGuildSm.animate({left: '-150px'}, 500, guildMain.show);
            guildMain.show();
        }
    };

    setTimeout(guildMain.init, 0);


}