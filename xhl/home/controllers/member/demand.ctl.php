<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: index.ctl.php  2015-11-26 06:32:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Member_Demand extends Ctl_Ucenter
{
    public function index($page=0)
    {
        if(!$page){
            $page = $this->GP('page');
        }
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 10;
        $pager['count'] = $count = 0;
        $filter = array('uid'=>$this->MEMBER['uid']);
        $orderby = array('id'=>'DESC');
        if ($items = K::M('demand/demand')->items($filter, $orderby, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('member/demand-index','{page}', $params));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;
        $this->tmpl='member/demand/demand.html';
    }

    //添加需求
    public function add()
    {
        $designer = $this->ucenter_designer();
        if($data = $this->checksubmit('data')){
            Import::L('from/rule.class.php');
            $from = new rule($data,$this->__rulearray());
            $val = $from->dorule();
            if(!$val){
                $this->err->add('数据错误',111);
            }elseif($this->GP('label')==false){
                $this->err->add('请选择标签',11);
            }else{
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
                $data['uname'] = $designer['uname'];
                $data['addtime'] = time();
                $data['label'] = implode(',',$this->GP('label'));
                if(K::M('demand/demand')->add($data)){
                    $this->err->add('添加需求文案成功');
                    $this->err->set_data('forward', $this->mklink('member/demand:index'));
                }
            }
        }else{
            $arr = array('level'=>1,'hidden'=>0);
            $this->pagedata['tree'] = K::M('xiangmu/cate')->items($arr);
            $this->pagedata['label'] = K::M('label')->items(array('type'=>1,'state'=>1));
            $this->tmpl='member/demand/add.html';
        }
    }

    public function edit($id)
    {
        $designer = $this->ucenter_designer();
        if(!$info = K::M('demand/demand')->detail($id)){
            $this->err->add('未找到该需求',11);
        }elseif ($info['uid']!=$designer['uid']){
            $this->err->add('您不是该需求归属者',12);
        }elseif($data = $this->checksubmit('data')){
            Import::L('from/rule.class.php');
            $from = new rule($data,$this->__rulearray());
            $val = $from->dorule();
            if(!$val){
                $this->err->add('数据错误',111);
            }elseif(!$label = $this->GP('label')){
                $this->err->add('请选择标签',11);
            }else{
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
                $data['uname'] = $designer['uname'];
                $data['addtime'] = time();
                $data['label'] = implode(',',$this->GP('label'));
                if(K::M('demand/demand')->update($id,$data,true)){
                    $this->err->add('修改需求文案成功');
                    $this->err->set_data('forward', $this->mklink('member/demand:index'));
                }
            }
        }else{
            $arr = array('level'=>1,'hidden'=>0);
            $this->pagedata['tree'] = K::M('xiangmu/cate')->items($arr);
            $this->pagedata['label'] = K::M('label')->items(array('type'=>1,'state'=>1));
            $info['label'] = explode(',',$info['label']);
            $this->pagedata['detail'] = $info;
            $this->pagedata['edit'] = $id;
            $this->pagedata['id'] = $id;
            $this->tmpl='member/demand/add.html';
        }
    }
    private function __rulearray(){
        return array(
            'title'=>array('required',2=>'min_length',15=>'max_length'),
            'money'=>array('required'),
            'demandtype'=>array('required','integer'),
//            'label'=>array('required'),
            'content'=>array('required')
        );
    }
}