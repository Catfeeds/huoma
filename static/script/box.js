//弹出层提示
//title提示信息 url 返回网址。为空时则刷新 ty 图标显示
function alertmsg(title, url, ty) {
    try{
        var index = parent.layer.getFrameIndex(window.name);
    }
    catch(err){}

    if (typeof (ty) == 'undefined') {
        ty = 1;
    }
    title=title.replace(/\[/g,"<");
    title=title.replace(/\]/g,">");
    $.layer({

        closeBtn: [0, true],
        title: '信息提示',
        dialog: {
            type: ty,
            msg: title
        },
        end: function() { //层彻底关闭后执行的回调
            if (typeof (url) == 'undefined' || url == 0) {

            }
            else if (url == 1) {
                location.reload();
            }
            else if (url == 2) {
                top.location.reload();
            }
            else if (url == 3) {
                parent.layer.close(index);
            }
            else if(url==4){
                layer.closeAll();}
            else {
                location.href = url;
            }
        }

    });
}
//不带按钮提示框
function alertnobtn(title) {
    var index = $.layer({
        type: 0,
        closeBtn: [0, true],
        title: '消息提示',
        dialog: {
            btns: 0,
            type: -1,
            msg: title
        }
    });
}

//操作提示 title操作内容 url 跳转url
function confirmmsg(title, url1, url2,open,bt1,bt2) {
    bt1=movar(bt1,'是');
    bt2=movar(bt2,'否');
    index= $.layer({
        area: ['min-width:100px', 'auto'],
        title: '操作提示',
        dialog: {
            msg: title,
            btns: 2,
            type: 4,
            closeBtn:false,
            btn: [bt1, bt2],
            yes: function() {
                if (typeof (url1) != 'undefined') {
                    if (url1 == 1) {
                        location.reload();
                    }
                    if (url1 == 2) {
                        layer.closeAll();
                    }
                    else if(open==1){
                        layer.close(index);
                        window.open(url1);

                    }
                    else {
                        location.href = url1;
                    }
                }
            },
            no: function() {
                if(open==1){
                    sendfeedback();
                }
                else if (typeof (url2) != 'undefined') {
                    if (url2 != 1) {
                        location.href = url2;
                    }
                }
            }

        },
        end:function(){
            if (open ==2) {
                location.href = url1;
            }
        }
    });
}
//在图层内显示提示
function alertdiv(title, id) {
    //关闭弹出层
    layer.closeAll()
    $("#" + id).css('display','');
    $("#" + id).html(title);
}
//在图层内显示tips提示
function alerttip(title, id,fx) {
    //关闭弹出层
    if (typeof (fx) == 'undefined'){fx=1;}
    layer.closeAll()
    $.layer({
        type: 4,
        shade: [0],
        time:5,
        closeBtn: false,
        tips : {
            msg: title,
            follow: '#'+id,
            guide: fx,
            isGuide: true
        }
    });
}


//数据加载效果
function loading(title, sj) {
    $.layer({
        type: 0,
        closeBtn: false,
        title: false,
        dialog: {
            type: 16,
            msg: title
        },
        end: function() { //层彻底关闭后执行的回调
            window.clearInterval(InterValObj);

        }

    });
    loadfalse(sj);
}
var SysSecond;
var InterValObj
function loadfalse(tm) {
    SysSecond = tm; //这里获取倒计时的起始时间 
    InterValObj = window.setInterval(Setfalse, 1000); //间隔函数，1秒执行 
}
function Setfalse() {
    if (SysSecond > 1) {
        SysSecond--;
    }
    else {
        alertmsg('操作超时，请重新操作', '', 3);
    }
}

//无刷新提交并返回提示
function getajax(urls) {
    $.ajax({
        cache: false,
        async: true,
        type: "GET",
        url: urls,
        success: function(data) {
            clickalert(data);
        }
    })
}

