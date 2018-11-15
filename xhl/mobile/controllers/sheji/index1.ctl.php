<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: designer.ctl.php 10025 2015-05-05 11:56:23  xinghuali
 */

class Ctl_Sheji_Index extends Ctl
{
    public function index()
    {
		$designer_uids = array();
		
		if($items =  K::M('case/case')->items(array('audit'=>1,'closed'=>0), array('mianji'=>'DESC'), 1, 8, $count)){
			foreach($items as $v){
				$designer_uids[$v['uid']] = $v['uid']; 
			}
			if($designer_uids){
             	$this->pagedata['designer_list'] = K::M('designer/designer')->items_by_ids($designer_uids);
            }
			$this->pagedata['items'] = $items;
		}
        $this->tmpl = 'mobile:sheji/index.html';
    }

	
	protected function check_designer($uid)
    {
        if(!($uid = (int)$uid) && !($uid = $this->GP('uid'))){
            $this->error(404);
        }else if(!$detail = K::M('designer/designer')->detail($uid)){
            $this->error(404);
        }
        $this->pagedata['detail'] = $detail;
        return $detail;
    }
}