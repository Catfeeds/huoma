layui.config({
    version: true
}).use('mobile', function () {
    var mobile = layui.mobile
        , layim = mobile.layim
        , layer = mobile.layer;

    //演示自动回复
    var autoReplay = [
        '您好，我现在有事不在，一会再和您联系。',
        '你没发错吧？face[微笑] ',
        '洗澡中，请勿打扰，偷窥请购票，个体四十，团体八折，订票电话：一般人我不告诉他！face[哈哈] ',
        '你好，我是主人的美女秘书，有什么事就跟我说吧，等他回来我会转告他的。face[心] face[心] face[心] ',
        'face[威武] face[威武] face[威武] face[威武] ',
        '<（@￣︶￣@）>',
        '你要和我说话？你真的要和我说话？你确定自己想说吗？你一定非说不可吗？那你说吧，这是自动回复。',
        'face[黑线]  你慢慢说，别急……',
        '(*^__^*) face[嘻嘻] ，是贤心吗？'
    ];

    $.ajax({
        url:root_path + '/index/getlist.html',
        success:function(data){
            if(data .code == 0){
                layim.config({

                    //上传图片接口
                    uploadImage: {
                        url: root_path + '/upload/uploadImg' //（返回的数据格式见下文）
                        , type: '' //默认post
                    }

                    //上传文件接口
                    , uploadFile: {
                        url: root_path + '/upload/uploadFile' //（返回的数据格式见下文）
                        , type: '' //默认post
                    }

                    //,brief: true

                    , init: data.data

                    //扩展聊天面板工具栏
                    , tool: [{
                        alias: 'code'
                        , title: '代码'
                        , iconUnicode: '&#xe64e;'
                    }]

                    //扩展更多列表
                    , moreList: [
                        {
                            alias: 'find'
                            , title: '发现'
                            , iconUnicode: '&#xe628;' //图标字体的unicode，可不填
                            , iconClass: '' //图标字体的class类名
                        },
                        {
                            alias: 'share'
                            , title: '分享与邀请'
                            , iconUnicode: '&#xe641;' //图标字体的unicode，可不填
                            , iconClass: '' //图标字体的class类名
                        }
                    ]

                    //,tabIndex: 1 //用户设定初始打开的Tab项下标
                    ,isNewFriend: false //是否开启“新的朋友”
                    , isgroup: true //是否开启“群聊”
                    ,chatTitleColor: '#fe552e' //顶部Bar颜色
                    ,title: '我的聊天' //应用名，默认：我的IM
                });
            }
        }
    });


    //创建一个会话
    /*
     layim.chat({
     id: 111111
     ,name: '许闲心'
     ,type: 'kefu' //friend、group等字符，如果是group，则创建的是群聊
     ,avatar: 'http://tp1.sinaimg.cn/1571889140/180/40030060651/1'
     });
     */


    //监听点击“新的朋友”
    layim.on('newFriend', function () {
        layim.panel({
            title: '新的朋友' //标题
            , tpl: '<div style="padding: 10px;">自定义模版，{{d.data.test}}</div>' //模版
            , data: { //数据
                test: ''
            }
        });
    });

    //查看聊天信息
    layim.on('detail', function (data) {
        //console.log(data); //获取当前会话对象
        layim.panel({
            title: data.name + ' 聊天信息' //标题
            ,
            tpl: '<div style="padding: 10px;">自定义模版，<a href="http://www.layui.com/doc/modules/layim_mobile.html#ondetail" target="_blank">参考文档</a></div>' //模版
            ,
            data: { //数据
                test: ''
            }
        });
    });

    //监听点击更多列表
    layim.on('moreList', function (obj) {
        switch (obj.alias) {
            case 'find':
                layer.msg('自定义发现动作');

                //模拟标记“发现新动态”为已读
                layim.showNew('More', false);
                layim.showNew('find', false);
                break;
            case 'share':
                layim.panel({
                    title: '邀请好友' //标题
                    , tpl: '<div style="padding: 10px;">自定义模版，{{d.data.test}}</div>' //模版
                    , data: { //数据
                        test: ''
                    }
                });
                break;
        }
    });

    //监听返回
    layim.on('back', function () {
        //如果你只是弹出一个会话界面（不显示主面板），那么可通过监听返回，跳转到上一页面，如：history.back();
    });

    //监听自定义工具栏点击，以添加代码为例
    layim.on('tool(code)', function (insert, send) {
        insert('[pre class=layui-code]123[/pre]'); //将内容插入到编辑器
        send();
    });

    //监听发送消息
    layim.on('sendMessage', function (data) {
        var To = data.to;
        //console.log(data);

        //演示自动回复
        setTimeout(function () {
            var obj = {};
            if (To.type === 'group') {
                obj = {
                    username: '模拟群员' + (Math.random() * 100 | 0)
                    , avatar: layui.cache.dir + 'images/face/' + (Math.random() * 72 | 0) + '.gif'
                    , id: To.id
                    , type: 'group'
                    , content: autoReplay[Math.random() * 9 | 0]
                }
            } else {
                obj = {
                    username: To.name
                    , avatar: To.avatar
                    , id: To.id
                    , type: To.type
                    , content: autoReplay[Math.random() * 9 | 0]
                }
            }
            layim.getMessage(obj);
        }, 3000);
    });

    //模拟收到一条好友消息
    setTimeout(function () {
        layim.getMessage({
            username: "贤心"
            , avatar: "http://tp1.sinaimg.cn/1571889140/180/40030060651/1"
            , id: "100001"
            , type: "friend"
            , cid: Math.random() * 100000 | 0 //模拟消息id，会赋值在li的data-cid上，以便完成一些消息的操作（如撤回），可不填
            , content: "嗨，欢迎体验LayIM。演示标记：" + new Date().getTime()
        });
    }, 3000);

    //监听查看更多记录
    layim.on('chatlog', function (data, ul) {
        console.log(data);
        layim.panel({
            title: '与 ' + data.name + ' 的聊天记录' //标题
            , tpl: '<div style="padding: 10px;">这里是模版，{{d.data.test}}</div>' //模版
            , data: { //数据
                test: 'Hello'
            }
        });
    });

    //模拟"更多"有新动态
    layim.showNew('More', true);
    layim.showNew('find', true);



    //建立WebSocket通讯
    var socket = new WebSocket('ws://127.0.0.1:7272');

    //连接成功时触发
    socket.onopen = function () {
        // 登录
        var login_data = '{"type":"init","uid":"{$uinfo.id}","username":"{$uinfo.username}","avatar":"{$uinfo.avatar}","sign":"{$uinfo.sign}"}';
        socket.send(login_data);
        //console.log( login_data );
        console.log("websocket握手成功!");
    };

    //监听收到的消息
    socket.onmessage = function (res) {
        //console.log(res.data);
        var data = eval("(" + res.data + ")");
        switch (data['message_type']) {
            // 服务端ping客户端
            case 'ping':
                socket.send('{"type":"ping"}');
                break;
            // 登录 更新用户列表
            case 'init':
                //console.log(data['id']+"登录成功");
                //layim.getMessage(res.data); //res.data即你发送消息传递的数据（阅读：监听发送的消息）
                break;
            //添加 用户
            case 'addUser':
                //console.log(data.data);
                layim.addList(data.data);
                break;
            //删除 用户
            case 'delUser':
                layim.removeList({
                    type: 'friend'
                    , id: data.data.id //好友或者群组ID
                });
                break;
            // 添加 分组信息
            case 'addGroup':
                // console.log(data.data);
                layim.addList(data.data);
                break;
            case 'delGroup':
                layim.removeList({
                    type: 'group'
                    , id: data.data.id //好友或者群组ID
                });
                break;
            // 检测聊天数据
            case 'chatMessage':
                //console.log(data.data);
                layim.getMessage(data.data);
                break;
            // 离线消息推送
            case 'logMessage':
                setTimeout(function () {
                    layim.getMessage(data.data)
                }, 1000);
                break;
            // 用户退出 更新用户列表
            case 'logout':
                break;
            //聊天还有不在线
            case 'ctUserOutline':
                console.log('11111');
                //layer.msg('好友不在线', {'time' : 1000});
                break;

        }
    };
});