<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: index.ctl.php  2015-12-01 13:02:23  xinghuali
 */

class Ctl_Website_Index extends Ctl
{
    public function index()
    {
        $ref = 'https://www.baidu.com';
        if ($url = $this->GP('czurl')) {
            $html = $this->get_contents($url,1,$ref);
            //截取网站编码
            preg_match("/charset=([\w|\-]+);?/", $html, $match);
            if (isset($match[1])) {
                $charset = $match[1];
                $charset = strtolower($charset);
            }
            //非utf8转utf8再截取，不转化可能截取后数据乱码
            if($charset!='utf-8'){
                $html = str_replace($match[1], "utf-8", $html);

                $html = iconv($charset, 'utf-8//IGNORE', $html);
            }
            //获取网站标题
            $title = $this->intercept_str($html,'<title>','</title>',1 );
            //网站源码 初判断
            $generator = $this->intercept_str($html,'<meta name="generator"','/>',1 );
            if($generator){
                $generator = $this->intercept_str($generator,'"','"',1 );
            }
            $author = $this->intercept_str($html,'<meta name="author"','/>',1 );
            if($author){
                $author = $this->intercept_str($author,'"','"',1 );
            }
            echo $title.'<br>';
            echo '网站源码：'.$generator.'<br>';
            echo '网站编码：'.$charset.'<br>';
            echo '作者：'.$author.'<br>';
            echo '开源网站官网：<a href="http://www.discuz.net/" target="_blank">源码下载</a>';
            exit;
        }else{
            $this->tmpl = 'website/index.html';
        }

    }
///////////////////////////------------使用中----------------------------------------------
    //通过网址获取内容
    function get_contents($url,$type=2,$referer='',$pos_tar=''){
        if($type == 0){
            $curlPost='w='.urlencode($pos_tar);
            $ch = curl_init();
            curl_setopt ($ch,CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_REFERER, $referer);
//curl_setopt ($ch,CURLOPT_POST, 1);
//curl_setopt ($ch,CURLOPT_POSTFIELDS, $curlPost);
            curl_setopt ($ch,CURLOPT_TIMEOUT,1000);
            ob_start();
            curl_exec($ch);
            $file_contents = ob_get_contents();
            ob_end_clean();
            curl_close($ch);
            return $file_contents;
        }
        if($type == 1){
            ob_start();
            $content = file_get_contents($url,false );
            ob_end_clean();
            return $content;
        }
        if($type == 2){
            $xmlhttp = new COM("Microsoft.XMLHTTP") or die("无法创建Microsoft.XMLHTTP组件!");
            $xmlhttp->open("GET",$url,False,"","");
            $xmlhttp->setRequestHeader("content-Type","text/html");
            $xmlhttp->send();
            $xmlhttpStr =  $xmlhttp->responseText;
            return  @mb_convert_encoding( $xmlhttpStr ,'UTF-8','GB2312');
        }
        if($type == 3){
            $str = file($url);
            $count = count($str);
            for ($i=0;$i<$count;$i++){
                $file .= $str[$i];
            }
            return $file;
        }
    }

    function intercept_str($str,$start,$end,$option){
        $strarr=explode($start,$str);
//print_r($strarr);
        @$tem=$strarr[1];
        if(empty($end)){
            return $tem;
        }else{
            $strarr=explode($end,$tem);
            if($option==1){
                return $strarr[0];
            }
            if($option==2){
                return $start.$strarr[0];
            }
            if($option==3){
                return $strarr[0].$end;
            }else{
                return $start.$strarr[0].$end;
            }
        }
    }

 /////////////////////////////////////////////////////////////////////////////////////////////










    function get_all_url($code){
        preg_match_all("/<a[^>]*href=[\"'](?<url>[^\"']*?)[\"'][^>]*>(?<text>[\\w\\W]*?)<\\/a/",$code,$arr);
        return array('name'=>$arr[2],'url'=>$arr[1]);
    }

