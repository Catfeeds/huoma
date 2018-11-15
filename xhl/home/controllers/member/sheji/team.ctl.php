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
        if ($items = K::M('xiangmu/xiangmuteam')->items($filt, null, 1, 100)) {
            $this->pagedata['items'] = $items;
        }
        $this->tmpl = 'member/sheji/team/team.html';
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
    public function delete($team_id){
       $designer = $this->ucenter_designer();
        if (!($team_id = (int) $team_id) && !($team_id = (int)$this->GP('photo_id'))) {
            $this->error(404);
        }else if(!$detail = K::M('xiangmu/xiangmuteam')->detail($team_id)) {
            $this->err->add('工程案例不存在或已经删除', 211);
        }else if ($detail['uid'] != $designer['designer_id']) {
            $this->err->add('不许越权管理别人的内容', 213);
        } else{
            if(K::M('xiangmu/xiangmuteam')->delete($team_id)){
                $this->err->add('删除人员成功');
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
            $this->pagedata['detail'] = $detail;
            $this->pagedata['edit'] = true;
            $this->pagedata['team_id'] = $team_id;
            $this->tmpl = 'member/sheji/team/teamcreate.html';
        }
    }
}