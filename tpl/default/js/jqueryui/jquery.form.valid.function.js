(function($) {
	//parmas[min,max]
	lengths =function(str,params){
		if(str.length<params[0] || str.length >params[1]){
			return {result : false , message : "字符长度限制"+params[0]+"-"+params[1]} ;
		}else{
			return true;
		}
	};
	//parmas[equalID,erromess]
	equalTo =function(str,params){
		var message = params[1]?params[1]:"信息不匹配";
		if(str != $("#"+params[0]).val()){
			return {result : false , message : message} ;
		}else{
			return true ;
		}
	};
})(jQuery);