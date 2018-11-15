<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: widget.php 5454 2015-06-11 05:17:35Z xinghuali $
 */

class Widget_Public extends Model
{

    public function help(&$params)
    {   
        $data['cate_list']      = K::M('article/cate')->fetch_all();
        $data['content_list']   = K::M('article/article')->items(array('from'=>'help','closed'=>0),array('article_id'=>'ASC'),1,50);
        $params['tpl'] = $params['tpl'] ? $params['tpl']: 'help.html';
        return $data;
    }

    public function kefu(&$params)
    {           
        $params['tpl'] =  $params['tpl'] ? $params['tpl'] : 'kefu.html';
        return true;
    }

    public function share(&$params)
    {
        $params['tpl'] =  $params['tpl'] ? $params['tpl'] : 'share.html';
        return $params;     
    }

    public function sobox(&$params)
    {
        $params['tpl'] =  $params['tpl'] ? $params['tpl'] : 'sobox.html';
        $request = K::$system->request;
        //$all_sotype = array('gs'=>array('ctl'=>'gs:items', 'title'=>'工厂'), 'qiye/store'=>array('ctl'=>'qiye/store','title'=>'企业'), 'product'=>array('ctl'=>'qiye/product','title'=>'商品'), 'designer'=>array('ctl'=>'designer:items','title'=>'设计师'), 'mechanic'=>array('ctl'=>'mechanic:items','title'=>'技工'), 'case'=>array('ctl'=>'case:items', 'title'=>'搜案例'), 'home'=>array('ctl'=>'home:items','title'=>'小区'), 'site'=>array('ctl'=>'home:items','title'=>'工地'), 'home:tuan'=>array('ctl'=>'home:tuan','title'=>'团装'), 'article'=>array('ctl'=>'article:items','title'=>'学装修'));
		$all_sotype = array('gs'=>array('ctl'=>'gs:items', 'title'=>'工厂'), 'designer'=>array('ctl'=>'designer:items','title'=>'设计师'),'case'=>array('ctl'=>'case:items', 'title'=>'搜案例'), 'home'=>array('ctl'=>'home:items','title'=>'展会'), 'article'=>array('ctl'=>'article:items'));
        
        if($a = $sotype[$request['ctl'].':'.$request['act']]){            
        }else if($request['ctl'] == 'qiye/store'){
            $a = array('ctl'=>'qiye/store','title'=>'企业');
        }else if(strpos($request['ctl'], 'mall') !== false){
            $a = array('ctl'=>'qiye/product','title'=>'商品');
        }else if(!$a = $sotype[$request['ctl']]){
            $a = array('ctl'=>'gs:items','title'=>'工厂');
        }
		
//		else if(strpos($request['ctl'], 'article') !== false){
//            $a = array('ctl'=>'article:items','title'=>'学装修');
//        }
        $data['all_sotype'] = $all_sotype;
        $data['sotype'] = $a;
        return $data;
    }
}