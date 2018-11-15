<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: canzhan.ctl.php 9372 2015-11-26 06:32:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Member_Member_Canzhan extends Ctl_Ucenter 
{
    public function canzhan($page=1)
    {
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        $filter['uid'] = $this->uid;
        if($items = K::M('canzhan/canzhan')->items($filter, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('canzhan:canzhan', array('{page}')));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'member/member/canzhan/canzhan.html';
    }
    public function daishenhe($page=1)
    {
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        $filter['uid'] = $this->uid;
        if($items = K::M('canzhan/canzhan')->items($filter, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('canzhan:canzhan', array('{page}')));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'member/member/canzhan/daishenhe.html';
    }
    public function weitongguo($page=1)
    {
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        $filter['uid'] = $this->uid;
        if($items = K::M('canzhan/canzhan')->items($filter, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('canzhan:canzhan', array('{page}')));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'member/member/canzhan/weitongguo.html';
    }
    public function jinxingzhong($page=1)
    {
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        $filter['uid'] = $this->uid;
        if($items = K::M('canzhan/canzhan')->items($filter, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('canzhan:canzhan', array('{page}')));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'member/member/canzhan/jinxingzhong.html';
    }
    public function wancheng($page=1)
    {
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        $filter['uid'] = $this->uid;
        if($items = K::M('canzhan/canzhan')->items($filter, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('canzhan:canzhan', array('{page}')));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'member/member/canzhan/wancheng.html';
    }
	
    public function create()
    {
        $shop = $this->ucenter_shang();
		if($data = $this->checksubmit('data')){

		  $data['uid'] =$shop['uid'];
		  $data['ztime'] = $data['ztime'];
		  $data['clientip'] = __IP;
		  $data['dateline'] = __CFG :: TIME;
		  $file = trim($data['files'],',');
		  $filename = trim($data['filesname'],',');
		  if(empty($file)){
				if(empty($data['zname'])){
					echo "1|展会名称和展位号不能为空！|/member/member/canzhan-create.html";
					exit;
				}
			}
		  unset($data['files']);
		  unset($data['filesname']);
           if($id = K::M('canzhan/canzhan')->create($data)){
			    $files = explode(',',$file);
			    $filename = explode(',',$filename);
				if(count($files)>0){
					$sql_insert = 'insert into {table}(cid,uid,type,filename,file,status,info)values';
					foreach($files as $key=>$fval){
						$filetype = substr(strrchr(strtolower($fval),'.'),1); 
						$sql_insert.="(".$id.",".$shop['uid'].",'".$filetype."','".$filename[$key]."','".$fval."',1,''),";
					}
					$sql_insert = substr($sql_insert,0,strlen($sql_insert)-1);
					if(K::M('canzhan/file')->addfile_sql($sql_insert)){
						echo "1|恭喜您，发布成功！！我们将在24小时内与您联系！|/member/member/canzhan-canzhan.html";
					}
				}
                
            }else{
				echo "1|数据保存失败！请联系在线客服解决！|/member/member/canzhan-canzhan.html";
			}
			exit;
        }else{
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'member/member/canzhan/create.html';
        }        
    }

    public function canzhanfile($cid=null, $page=1)
    {
		$shang = $this->ucenter_shang();
        if (!($cid = (int) $cid) && !($cid = (int)$this->GP('cid'))) {
            $this->error(404);
        } else if (!$detail = K::M('canzhan/canzhan')->detail($cid)) {
            $this->err->add('您要查看的内容不存在或已经删除', 212);
        } else if ($detail['uid'] != $shang['uid']) {
            $this->err->add('您没有权限查看该内容', 212);
        } else {
            $pager = array('cid'=>$cid);
            $pager['page'] = (int)$page;
            $pager['limit'] = $limit = 20;
            $pager['count'] = $count = 0;
            $this->pagedata['detail'] = $detail;
            if($items = K::M('canzhan/file')->items_by_file($cid, $page, $limit, $count)){
                $this->pagedata['items'] = $items;
                $pager['count'] = $count;
                $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink("member/member/canzhan:canzhanfile", array($cid,'{page}')));
            }
            $this->pagedata['pager'] = $pager;
            $this->tmpl = 'member/member/canzhan/canzhanfile.html';
        }        
    }
	    public function upload($cid = null)
    {
       $shang = $this->ucenter_shang();
        if(!($cid = (int)$cid) && !($cid = (int)$this->GP('cid'))){
            $this->err->add('非法的参数请求', 201);
        }else if(!$canzhan = K::M('canzhan/canzhan')->detail($cid)){
            $this->err->add('计划不存在或已经删除', 202);
        }elseif ($canzhan['uid'] != $shang['uid']) {
            $this->err->add('不许越权管理别人的内容', 212);
        } else if(!$attach = $_FILES['Filedata']){
            $this->err->add('上传文件失败', 401);
        }else if(UPLOAD_ERR_OK != $attach['error']){
            $this->err->add('上传文件失败', 402);
        }else{
            if($data = K::M('canzhan/file')->upload($cid, $attach)){
                $cfg = $this->system->config->get('attach');
                $this->err->set_data('file', $cfg['attachurl'].'/'.$data['file']);
                $this->err->add('上传文件成功');
            }
        }
        $this->err->json();
    }    
    
    public function update($cid = null)
    {
        $shang = $this->ucenter_shang();
        if (!($cid = (int) $cid) && !($cid = (int)$this->GP('cid'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('canzhan/canzhan')->detail($cid)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } else if ($detail['uid'] != $shang['uid']) {
            $this->err->add('不许越权管理别人的内容', 212);
        } else if ($data = $this->checksubmit('data')) {
            $photo_ids = array();
            foreach($data as $k=>$v){
                $photo_ids[$k] = $k;
            }
            if(empty($photo_ids)){
                $this->err->add('没有您要更新的内容', 212);
            }else if(!$photoinfos = K::M('canzhan/file')->items_by_ids($photo_ids)){
                $this->err->add('没有您要更新的内容', 212); 
            }else{
                $obj = K::M('canzhan/file');
                foreach($data as $k=>$v){
                    if($photoinfos[$k]['cid'] == $cid){
                        if($v['filename'] != $photoinfos[$k]['filename']){
                            $obj->update($k, array('filename'=>$v['filename']));
                        }
                    }
                }
                $this->err->add('更新成功');
            }
        }    
    }    

    public function canzhanDetail($id=null)
    {
        if(!$id = (int)$id){
            $this->error(404);
        }else if(!$detail = K::M('canzhan/canzhan')->detail($id)){
            $this->err->add('查看的参展计划不存在或已经删除', 211);
        }else if($detail['uid'] != $this->uid){
            $this->err->add('您没有权限查看该参展计划', 212);
        }else{
			if($look_list_sj = K::M('canzhan/look')->items_by_canzhan_sj($id, 1, 5)){
				$look_list_t = array();
                foreach($look_list_sj as $k=>$v){
                    $uids[$v['uid']] = $v['uid'];
					$v['info'] = unserialize($v['info']);
					$canzhan_case = K::M('canzhan/case')->items(array('look_id'=>$v['look_id']), array('dateline'=>'DESC'));
					$czc_list = $boajia_case = array();
					if(count($canzhan_case>0)){
						foreach($canzhan_case as $ccval){
							$ccval['cphoto'] = K::M('canzhan/photo')->items(array('case_id'=>$ccval['case_id'],'closed'=>0),array('dateline'=>'DESC'),1,4);
							$czc_list[] = $ccval;
							if($ccval['is_ok']){
								$ccval['baojia'] = K::M('canzhan/baojia')->items(array('case_id'=>$ccval['case_id'],'status'=>2),array('dateline'=>'DESC'));
								$boajia_case[] = $ccval;
							}
						}
					}
					$v[canzhan_case] = $czc_list;
					$look_list_t[$k] = $v;
                }
                $this->pagedata['look_list_sj'] = $look_list_t;
                $this->pagedata['boajia_case'] = $boajia_case;
            }
            if($look_list = K::M('canzhan/look')->items_by_canzhan($id)){
                $uids = array();
                foreach($look_list as $k=>$v){
                    $uids[$v['uid']] = $v['uid'];
                }
                $this->pagedata['look_list'] = $look_list;
            }
			//推荐设计师条件 按面积推荐 目前没有限制
			$count_sj = count($look_list_t);
            $this->pagedata['count_sj'] = $count_sj;
            $this->pagedata['pager'] = $pager;
            $this->pagedata['detail'] = $detail;
            $this->pagedata['status_list'] = K::M('canzhan/canzhan')->status_list($detail['status']);
            $this->tmpl = 'member/member/canzhan/canzhanDetail.html';
        }
    }
    
    public function selectdashejishi($id=0,$page=1)
    {
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 4;
        $pager['count'] = $count = 0;
 		$filter = array();
		$filter['closed'] = 0;
		$filter['audit'] = 1;
        if($items = K::M('designer/designer')->items($filter, null, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('canzhan:canzhan', array('{page}')));
            $this->pagedata['items'] = $items;
        }
		$num = ceil($count/$limit);
		if($page>=$num){
			$pager['left'] = $page-1;
			$pager['right'] = 1;
		}elseif($page<=1){
			$pager['left'] = $num;
			$pager['right'] = 2;
		}else{
			$pager['left'] = $page-1;
			$pager['right'] = $page+1;
		}
		$pager['id'] = $id;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'member/member/canzhan/selectdashejishi.html';
    }

    public function selectdesigner($id=0,$uid=0)
    {   
        if(!$id || !$uid){
            $this->err->add('非法访问！', 211);
        }else if(!$detail = K::M('canzhan/canzhan')->detail($id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }elseif($detail['uid']!=$this->uid){
            $this->err->add('无权进行当前操作', 212);
        }else{
                if($detail['status']<2){
					$this->err->add('该计划还未审核通过，不可操作', 214);
				}elseif(!$designer = K::M('designer/designer')->detail($uid)){
					$this->err->add('该用户不存在', 201)->response();
				}elseif($looked = K::M('canzhan/look')->items(array('uid'=>$designer['uid'],'id'=>$id))){
					$this->err->add('已预约过该设计师，不可重复预约！', 201)->response();
				}else{
					$datas = K::M('canzhan/look')->getdata($designer['uid']);
					$datas['uid'] = $designer['uid'];
					$datas['id'] = $id; 
					$datas['dateline'] = __TIME;
					$datas['clientip'] = __IP;
					$canzhan_look = true;
					
					if($canzhan_look == true && $look_id = K::M('canzhan/look')->create($datas)){
						
/*						if($sms = $this->GP('sms')){
							$smsdata = array('designer'=>$designer['name'],'dateline'=> __TIME);
							K::M('sms/sms')->designer($designer, 'admin_designer_renwu', $smsdata);
					   }*/
//						$this->err->set_data('forward', '?canzhan/canzhan-detail-'.$id.'.html');
						$this->err->add('预约设计师成功！');
					}
                    
                } 
        }
    }  

    
    public function canzhanEdit($id=null)
    {
        if(!($id = (int)$id) && !($id = (int)$this->GP('id'))){
            $this->error(404);
        }else if(!$detail = K::M('canzhan/canzhan')->detail($id)){
            $this->err->add('查看的参展计划不存在或已经删除', 211);
        }else if($detail['uid'] != $this->uid){
            $this->err->add('您没有权限操作该参展计划', 212);
        }else if($data = $this->checksubmit('data')){
            if(K::M('canzhan/canzhan')->update($id, $data)){
                $this->err->add('完善参展计划信息成功');
            }
        }else{
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'member/member/canzhan/canzhanEdit.html';
        }        
    }

    public function signLook($look_id)
    {
        if(!$look_id = (int)$look_id){
            $this->error(404);
        }else if(!$look = K::M('canzhan/look')->detail($look_id)){
            $this->err->add('竞标不存在或已经删除', 211);
        }else if(!$canzhan = K::M('canzhan/canzhan')->detail($look['id'])){
            $this->err->add('参展计划不存或已经删除', 212);
        }else if($canzhan['uid'] != $this->uid){
            $this->err->add('你没有权限操作该参展计划信息', 213);
        }else if(empty($canzhan['audit'])){
            $this->err->add('该参展计划还在审核中，不可操作', 214);
        }else if($canzhan['sign_uid']){
            $this->err->add('已经有中标者，不可重复设置', 215);
        }else if(!$member = K::M('member/member')->detail($look['uid'])){
			$this->err->add('该投标用户不存在', 216);
		}else if(K::M('canzhan/look')->sign($look_id)){
			 switch ($member['from']) {
				case 'designer':
					K::M('designer/designer')->update_count($look['uid'], 'canzhan_sign'); break;
				case 'mechanic':
					K::M('mechanic/mechanic')->update_count($look['uid'], 'canzhan_sign'); break;
				case 'company':
					$company = K::M('company/company')->items(array('uid'=>$look['uid']));
					foreach($company as $k => $v){
						$this->company['company_id'] = $v['company_id'];
					}
					K::M('company/company')->update_count($this->company['company_id'], 'canzhan_sign'); 
				case 'shop':
					$shop = K::M('shop/shop')->items(array('uid'=>$look['uid']));
					foreach($shop as $k => $v){
						$this->company['shop_id'] = $v['shop_id'];
					}
					K::M('shop/shop')->update_count($this->shop['shop_id'], 'canzhan_sign'); break;
			}
            
            $this->err->add('设置中标成功');
        }
    }

    public function company($page=1)
    {
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        $filter['uid'] = $this->uid;
        if($items = K::M('company/yuyue')->items($filter, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
            $company_ids = array();
            foreach($items as $k=>$v){
                $company_ids[$v['company_id']] = $v['company_id'];
            }
            if($company_ids){
                $this->pagedata['company_list'] = K::M('company/company')->items_by_ids($company_ids);
            }
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;        
        $this->tmpl = 'member/member/canzhan/company.html';
    }

    public function companyDetail($yuyue_id=null)
    {
        if(!$yuyue_id = (int)$yuyue_id){
            $this->error(404);
        }else if(!$detail = K::M('company/yuyue')->detail($yuyue_id)){
            $this->err->add('您要查看的预约不存在或已经删除', 212);
        }else if($detail['uid'] != $this->uid){
            $this->err->add('您没有权限查看该预约', 213);
        }else{
            if($detail['company_id']){
                $this->pagedata['company'] = K::M('company/company')->detail($detail['company_id']);
            }
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'member/member/canzhan/companyDetail.html';
        }
    }

    public function designer($page=1)
    {
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        $filter['uid'] = $this->uid;
        if($items = K::M('designer/yuyue')->items($filter, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
            $designer_ids = array();
            foreach($items as $k=>$v){
                $designer_ids[$v['designer_id']] = $v['designer_id'];
            }
            if($designer_ids){
                $this->pagedata['designer_list'] = K::M('designer/designer')->items_by_ids($designer_ids);
            }
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;        
        $this->tmpl = 'member/member/canzhan/designer.html';
    }

    public function designerDetail($yuyue_id=null)
    {
        if(!$yuyue_id = (int)$yuyue_id){
            $this->error(404);
        }else if(!$detail = K::M('designer/yuyue')->detail($yuyue_id)){
            $this->err->add('您要查看的预约不存在或已经删除', 212);
        }else if($detail['uid'] != $this->uid){
            $this->err->add('您没有权限查看该预约', 213);
        }else{
            if($detail['designer_id']){
                $this->pagedata['designer'] = K::M('designer/designer')->detail($detail['designer_id']);
            }
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'member/member/canzhan/designerDetail.html';
        }
    }

    public function mechanic($page=1)
    {
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        $filter['uid'] = $this->uid;
        if($items = K::M('mechanic/yuyue')->items($filter, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
            $mechanic_ids = array();
            foreach($items as $k=>$v){
                $mechanic_ids[$v['mechanic_id']] = $v['mechanic_id'];
            }
            if($mechanic_ids){
                $this->pagedata['mechanic_list'] = K::M('mechanic/mechanic')->items_by_ids($mechanic_ids);
            }
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;        
        $this->tmpl = 'member/member/canzhan/mechanic.html';
    }

    public function mechanicDetail($yuyue_id=null)
    {
        if(!$yuyue_id = (int)$yuyue_id){
            $this->error(404);
        }else if(!$detail = K::M('mechanic/yuyue')->detail($yuyue_id)){
            $this->err->add('您要查看的预约不存在或已经删除', 212);
        }else if($detail['uid'] != $this->uid){
            $this->err->add('您没有权限查看该预约', 213);
        }else{
            if($detail['mechanic_id']){
                $mechanic = K::M('mechanic/mechanic')->detail($detail['mechanic_id']);
                $mechanic['attrvalues'] = K::M('mechanic/attr')->attrs_ids_by_mechanic($mechanic['mechanic_id']);
                $this->pagedata['mechanic'] = $mechanic;
            }
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'member/member/canzhan/mechanicDetail.html';
        }
    }

    public function shop($page=1)
    {
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        $filter['uid'] = $this->uid;
        if($items = K::M('shop/yuyue')->items($filter, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
            $shop_ids = $product_ids = array();
            foreach($items as $k=>$v){
                $shop_ids[$v['shop_id']] = $v['shop_id'];
                if($v['product_id']){
                    $product_ids[$v['product_id']] = $v['product_id'];
                }
            }
            if($shop_ids){
                $this->pagedata['shop_list'] = K::M('shop/shop')->items_by_ids($shop_ids);
            }
            if($product_ids){
                $this->pagedata['product_list'] = K::M('product/product')->items_by_ids($product_ids);
            }
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;        
        $this->tmpl = 'member/member/canzhan/shop.html';
    }

    public function shopDetail($yuyue_id=null)
    {
        if(!$yuyue_id = (int)$yuyue_id){
            $this->err->add('未指定要查看的预约', 211);
        }else if(!$detail = K::M('shop/yuyue')->detail($yuyue_id)){
            $this->err->add('您要查看的预约不存在或已经删除', 212);
        }else if($detail['uid'] != $this->uid){
            $this->err->add('您没有权限查看该预约', 213);
        }else{
            if($detail['product_id']){
                $this->pagedata['product'] = K::M('product/product')->detail($detail['product_id']);
            }
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'member/member/canzhan/shopDetail.html';
        }        
    }

}