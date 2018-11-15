$(function () {
    $(".payment_time_title em").click(function () {
        $("#bg").css({
            display: "block", height: $(document).height()
        });
        var $box = $('.payment_time_mask');
        $box.css({
            display: "block",
        });
    });
    //点击关闭按钮的时候，遮罩层关闭
//  $(".payment_time_mask li").on('click',function () {
//      $("#bg,.payment_time_mask").css("display", "none");
//      $(".payment_time_title em").text($(this).html());
//  });
    $(".bottom2 ul").on("click", "li", function (event) {
        $(this).addClass("current");
    })
    var array = []
    $(".payment_time_mask .a3").on('click', function () {
        var industry = $("#industry").val();
        var data = {};
        data.industry = industry;
        $.ajax({
            url:LOCAL_URL+'/designer-industry.html',
            type:'POST',
            data:data,
            dataType:'JSON',
            success:function(res){
                if(res.error > 0){
                    window.location.href = "member.html";
                }
                window.location.reload();
            },
            error:function(){
            }
        })
    });
    $(".top .a1").on("click", function () {
//		alert("!1")
        $(".bottom2 ul li").removeClass("current");
        $(".payment_time_mask").css("display", "none");
        $("#bg").css("display", "none");

    })

    $(".box2 em").click(function () {
        $("#bg1").css({
            display: "block", height: $(document).height()
        });
        var $box = $('.payment_time_mask1');
        $box.css({
            display: "block",
        });
    });
    //点击关闭按钮的时候，遮罩层关闭
    $(".bottom2 ul").on("click", "li", function (event) {
        $(this).addClass("current");
    })
    var array = []
    $(".top .a1").on("click", function () {
        $(".bottom2 ul li").removeClass("current");
        $(".payment_time_mask1").css("display", "none");
        $("#bg1").css("display", "none");
    })

    $(".box3 em").click(function () {
        $("#bg2").css({
            display: "block", height: $(document).height()
        });
        var $box = $('.payment_time_mask2');
        $box.css({
            display: "block",
        });
    });
    //点击关闭按钮的时候，遮罩层关闭
    $(".bottom2 ul").on("click", "li", function (event) {
        $(this).addClass("current");
    })
    var array = []
    $(".payment_time_mask2 .a3").on('click', function () {
        var data = {};
        data.schoolname = $("#schoolname").val();
        data.majorstr = $("#majorstr").val();
        data.degree = $("#degree").children('option:selected').val();
        data.date_start = $("#date_start").val();
        data.date_end = $("#date_end").val();
        if(data.schoolname != ''){
            var alert_str = "";
            if(data.majorstr == ''){
                alert_str += "请输入专业名称\n";
            }
            if(data.date_start == ''){
                alert_str += "请选择开始日期\n";
            }
            if(data.date_end == ''){
                alert_str += "请选择结束日期\n";
            }
            if(alert_str.length > 0){
                alert(alert_str);
                return false;
            }
        }
        $(".payment_time_mask2").css("display", "none");
        $("#bg2").css("display", "none");
        $.ajax({
            url:LOCAL_URL+'/designer-edu.html',
            type:'POST',
            data:data,
            dataType:'JSON',
            success:function(res){
                if(res.error > 0){
                    window.location.href = "member.html";
                }
                window.location.reload();
            },
            error:function(){
            }
        })
    });
    $(".top .a1").on("click", function () {
//		alert("!1")
        $(".bottom2 ul li").removeClass("current");
        $(".payment_time_mask2").css("display", "none");
        $("#bg2").css("display", "none");

    })

    $(".box4 em").click(function () {
        $("#bg3").css({
            display: "block", height: $(document).height()
        });
        var $box = $('.payment_time_mask3');
        $box.css({
            display: "block",
        });
    });
    //    点击关闭按钮的时候，遮罩层关闭
    $(".bottom2 ul").on("click", "li", function (event) {
        $(this).addClass("current");
    })
    var array = []
    $(".payment_time_mask3 .a3").on('click', function () {
        var data = {};
        data.orgname = $("#orgname").val();
        data.job = $("#job").val();
        data.workdesc = $("#workdesc").val();
        data.job_start = $("#job_start").val();
        data.job_end = $("#job_end").val();
        if(data.orgname != ''){
            var alert_str = "";
            if(data.job == ''){
                alert_str += "请输入职位\n";
            }
            if(data.job_start == ''){
                alert_str += "请选择开始日期\n";
            }
            if(data.job_end == ''){
                alert_str += "请选择结束日期\n";
            }
            if(alert_str.length > 0){
                alert(alert_str);
                return false;
            }
        }
        $(".payment_time_mask3").css("display", "none");
        $("#bg3").css("display", "none");
        $.ajax({
            url:LOCAL_URL+'/designer-job.html',
            type:'POST',
            data:data,
            dataType:'JSON',
            success:function(res){
                if(res.error > 0){
                    window.location.href = "member.html";
                }
                window.location.reload();
            },
            error:function(){
            }
        })
    });
    $(".top .a1").on("click", function () {
//		alert("!1")
        $(".bottom2 ul li").removeClass("current");
        $(".payment_time_mask3").css("display", "none");
        $("#bg3").css("display", "none");

    });
$(".payment_time_mask1 .a3").click(function(){
    var data = {};
    data.skillname = $("#skillname").val();
    data.skilllevel = $("#skilllevel").children('option:selected').val();
    if(data.skillname != '' && data.skilllevel == 0){
        $("body").append("<div class='alert_div'><h1>提示</h1>" +
"<span>请选择星级</span></div>");
$('.alert_div').show ().delay (1000).fadeOut ();
        return false;
    }
    $("#bg1").hide();
    $(".payment_time_mask1").hide();
    $.ajax({
        url:LOCAL_URL+'/designer-skill.html',
        type:'POST',
        data:data,
        dataType:'JSON',
        success:function(res){
            if(res.error > 0){
                window.location.href = "member.html";
            }
            window.location.reload();
        },
        error:function(){
        }
    })
});
//第二个

//新的内容
    $.ajax({
        url:LOCAL_URL+'/designer-preference.html',
        type:'POST',
        data:{1:1},
        dataType:'JSON',
        success:function(res){
            if(res.error == 1){
                window.location.href="login.html?link=member_preference.html";
                return;
            }
            //熟悉的领域
            var str = "",str1 = "";
            if(res.info.industry){
                $.each(res.info.industry,function(val,index,arr){
                    str += '<li id="preference_li'+val+'"> <p class="pt" type="text">'+index+'</p><button onclick="del_industry('+val+')">删除</button></li>';
                    if(str1.length > 0){
                        str1 += '，';
                    }
                    str1 += index;
                });
            }
            $("#industry_list").append(str);
            if(str1.length > 0) {
                $("#industry_str").html(str1);
            }
            //专业技能
            str = "";str1 = "";
            if(res.info.skill){
                $.each(res.info.skill,function(val,index,arr){
                    str += '<li id="skill_li'+val+'"> <p class="pt" type="text">'+index.name+'，' +index.level+ '星</p><button onclick="del_skill('+val+')">删除</button></li>';
                    if(str1.length > 0){
                        str1 += '，';
                    }
                    str1 += index.name;
                });
            }
            $("#skill_list").append(str);
            if(str1.length > 0){
                $("#skill_str").html(str1);
            }
            //教育经历
            str = "";str1 = "";
            if(res.info.edu){
                $.each(res.info.edu,function(val,index,arr){
                    str += '<li id="edu_li'+val+'"> <p class="pt" type="text">学校：'+index.schoolname+'；专业：' +index.majorstr+ '；学历' +index.degree+ '；' +index.date_start+ '；' +index.date_end+ '</p><button onclick="del_edu('+val+')">删除</button></li>';
                    if(str1.length > 0){
                        str1 += '，';
                    }
                    str1 += index.schoolname;
                });
            }
            $("#edu_list").append(str);
            if(str1.length > 0){
                $("#edu_str").html(str1);
            }
            //工作经历
            str = "";str1 = "";
            if(res.info.job){
                $.each(res.info.job,function(val,index,arr){
                    str += '<li id="job_li'+val+'"> <p class="pt" type="text">单位：'+index.orgname+'；职位：' +index.job+ '；' +index.job_start+ '；' +index.job_end+ '；' +index.workdesc+ '</p><button onclick="del_job('+val+')">删除</button></li>';
                    if(str1.length > 0){
                        str1 += '，';
                    }
                    str1 += index.orgname;
                });
            }
            $("#job_list").append(str);
            if(str1.length > 0){
                $("#job_str").html(str1);
            }
        },
        error:function(){
        }

    });
});

function del_industry(id){
    $.ajax({
        url:LOCAL_URL+'/designer-del_industry.html',
        type:'POST',
        data:{key:id},
        dataType:'JSON',
        success:function(res){
            $("#preference_li"+id).remove();
        },
        error:function(){
        }

    });
}

function del_skill(id){
    $.ajax({
        url:LOCAL_URL+'/designer-del_skill.html',
        type:'POST',
        data:{key:id},
        dataType:'JSON',
        success:function(res){
            $("#skill_li"+id).remove();
        },
        error:function(){
        }

    });
}

function del_edu(id){
    $.ajax({
        url:LOCAL_URL+'/designer-del_edu.html',
        type:'POST',
        data:{key:id},
        dataType:'JSON',
        success:function(res){
            $("#edu_li"+id).remove();
        },
        error:function(){
        }

    });
}

function del_job(id){
    $.ajax({
        url:LOCAL_URL+'/designer-del_job.html',
        type:'POST',
        data:{key:id},
        dataType:'JSON',
        success:function(res){
            $("#job_li"+id).remove();
        },
        error:function(){
        }

    });
}