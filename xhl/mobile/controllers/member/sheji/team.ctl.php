<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: zhantai.ctl.php  2016-01-12 22:07:36  xinghuali
 */

class Ctl_Member_Sheji_Team extends Ctl_Ucenter
{
    /*
     * 团队
     */
    public function index(){
        $designer = $this->ucenter_designer();
        $filt['uid'] = $designer['uid'];
        $page = 1;
        if($this->GP('page')){
            $page = $this->GP('page');
        }
        if($this->GP('id')){
            $filt['xiangmu_id'] = $this->GP('id');
        }
        $items = K::M('xiangmu/xiangmuteam')->items($filt, null, $page, 100);

        $this->system->config->load(array("site", "bulletin", "attach"));
        $attachurl =  Mdl_System_Config::$_CFG["attach"]["attachurl"];
        foreach($items as $k => $v){
            $items[$k]['team_task'] = mb_substr(strip_tags($v['team_task']), 0, 15, 'UTF-8') . '...';
            $items[$k]['team_img'] = $attachurl.'/'.$items[$k]['team_img'];
        }
        $info['error'] = 0;
        $info['info'] = $items;
        $this->ajaxReturn($info);
//        $this->tmpl = 'member/sheji/team/team.html';
    }
//    public function team($xiangmu_id= null){
//        $designer = $this->ucenter_designer();
//        if (!($xiangmu_id = (int) $xiangmu_id) && !($xiangmu_id = (int)$this->GP('xiangmu_id'))) {
//            $this->err->add('未指定合法的内容ID', 211);
//        } elseif (!$detail = K::M('xiangmu/xiangmu')->detail($xiangmu_id)) {
//            $this->err->add('您要修改的内容不存在或已经删除', 212);
//        } elseif ($detail['uid'] != $designer['uid']) {
//            $this->err->add('不许越权管理别人的内容', 212);
//        } else {
//            $filt['xiangmu_id'] = $xiangmu_id;
//            if ($items = K::M('xiangmu/xiangmuteam')->items($filt, null, 1, 100)) {
//                $this->pagedata['items'] = $items;
//            }
//            $this->pagedata['xiangmu_id'] = $xiangmu_id;
//            $this->tmpl = 'member/sheji/team/team.html';
//        }
//    }
    /*
     * 团队添加
     */
    public function teamadd(){
        $designer = $this->ucenter_designer();
        if($data = $this->checksubmit('data')){
            if ($_FILES['data']) {
                foreach ($_FILES['data'] as $k => $v) {
                    foreach ($v as $kk => $vv) {
                        $attachs[$kk][$k] = $vv;
                    }
                }
                $cfg = K::$system->config->get('attach');
                $oImg = K::M('image/gd');
                $upload = K::M('magic/upload');
                foreach ($attachs as $k => $attach) {
                    if ($attach['error'] == UPLOAD_ERR_OK) {
                        if ($a = $upload->upload($attach, 'company')) {
                            $data[$k] = $a['photo'];
                            if ($k === 'logo') {
                                $size['photo'] = $cfg['company']['logo'] ? $cfg['company']['logo'] : '200X100';
                            } else {
                                $size['photo'] = $cfg['company']['thumb'] ? $cfg['company']['thumb'] : '300X300';
                            }
                            $oImg->thumbs($a['file'], array($size['photo'] => $a['file']));
                        }
                    }
                }
            }
            $data['uid'] = $designer['uid'];
            if(K::M('xiangmu/xiangmuteam')->create($data)){
                $this->err->add('添加团队人员成功');
                $this->err->set_data('forward', $this->mklink('member/sheji/team:index'));
            }
        }else{
            $this->tmpl = 'member/sheji/team/teamcreate.html';
        }
    }
    public function lists($xiangmu_id = NULL){

        $designer = $this->ucenter_designer();
        if(!$detail = K::M('xiangmu/xiangmu')->detail($xiangmu_id)) {
            $this->err->add('工程案例不存在或已经删除', 211);
        }else if ($detail['uid'] != $designer['uid']) {
            $this->err->add('不许越权管理别人的内容', 213);
        }elseif ($data = $this->checksubmit('teamid')) {
            $olduid = $detail['teamid'];
            $filt['uid'] = $designer['uid'];
            $items = K::M('xiangmu/xiangmuteam')->items($filt, null, 1, 100);
            $teamarr = array();
            foreach ($items as $k=>$v){
                $teamarr[] = $v['team_id'];
            }
            $teamid = $this->GP('teamid');
            $error = 0;
            foreach ($teamid as $v){
                if(!in_array($v,$teamarr)){
                    $error = 1;
                    break;
                }
            }
            if($error){
                $this->err->add('选中人员数据有误', 213);
            }
            $teamidstr = implode(',',$teamid);
            if($olduid == ''){
                $datas['teamid'] = $teamidstr;
            }else{
                $datas['teamid'] = $olduid.','.$teamidstr;
            }
            if(K::M('xiangmu/xiangmu')->update($xiangmu_id, $datas)){
                $this->err->set_data('forward', $this->mklink('member/sheji/zhantai:teamlist', array($xiangmu_id)));
                $this->err->add('添加团队成功');
            }else{
                $this->err->set_data('forward', $this->mklink('member/sheji/zhantai:teamlist', array($xiangmu_id)));
                $this->err->add('添加团队失败',121);
            }
        }else{
            $uid = $detail['teamid'];
            $uidarr = explode(',',$uid);
            $filt['uid'] = $designer['uid'];
            $items = K::M('xiangmu/xiangmuteam')->items($filt, null, 1, 100);
            $teamarr = array();
            foreach ($items as $k=>$v){
                $teamarr[] = $v['team_id'];
            }
            $filts['team_id'] = $arr = array_diff($teamarr,$uidarr);
            $item = K::M('xiangmu/xiangmuteam')->items($filts, null, 1, 100);

            $this->system->config->load(array("site", "bulletin", "attach"));
            $attachurl =  Mdl_System_Config::$_CFG["attach"]["attachurl"];
            foreach($item as $k => $v){
                $item[$k]['team_task'] = mb_substr(strip_tags($v['team_task']), 0, 15, 'UTF-8') . '...';
                $item[$k]['team_img'] = $attachurl.'/'.$item[$k]['team_img'];
            }
            $info['error'] = 0;
            $info['info'] = $item;
            $this->ajaxReturn($info);
        }
    }
    public function teamlist($xiangmu_id=null){
        $designer = $this->ucenter_designer();
        if(!$detail = K::M('xiangmu/xiangmu')->detail($xiangmu_id)) {
            $this->err->add('工程案例不存在或已经删除', 211);
        }else if ($detail['uid'] != $designer['uid']) {
            $this->err->add('不许越权管理别人的内容', 213);
        }else{
            $teamidarr = explode(',',$detail['teamid']);
            $filt['team_id'] = $teamidarr;
            if ($items = K::M('xiangmu/xiangmuteam')->items($filt, null, 1, 100)) {
                $this->pagedata['items'] = $items;
            }
            $this->system->config->load(array("site", "bulletin", "attach"));
            $attachurl =  Mdl_System_Config::$_CFG["attach"]["attachurl"];
            foreach($items as $k => $v){
                $items[$k]['team_task'] = mb_substr(strip_tags($v['team_task']), 0, 15, 'UTF-8') . '...';
                $items[$k]['team_img'] = $attachurl.'/'.$items[$k]['team_img'];
            }
            $info['error'] = 0;
            $info['info'] = $items;
            $this->ajaxReturn($info);
            $this->pagedata['xiangmu_id'] = $xiangmu_id;
            $this->tmpl = 'member/sheji/team/team.html';
        }
    }
    public function delete($team_id){
        $designer = $this->ucenter_designer();
        if (!($team_id = (int) $team_id) && !($team_id = (int)$this->GP('photo_id'))) {
            $this->ajaxReturn(array('error'=>1,'message'=>"团队不存在或已经删除"));
            $this->error(404);
        }else if(!$detail = K::M('xiangmu/xiangmuteam')->detail($team_id)) {
            $this->ajaxReturn(array('error'=>211,'message'=>"团队不存在或已经删除"));
            $this->err->add('团队不存在或已经删除', 211);
        }else if ($detail['uid'] != $designer['designer_id']) {
            $this->ajaxReturn(array('error'=>213,'message'=>"不许越权管理别人的内容"));
            $this->err->add('不许越权管理别人的内容', 213);
        } else{
            if(K::M('xiangmu/xiangmuteam')->delete($team_id)){
                $this->ajaxReturn(array('error'=>0,'message'=>"删除团队成功"));
                $this->err->add('删除团队成功');
            }
        }
    }
    public function edit($team_id){
        $designer = $this->ucenter_designer();
        if (!($team_id = (int) $team_id) && !($team_id = (int)$this->GP('photo_id'))) {
            $this->error(404);
        }else if(!$detail = K::M('xiangmu/xiangmuteam')->detail($team_id)) {
            $this->err->add('工程案例不存在或已经删除', 211);
        }else if ($detail['uid'] != $designer['designer_id']) {
            $this->err->add('不许越权管理别人的内容', 213);
        } else if ($data = $this->checksubmit('data')) {
            if ($_FILES['data']) {
                foreach ($_FILES['data'] as $k => $v) {
                    foreach ($v as $kk => $vv) {
                        $attachs[$kk][$k] = $vv;
                    }
                }
                $cfg = K::$system->config->get('attach');
                $oImg = K::M('image/gd');
                $upload = K::M('magic/upload');
                foreach ($attachs as $k => $attach) {
                    if ($attach['error'] == UPLOAD_ERR_OK) {
                        if ($a = $upload->upload($attach, 'company')) {
                            $data[$k] = $a['photo'];
                            if ($k === 'logo') {
                                $size['photo'] = $cfg['company']['logo'] ? $cfg['company']['logo'] : '200X100';
                            } else {
                                $size['photo'] = $cfg['company']['thumb'] ? $cfg['company']['thumb'] : '300X300';
                            }
                            $oImg->thumbs($a['file'], array($size['photo'] => $a['file']));
                        }
                    }
                }
            }

            if (K::M('xiangmu/xiangmuteam')->update($team_id, $data)) {
                $this->err->set_data('forward', $this->mklink('member/sheji/team:index', array($team_id)));
                $this->err->add('修改内容成功');
            }
        }else{
            if($detail['team_img']){
                $this->system->config->load(array("site", "bulletin", "attach"));
                $attachurl =  Mdl_System_Config::$_CFG["attach"]["attachurl"];
                $detail['team_img'] = $attachurl."/".$detail['team_img'];
            }
            $info['detail'] = $detail;
            $info['team_id'] = $team_id;
            $info['error'] = 0;
            $this->ajaxReturn($info);
        }
    }
}