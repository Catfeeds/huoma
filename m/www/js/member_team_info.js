$(function () {
    var team_id = $.url().param('id');
    if(typeof (team_id) == 'undefined'){
        team_id = 0;
    }
    $("#team_id").val(team_id);
    var data = {
        'act':'team_info'
    };
    data.id = team_id;
    $.ajax({
        type: 'POST',
        url: LOCAL_URL+"/member/sheji/team-edit-"+data.id+".html",
        data: data,
        dataType: 'JSON',
        success: function (res) {
            $("#team_name").val(res.detail.team_name);
            $("#team_position").val(res.detail.team_position);
            if(res.detail.team_img!=''){
                $("#face").show().attr('src',res.detail.team_img);
            }
            $("#team_mobile").val(res.detail.team_mobile);
            $("#team_email").val(res.detail.team_email);
            $("#slogan").val(res.detail.slogan);
            $("#team_task").val(res.detail.team_task);
        },
        error: function (res) {
        }
    });

});
$(pageInit);
var editor;
function pageInit()
{
    var plugins={
        Code:{c:'btnCode',t:'插入代码',h:1,e:function(){
            var _this=this;
            var htmlCode='<div><select id="xheCodeType"><option value="html">HTML/XML</option><option value="js">Javascript</option><option value="css">CSS</option><option value="php">PHP</option><option value="java">Java</option><option value="py">Python</option><option value="pl">Perl</option><option value="rb">Ruby</option><option value="cs">C#</option><option value="c">C++/C</option><option value="vb">VB/ASP</option><option value="">其它</option></select></div><div><textarea id="xheCodeValue" wrap="soft" spellcheck="false" style="width:300px;height:100px;" /></div><div style="text-align:right;"><input type="button" id="xheSave" value="确定" /></div>';
            var jCode=$(htmlCode),jType=$('#xheCodeType',jCode),jValue=$('#xheCodeValue',jCode),jSave=$('#xheSave',jCode);
            jSave.click(function(){
                _this.loadBookmark();
                _this.pasteHTML('<pre class="prettyprint lang-'+jType.val()+'">'+_this.domEncode(jValue.val())+'</pre>');
                _this.hidePanel();
                return false;
            });
            _this.saveBookmark();
            _this.showDialog(jCode);
        }}
    };
    editor=$('#team_task').xheditor({
        upLinkUrl:LOCAL_URL + '/upload.php',
        upImgUrl:LOCAL_URL + '/upload.php',
        upFlashUrl:LOCAL_URL + '/upload.php',
        upMediaUrl:LOCAL_URL + '/upload.php',
        localUrlTest:/^https?:\/\/[^\/]*?(wordhuo\.com)\//i,
        remoteImgSaveUrl:LOCAL_URL + '/saveremoteimg.php',
        tools:'Bold,Italic,Underline,Strikethrough,|,Align,List,|,Link,Img,Code',
        plugins:plugins
    });
}

function submit_form(){
    if($('#team_name').val() == ''){
        $("body").append("<div class='alert_div'><h1>提示</h1>" +
"<span>请输入名称</span></div>");
$('.alert_div').show ().delay (1000).fadeOut ();
        return;
    }
    if($('#team_mobile').val() == ''){
       $("body").append("<div class='alert_div'><h1>提示</h1>" +
"<span>请输入手机号</span></div>");
$('.alert_div').show ().delay (1000).fadeOut ();
        return;
    }
    var data = new FormData($('#member_form')[0]);
    data.append("data[team_task]",$("#team_task").val());
    var team_id = $("#team_id").val();
    $.ajax({
        type: 'POST',
        url: LOCAL_URL+"/member/sheji/team-edit-"+team_id+".html",
        data: data,
        processData : false,
        contentType : false,
        dataType: 'JSON',
        success: function (res) {
            if(res.error == 0){
                window.location.href="member_team.html";
            }else{
                alert(res.message);
            }
        },
        error: function (res) {
        }
    });
}