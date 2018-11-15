/*! jQuery form plug-in 1.0.1
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
 * 	 All of the form item's define
 * 	 Involve hidden 、textBox、radio、checkBox、textArea、select and so on
 *   I will define their's style and validate
 *   And for example the textBox have many items user Name,company Name,telephone,Address and so on
 */

(function($) {
	var message_prefix_qsr = "请正确输入" ;
	var message_prefix_qxz = "请选择" ;
	//定义所有的提示信息
     var MESSAGE_NOTICE =
     {
    	'address':'中英文数字',
			'username':'可填字符为字母与数字，且字符的范围（5-20）。',
			'password':'格式必须为6-20个非特殊字符。',
			'chinese':'只允许输入汉字。',
			'chineseprefix':'只能以汉字开头,中间可以包含字母和数字。',
			'domain':'例如：www.3jia5.com，如果包含中文总字节长度不可以大于60。',
			'ip':'例如：255.255.255.255',
			'ipDomain':'例如：255.255.255.255或www.powercdn.com',
			'number':'只允许输入数字。',
			'checkbox':'至少选择一项。',
			'equalTo':'请输入',
			'email':'请输入邮箱格式',
			'mobile':'手机格式',
			'money':'金额必须是大于0的整数或者两位以内的小数！'
    };
   function getMessage(name){
   		return MESSAGE_NOTICE[name]==undefined ? "请正确输入":MESSAGE_NOTICE[name];
   };
	jQuery.fn.extend({
		  valids : function(dataobj){
		  	var s=dataobj.validType;
		  	var self = this;
		  	var message ="请输入";
		  	if(dataobj.prompt){
		  		message = dataobj.prompt;
		  	}
		  	self.attr('error_message',message);
		  	if(dataobj.required){
		  		if(self.attr("type")=="checkbox" || self.attr("type")=="radio"){
		  			self.parent().attr("required",dataobj.required);
		  		}else{
					self.attr("required",dataobj.required);
		  		}
		  	}
		  	$.init(self,message);
				this.blur(function(){
					var oval=self.val();
					if(self.attr("type")=="checkbox" || self.attr("type")=="radio"){
						var oname=self.attr("name");
						if($("input:[name="+oname+"]:checked").length ==0){
							$.addStyle(self);
						}else{
							$.removeStyle(self);
						}
						return ;
					}else if(dataobj.required && oval.length == 0){
							$.addStyle(self);
							return false;
					}else{
						if(oval == 0){
							$.removeStyle(self);
							return true;
						}
						var res = true;
				  	for(var i in s){
				  			if(typeof s[i]=="object"){
				  				valid= $.validator("callback",self,s[i]);
				  			}else{
				  				valid =$.validator(s[i],self);
				  				valid['text'] =getMessage(s[i]);
				  			}
			  			 	if(valid['level'] == 'error'){
							  		self.attr("error_message",valid['text']);
							  		res = false;
							 	}
							  else{
								  res = true;
							  }
				  			if(!res){
									break;
								}
						}
						if(res){
						  	$.removeStyle(self);
					  }else{
							  $.addStyle(self);
						}
					}
				});
		  },
		  //Button form 提交按钮
		  htmlform : function(formid){
				var obj = this;
				var form = obj.parents("form") ;
				if(formid != undefined){
					form = $("#"+formid) ;
				}
				this.click(function(){
					 var flag = submitValid(form);
					 if(flag) form.submit();
				});
		  },
		  //Button form Ajax提交按钮
		  ajaxform : function(formid){
			  var obj = this;
			  var form = obj.parents("form") ;
			  if(formid != undefined){
					form = $("#"+formid) ;
			  }
			  this.click(function(){
    			var flag = submitValid(form);
				var data =_getData(form);
				if(flag){
					var url = form.attr( "action" ) ;
					var method =  form.attr( "method" ) ;
					$.ajax({
							url : url ,
							async : true ,
							type : method,
							data : data ,
							success :  function(){alert("success");} ,
							error :  function(){alert("error");}
					});
				}
			  });
		  }
	});
})(jQuery);