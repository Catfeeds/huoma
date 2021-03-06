<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: case.ctl.php 9372 2015-11-26 06:32:36  xinghuali
 */

class Ctl_Member_Designer_Case extends Ctl_Ucenter
{
    
    protected $_allower_fields = 'mianji,title,intro,istz';

    public function index($page = 1)
    {
        $designer = $this->ucenter_designer();
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 20;
        $filter['istz'] = 0;
        $filter['uid'] = $designer['designer_id'];
        $filter['closed'] = 0;
        if ($items = K::M('case/case')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
            $this->pagedata['items'] = $items;
        }        
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile:member/designer/case/items.html';
    }
	
	public function listcon($page = 0)
    {
		$designer = $this->ucenter_designer();
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 20;
        $filter['istz'] = 0;
        $filter['uid'] = $designer['designer_id'];
        $filter['closed'] = 0;
        if ($items = K::M('case/case')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
            $this->pagedata['items'] = $items;
        }        
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile:member/designer/case/listcon.html';
    }

	public function tezhuang($page = 0)
    {
		if(!$page = $this->GP('page')){
			$page=1;
		}
        $designer = $this->ucenter_designer();
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 20;
        $filter['istz'] = 1;
        $filter['uid'] = $designer['designer_id'];
        $filter['closed'] = 0;
        if ($items = K::M('case/case')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
            $this->pagedata['items'] = $items;
        }        
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile:member/sheji/zhantai/tezhuang.html';
    }
	
    public function create()
    {
        $designer = $this->ucenter_designer();		
        if(K::M('system/integral')->check('case',  $this->MEMBER) === false){
            $this->err->add('很抱歉您的账户余额不足！', 201);
        }else if($data = $this->checksubmit('data')){
			$allow_case = K::M('member/group')->check_priv($designer['group_id'], 'allow_case');
            if($allow_case<0){
				$this->err->add('您是【'.$designer['group_name'].'】没有权限上传案例', 333);
			}elseif(!$data = $this->check_fields($data, $this->_allower_fields)){
                $this->err->add('非法的数据提交', 201);
            }//else if(!$detail = K::M('home/home')->detail($data['home_id'])){
//				$this->err->add('该案例添加的小区不存在或者已经删除', 201);
//			}
			else{
                $data['designer_id'] = $designer['designer_id'];
                $data['company_id'] = $designer['company_id'];
				$data['home_name'] = $detail['name'];
				$data['city_id'] = $this->request['city_id'];
				$data['uid'] = $uid = $this->uid;
				if($_FILES['data']['name']['huxing']){
                    foreach($_FILES['data'] as $k=>$v){
                        foreach($v as $kk=>$vv){
                            $attachs[$kk][$k] = $vv;
                        }
                    }
                    $upload = K::M('magic/upload');
                    foreach($attachs as $k=>$attach){
                        if($attach['error'] == UPLOAD_ERR_OK){
                            if($a = $upload->upload($attach, 'home')){
                                $data[$k] = $a['photo'];
                            }
                        }
                    }
                }else{
					if($photo = K::M('home/photo')->detail($data['huxing_id'])){
						$data['huxing'] = $photo['photo'];
					}
				}
                if ($case_id = K::M('case/case')->create($data)) {
                    if ($attr = $this->GP('attr')) {
                        K::M('case/attr')->update($case_id, $attr);
                    }                    
                    if ($company_id = (int) $data['company_id']) {
                        K::M('company/company')->update_count($company_id, 'case_num', 1);
                    }
                    K::M('designer/designer')->update_count($designer['designer_id'], 'case_num', 1);
                    if ($home_id = (int)$data['home_id']) {
                        K::M('home/home')->update_count($home_id, 'case_num', 1);
                        K::M('home/home')->update($home_id, array('last_case_designer_id'=>$designer['designer_id']));
                    }
                    K::M('member/integral')->commit('case', $this->MEMBER,'发布案例');
                    $this->err->set_data('forward', $this->mklink('member/designer/case:detail', array($case_id)));
                    $this->err->add('添加案例成功');
                }
            }
        } else {
            $this->pagedata['pager'] = $pager;
            $this->tmpl = 'mobile:member/designer/case/create.html';
        }
    }

