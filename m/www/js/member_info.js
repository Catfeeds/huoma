$(function () {
    var data = {
        'act':'member_info'
    };
    $.ajax({
        type: 'POST',
        url: LOCAL_URL+"/member/designer-info.html",
        data: data,
        dataType: 'JSON',
        success: function (res) {
            $("#name").val(res.designer_info.name);
            //城市列表
            var str = '<option value="0">请选择</option>';
            $.each(res.province_list, function (val, index, arr) {
                str += '<option value="'+val+'">'+index+'</option>';
            });
            var province = $("#province");
            province.append(str);
            if(res.designer_info.province_id >0 ){
                province.val(res.designer_info.province_id);
            }
            //地级市列表
            str = '<option value="0">请选择</option>';
            $.each(res.city_list, function (val, index, arr) {
                str += '<option value="'+val+'">'+index+'</option>';
            });
            var city = $("#city");
            city.append(str);
            if(res.designer_info.city_id >0 ){
                city.val(res.designer_info.city_id);
            }
            //县市列表
            str = '<option value="0">请选择</option>';
            $.each(res.area_list, function (val, index, arr) {
                str += '<option value="'+val+'">'+index+'</option>';
            });
            var area = $("#area");
            area.append(str);
            if(res.designer_info.area_id >0 ){
                area.val(res.designer_info.area_id);
            }
            if(res.designer_info.face!=''){
                $("#face_img").show().attr('src',res.designer_info.face);
            }
            $("#qq").val(res.designer_info.qq);
            $("#skills").val(res.designer_info.skills);
            $("#slogan").val(res.designer_info.slogan);
            $("#school").val(res.designer_info.school);
            $("#about").val(res.designer_info.about);
        },
        error: function (res) {
        }
    });
    $("#province").change(function(){
        var val = $(this).val();
        var str = "<option value='0'>请选择</option>";
        $("#city,#area").empty().append(str);
        if(val > 0){
            $.ajax({
                type: 'POST',
                url: LOCAL_URL+"/member/designer-info.html",
                data: {province_id:val},
                dataType: 'JSON',
                success: function (res) {
                    //地级市列表
                    str = "";
                    $.each(res, function (val, index, arr) {
                        str += '<option value="'+val+'">'+index+'</option>';
                    });
                    $("#city").append(str);
                },
                error: function (res) {
                }
            });
        }
    });
    $("#city").change(function(){
        var val = $(this).val();
        var str = "<option value='0'>请选择</option>";
        $("#area").empty().append(str);
        if(val > 0){
            $.ajax({
                type: 'POST',
                url: LOCAL_URL+"/member/designer-info.html",
                data: {city_id:val},
                dataType: 'JSON',
                success: function (res) {
                    //地级市列表
                    str = "";
                    $.each(res, function (val, index, arr) {
                        str += '<option value="'+val+'">'+index+'</option>';
                    });
                    $("#area").append(str);
                },
                error: function (res) {
                }
            });
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
    editor=$('#about').xheditor({
        upLinkUrl:'demos/upload.php?immediate=1',
        upImgUrl:'demos/upload.php?immediate=1',
        upFlashUrl:'demos/upload.php?immediate=1',
        upMediaUrl:'demos/upload.php?immediate=1',
        localUrlTest:/^https?:\/\/[^\/]*?(wordhuo\.com)\//i,
        remoteImgSaveUrl:'demos/saveremoteimg.php',
        tools:'Bold,Italic,Underline,Strikethrough,|,Align,List,|,Link,Img,Code',
        plugins:plugins
    });
}


function submit_form(){
    var data = new FormData($('#member_form')[0]);
    data.append("data[about]",$("#about").val());
    $.ajax({
        type: 'POST',
        url: LOCAL_URL+"/member/designer-info.html",
        data: data,
        processData : false,
        contentType : false,
        dataType: 'JSON',
        success: function (res) {
            if(res.error == 0){
                window.location.href="member.html";
            }else{
                alert(res.message);
            }
        },
        error: function (res) {
        }
    });
}