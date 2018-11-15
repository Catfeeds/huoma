
/* jQuery form plug-in 1.0.1
 *
 * http://bassistance.de/jquery-plugins/jquery-plugin-validation/
 * http://docs.jquery.com/Plugins/Validation
 *
 * Copyright (c) 2010 NickCheng
 * You can affiliation me My Email Address :NickCZPing@gmail.com
 * And My QQ Number is:	406762380
 *
 * $Id: jquery.form-1.0.1 6403 2010-04-09 09:07
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 * Power description :
 * 	 All of the form item's valid
 * 	 Involve hidden ,textBox,radio,checkBox,textArea,select and so on
 *   I will define their's style and validate
 *   And for example the textBox have many items userName,companyName,telephone,Address and so on
 *   目前该版本支持：ie6,7,8;firefox3.以上;Chrome
 */

(function($) {
	var str = "";
	var Sys = {};
	var ua = navigator.userAgent.toLowerCase();
	//判断浏览器类型
	var s;
    (s = ua.match(/msie ([\d.]+)/)) ? Sys.ie = s[1] :
    (s = ua.match(/firefox\/([\d.]+)/)) ? Sys.firefox = s[1] :
    (s = ua.match(/chrome\/([\d.]+)/)) ? Sys.chrome = s[1] :
    (s = ua.match(/opera.([\d.]+)/)) ? Sys.opera = s[1] :
    (s = ua.match(/version\/([\d.]+).*safari/)) ? Sys.safari = s[1] : 0;
	//定义所有需验证的控件名称
	//定义所有的正则
	//'money':/^-?\d+(\.\d{0,2})?$/  原来
    /*var WIDGETREG =['address','authcode'，'bankaccount','chineseName','code'，'date','datetime'，'domain','email','eng','equalTo','filename','float',
    'idcard','ip','mobile','money','number','phone','password','qq','realName','textarea','','','','','','','username','password','number'
    ];*/
     var WIDGETREG =
     {
				'address':/(^[\u4e00-\u9fa5]*[0-9a-zA-Z]*([\u4e00-\u9fa5]|[0-9a-zA-Z])*$)/,
				'authcode':/^[^\s?<>\'\"!@%#$~&*():;]*$/,
				'bankaccount':/^(?:\d{4}){4,5}\d{3}$/,
				'chineseName':/(^[\u4e00-\u9fa5]*$)/,
				'confirmpwd':'',
				'commonSelect':'',
				'commonRadio':'',
				'date':/^\d{4}-\d{2}-\d{2}$/,
				'datetime':/^\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2}$/,
				'domain':/^(\*\.)?[\w\u4e00-\u9fa5\-_]+(\.[\w\u4e00-\u9fa5\-_]+)+([\w\-\.,@?^=%&:\/~\+#]*[\w\-\@?^=%&\/~\+#])?$/,
				'email':/^[a-zA-Z0-9_\\.]+@[a-zA-Z0-9-.]+[\\.a-zA-Z]+$/,
				'idcard':/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}(\d|x|X)$/,
				'invalidchar': /^[^<>$';]*$/,
				'ip':/^(([1-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))\.)(([0-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))\.){2}([0-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))$/,
				'ipDomain':/(^(([1-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))\.)(([0-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))\.){2}([0-9]|([1-9]\d)|(1\d\d)|(2([0-4]\d|5[0-5])))$)|(^(\*\.)?[\w\u4e00-\u9fa5\-_]+(\.[\w\u4e00-\u9fa5\-_]+)+([\w\-\.,@?^=%&:\/~\+#]*[\w\-\@?^=%&\/~\+#])?$)/,
				'mobile':/^(1[0-9]{10})?$/,
				'money':/^([1-9]\d*)|(\d+\.([1-9]|(\d[1-9])))$/,
				'notempty':/\S/,
				'number':/^\d*$/,
				'password':/^[0-9A-z-_~!@#$%^&*()_+`\[\]\;\:\"\<\>\.]{6,20}$/,
				'phone':/^(\+)?([0-9]{1,3}[-\s])?([0-9]{3,4}[-\s])?([0-9]{7,8})([-\s][0-9]{1,5})?$/,
				'qq':/^[1-9][0-9]{4,}$/,
      	'realName':/^([\u4e00-\u9fa5]{2,12})|([a-zA-Z-\s]{3,20})$/,
      	'textbox':/^[^;'"<>#]*$/,
      	'textarea':/^[^<>#]*$/,
      	'urlname':/^([a-z]+:\/\/)?([\w-]+)\.([\w-]+)(\.[\w-]+)*(\/)?[^\s]*$/,
      	'username':/^[A-Za-z1-9]\w{4,19}$/,
      	'zipcode':/^[0-9]{6}$/,
      	'companyName':/^[a-zA-Z\u4e00-\u9fa5]{1}[a-zA-Z\u4e00-\u9fa5\.\d ]{1,20}$/,
      	'question':/^[a-zA-Z\u4e00-\u9fa5\d]{1}[a-zA-Z\u4e00-\u9fa5\.\,\r\n\\\/\d\u3002\uff1f\uff01\uff0c\u3001\uff1b\uff1a\u201c\u201d\u2018\u2019\uff08\uff09\u300a\u300b\u3008\u3009\u3010\u3011\u300e\u300f\u300c\u300d\ufe43\ufe44\u3014\u3015\u2026\u2014\uff5e\ufe4f\uffe5 ]{1,500}$/,
      	//question匹配这些中文标点符号 。 ？ ！ ， 、 ； ： “ ” ‘ ' （ ） 《 》 〈 〉 【 】 『 』 「 」 ﹃ ﹄ 〔 〕 … — ～ ﹏ ￥
      	'bz':/^[a-zA-Z\u4e00-\u9fa5\.\,\r\n\\\/\d\u3002\uff1f\uff01\uff0c\u3001\uff1b\uff1a\u201c\u201d\u2018\u2019\uff08\uff09\u300a\u300b\u3008\u3009\u3010\u3011\u300e\u300f\u300c\u300d\ufe43\ufe44\u3014\u3015\u2026\u2014\uff5e\ufe4f\uffe5 ]{1,500}$/
      	//备注
    };
	//初始化项当鼠标移向控件弹出提示信息，移开则隐藏提示信息（obj:当前对象，str_:初始化提示信息）
	$.init = function(obj,str_){
			var str_temp_=str_;
		  if(obj.attr("required") || ((obj.attr("type")=="checkbox") && obj.parent().attr("required"))){
				var redstar = "<span class='redstar'>*</span>"
				var newtitle= obj.parent().prev().find('label').text();
				var trimtitle = $.trim(newtitle);
				if(_isHaveStar(trimtitle))
					obj.parent().prev().find('label').html(newtitle + redstar);
		  }
			  obj.hover(function () {
				  if ($.hasStyle(obj)) {
					  if ($('#tooltips-box').size() == 0) {
						  if ($('#TB_window').size() > 0) {
							  $('#TB_window').append('<div id="tooltips-box"><span class="arrow"></span><div class="tooltips-howpanel-top" style="display:none;"></div><div class="tooltips-howpanel"></div><iframe id="tooltips_iframe"></iframe><span class="arrow_after"></span></div>');
						  } else {
							  $('body').append('<div id="tooltips-box"><span class="arrow"></span><div class="tooltips-howpanel-top" style="display:none;"></div><div class="tooltips-howpanel"></div><iframe id="tooltips_iframe"></iframe><span class="arrow_after"></span></div>');
						  }
					  }
					  tipShow();
				  } else {
					  tipHidden();
				  }
			  }, function () {
				  tipHidden();
			  });
		  //获得当前高度（obj：当前对象）
		  _getTop = function(obj){
			  var position = obj.position();
			  var type = obj.attr("type");
			  var top = position.top ;
			  if(type == "textarea"){
				  var _top = 0;
				  if(Sys.ie) _top = obj.attr("rows") * 22;
				  if(Sys.firefox) _top = obj.attr("rows") * 19;
				  else _top = obj.attr("rows") * 17;
				  var tatop = top;
				  if($.browser.msie) {
				  	if($.browser.version<9){
						tatop=tatop+60;
				  	}
				  }
				  return tatop;
			  }else{
				  var untatop = obj.offset().top;
				  return untatop;
			  }

		  };
		  _getWidth = function(object) {
		        return object.offsetWidth;
		  };

		  _getLeft = function(obj) {
			  var position = obj.position();
			  var left = position.left;
			  left=obj.offset().left;
	      	  return left;
		  };

		  tipShow = function(){


		  	if(obj.hasClass("error-style")){
		  		str_=obj.attr("error_message");
		  	}else{
		  		str_=str_temp_;
		  	}

		    $('.tooltips-howpanel').html(str_);
			  if(obj.attr("type")=="checkbox" || obj.attr("type")=="radio"){
				  var left = _getLeft(obj.parent());
				  var obj_width = $(obj.parent()).width();
				  var tp = _getTop(obj.parent());
			  }else{
				  var left = _getLeft(obj);
				  var obj_width = $(obj).width();
				  var tp = _getTop(obj);
			  }

				var width = $(".tooltips-howpanel").width();
	      var height = $(".tooltips-howpanel").height();
				var swidth = document.body.scrollWidth;
				var xx = left+width-swidth;
				var lf = 0;
				var selftop=13;
				lf=left+obj_width;
				lf = lf+21;
				$('#tooltips-box').css({left:lf+'px',top:tp+'px',position:'absolute'});
				$('#tooltips_iframe').css({width:'240px',border:0,height:'35px'});
				$('#tooltips-box').fadeIn("fast");
				$('.tooltips-howpanel').fadeIn("fast");
				$('.tooltips-howpanel-top').fadeIn("fast");
		//	}
  		 };
		 tipHidden = function(){
			 	$('#tooltips-box').hide();
				$('.tooltips-howpanel').hide();
				$('.tooltips-howpanel-top').hide();
				$('#tooltips_iframe').css({width:'0px',height:'0px'});
		 };

		 obj.hover(window['tipShow'],window['tipHidden'])
					.focus(window['tipShow'])
					.blur(window['tipHidden']);

	};

	//判断是否需要加“*”号
	_isHaveStar = function(str){
		var flag = true;
		if(Sys.ie || Sys.chrome){
			str = str.substring(str.length-1);
			if(str == "*")
			return false;
		}else{
			for(var i in str){
				if(str[i] == "*"){
					flag = false;
					break;
				}
			}
		}
		return flag;
	};

	//表单所填信息验证（name:当前方法名，obj:当前控件对象,参数）
	$.validator = function(name , obj,param){
		str = obj.val();
		var reg = WIDGETREG[name];
		if(reg != "" && reg != undefined){
			if(str !="" && str != null && reg.test(str)){
				str = {level:'right'};
			}else{
				str ={level:'error'};
			}
			return str;
		}else if ( name == 'callback' ){
					var objval = $(obj).val();
					var res = param.callback( objval ,param.params);
					if( !res || res == true || res.result == true) {
						str = {level:'right'};
					}
					else {
						str = { level : "error",text : res.message} ;
					}
					return str;
		}
	};
	//提交时验证（form:当前form对象）
	submitValid = function(form){
		  var flag = true;
		  $.each($("input[type!='button'][type!='submit'][type!='reset'],textarea,select",form) , function(){
		  	 $(this).trigger("blur");
		  	 flag =$.hasStyle($(this));
		  	 if(!flag) return false;
		  }
		  ) ;
		  return flag;
	};
	//获得表单值（form:当前form对象）
	/*_getData_bak = function(form){
		  var data = "{";
		  $.each($(":input[type!='button'][type!='submit'][type!='reset']" , form ) , function(){
			  var self = $(this) ;
			  var selfid = self.attr("id");
			  var selfval = (self.val() != null && self.val() != '')? self.val() : null;
			  data += "'"+selfid+"':'"+selfval+"',";
		  });
		  data = data.substring(0,data.length-1);
		  data = data + "}";
		  return data;
	};*/

	//获得表单值（form:当前form对象）
	_getData = function(form){
	  	var data = {};
	    $(":input[type!='button'][type!='submit'][type!='reset']" , form ).each(function (i, n) {
	        if ($(n).is(":radio") || $(n).is(":checkbox")) {
	            if (!$(n).attr("checked"))
	                return;
	        }

	        if (data[n.name])
	        {
	            data[n.name] = data[n.name] + "," + $(n).val();
	        }
	        else
	        {
	            data[n.name] = $(n).val();
	        }
	    });
	    data['random'] = Math.random();
	    return data;
	};


	//获得当前控件前提示（self：当前控件对象）
	_getLabelInfo = function(self){
		var _title = self.parent().prev().find('label').html();
		if(_title == null)
			_title =  self.parent().prev().html();
		if(_title != null)
			return _title.replace('\：','').replace('\*','');
		else
			return '';
	};

	//添加错误提示信息样式（隐藏正确样式）（obj：当前控件对象）
	$.addStyle = function(obj,param){
		if(param != undefined){
				obj.parent().removeClass("box-right-style");
				obj.parent().addClass("box-error-style");
		}else if(obj.attr("type")=="checkbox" || obj.attr("type")=="radio" ){
				obj.parent().removeClass("right-style");
			  obj.parent().addClass("error-style");
		}else{
				obj.removeClass('right-style');
				obj.addClass("error-style");
		}
	};

	//添加正确时样式（隐藏错误提示样式）（obj：当前控件对象）
	$.removeStyle = function(obj,param){
		if(param == 'box'){
			obj.parent().parent().removeClass('box-error-style');
			obj.parent().parent().addClass('box-right-style');
		}else if(obj.attr("type")=="checkbox" || obj.attr("type")=="radio" ){
			obj.parent().removeClass('error-style');
			obj.parent().addClass('right-style');
		}else{
			obj.removeClass('error-style');
			obj.addClass('right-style');
		}
	};
	$.hasStyle = function(obj,param){
		if(param != undefined){
			  if(obj.parent().hasClass("box-error-style")){
			  	return false;
			  }else{
			  	return true;
			  }
		}else if(obj.attr("type")=="checkbox" || obj.attr("type")=="radio" ){
				if(obj.parent().hasClass("error-style")){
			  	return false;
			  }else{
			  	return true;
			  }
		}else{
				if(obj.hasClass("error-style")){
			  	return false;
			  }else{
			  	return true;
			  }
		}
	};

})(jQuery);