    public function edit($case_id = null)
    {
        $designer = $this->ucenter_designer();
        if (!($case_id = (int) $case_id) && !($case_id = (int)$this->GP('case_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('case/case')->detail($case_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } elseif ($detail['uid'] != $designer['designer_id']) {
            $this->err->add('不许越权管理别人的内容', 212);
        } else if ($data = $this->checksubmit('data')) {
            if(K::M('member/group')->check_priv($designer['group_id'], 'allow_case')<0){
				$this->err->add('您是【'.$designer['group_name'].'】没有权限修改案例', 333);
			}elseif (!$data = $this->check_fields($data,  $this->_allower_fields)) {
                $this->err->add('非法的数据提交', 201);
            } else {
				unset($data['city_id'],$data['uid']);
				if($_FILES['data']['name']['huxing']){
                    foreach($_FILES['data'] as $k=>$v){
                        foreach($v as $kk=>$vv){
                            $attachs[$kk][$k] = $vv;
                        }
                    }
                    $upload = K::M('magic/upload');
                    foreach($attachs as $k=>$attach){
                        if($attach['error'] == UPLOAD_ERR_OK){
                            if($a = $upload->upload($attach, 'home')){
								if($a['photo']){
									$data[$k] = $a['photo'];
									$data['huxing_id'] = '0';
								}
                            }
                        }
                    }
                }else{
					if($photo = K::M('home/photo')->detail($data['huxing_id'])){
						$data['huxing'] = $photo['photo'];
					}
				}
                if (K::M('case/case')->update($case_id, $data)) {
                    if($detail['home_id'] != $data['home_id']){
                        if($home_id = (int) $data['home_id']){
                            K::M('home/home')->update_count($home_id, 'case_num', 1);
                        }
                        if($home_id = (int)$detail['home_id']){
                             K::M('home/home')->update_count($home_id, 'case_num', -1);
                        }
                    }
                    if (!$attr = $this->GP('attr')) {
                        $attr = array();
                    }
                    K::M('case/attr')->update($case_id, $attr);
                     $this->err->set_data('forward', $this->mklink('member/designer/case:detail', array($case_id)));
                   $this->err->add('修改内容成功');
                }
            }
        } else {
            if ($attrs = K::M('case/attr')->attrs_by_case($case_id)) {
                $this->pagedata['attrs'] = $attrs;
                $detail['attrvalues'] = array_keys($attrs);
            }
            if ($home_id = (int) $detail['home_id']) {
                $this->pagedata['home'] = K::M('home/home')->detail($home_id);
            }
            if ($huxing_id = (int) $detail['huxing_id']) {
                $this->pagedata['huxing'] = K::M('home/photo')->detail($huxing_id);
            }
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'mobile:member/designer/case/edit.html';
        }
    }

    public function detail($case_id=null,$group=0, $page=1)
    {
        $designer = $this->ucenter_designer();
        if (!($case_id = (int) $case_id) && !($case_id = (int)$this->GP('case_id'))) {
            $this->error(404);
        } else if (!$detail = K::M('case/case')->detail($case_id)) {
            $this->err->add('您要查看的内容不存在或已经删除', 212);
        } else if ($detail['uid'] != $designer['designer_id']) {
            $this->err->add('您没有权限查看该内容', 212);
        } else {
            $pager = array('case_id'=>$case_id);
            $pager['page'] = (int)$page;
            $pager['limit'] = $limit = 20;
            $pager['count'] = $count = 0;
            if($items = K::M('case/photo')->items_by_case($case_id, 1, 50, $count)){
				if($detail['cz_id']){
					$xiaoguotu = array();
					foreach($items as $key=>$val){
						$xiaoguotu[$val['group']][$key]=$val;
					}
					print_r($xiaoguotu);
					$this->pagedata['xiaoguotu'] = $xiaoguotu;
					$this->pagedata['shejigao'] = count($xiaoguotu);
			   }else{
        	       	$this->pagedata['items'] = $items;
 	               $pager['count'] = $count;
				}
                $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink("member/designer/case:detail", array($case_id,'{page}')));
            }
			if($detail['istz']){
				if($baoguan = K::M('case/baoguan')->items_by_case($case_id, 1, 50, $count)){
					$this->pagedata['baoguan'] = $baoguan;
				}
				if($shigong = K::M('case/shigong')->items_by_case($case_id, 1, 50, $count)){
					$this->pagedata['shigong'] = $shigong;
				}
				if($moxing = K::M('case/moxing')->items_by_case($case_id, 1, 50, $count)){
					$this->pagedata['moxing'] = $moxing;
				}
			}
            $this->pagedata['detail'] = $detail;
            $this->pagedata['pager'] = $pager;
            $this->tmpl = 'mobile:member/designer/case/detail.html';
        }        
    }

    public function upload($case_id = null,$group = 0)
    {
        if(!$group = (int)$this->GP('group')){
			$group = 0;
		}
        $designer = $this->ucenter_designer();
        $allow_case = K::M('member/group')->check_priv($designer['group_id'], 'allow_case'); 
        if($allow_case < 0){
             $this->err->add('您是【'.$designer['group_name'].'】没有权限上传案例', 333);
        }else if(!($case_id = (int)$case_id) && !($case_id = (int)$this->GP('case_id'))){
            $this->err->add('非法的参数请求', 201);
        }else if(!$case = K::M('case/case')->detail($case_id)){
            $this->err->add('案例不存在或已经删除', 202);
        }elseif ($case['uid'] != $designer['designer_id']) {
            $this->err->add('不许越权管理别人的内容', 212);
        } else if(!$attach = $_FILES['Filedata']){
            $this->err->add('上传图片失败', 401);
        }else if(UPLOAD_ERR_OK != $attach['error']){
            $this->err->add('上传图片失败', 402);
        }else{
			$attach['group'] = $group;
            if($data = K::M('case/photo')->upload($case_id, $attach)){
                if($allow_case != $case['audit'] && empty($case['photos'])){
                    K::M('case/case')->update($case_id, array('audit'=>$allow_case));
                }
                $cfg = $this->system->config->get('attach');
                $this->err->set_data('photo', $cfg['attachurl'].'/'.$data['photo']);
                $this->err->add('上传图片成功');
            }
        }
        $this->err->json();
    }    
    
	 public function upload_baoguan($case_id = null)
    {
        $designer = $this->ucenter_designer();
        $allow_case = K::M('member/group')->check_priv($designer['group_id'], 'allow_case'); 
        if($allow_case < 0){
             $this->err->add('您是【'.$designer['group_name'].'】没有权限上传案例', 333);
        }else if(!($case_id = (int)$case_id) && !($case_id = (int)$this->GP('case_id'))){
            $this->err->add('非法的参数请求', 201);
        }else if(!$case = K::M('case/case')->detail($case_id)){
            $this->err->add('案例不存在或已经删除', 202);
        }elseif ($case['uid'] != $designer['designer_id']) {
            $this->err->add('不许越权管理别人的内容', 212);
        } else if(!$attach = $_FILES['Filedata']){
            $this->err->add('上传图片失败', 401);
        }else if(UPLOAD_ERR_OK != $attach['error']){
            $this->err->add('上传图片失败', 402);
        }else{
            if($data = K::M('case/baoguan')->upload($case_id, $attach)){
                $cfg = $this->system->config->get('attach');
                $this->err->set_data('photo', $cfg['attachurl'].'/'.$data['photo']);
                $this->err->add('上传图片成功');
            }
        }
        $this->err->json();
    }    
    public function upload_shigong($case_id = null)
    {
        $designer = $this->ucenter_designer();
        $allow_case = K::M('member/group')->check_priv($designer['group_id'], 'allow_case'); 
        if($allow_case < 0){
             $this->err->add('您是【'.$designer['group_name'].'】没有权限上传案例', 333);
        }else if(!($case_id = (int)$case_id) && !($case_id = (int)$this->GP('case_id'))){
            $this->err->add('非法的参数请求', 201);
        }else if(!$case = K::M('case/case')->detail($case_id)){
            $this->err->add('案例不存在或已经删除', 202);
        }elseif ($case['uid'] != $designer['designer_id']) {
            $this->err->add('不许越权管理别人的内容', 212);
        } else if(!$attach = $_FILES['Filedata']){
            $this->err->add('上传图片失败', 401);
        }else if(UPLOAD_ERR_OK != $attach['error']){
            $this->err->add('上传图片失败', 402);
        }else{
            if($data = K::M('case/shigong')->upload($case_id, $attach)){
                $cfg = $this->system->config->get('attach');
                $this->err->set_data('photo', $cfg['attachurl'].'/'.$data['photo']);
                $this->err->add('上传图片成功');
            }
        }
        $this->err->json();
    }
    public function upload_moxing($case_id = null)
    {
        $designer = $this->ucenter_designer();
        $allow_case = K::M('member/group')->check_priv($designer['group_id'], 'allow_case'); 
        if($allow_case < 0){
             $this->err->add('您是【'.$designer['group_name'].'】没有权限上传案例', 333);
        }else if(!($case_id = (int)$case_id) && !($case_id = (int)$this->GP('case_id'))){
            $this->err->add('非法的参数请求', 201);
        }else if(!$case = K::M('case/case')->detail($case_id)){
            $this->err->add('案例不存在或已经删除', 202);
        }elseif ($case['uid'] != $designer['designer_id']) {
            $this->err->add('不许越权管理别人的内容', 212);
        } else if(!$attach = $_FILES['Filedata']){
            $this->err->add('上传图片失败', 401);
        }else if(UPLOAD_ERR_OK != $attach['error']){
            $this->err->add('上传图片失败', 402);
        }else{
            if($data = K::M('case/moxing')->upload($case_id, $attach)){
                $this->err->set_data('photo', $cfg['attachurl'].'/'.$data['photo']);
                $this->err->add('上传图片成功');
            }
        }
        $this->err->json();
    }    
	
    public function update($case_id = null)
    {
        $designer = $this->ucenter_designer();
        if (!($case_id = (int) $case_id) && !($case_id = (int)$this->GP('case_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('case/case')->detail($case_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } else if ($detail['uid'] != $designer['designer_id']) {
            $this->err->add('不许越权管理别人的内容', 212);
        } else if ($data = $this->checksubmit('data')) {
            $photo_ids = array();
            foreach($data as $k=>$v){
                $photo_ids[$k] = $k;
            }
            if(empty($photo_ids)){
                $this->err->add('没有您要更新的内容', 212);
            }else if(!$photoinfos = K::M('case/photo')->items_by_ids($photo_ids)){
                $this->err->add('没有您要更新的内容', 212); 
            }else{
                $obj = K::M('case/photo');
                foreach($data as $k=>$v){
                    if($photoinfos[$k]['case_id'] == $case_id){
                        if($v['title'] != $photoinfos[$k]['title']){
                            $obj->update($k, array('title'=>$v['title']));
                        }
                    }
                }
                $this->err->add('更新成功');
            }
        }    
    }    
    
    public function delete($case_id= null)
    {
        $designer = $this->ucenter_designer();
        if (!($case_id = (int) $case_id) && !($case_id = (int)$this->GP('case_id'))) {
            $this->error(404);
        }else if(!$case = K::M('case/case')->detail($case_id)){
            $this->err->add('案例不存在或已经删除', 212);
        }else if ($case['uid'] != $designer['designer_id']) {
            $this->err->add('不许越权管理别人的内容', 212);
        }else if(K::M('case/case')->delete($case_id)){
            $this->err->add('删除案例成功');
        }   
    }

	public function defaultphoto($photo_id= null)
	{
		$designer = $this->ucenter_designer();
		if (!($photo_id = (int) $photo_id) && !($photo_id = (int)$this->GP('photo_id'))) {
            $this->error(404);
        }else if(!$detail = K::M('case/photo')->detail($photo_id)) {
            $this->err->add('工程案例不存在或已经删除', 211);
        }else if(!$case = K::M('case/case')->detail($detail['case_id'])){
            $this->err->add('案例不存在或已经删除', 212);
        }else if ($case['uid'] != $designer['designer_id']) {
            $this->err->add('不许越权管理别人的内容', 213);
        } else{
            if(K::M('case/case')->update($detail['case_id'],array('photo'=>$detail['photo']))){
                $this->err->add('修改封面成功');
            }
        }   
	}

    public function deletephoto($photo_id= null)
    {
       $designer = $this->ucenter_designer();
        if (!($photo_id = (int) $photo_id) && !($photo_id = (int)$this->GP('photo_id'))) {
            $this->error(404);
        }else if(!$detail = K::M('case/photo')->detail($photo_id)) {
            $this->err->add('工程案例不存在或已经删除', 211);
        }else if(!$case = K::M('case/case')->detail($detail['case_id'])){
            $this->err->add('案例不存在或已经删除', 212);
        }else if ($case['uid'] != $designer['designer_id']) {
            $this->err->add('不许越权管理别人的内容', 213);
        } else{
            if(K::M('case/photo')->delete($photo_id)){
                $this->err->add('删除工程案例成功');
            }
        }   
    }
	
	public function deletebaoguan($photo_id= null)
    {
        $designer = $this->ucenter_designer();
        if (!($photo_id = (int) $photo_id) && !($photo_id = (int)$this->GP('photo_id'))) {
            $this->error(404);
        }else if(!$detail = K::M('case/baoguan')->detail($photo_id)) {
            $this->err->add('报馆图不存在或已经删除', 211);
        }else if(!$case = K::M('case/case')->detail($detail['case_id'])){
            $this->err->add('案例不存在或已经删除', 212);
        }else if ($case['uid'] != $designer['designer_id']) {
            $this->err->add('不许越权管理别人的内容', 213);
        } else{
            if(K::M('case/baoguan')->delete($photo_id)){
                $this->err->add('删除报馆图成功');
            }
        }   
    }	
	public function deleteshigong($photo_id= null)
    {
        $designer = $this->ucenter_designer();
        if (!($photo_id = (int) $photo_id) && !($photo_id = (int)$this->GP('photo_id'))) {
            $this->error(404);
        }else if(!$detail = K::M('case/shigong')->detail($photo_id)) {
            $this->err->add('施工图不存在或已经删除', 211);
        }else if(!$case = K::M('case/case')->detail($detail['case_id'])){
            $this->err->add('案例不存在或已经删除', 212);
        }else if ($case['uid'] != $designer['designer_id']) {
            $this->err->add('不许越权管理别人的内容', 213);
        } else{
            if(K::M('case/shigong')->delete($photo_id)){
                $this->err->add('删除施工图成功');
            }
        }   
    }
    public function deletemoxing($photo_id= null)
    {
        $designer = $this->ucenter_designer();
        if (!($photo_id = (int) $photo_id) && !($photo_id = (int)$this->GP('photo_id'))) {
            $this->error(404);
        }else if(!$detail = K::M('case/moxing')->detail($photo_id)) {
            $this->err->add('模型不存在或已经删除', 211);
        }else if(!$case = K::M('case/case')->detail($detail['case_id'])){
            $this->err->add('案例不存在或已经删除', 212);
        }else if ($case['uid'] != $designer['designer_id']) {
            $this->err->add('不许越权管理别人的内容', 213);
        } else{
            if(K::M('case/moxing')->delete($photo_id)){
                $this->err->add('删除模型成功');
            }
        }   
    }

}