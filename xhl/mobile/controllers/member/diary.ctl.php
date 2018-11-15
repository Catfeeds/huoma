<?php

Import::C('member/ucenter');

class Ctl_Member_Diary extends Ctl_Ucenter {

    protected $_diary_allower_fields = 'title,home_id,face_pic,company_id,type_id,way_id,total_price,start_date,end_date';
    protected $_diary_detail_allower_fields = '';

    public function index() {
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 10;
        $filter['uid'] = $this->uid;
        if ($items = K::M('diary/diary')->items($filter, null, $page, $limit, $count)) {
            foreach ($items as $k => $v) {
                if ($v['home_id']) {
                    $home_ids[$v['home_id']] = $v['home_id'];
                }
                if ($v['company_id']) {
                    $company_ids[$v['company_id']] = $v['company_id'];
                }
                $items[$k]['create_ip'] = $v['create_ip'] . '(' . K::M("misc/location")->location($v['create_ip']) . ')';
            }
            if (!empty($home_ids)) {
                $this->pagedata['home_list'] = K::M('home/main')->items_by_ids($home_ids);
            }
            if (!empty($company_ids)) {
                $this->pagedata['company_list'] = K::M('company/company')->items_by_ids($company_ids);
            }
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}'), array(), true), array());
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['status'] = K::M('home/site')->get_status();
        $this->tmpl = 'member/diary/index.html';
    }

    public function create() {
        if(K::M('system/integral')->check('diary',  $this->MEMBER) === false){
            $this->err->add('很抱歉您的账户余额不足！', 201);
        }
        elseif ($audit = K::M('system/audit')->audit('diary', $this->MEMBER) == -1) {
            $this->err->add('很抱歉您所在的用户组没有权限操作', 201);
        } elseif ($data = $this->checksubmit('data')) {
            if (!$data = $this->check_fields($data, $this->_diary_allower_fields)) {
                $this->err->add('非法的数据提交', 201);
            } else {
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
                            if ($a = $upload->upload($attach, 'diary')) {
                                $data[$k] = $a['photo'];

                                $size['photo'] = $cfg['diary']['photo'] ? $cfg['diary']['photo'] : 200;
                                $oImg->thumbs($a['file'], array($size['photo'] => $a['file']));
                            }
                        }
                    }
                }
                $data['city_id'] = $this->request['city_id'];
                $data['uid'] = $this->uid;
                $data['audit'] = $audit;
                $data['create_ip'] = __IP;
                $data['dateline'] = __TIME;
                if ($diary_id = K::M('diary/diary')->create($data)) {
                    K::M('system/integral')->commit('diary',  $this->MEMBER,'发布日记');
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward', $this->mklink('member/diary:detail', array($diary_id), array(), true));
                }
            }
        } else {
            $this->pagedata['status'] = K::M('home/site')->get_status();
            $this->pagedata['setting'] = K::M('tenders/setting')->fetch_all_setting();
            $this->pagedata['type'] = K::M('tenders/setting')->get_type();
            $this->tmpl = 'member/diary/create.html';
        }
    }

    public function detail($diary_id = null, $page = 1) {
        if (!($diary_id = (int) $diary_id) && !($diary_id = (int)$this->GP('diary_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('diary/diary')->detail($diary_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } elseif ($detail['uid'] != $this->uid) {
            $this->err->add('不可以越权管理', 212);
        } else {
            $filter = $pager = array();
            $pager['page'] = max(intval($page), 1);
            $pager['limit'] = $limit = 10;
            $filter['diary_id'] = $diary_id;
            if ($items = K::M('diary/detail')->items($filter, null, $page, $limit, $count)) {
                $pager['count'] = $count;
                $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array($diary_id, '{page}')), array());
            }
            $this->pagedata['items'] = $items;
            $this->pagedata['pager'] = $pager;
            $this->pagedata['diary_id'] = $diary_id;
            $this->pagedata['diary'] = $detail;
            $this->pagedata['status'] = K::M('home/site')->get_status();
            $this->tmpl = 'member/diary/detail.html';
        }
    }

    public function detailCreate($diary_id = null) {
        if (!($diary_id = (int) $diary_id) && !($diary_id = (int)$this->GP('diary_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('diary/diary')->detail($diary_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } elseif ($detail['uid'] != $this->uid) {
            $this->err->add('不可以越权管理', 212);
        } else if ($this->checksubmit()) {
            if (!$data = $this->GP('data')) {
                $this->err->add('非法的数据提交', 201);
            } else {
                $data['diary_id'] = $diary_id;
                $data['create_ip'] = __IP;
                $data['dateline'] = __TIME;
                if ($detail_id = K::M('diary/detail')->create($data)) {
                    K::M('diary/diary')->update($diary_id, array('status' => $data['status'],'content_num'=>$detail['content_num']+1));
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward', $this->mklink('member/diary:detail', array($diary_id), array(), true));
                }
            }
        } else {
            $this->pagedata['diary_id'] = $diary_id;
            $this->pagedata['status'] = K::M('home/site')->get_status();
            $this->tmpl = 'member/diary/detailCreate.html';
        }
    }

    public function detailEdit($detail_id = null) {
        if (!($detail_id = (int) $detail_id) && !($detail_id = (int)$this->GP('detail_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('diary/detail')->detail($detail_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } else if (!$diary = K::M('diary/diary')->detail($detail['diary_id'])) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } elseif ($diary['uid'] != $this->uid) {
            $this->err->add('不可以越权管理', 212);
        } else if ($this->checksubmit('data')) {
            if (!$data = $this->GP('data')) {
                $this->err->add('非法的数据提交', 201);
            } else {
                $data['diary_id'] = $detail['diary_id']; //不允许传递值过来覆盖
                if (K::M('diary/detail')->update($detail_id, $data)) {
                    K::M('diary/diary')->update($detail['diary_id'], array('status' => $data['status']));
                    $this->err->add('修改内容成功');
                }
            }
        } else {
            $this->pagedata['status'] = K::M('home/site')->get_status();
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'member/diary/detailEdit.html';
        }
    }

    public function edit($diary_id = null) {
        if (!($diary_id = (int) $diary_id) && !($diary_id = (int)$this->GP('diary_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('diary/diary')->detail($diary_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } elseif ($detail['uid'] != $this->uid) {
            $this->err->add('不可以越权管理', 212);
        } else if ($data = $this->checksubmit('data')) {
            if (!$data = $this->check_fields($data, $this->_diary_allower_fields)) {
                $this->err->add('非法的数据提交', 201);
            } else {
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
                            if ($a = $upload->upload($attach, 'diary')) {
                                $data[$k] = $a['photo'];

                                $size['photo'] = $cfg['diary']['photo'] ? $cfg['diary']['photo'] : 200;
                                $oImg->thumbs($a['file'], array($size['photo'] => $a['file']));
                            }
                        }
                    }
                }
                if (K::M('diary/diary')->update($diary_id, $data)) {
                    $this->err->add('修改内容成功');
                }
            }
        } else {
            $this->pagedata['status'] = K::M('home/site')->get_status();
            $this->pagedata['setting'] = K::M('tenders/setting')->fetch_all_setting();
            $this->pagedata['type'] = K::M('tenders/setting')->get_type();
            $this->pagedata['detail'] = $detail;
            if ($company_id = $detail['company_id']) {
                $this->pagedata['company'] = K::M('company/company')->detail($company_id);
            }
            if ($home_id = (int) $detail['home_id']) {
                $this->pagedata['home'] = K::M('home/main')->detail($home_id);
            }

            $this->tmpl = 'member/diary/edit.html';
        }
    }

}