    function removelink($str){
        $mode=array("#<a href=\"(.*)\">#iUs","#</a>#iUs");
        $want=array("","");
        $con=preg_replace($mode,$want,$str);
        return $con;
    }

    function get_domain($url)
    {
        $rs = parse_url($url);
        $main_url = $rs["host"];
        if(!strcmp(long2ip(sprintf("%u",ip2long($main_url))),$main_url))
        {
            return $main_url;
        }else{
            $arr = explode(".",$main_url);
            $count=count($arr);
            $endArr = array("com","net","org",'gov','ac','cn');//com.cn net.cn 等情况
            if (in_array($arr[$count-2],$endArr))
            {
                $domain = $arr[$count-3].".".$arr[$count-2].".".$arr[$count-1];
            }else{
                $domain = $arr[$count-2].".".$arr[$count-1];
            }
            return $domain;
        }
    }

// 内容图片
    function grabimagecontent($url,$dir="",$filename=""){

//$url为空则返回false;
        if($url==""){ return 0; }
        $ext = strrchr($url,".");//得到图片的扩展名
//$ext = '.jpg';//得到图片的扩展名
//$filename = strrchr($url,"/");//得到图片的扩展名

        if($filename == ""){$filename = time();}//以时间戳另起名
//开始捕捉
        ob_start();
//目录结构年月日，时 _thumb
//$dir1="down_img/".date('Ymd',time())."/";
//if(!is_dir($dir.$dir1)){
//	if(!mkdir($dir.$dir1)) return 0;
//}

//$dir1=$dir1.date('H',time())."/";
//if(!is_dir($dir.$dir1)){
//	if(!mkdir($dir.$dir1)) return 0;
//}

//读取文件成功
        if(readfile($url)){
            $img = ob_get_contents();
            ob_end_clean();
        }else{
            return 0;
        }

        $size = strlen($img);
        $fp2 = fopen($dir.$filename.$ext,"a");
        fwrite($fp2,$img);
        fclose($fp2);


        return $dir.$filename.$ext;
    }


//保存图片
    function grabimage($url,$dir="",$filename=""){
//$url为空则返回false;
        if($url==""){ return 0; }
//$ext = strrchr($url,".");//得到图片的扩展名
        $ext = '.jpg';//得到图片的扩展名
//$filename = strrchr($url,"/");//得到图片的扩展名

        if($filename == ""){$filename = time();}//以时间戳另起名
//开始捕捉
        ob_start();
//目录结构年月日，时 _thumb
//$dir1="down_img/".date('Ymd',time())."/";
//if(!is_dir($dir.$dir1)){
//	if(!mkdir($dir.$dir1)) return 0;
//}

//$dir1=$dir1.date('H',time())."/";
//if(!is_dir($dir.$dir1)){
//	if(!mkdir($dir.$dir1)) return 0;
//}

//读取文件成功
        if(readfile($url)){
            $img = ob_get_contents();
            ob_end_clean();
        }else{
            return 0;
        }

        $size = strlen($img);
        $fp2 = fopen($dir.$filename.$ext,"a");
        fwrite($fp2,$img);
        fclose($fp2);
//copy($dir.$dir1.$filename.$ext,$dir.$dir1.$filename."_thumb".$ext);
        if(!change_size($dir.$filename.$ext,$dir.'small_'.$filename.$ext)){ return 0; }

        return $filename.$ext;
    }

//缩略图
    function change_size($source, $newfile, $c_width = 300, $c_height = 300)
    {
        if(file_exists($source))
        {
            // 获取原图片的尺寸及类型
            list($width, $height, $picture_type) = getimagesize($source);
            if($width <= $c_width && $height <= $c_height)
            {

                $ext = strrchr($source,".");//得到图片的扩展名
                ob_start();
                if(readfile($source)){
                    $img = ob_get_contents();
                    ob_end_clean();
                }else{
                    return 0;
                }

                $size = strlen($img);
                $fp2 = fopen($newfile,"a");
                fwrite($fp2,$img);
                fclose($fp2);

                return 1;
            }
            else
            {
                //如果是宽图
                if($c_width/$c_height < $width/$height){
                    /*					$dw=$c_width/$c_height*$height;
                                        $dx=($width-$dw)/2;
                                        //$dx=($su_w-$c_width)/2;
                                        $dy=0;
                                        $dh=$height;
                    */					$dh=$width;
                    $dx=0;
                    //$dx=($su_w-$c_width)/2;
                    $dy=0; //开始y点坐标
                    $dw=$width;
                    $sx=0;
                    $sy=($c_height-($height/$width*$c_height))/2;
                    $cx=0;
                    $cy=$sy+($height/$width*$c_height);

                }else{//如果是高图
                    /*					$dh=$c_height/$c_width*$width;
                                        $dx=0;
                                        //$dx=($su_w-$c_width)/2;
                                        $dy=($height-$dh)/2; //开始y点坐标
                                        $dw=$width;
                    */					$dh=$height;
                    $dx=0;
                    //$dx=($su_w-$c_width)/2;
                    $dy=0; //开始y点坐标
                    $dw=$height;
                    $sx=($c_width-($width/$height*$c_width))/2;
                    $sy=0;
                    $cx=$sx+($width/$height*$c_width);
                    $cy=0;
                }
                //		$_dest_height = ($width/$_dest_width)*$height;
            }
            if($picture_type)
            {
                switch ($picture_type)
                {
                    case 1:
                        $picture_extension = 'jpg';
                        $picture_out = 'imagejpeg';
                        $image = imagecreatefromjpeg($source);
                        break;
                    case 2:
                        $picture_extension = 'gif';
                        $picture_out = 'imagegif';
                        $image = imagecreatefromjpeg($source);
                        break;
                    case 3:
                        $picture_extension = 'png';
                        $picture_out = 'imagepng';
                        $image = imagecreatefrompng($source);
                        break;
                }
                //根据比例，计算新图片的尺寸
                //新建一个真彩色图像
                $image_p = imagecreatetruecolor($c_width, $c_height);
                //重采样拷贝部分图像并调整大小
                $color = imagecolorallocate($image_p,255,255,255);
                imagefill($image_p,0,0,$color);
                imagecopyresampled($image_p, $image, $sx, $sy, $dx, $dy, $c_width, $c_height, $dw, $dh);
                imagefill($image_p,$cx,$cy,$color);
                // 将图片保存到服务器
                imagejpeg($image_p, $newfile, 75);
                //在浏览器显示图片
                //销毁图片，释放内存
                imagedestroy($image_p);
            }
            return 1;
        }
        else
        {
            return 0;
        }
    }




