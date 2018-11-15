<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: index.ctl.php 2335 2015-11-18 17:15:56  xinghuali
 */
class Ctl_Project extends Ctl
{ 
    public function index($xiangmu_id=0)
    {
        $filter = array();
        $filter['closed'] = 0;
        if($xiangmu_id){
            $filter['xiangmu_id'] = $xiangmu_id;
        }
        $page = 1;
        if($this->GP('page')){
            $page = $this->GP('page');
        }
        if($this->GP('keywords')){
            $filter['project_title'] = "LIKE:%".$this->GP('keywords')."%";
        }
        if($class = $this->GP('project_class')){
            switch($class){
                case 'day':
                    $filter['project_dateline'] = ">:".(__TIME - 60*60*24);//每天
                    break;
                case 'week':
                    $filter['project_dateline'] = ">:".(__TIME - 60*60*24*7);//每周
                    break;
                case 'month':
                    $filter['project_dateline'] = ">:".(__TIME - 60*60*24*30);//每月
                    break;
                default:
                    break;
            }
        }
        $project = K::M('project/project')->items_by_attr($filter, array('project_id'=>'DESC'), $page, 10);
        foreach($project as $k => $v){
            $project[$k]['project_content'] = mb_substr(strip_tags($v['project_content']), 0, 24, 'UTF-8') . '...';
            $project[$k]['favorites'] = $v['favorites']?$v['favorites']:0;
            $project[$k]['comments'] = $v['comments']?$v['comments']:0;
        }

        $this->system->config->load(array("site", "bulletin", "attach"));
        $attachurl =  Mdl_System_Config::$_CFG["attach"]["attachurl"];
        $res = array(
            'info' =>$project,
            'attachurl' => $attachurl
        );
        $this->ajaxReturn($res);

    }

    public function detail($project_id){
        $detail = K::M('project/project')->detail($project_id);
        $detail['desc_desc'] = mb_substr(strip_tags($detail['desc']), 0, 24, 'UTF-8') . '...';
        $this->system->config->load(array("site", "bulletin", "attach"));
        $detail["attachurl"] =  Mdl_System_Config::$_CFG["attach"]["attachurl"];
        K::M('xiangmu/xiangmu') -> update($detail['xiangmu_id'],array('views'=>intval($detail['views'])+1),true);
//        $this->dump($detail);
        $this->ajaxReturn($detail);
    }

    public function comment(){
        $id = $this->GP('id');
        $page = $this->GP('page') ? $this->GP('page') : 1;
        $count = 0;
        $comment = K::M('xiangmu/comment')->items_by_xiangmu($id, $page, 8, $count);
        $uids = array();
        foreach($comment as $v){
            $uids[$v['uid']] = $v['uid'];
        }
        if($uids){
            $user_list = K::M('member/member')->items_by_ids($uids);
        }
        foreach($comment as $k => $v){
            $comment[$k]['uname'] = $user_list[$v['uid']]['uname']?$user_list[$v['uid']]['uname']:'匿名';
            $comment[$k]['date'] = date('Y.m.d',$v['dateline']);
        }
        $this->ajaxReturn($comment);
    }

    public function info($project_id){
        $info = K::M('project/project')->info($project_id);
        $this->ajaxReturn($info);
    }
}


