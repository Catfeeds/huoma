<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: photo.ctl.php 9372 2015-11-26 06:32:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Member_Chao_Jindu extends Ctl_Ucenter 
{
    protected $_allow_fields = 'type,title';
    public function index($page=1)
    {
        $company = $this->ucenter_company();
        $pager['page'] = $page = max(intval($page), 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        if($items = K::M('company/photo')->items_by_company($company['company_id'], $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->pagedata['type_list'] = K::M('company/photo')->get_type_means();
        $this->tmpl = 'mobile:member/company/photo/items.html';
    }

    public function tianjiajindu($cz_id=0)
    {
		if(!$cz_id){
			$this->err->add('非法的数据来源', 201);
		}
        $company = $this->ucenter_company();
        if ($data = $this->checksubmit('data')) {
                if(empty($data['logo'])){
                    $this->err->add('图片上传失败！', 211);
                }else{
                    $data['photo'] = $data['logo'];
                    unset($data['logo']);
                    $data['company_id'] = $company['company_id'];
                    $data['cz_id'] = $cz_id;
                    $data['addtime'] = __TIME;
                    $data['orderby'] = 50;
                    if ($pic_id = K::M('canzhan/jindu')->create($data)) {
                        $this->err->add('添加内容成功');
                        $this->err->set_data('forward',  $this->mklink('member/chao/baojia:qiandan'));
                    }
                } 
        } else {
            $this->pagedata['cz_id'] = $cz_id;
            $this->pagedata['type_list'] = K::M('canzhan/jindu')->get_type_means();
	        $this->tmpl = 'mobile:member/chao/baojia/jindu.html';
        }
    }

    public function update()
    {
        $company = $this->ucenter_company();
        if($data = $this->checksubmit('data')){
            $pic_ids = array();
            foreach($data as $k=>$v){
                $pic_ids[$k] = $k;
            }
            if($items = K::M('company/photo')->items_by_ids($pic_ids)){
                foreach($items as $k=>$v){
                    if($a = $data[$k]){
                        if($v['company_id'] == $company['company_id']){
                            if($a['title'] != $v['title'] || $a['type'] != $v['type']){
                                K::M('company/photo')->update($k, array('type'=>$a['type'], 'title'=>$a['title']));
                            }
                        }
                    }
                }
            }           
        }
    }

    public function delete($pic_id=null)
    {
        $company = $this->ucenter_company();
        if(!$pic_id = (int)$pic_id){
            $this->err->add('未定义操作', 211);
        }else if(!$detail = K::M('company/photo')->detail($pic_id)){
            $this->err->add('您要删除的内容不存在或已经删除', 212);
        }else if($detail['company_id'] != $company['company_id']){
            $this->err->add('非法的数据提交', 213);
        }else if(K::M('company/photo')->delete($pic_id)){
			if (file_exists('czfiles/'.$detail['photo'])) {
            @unlink('czfiles/'.$detail['photo']);
	        }
            $this->err->add('删除成功');
        }
    }

}