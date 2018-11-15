<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: date.mdl.php 2034 2016-01-09 10:53:33  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Data_Date extends Model 
{    
    
    public function zhan_date($num=12)
    {
        $zhan_date = array();
		for($i=0;$i<$num;$i++){
			$y = $yy = date('y');
			$m = date('m')+$i;
			$mm = date('m')-$i-1;
			if($m>12){
				$m = $m-12;
				$y += 1;
			}
			if($mm<1){
				$mm = $mm+12;
				$yy -= 1;
			}
			if($i==0){
				$zhan_date['now'][$m]['name']='本月份';
			}else{
				$zhan_date['now'][$m]['name']=$y.'年'.$m.'月份';
			}
			$zhan_date['now'][$m]['zhi']=mktime(0,0,0,$m,1,$y);
			$zhan_date['last'][$m]['name']=$yy.'年'.$mm.'月份';
			$zhan_date['last'][$m]['zhi']=mktime(0,0,0,$mm,1,$yy);
		}
        return $zhan_date;
    }

}