    function intercept_str2($str,$start,$end,$option){
        $strarr=explode($start,$str);
        $tem=$strarr[2];
        if(empty($end)){
            return $tem;
        }else{
            $strarr=explode($end,$tem);
            if($option==1){
                return $strarr[0];
            }
            if($option==2){
                return $start.$strarr[0];
            }
            if($option==3){
                return $strarr[0].$end;
            }else{
                return $start.$strarr[0].$end;
            }
        }
    }

    function is_utf8($gonten)
    {
        if (preg_match("/^([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){1}/",$gonten) == true ||preg_match("/([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){1}$/",$gonten) == true ||preg_match("/([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){2,}/",$gonten) == true)
        {
            return  true;
        }
        else
        {
            return false;
        }
    }
    function get_basepath(){
        if ($dir = trim(dirname($_SERVER['SCRIPT_NAME']),'\,/')) {
            $base_path = "/$dir";
            $base_path .= '/';
        }else {
            $base_path = '/';
        }
        return $base_path;
    }
    function getmicrotime() {
        list($usec,$sec) = explode(" ",microtime());return ((float)$usec +(float)$sec);
    }

    function write_txt($count="",$fileurl=""){
        $fp = fopen($fileurl,'ab'); //以二进制追加方式打开文件,没文件就创建
        $col =$count."\n"; //记录赋值
        fwrite($fp, $col, strlen($col)); //插入第一条记录
        fclose($fp); //关闭文件
    }
}