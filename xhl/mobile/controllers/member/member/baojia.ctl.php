<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: canzhan.ctl.php 9378 2015-09-7 11:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Member_Member_Baojia extends Ctl_Ucenter 
{
    public function show($baojia_id=null)
    {
        if(!$baojia_id = (int)$baojia_id){
             $this->error(404);
        }else if(!$baojia = K::M('canzhan/baojia')->detail($baojia_id)){
            $this->err->add('该报价不存在或已经删除', 211);
        }else{
 			$case = K::M('canzhan/case')->detail($baojia['case_id']);
			$cphoto = K::M('canzhan/photo')->items(array('case_id'=>$case['case_id'],'closed'=>0),array('dateline'=>'DESC'),1,4);
			$btype = array();
			if($baojia){
				$btype = K::M('canzhan/bxmtype')->items_list($baojia['baojia_id']);
			}
            $this->pagedata['baojia'] = $baojia; 
            $this->pagedata['btype'] = $btype; 
            $this->pagedata['bianhao'] = $bianhao; 
            $this->pagedata['case'] = $case; 
            $this->pagedata['cphoto'] = $cphoto; 
           $this->tmpl = 'member/member/baojia/show.html';
        }  
    }



    public function qiandan($id=null)
    {
		if (!($id = (int) $id) && !($id = (int)$this->GP('id'))) {
            $this->error(404);
        }elseif(!$baojia = K::M('canzhan/baojia')->detail($id)){
			echo $id;
			print_r($baojia);
			exit;
            $this->err->add('该报价单不存在或已经删除'.$id, 211);
        } else {
			$t = time();
			K::M('canzhan/canzhan')->update($baojia['id'], array('qdcase_id'=>$baojia['case_id'],'qdlook_id'=>$baojia['look_id'],'qdbaojia_id'=>$id,'qduid'=>$this->uid,'sign_time'=>$t,'sign_company_id'=>$baojia['company_id']),1);
			K::M('canzhan/baojia')->update($id, array('qdtime'=>time(),'qduid'=>$this->uid),1);
			$this->err->add('签单成功！');
		}
    }
}