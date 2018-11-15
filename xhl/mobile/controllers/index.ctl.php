<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: index.ctl.php 2335 2015-11-18 17:15:56  xinghuali
 */
class Ctl_Index extends Ctl
{ 
    public function index()
    {
        
        $filter = array();
        $filter['closed'] = 0;
        $filter['audit'] = 1;
        $page = 1;
        if($this->GP('page')){
            $page = $this->GP('page');
        }
        if($this->GP('cat_id')){
            $filter['cat_id'] = $this->GP('cat_id');
        }
        if($this->GP('keywords')){
            $filter['title'] = "LIKE:%".$this->GP('keywords')."%";
        }
        if ($project = K::M('xiangmu/xiangmu')->items($filter, array('xiangmu_id'=>'DESC'), $page, 10)) {
            foreach($project as $k => $v){
                $project[$k]['desc'] = mb_substr($v['desc'], 0, 24, 'UTF-8') . '...';
                $project[$k]['title'] = mb_substr($v['title'], 0, 9, 'UTF-8') . '';
                $project[$k]['dateline'] = date('Y-m-d',$v['dateline']);
            }
            $this->pagedata['project'] = $project;
        }

        $act = $this->GP('ajax');
        if($act == '1'){
            $this->system->config->load(array("site", "bulletin", "attach"));
            $attachurl =  Mdl_System_Config::$_CFG["attach"]["attachurl"];
            $res = array(
                'info' =>$project,
                'attachurl' => $attachurl
            );
            $this->ajaxReturn($res);
        }
        Header("HTTP/1.1 301 Moved Permanently");
        Header("Location: /www");
        $this->pagedata['page_time'] = __TIME.rand(100000,9999999);
        $this->pagedata['selected_id'] = '1';
        $this->tmpl = 'mobile:index/index.html';
    }
    public function follow_project()
    {
        $filter = array();
        $filter['closed'] = 0;
        $filter['audit'] = 1;
        $page = 1;
        $member = $this->MEMBER;
        $map = array(
            'uid'=>$member['uid'],
            'type'=>1
        );
        $follow_project = K::M('xiangmu/sheji')->get_all($map);
        $ids = "";
        foreach($follow_project as $k=>$v){
            $ids .= $ids?",":"";
            $ids .= $v['xiangmu_id'];
        }
        if($ids){
            $filter['xiangmu_id']=array(
                'in'=>$ids
            );
        }
        if($this->GP('page')){
            $page = $this->GP('page');
        }
        if($this->GP('cat_id')){
            $filter['cat_id'] = $this->GP('cat_id');
        }
        if($this->GP('keywords')){
            $filter['title'] = "LIKE:%".$this->GP('keywords')."%";
        }
        if ($project = K::M('xiangmu/xiangmu')->items($filter, array('xiangmu_id'=>'DESC'), $page, 8)) {
            foreach($project as $k => $v){
                $project[$k]['desc'] = mb_substr($v['desc'], 0, 27, 'UTF-8') ;
                if(strlen($project[$k]['desc']) > 27){
                    $project[$k]['desc'] .= '...';
                }
                $project[$k]['title'] = mb_substr($v['title'], 0, 9, 'UTF-8');
            }
        }

        $this->system->config->load(array("site", "bulletin", "attach"));
        $attachurl =  Mdl_System_Config::$_CFG["attach"]["attachurl"];
        $res = array(
            'info' =>$project,
            'attachurl' => $attachurl
        );
        $this->ajaxReturn($res);
    }
}


