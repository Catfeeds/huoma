$(document).ready(function () {
    var submit_btn = $('#submit_btn');
    submit_btn.click(function(e){
        if($("#mobile").val() == ''){
            alert('请输入手机号码');
            return false;
        }
        if($("#regCode").val() == ''){
            alert('请输入验证码');
            return false;
        }
        if($("#password").val() == ''){
            alert('请输入密码');
            return false;
        }
        if($("#password_check").val() == ''){
            alert('请再次输入密码');
            return false;
        }
        if($("#password").val() != $("#password_check").val()){
            alert('两次输入的密码不一致');
            return false;
        }
        if(!$('input[name="isAllow"]').is(':checked')){
            alert('请阅读并同意《干点活服务协议》');
            e.preventDefault();
            return fasle;
        }
        var data = {};
        data.mobile = $("#mobile").val();
        data.regCode = $("#regCode").val();
        data.passwd = $("#password").val();
        data.passwd_check = $("#password_check").val();

        $.ajax('/user-create_user_ajax-designer.html',{
            type:'POST',
            data:data,
            dataType:'JSON',
            success:function(res){
                if(res.error == 1){
                    alert(res.message);
                    return false;
                }
                window.location.href='/member/designer.html';
            },
            error:function(){
            }
        });
    });
});