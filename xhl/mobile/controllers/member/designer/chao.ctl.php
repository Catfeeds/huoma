<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: chao.ctl.php 9372 2015-10-26 06:32:36  xinghuali
 */

class Ctl_Member_Designer_Chao extends Ctl_Ucenter
{
    
    protected $_allower_fields = 'chao_id,cz_id,uid,title,photo,chang,kuan,gao,mianji,type_soft,type_soft_v,type_light,type_map,backbg,filesize,fileurl,filename,seo_title,seo_keywords,seo_description,lasttime,clientip,dateline';

    public function index($type=9, $page = 1)
    {
        $designer = $this->ucenter_designer();
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 20;
        $filter['uid'] = $designer['designer_id'];
		if($type!=9){
        	$filter['audit'] = $type;
		}
        $filter['closed'] = 0;
        if ($items = K::M('chao/chao')->items($filter, array('chao_id'=>'DESC'), $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
            $this->pagedata['items'] = $items;
        }        
        $this->pagedata['type'] = $type;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile:member/designer/chao/items.html';
    }

    public function create($cz_id=0)
    {
        $designer = $this->ucenter_designer();	
        if($this->checksubmit()){
 			$allow_chao = K::M('member/group')->check_priv($designer['group_id'], 'allow_chao');
			if(!$data = $this->GP('data')){
 				echo '1|非法的数据提交！|/member/designer/chao-create.html';
            }elseif($allow_chao<0){
 				echo '1|您是【'.$designer['group_name'].'】没有权限上传模型|/member/designer/chao-create.html';
			}elseif(!$data = $this->check_fields($data, $this->_allower_fields)){
 				echo '1|非法的数据提交！|/member/designer/chao-create.html';
            }elseif(empty($data['title'])){
                echo '1|模型发布失败！标题未填写？|/member/designer/chao-create.html';
            }else{
				$data['uid'] = $uid = $this->uid;
				$data['lasttime'] =  __CFG :: TIME;
				$data['dateline'] =  __CFG :: TIME;
				$data['clientip'] = __IP;
				$data['mianji'] = $data['mianji']?$data['mianji']:$data['chang']*$data['kuan'];
				$data['size']=0;
				$files = array();
				$data['photo'] = '';
				if(count($data['filesize'])>0){
					foreach($data['filesize'] as $key=>$val){
						$data['size'] +=$val;
						$files[$key]['filesize'] = $val;
						$files[$key]['filetype'] = substr(strrchr(strtolower($data['fileurl'][$key]),'.'),1); 
						if(($files[$key]['filetype']=='jpg' || $files[$key]['filetype']=='png') && $data['photo']==''){
							$data['photo']=$data['fileurl'][$key];
						}
						$files[$key]['fileurl'] = $data['fileurl'][$key];
						$files[$key]['filename'] = $data['filename'][$key];
						
					}
				}
				unset($data['filesize']);
				unset($data['fileurl']);
				unset($data['filename']);
				
				
				//$data['photo'];
                if($chao_id = K::M('chao/chao')->create($data)){
	
                    if ($attr = $this->GP('attr')) {
                        K::M('chao/attr')->update($chao_id, $attr);
                    }
					if(count($files)>0){
		
						$sql_insert = 'insert into {table}(chao_id,type,title,photo,size,views,orderby,closed,clientip,dateline)values';
						foreach($files as $fval){
							$sql_insert.="(".$chao_id.",'".$fval['filetype']."','".$fval['filename']."','".$fval['fileurl']."','".$fval['filesize']."',0,50,0,'".__IP."',".__CFG :: TIME."),";
						}
						$sql_insert = substr($sql_insert,0,strlen($sql_insert)-1);
						if(K::M('chao/photo')->addfile_sql($sql_insert)){
//							K::M('designer/designer')->update_count($designer['designer_id'], 'chao_num', 1);
							if($data['cz_id']){
								echo "1|恭喜您，模型发布成功！请耐心等待审核！|/member/sheji/canzhan-looked.html";		
								
							}else{
								echo "1|恭喜您，模型发布成功！请耐心等待审核！|/member/designer/chao-index.html";					
							}
						}
					}
					              
                }
            }
			exit;
        } else {
			if($cz_id && $canzhan = K::M('canzhan/canzhan')->detail($cz_id)){
				$num = K::M('chao/chao')->count("cz_id={$cz_id} and uid={$this->uid}");
				$canzhan['expo'] = unserialize($canzhan['wenxun']);
				unset($canzhan['wenxun']);
	            $this->pagedata['canzhan'] = $canzhan;
				$num = $num+1;
	            $this->pagedata['cz_title'] = $canzhan['cname'].'_'.$this->uname.'_'.$num.'稿';
				$this->pagedata['cz_id'] = $cz_id;
			}else{
	            $this->pagedata['cz_id'] = 0;
			}
            $this->tmpl = 'mobile:member/designer/chao/create.html';
        }
    }

    public function edit($chao_id = null)
    {
        $designer = $this->ucenter_designer();
        if (!($chao_id = (int) $chao_id) && !($chao_id = (int)$this->GP('chao_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('chao/chao')->detail($chao_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } elseif ($detail['uid'] != $designer['designer_id']) {
            $this->err->add('不许越权管理别人的内容', 212);
        } else if ($data = $this->checksubmit('data')) {
            if(K::M('member/group')->check_priv($designer['group_id'], 'allow_chao')<0){
				$this->err->add('您是【'.$designer['group_name'].'】没有权限修改模型', 333);
			}elseif (!$data = $this->check_fields($data,  $this->_allower_fields)) {
                $this->err->add('非法的数据提交', 201);
            } else {
				unset($data['city_id'],$data['uid']);
                if (K::M('chao/chao')->update($chao_id, $data)) {
                     if (!$attr = $this->GP('attr')) {
                        $attr = array();
                    }
                    K::M('chao/attr')->update($chao_id, $attr);
                    $this->err->add('修改内容成功');
                }
            }
        } else {
            if ($attrs = K::M('chao/attr')->attrs_by_chao($chao_id)) {
                $this->pagedata['attrs'] = $attrs;
                $detail['attrvalues'] = array_keys($attrs);
            }
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'mobile:member/designer/chao/edit.html';
        }
    }

    public function detail($chao_id=null, $page=1)
    {
        $designer = $this->ucenter_designer();
        if (!($chao_id = (int) $chao_id) && !($chao_id = (int)$this->GP('chao_id'))) {
            $this->error(404);
        } else if (!$detail = K::M('chao/chao')->detail($chao_id)) {
            $this->err->add('您要查看的内容不存在或已经删除', 212);
        } else if ($detail['uid'] != $designer['designer_id']) {
            $this->err->add('您没有权限查看该内容', 212);
        } else {
            $pager = array('chao_id'=>$chao_id);
            $pager['page'] = (int)$page;
            $pager['limit'] = $limit = 20;
            $pager['count'] = $count = 0;
            $this->pagedata['detail'] = $detail;
            if($items = K::M('chao/photo')->items_by_chao($chao_id, $page, $limit, $count)){
                $this->pagedata['items'] = $items;
                $pager['count'] = $count;
                $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink("member/designer/chao:detail", array($chao_id,'{page}')));
            }
            $this->pagedata['pager'] = $pager;
            $this->tmpl = 'mobile:member/designer/chao/detail.html';
        }        
    }

    public function upload($chao_id = null)
    {
        $designer = $this->ucenter_designer();
        $allow_chao = K::M('member/group')->check_priv($designer['group_id'], 'allow_chao'); 
        if($allow_chao < 0){
             $this->err->add('您是【'.$designer['group_name'].'】没有权限上传模型', 333);
        }else if(!($chao_id = (int)$chao_id) && !($chao_id = (int)$this->GP('chao_id'))){
            $this->err->add('非法的参数请求', 201);
        }else if(!$chao = K::M('chao/chao')->detail($chao_id)){
            $this->err->add('模型不存在或已经删除', 202);
        }elseif ($chao['uid'] != $designer['designer_id']) {
            $this->err->add('不许越权管理别人的内容', 212);
        } else if(!$attach = $_FILES['Filedata']){
            $this->err->add('上传文件失败', 401);
        }else if(UPLOAD_ERR_OK != $attach['error']){
            $this->err->add('上传文件失败', 402);
        }else{
            if($data = K::M('chao/photo')->upload($chao_id, $attach)){
                if($allow_chao != $chao['audit'] && empty($chao['photos'])){
                    K::M('chao/chao')->update($chao_id, array('audit'=>$allow_chao));
                }
                $cfg = $this->system->config->get('attach');
                $this->err->set_data('photo', $cfg['attachurl'].'/'.$data['photo']);
                $this->err->add('上传文件成功');
            }
        }
        $this->err->json();
    }    
    
    public function update($chao_id = null)
    {
        $designer = $this->ucenter_designer();
        if (!($chao_id = (int) $chao_id) && !($chao_id = (int)$this->GP('chao_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('chao/chao')->detail($chao_id)) {
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
            }else if(!$photoinfos = K::M('chao/photo')->items_by_ids($photo_ids)){
                $this->err->add('没有您要更新的内容', 212); 
            }else{
                $obj = K::M('chao/photo');
                foreach($data as $k=>$v){
                    if($photoinfos[$k]['chao_id'] == $chao_id){
                        if($v['title'] != $photoinfos[$k]['title']){
                            $obj->update($k, array('title'=>$v['title']));
                        }
                    }
                }
                $this->err->add('更新成功');
            }
        }    
    }    
    
    public function delete($chao_id= null)
    {
        $designer = $this->ucenter_designer();
        if (!($chao_id = (int) $chao_id) && !($chao_id = (int)$this->GP('chao_id'))) {
            $this->error(404);
        }else if(!$chao = K::M('chao/chao')->detail($chao_id)){
            $this->err->add('模型不存在或已经删除', 212);
        }else if ($chao['uid'] != $designer['designer_id']) {
            $this->err->add('不许越权管理别人的内容', 212);
        }else if(K::M('chao/chao')->delete($chao_id)){
            $this->err->add('删除模型成功');
        }   
    }

	public function defaultphoto($photo_id= null)
	{
		$designer = $this->ucenter_designer();
		if (!($photo_id = (int) $photo_id) && !($photo_id = (int)$this->GP('photo_id'))) {
            $this->error(404);
        }else if(!$detail = K::M('chao/photo')->detail($photo_id)) {
            $this->err->add('工程模型不存在或已经删除', 211);
        }else if(!$chao = K::M('chao/chao')->detail($detail['chao_id'])){
            $this->err->add('模型不存在或已经删除', 212);
        }else if ($chao['uid'] != $designer['designer_id']) {
            $this->err->add('不许越权管理别人的内容', 213);
        } else{
            if(K::M('chao/chao')->update($detail['chao_id'],array('photo'=>$detail['photo']))){
                $this->err->add('修改封面成功');
            }
        }   
	}

    public function deletephoto($photo_id= null)
    {
        $designer = $this->ucenter_designer();
        if (!($photo_id = (int) $photo_id) && !($photo_id = (int)$this->GP('photo_id'))) {
            $this->error(404);
        }else if(!$detail = K::M('chao/photo')->detail($photo_id)) {
            $this->err->add('工程模型不存在或已经删除', 211);
        }else if(!$chao = K::M('chao/chao')->detail($detail['chao_id'])){
            $this->err->add('模型不存在或已经删除', 212);
        }else if ($chao['uid'] != $designer['designer_id']) {
            $this->err->add('不许越权管理别人的内容', 213);
        } else{
            if(K::M('chao/photo')->delete($photo_id)){
                $this->err->add('删除工程模型成功');
            }
        }   
    }


    public function show($chao_id)
    {
        if(!$chao_id){
             $this->err->add('来源有误', 211);
        }elseif(!$zhantai = K::M('chao/chao')->detail($chao_id)){
            $this->err->add('信息已过时', 211);
        }else{
			$photos = K::M('chao/photo')->items_by_chao($chao_id, 1, 50);
			$list_pic=array();
			foreach($photos as $val){
				$type = strtolower($val['type']);
				if($type !='rar' && $type !='zip'){
					$list_pic[] = $val;
				}
			}
			$this->pagedata['list_pic'] = $list_pic;;
			$this->pagedata['zhantai'] = $zhantai;
			$this->tmpl = 'mobile:member/designer/chao/show.html';
		}
    }


}