function getcard(str) {
    if (str) {
        $("#dpcard").html("恭喜您获得：" + str);
    }
    return true;
}
//根据内容显示弹出效果
function clickalert(data) {
    var msg = data.split("|");
    if (msg[0] == 1) { //提示框
        if(msg[4]==1){
            parent.alertmsg(msg[1], msg[2], msg[3]);
        }
        else{
            alertmsg(msg[1], msg[2], msg[3]);
        }
    }
    else if (msg[0] == 2) { //选择框
        confirmmsg(msg[1], msg[2], msg[3],msg[4],msg[5],msg[6]);
    }
    else if (msg[0] == 3) { //提示层
        alertdiv(msg[1], msg[2]);
    }
    else if (msg[0] == 4) { //无提示
        if (typeof (msg[1]) != 'undefined' && msg[1] != 1 && msg[1] != 2) {
            if(msg[2]==1){
                confirmmsg("下载是否成功？",2,1,1);
            }
            else{
                layer.closeAll() ;
            }
            hide.location.href=msg[1];
        }
        else if(msg[1]==1){
            layer.closeAll() ;
        }
        else if(msg[1]==2){
            eval(msg[2]);
        }
        else {
            location.reload();
        }
    }
    else if (msg[0] == 5) { //无提示
        if (typeof (msg[1]) != 'undefined' && msg[1] != 1) {
            location.href=msg[1];
        }
        else if(msg[1]==1){

        }
        else {
            location.reload();
        }

    }
    else if (msg[0] == 6) { //无提示
        alerttip(msg[1],msg[2]);

    }
    else if(msg[0]==7){
        layer.closeAll() ;
        $('label',"."+msg[2]).css('display','');
        $('label',"."+msg[2]).html(msg[1]);

    }
    else if (data.indexOf('loading')>=0) { //提示层
        location.href=msg[1];
    }

}
function movar(tmp, msg) {
    if (typeof (tmp) == "undefined" || tmp == "")
    {
        return msg;
    }
    else {
        return tmp;
    }
}
function openpage(url, t, w, h) {
    w=movar(w,400);
    h=movar(h,300);
    if(t!=1){
        var indexpage= $.layer({
            type: 2,
            title: t,
            iframe: {src : url},
            area: [w+"px", h+"px"]
        });
    }
    else{
        var  indexpage=  $.layer({
            type: 2,
            title: false ,
            closeBtn: false,
            offset: ['60px', ''],
            iframe: {src : url},
            area: [w+"px", h+"px"]
        });
    }
}
function sendsj(tm,tid,djs) {
    SysSecond = tm; //这里获取倒计时的起始时间   
    InterValObj = window.setInterval(_sendmsg(tid,djs), 1000); //间隔函数，1秒执行 
}
function sendmsg(tid,djs) {
    if (SysSecond > 1) {
        SysSecond--;
        $("#"+djs).html("<font style='padding-left:10px;'>"+SysSecond+"秒后重发</font>");
    }
    else {
        $("#"+djs).html('');
        $("#"+tid).removeClass('disable');

    }

}
function _sendmsg(tid,djs){
    return function(){
        sendmsg(tid,djs);
    }
}
$(function() {
    document.domain="localhost"//设置自身的域
    $(".sendmobile").click(function(){

        tid=$(this).attr('id');
        djs=$(this).attr('djs');
        $(this).addClass('disable');
        sendsj(30,tid,djs);
        url=$(this).attr('url');
        id=$(this).attr('inputid');
        data=$("#"+id).val();
        urls=url+"?id="+data;
        getajax(urls);


    })
    $("body").on("click",".posturl",function() {
        var time = $(this).attr('loadtime');
        var title = $(this).attr('loadtitle');
        var flag = $(this).attr('flag');
        var czts = $(this).attr('czts');
        var btn = $(this).attr('btn');
        btn=movar(btn,"下载|取消");
        bts=btn.split("|");
        time = movar(time, 30);
        title = movar(title, '数据正在提交中...');
        czts = movar(czts, '是否确定执行该操作');
        czts=czts.replace(/\[/g,"<");
        czts=czts.replace(/\]/g,">");
        urls = $(this).attr('url');
        if (flag == 1) {
            $.layer({
                area: ['min-width:100px', 'auto'],
                title: '操作提示',
                dialog: {
                    msg: czts,
                    btns: 2,
                    type: 4,
                    btn: [bts[0], bts[1]],
                    yes: function() {

                        if($('input[name=cardname][checked]').val()=='free'){
                            urls=urls+ "&cardname=free";
                        }
                        //alert($('input[name=cardname][checked]').val());
                        parent.loading(title, time);
                        getajax(urls);
                    }
                }
            });
        }
        else if(flag == 2){
            loading(title, time);
            getajax(urls);
        }
        else {
            //loading(title, time);
            getajax(urls);
            //  location.href=urls;
        }
    });

    $("body").on("click",".posturl1",function() {
        var time = $(this).attr('loadtime');
        var title = $(this).attr('loadtitle');
        var flag = $(this).attr('flag');
        var czts = $(this).attr('czts');
        var btn = $(this).attr('btn');
        btn=movar(btn,"下载|取消");
        bts=btn.split("|");
        time = movar(time, 30);
        title = movar(title, '数据正在提交中...');
        czts = movar(czts, '是否确定执行该操作');
        czts=czts.replace(/\[/g,"<");
        czts=czts.replace(/\]/g,">");
        urls = $(this).attr('url');
        if (flag == 1) {
            $.layer({
                area: ['min-width:100px', 'auto'],
                title: '操作提示',
                dialog: {
                    msg: czts,
                    btns: 2,
                    type: 4,
                    btn: [bts[0], bts[1]],
                    yes: function() {
                        layer.closeAll();
                        hide.location.href=urls;
                    }
                }
            });
        }
        else {
            hide.location.href=urls;
        }
    });

    $(".submitform").submit(function() {
        var time = $(this).attr('loadtime');
        var title = $(this).attr('loadtitle');
        time = movar(time, 30);
        title = movar(title, '数据正在提交中...');
        loading(title, time);
        var url = $(this).attr('url');
        url = movar(url, $(this).attr("action"));
        var i = $.post(url, $(this).serialize(), function(data) {
            clickalert(data);
        });
        return false;
    })
    $("#postaction").submit(function() {
        url= $(this).attr("action");
        var i = $.post(url, $(this).serialize(), function(data) {
            clickalert(data);
        });
        return false;
    })
})
function windowopen(url){
    window.open (url,'newwindow','height=600,width=620,top=0,toolbar=no,menubar=no,scrollbars=no, resizable=no,location=no, status=no')
}
function openwin(url) {
    var a = document.createElement("a");
　　a.setAttribute("href", url);
　　a.setAttribute("target",'_blank');
　　document.body.appendChild(a);
　　if(a.click){
    　　a.click();
　　}else{
    　　try{
        　　var evt = document.createEvent('Event');
　　a.initEvent('click', true, true);
　　a.dispatchEvent(evt);
　　}catch(e){
        　　window.open(url);
　　}
　　}
　　document.body.removeChild(a);
}
function pdin(id,t){
    if($("#"+id).val()==""){
        alertmsg(t,'0',3);
        $("#"+id).focus();
        // $(ti).blur();
    }
}
function usercard(id){
    var t=$(id);
    if(typeof(t.attr('checked'))=='undefined'){
        t.attr('checked','checked');
    }
    else{
        t.removeAttr('checked');
    }
}