<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author xinghuali<xinghuali@126.com>
 * $Id: admin.ctl.php 2016-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Admin_Admin extends Ctl
{
	
	public function index($page=1)
	{
		$pager['page'] = $page = max(intval($page), 1);
		$pager['limit'] = $limit = 50;
		$pager['count'] = $count = 0;
		if($items = K::M('admin/view')->items(null, null, $page, $limit, $count)){
			$pager['count'] = $count;
			$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
			$this->pagedata['items'] = $items;
		}
		
		$this->pagedata['role_list'] = K::M('admin/role')->fetch_all();
		$this->pagedata['pager'] = $pager;
		$this->tmpl = 'admin:admin/admin/index.html';
	}

	public function create()
	{
		if($this->admin->role['role'] == 'editor'){
			$this->err->add('您没有权限创建或修改管理员',201);
		}else{ 
			$this->pagedata['role_list'] = K::M('admin/role')->fetch_all();
			$this->tmpl = 'admin:admin/admin/detail.html';
		}
	}

	public function edit($ID)
	{
		if($this->admin->role['role'] == 'editor'){
			$this->err->add('您没有权限创建或修改管理员',201);
		}else if(!$ID = intval($ID)){
			$this->err->add('没有指定要修改的管理员',202);
		}else if(!$detail = K::M('admin/view')->admin($ID)){
			$this->err->add('你要修改的管理员不存在或已经删除',201);
		}else{
			$this->pagedata['detail'] = $detail;
			$this->pagedata['role_list'] = K::M('admin/role')->fetch_all();
			$this->tmpl = 'admin:admin/admin/detail.html';
		}
	}

	public function save()
	{
		if($this->admin->admin['role'] == 'editor'){
			$this->err->add('您没有权限创建或修改管理员',201);
		}else if(!$data = $this->GP('data')){
			$this->err->add('非法的数据提交',202);
		}else if($ID = $this->GP('admin_id')){
			if(empty($data['passwd'])){
				unset($data['passwd']);
			}
			if(K::M('admin/handler')->update($ID, $data)){
				$this->err->add('修改管理员成功');
			}
		}else if(K::M('admin/handler')->create($data)){
			$this->err->add('添加管理员成功');
		}
	}

    public function delete($admin_id)
    {
        if(!empty($admin_id)){
            if(K::M('admin/handler')->delete($admin_id, true)){
                $this->err->add('删除管理员成功');
            }
        }else if($pks = $this->GP('admin_id')){
            if(K::M('admin/handler')->delete($pks, true)){
                $this->err->add('批量删除管理员成功');
            }
        }else{
            $this->err->add('未指定要删除的管理员ID', 401);
        }
    }
	
	    public function dialog($role_id=8,$page=1)
    {
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 10;
        $pager['multi'] = $multi = ($this->GP('multi') == 'Y' ? 'Y' : 'N');
        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['uid']){$filter['uid'] = $SO['uid'];}
            if($SO['uname']){$filter['uname'] = "LIKE:%".$SO['uname']."%";}
            if($SO['mail']){$filter['mail'] = "LIKE:%".$SO['mail']."%";}
            if($SO['mobile']){$filter['mobile'] = "LIKE:%".$SO['mobile']."%";}
            if($SO['realname']){$filter['realname'] = "LIKE:%".$SO['realname']."%";}
            if($SO['regip']){$filter['regip'] = "LIKE:%".$SO['regip']."%";}
            if($SO['closed']){
                $filter['closed'] = $SO['closed'];
            }else{
                $filter['closed'] = array(0, 1, 2);
            }
            if(is_array($SO['lastlogin'])){if($SO['lastlogin'][0] && $SO['lastlogin'][1]){$a = strtotime($SO['lastlogin'][0]); $b = strtotime($SO['lastlogin'][1]);$filter['lastlogin'] = $a."~".$b;}}
            if(is_array($SO['dateline'])){if($SO['dateline'][0] && $SO['dateline'][1]){$a = strtotime($SO['dateline'][0]); $b = strtotime($SO['dateline'][1]);$filter['dateline'] = $a."~".$b;}}
        }
		if($role_id==8){
			$filter['role_id'] = $role_id;
		}else{
			$filter['role_id'] = $role_id;
		}
        if($items = K::M('admin/base')->items($filter, null, $page, $limit, $count)){
			if($role_id==8){
				$items[10] =   array ( 	'admin_id' => 10,
										'admin_name' => 'wang',
										'realname' => '王杰',
										'mobile' => '18612274488',
										'qq' => '2850505055',
										'role_id' => 8 ,
										'closed' => 0
									);
			}
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array($from,'{page}')), array('SO'=>$SO, 'multi'=>$multi));
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:admin/admin/dialog.html';   
    }

}