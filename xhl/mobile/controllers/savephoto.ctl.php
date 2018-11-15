<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: Android.ctl.php 2016-03-16 17:15:56  xinghuali
 */
class Ctl_Savephoto extends Ctl
{ 
    public function index($openid=null)
    {
        $cfg = K::$system->config->get('attach');

	if(!empty($_POST['photo'])){
		$base64 = @$_POST['photo'];	 //post过来的图片数据。
		$type = empty($_POST['type'])?1:$_POST['type'];	  //上传的图片类型，区分是洗车前的，还是洗车后的存到不同的数据表中并保存成功后跳转到不同的位置
		$id = empty($_POST['uid'])?1:$_POST['uid'];
		$type = (int) $type;
		$id = (int) $id;
		$return_arr = array();
		
		$img = base64_decode($base64);
		$filesname = 'expo_'.date("YmdHis").rand(1000,9999).'.jpg';
		

        $ym = date('Ym', __CFG::TIME);
        $path1 = 'canzhan/'.$ym.'/';
        $path = $cfg['attachdir'].'canzhan/'.$ym.'/';
		if(!is_dir($path)){
			mkdir($path,0777,true);
		}
		
		$filenamepath = $path.$filesname;
		
		$a = file_put_contents($filenamepath, $img);//返回的是字节数printr(a);

		if($type<5 && $id){
					$data['type'] = $type;
					$data['cz_id'] = $id;
					$data['photo'] = $path1.$filesname;
                    $data['addtime'] = __TIME;
                    $data['orderby'] = 50;
			K::M('canzhan/jindu')->create($data);
			$this->change_size($filenamepath,$filenamepath);
			$oImg = K::M('image/gd');
			$uname = 'LXH';
            $oImg->watermark($filenamepath, $uname);
			$return_arr['url'] = 'http://app.jisunet.com/member/chao/baojia-qiandan.html';
		}else{
			$return_arr['url'] = 'http://app.jisunet.com/member/chao/baojia-qiandan.html';
		}
		
		if($a){
			$return_arr['state'] = 1;
			$return_arr['message'] = '成功';
			echo ecm_json_encode($return_arr);
			//echo "成功";
		}else{
			$return_arr['state'] = 0;
			$return_arr['message'] = '失败';
			echo ecm_json_encode($return_arr);
		}
	}else{
			echo ecm_json_encode(array(
				'state'=>0,
				'message'=>'提交数据不能为空！'
				));
	}

    }
	
public function change_size($source, $newfile, $c_width = 1000, $c_height = 1000)
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

}