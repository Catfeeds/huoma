<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: select.ctl.php 3304 2015-02-14 11:01:43  xinghuali
 */
Import::C('member/ucenter');
class Ctl_Member_Select extends Ctl_Ucenter
{
	
	public function index()
	{

	}

	public function home($page=1)
	{
        $filter = $pager = $params = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 10;
        $pager['city_id'] = (int)$this->GP('city_id');
        $pager['multi'] = $params['multi'] = $multi = ($this->GP('multi') == 'Y' ? 'Y' : 'N');
        if($SO = $this->GP('SO')){
            if($SO['area_id']){
            	$filter['area_id'] = $SO['area_id'];
       		}else if($pager['city_id']){
                $SO['city_id'] = $params['city_id'] = $filter['city_id'] = $pager['city_id'];
            }else if($SO['city_id']){
       			$filter['city_id'] = $SO['city_id'];
       		}
            if($SO['name']){$filter['name'] = "LIKE:%".$SO['name']."%";}
            $params['SO'] = $pager['SO'] = $SO;
        }
        $filter['closed'] = 0;
        if($items = K::M('home/main')->items($filter, null, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), $params);
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['city_list'] = K::M("data/city")->fetch_all();
        $this->pagedata['area_list'] = K::M("data/area")->fetch_all();
        $this->tmpl = 'view:select/home.html'; 
	}

	public function company($page=null)
	{
        $filter = $pager = $params = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 10;
        $pager['city_id'] = (int)$this->GP('city_id');
        $pager['multi'] = $params['multi'] = $multi = ($this->GP('multi') == 'Y' ? 'Y' : 'N');
        if($SO = $this->GP('SO')){
            if($SO['area_id']){
                $filter['area_id'] = $SO['area_id'];
            }else if($pager['city_id']){
                $SO['city_id'] = $params['city_id'] = $filter['city_id'] = $pager['city_id'];
            }else if($SO['city_id']){
                $filter['city_id'] = $SO['city_id'];
            }
            if($SO['name']){$filter['name'] = "LIKE:%".$SO['name']."%";}
            $params['SO'] = $pager['SO'] = $SO;
        }
        $filter['closed'] = 0;
        if($items = K::M('company/company')->items($filter, null, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pager'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), $params);
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['city_list'] = K::M("data/city")->fetch_all();
        $this->pagedata['area_list'] = K::M("data/area")->fetch_all();
        $this->tmpl = 'view:select/company.html'; 
	}

    /**
     * 需要传递小区ID
     */
	public function huxing($home_id, $page=1)
	{

        if(!($home_id = (int)$home_id) && !($home_id = (int)$this->GP('home_id'))){
            $this->err->add('未指定户型图的小区', 211);
        }else if(!$home = K::M('home/main')->detail($home_id)){
            $this->err->add('指定的小区不存在或已经删除', 211);
        }else{
            $filter = $pager = array();
            $pager['page'] = max(intval($page), 1);
            $pager['limit'] = $limit = 10;
            $pager['multi'] = $params['multi'] = $multi = ($this->GP('multi') == 'Y' ? 'Y' : 'N');
            $filter['home_id'] = $home_id;
            $filtre['type'] = 1;
            if($items = K::M('home/pics')->items($filter, null, $page, $limit, $count)){
                $pager['count'] = $count;
                $pager['pager'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array($home_id, '{page}')), $params);
                $this->pagedata['items'] = $items;
            }
            $this->pagedata['home'] = $home;
            $this->pagedata['pager'] = $pager;
            $this->tmpl = 'view:select/huxing.html';
        }
	}
}