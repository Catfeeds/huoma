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
            // $("#name").val(res.designer_info.name);
            if(res.error != 1){
                var str = "";
                if(res.designer_info.uname){
                    if(res.preference == 0){
                        var item_card = $("#item-card");
                        item_card.children('.main1').show().children('.p1').html('Hi,'+res.designer_info.uname+'是否设置投资偏好？');
                    }
                    str = '<a class="unlog" href="member.html">'+res.designer_info.uname+'</a> <a class="unlog" href="javascript:loginout();">注销</a>';
                    $(".menu-user-info").html(str);
                }
                if(res.designer_info.face){
                    $("#member_face").attr('src',res.designer_info.face);
                }
            }
        },
        error: function (res) {
        }
    });

});


function loginout (){
    $.ajax({
        type: 'POST',
        url: LOCAL_URL+"/user-loginout.html",
        data: {logout:'logout'},
        dataType: 'JSON',
        success: function (res) {
            window.location.href="index.html";
        },
        error: function (res) {
            window.location.href="index.html";
        }

    });
}