// JavaScript Document
var weburl="http://localhost/";
$(document).ready(
	function() {
		$('#upmodel').flash({
		  swf: weburl+'static/flash/updata.swf',
		  width: 400,
		  height: 260,
		  allowScriptAccess: 'always',
		  allowFullScreen: 'false'
	  });
	}
);
function cs(){
	//var idds="['upcode'";
	//$("#getpost input[type='text'],select").each(function(i){
	//	idds += ",'"+$(this).attr('id')+"'"; 
  //});
  //idds +="]";
  var idd="upcode,postype,posturl,postfurl";
	$("#getpost input[type='text'],select,input[type='checkbox'],input[type='radio']").each(function(i){
		tmp =$(this).attr('id');		
		if($("#"+tmp).length>0){
			idd += ","+tmp; 
		}
  });
  idds=idd.split(",");
  alert(idds);
}
function challs_flash_update(){
	var idd="upcode,postype,posturl,postfurl";
	$("#getpost input[type='text'],select,input[type='checkbox'],input[type='radio']").each(function(i){
		if($(this).attr('id')!='undefined' && $(this).attr('id')!=""){
			idd += ","+$(this).attr('id'); 
		}
  });
  idds=idd.split(",");
	var a={};
	a.FormName = "upfile";
//	a.url=weburl+"add/up.php";
	a.url=weburl+"up.html";
	a.parameter="bs=tyi";
	a.typefile=["*.gif,*.jpg,*.png,*.doc","*.gif;*.jpg;*.png;*.doc"];
	a.UpSize=0;//可限制传输文件总容量，0或负数为不限制，单位MB
	a.fileNum=0;//可限制待传文件的数量，0或负数为不限制
	a.size=2000;//上传单个文件限制大小，单位MB，可以填写小数类型
	a.FormID=idds;
	a.CompleteClose=true;
	a.returnServer = true;//设置为true时，组件必须等到服务器有反馈值了才会进行下一个步骤，否则不会等待服务器返回值，直接进行下一步骤，默认为false

	//a.repeatFile = true;
	
	return a ;
}
function challs_flash_kaishi(){
	loading('正在上传文件...',72000);
}
function challs_flash_onComplete(a){ //每次上传完成调用的函数，并传入一个Object类型变量，包括刚上传文件的大小，名称，上传所用时间,文件类型
	//var name=a.fileName; //获取上传文件名
	//var size=a.fileSize; //获取上传文件大小，单位字节
	//var time=a.updateTime; //获取上传所用时间 单位毫秒
	//var type=a.fileType; //获取文件类型，在 Windows 上，此属性是文件扩展名。 在 Macintosh 上，此属性是由四个字符组成的文件类型
	
}
function challs_flash_onStart(a){ //开始一个新的文件上传时事件,并传入一个Object类型变量，包括刚上传文件的大小，名称，类型
	//var name=a.fileName; //获取上传文件名
	//var size=a.fileSize; //获取上传文件大小，单位字节
	//var type=a.fileType; //获取文件类型，在 Windows 上，此属性是文件扩展名。 在 Macintosh 上，此属性是由四个字符组成的文件类型
//	document.getElementById('show').innerHTML+=name+'开始上传！<br />';
}
function challs_flash_onCompleteData(a){ //获取服务器反馈信息事件	
	
	arrtmp=a.split("|");
	$('#files').val(($('#files').val())+","+arrtmp[1]);
	$('#filesname').val(($('#filesname').val())+","+arrtmp[2]);
//	$("#show").append('<input value="'+$.trim(arrtmp[0])+'" type=text name="url'+i+'"><input value="'+arrtmp[3]+'" type=text name="foot'+i+'"><input value="'+arrtmp[1]+'" type=text name="sizes'+i+'"><input value="'+arrtmp[2]+'" type=text name="ext'+i+'">');	
}
function challs_flash_onCompleteAll(a){
	loading('文件上传完成，失败'+a+'个，<br>正在保存数据...',3600);
	//$('#files').val($('#files').val()-a);
	$('#tjsubmit').click();
}
function challs_flash_FormData(a){
try{
        var value = '';
        var id=document.getElementById(a);
        if(id.type == 'radio'){
            var name = document.getElementsByName(id.name);
            for(var i = 0;i<name.length;i++){
                if(name[i].checked){
                    value = name[i].value;
                }
            }
        }else if(id.type == 'checkbox'){
            var name = document.getElementsByName(id.name);
            for(var i = 0;i<name.length;i++){
                if(name[i].checked){
                   // if(i>0) value+=",";
                    value += name[i].value+'|';
                }
            }
            value=value.substring(0,value.length-1);
        }
        else{
		value=id.value;
            }
            return value;
	}catch(e){
		return '';
	}
}
//FLASH结束