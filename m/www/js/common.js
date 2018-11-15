$(document).ready(function () {
    $.ajax({
        url:LOCAL_URL+"/member/designer.html",
        type:'POST',
        data:{login:'1'},
        dataType:'JSON',
        success:function(res){
            if(res.error == 1){
                window.location.href="login.html";
            }
        },
        error:function(){
        }

    });
});