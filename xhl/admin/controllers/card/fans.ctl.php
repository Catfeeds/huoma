<?php
/**
 * Copy Right 16-expo.com
 * 人要活得优雅,代码更需要优雅
 * $Id: guan.ctl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Card_Fans extends Ctl
{
    
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;
       if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['fanid']){$filter['fanid'] = $SO['fanid'];}
            if($SO['uid']){$filter['uid'] = $SO['uid'];}
            if($SO['nickname']){$filter['nickname'] = "LIKE:%".$SO['nickname']."%";}
            if($SO['openid']){$filter['openid'] = $SO['openid'];}
        }

//		$filter['closed'] = 0;
		
        if($items = K::M('card/fans')->items($filter, null, $page, $limit, $count)){
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;

        $this->tmpl = 'admin:card/fans/items.html';
    }

    public function so($target)
    {
		if($target){
            $pager['multi'] = $multi == 'Y' ? 'Y' : 'N';
            $pager['target'] = $target;
        }
        $this->pagedata['pager'] = $pager;  
        $this->tmpl = 'admin:card/fans/so.html';
    }

    public function edit($id=null)
    {
        if(!($id = (int)$id) && !($id = $this->GP('id'))){
            $this->err->add('未指定要修改的内容ID', 211);
        }else if(!$detail = K::M('card/fans')->detail($id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }else if($this->checksubmit('data')){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{
				
				$mid = $id = $this->GP('mid');
				$mdata = $this->GP('mdata');
				K::M('card/appmember')->update($mid,$mdata);
                if(K::M('card/fans')->update($id, $data)){

                    $this->err->add('修改内容成功');
                }  
            } 
        }else{
			//获取详细资料
			$openid = $detail['openid'];
			$uniacid = $detail['uniacid'];
			$member = K::M('card/appmember')->find("openid='$openid' and uniacid='$uniacid'");
			if(!$member){
					$insert = [
						'openid'=>$openid,
						'uniacid'=>$uniacid,
					];
				$member['id'] = K::M('card/appmember')->create($insert);

			}
			$this->pagedata['member'] =$member;
        	$this->pagedata['detail'] = $detail;
        	$this->tmpl = 'admin:card/fans/edit.html';
        }
    }

    public function delete($id=null)
    {
		if($id = (int)$id){
            if($guan = K::M('card/fans')->detail($id)){
            	if(K::M('card/fans')->delete($id)){
                    $this->err->add('删除场馆成功');
                }
            }
        }else if($ids = $this->GP('id')){
            if($items = K::M('card/fans')->items_by_ids($ids)){
                $aids = $ids = array();
                foreach($items as $v){
                    
                    $aids[$v['id']] = $v['id'];
                }
                if($aids && K::M('card/fans')->delete($aids)){
                    $this->err->add('批量删除成功');
                }
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

	public function cardinfo($id=null)
	{
		if(!($id = (int)$id) && !($id = $this->GP('id'))){
			$this->err->add('未指定要修改的内容ID', 211);
		}else if(!$detail = K::M('card/fans')->detail($id)){
			$this->err->add('您要修改的内容不存在或已经删除', 212);
		}else{
			$openid = $detail['openid'];
			$uniacid = $detail['uniacid'];
			$card = K::M('card/card')->find("openid='$openid' and uniacid='$uniacid'");
			$this->pagedata['detail'] = $card;
			$this->tmpl = 'admin:card/fans/cardinfo.html';
		}
	}

}