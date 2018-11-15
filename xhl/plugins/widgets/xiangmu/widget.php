<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: widget.php 3129 2015-01-20 01:18:18  xinghuali
 */

class Widget_Xiangmu extends Model
{

    public function index(&$params)
    {
        
    }

	public function cate(&$params)
	{
		$params['tpl'] = 'cate_options.html';
		$data['value'] = $params['value'] ? $params['value'] : 0;
		$from = $params['from'] ? $params['from'] : null;
    	$data['tree'] = K::M('xiangmu/cate')->tree($from);
    	return $data;			
	}
    
    public function newitems(&$params){
        $data['limit'] = $params['limit'] ? $params['limit'] : 5;
        $filter['from'] = 'xiangmu';
        $filter['closed'] = 0;
        $xiangmu = K::M('xiangmu/view')->items($filter,array('xiangmu_id'=>'DESC') , 1,$data['limit']);
        $cates = K::M('xiangmu/cate')->fetch_all();
        foreach($xiangmu as $k=>$v){
            $xiangmu[$k]['cat_title'] = $cates[$v['cat_id']]['title'];
        }
        $data['xiangmu'] = $xiangmu;
        $params['tpl'] = 'newitems.html'; 
        return $data;
    }
    
    public function randitems(&$params){
        $data['limit'] = $params['limit'] ? $params['limit'] : 8;
        $filter['from'] = 'xiangmu';
        $filter['closed'] = 0;
        $count = K::M('xiangmu/view')->count(" `from`='xiangmu' AND closed=0 ");
        if($data['limit'] > $count){
             $xiangmu = K::M('xiangmu/view')->items($filter,array('xiangmu_id'=>'DESC') , 1,$data['limit']);
        }else{
             $page = rand(1,  ceil(($count-$data['limit'])/ $data['limit']));
             $xiangmu = K::M('xiangmu/view')->items($filter,array('xiangmu_id'=>'ASC') , $page,$data['limit']);
        }
       
        $cates = K::M('xiangmu/cate')->fetch_all();
        foreach($xiangmu as $k=>$v){
            $xiangmu[$k]['cat_title'] = $cates[$v['cat_id']]['title'];
        }
        $data['xiangmu'] = $xiangmu;
        $params['tpl'] = 'randitems.html'; 
        return $data;
    }
    
 

}