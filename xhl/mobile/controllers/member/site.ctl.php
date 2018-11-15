<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: site.ctl.php 3304 2015-02-14 11:01:43  xinghuali
 */

Import::C('member/ucenter');
class Ctl_Member_Site extends Ctl_Ucenter 
{

    protected $_site_create_allower_fields = 'area_id,home_id,title,addr,intro';
    protected $_notes_create_allower_fields = 'status,content';
    protected $_notes_edit_allower_fields = 'content';
    public function create()
    {
        $this->check_company();
         if(K::M('system/integral')->check('site',  $this->MEMBER) === false){
            $this->err->add('很抱歉您的账户余额不足！', 201);
        }
        elseif ($audit = K::M('system/audit')->audit('site', $this->MEMBER) == -1) {
            $this->err->add('很抱歉您所在的用户组没有权限操作', 201);
        } elseif ($data = $this->checksubmit('data')) {
            if (!$data = $this->check_fields($data, $this->_site_create_allower_fields)) {
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
                            if ($a = $upload->upload($attach, 'home')) {
                                $data[$k] = $a['photo'];

                                $size['photo'] = $cfg['site']['photo'] ? $cfg['site']['photo'] : 200;
                                $oImg->thumbs($a['file'], array($size['photo'] => $a['file']));
                            }
                        }
                    }
                }
                $data['company_id'] = $this->company['company_id'];
                $data['city_id'] = $this->company['city_id'];
                $data['dateline'] = __TIME;
                $data['create_ip'] = __IP;
                $data['audit'] = $audit;
                if ($site_id = K::M('home/site')->create($data)) {
                     if ($company_id = (int) $data['company_id']) {
                        K::M('company/company')->update_count($company_id, 'site_num', 1);
                        K::M('company/company')->update($company_id, array('site_time'=>__TIME));
                    }
                    if ($home_id = (int) $data['home_id']) {
                        K::M('home/main')->update_count($home_id, 'site_num', 1);
                    }
                    
                    K::M('system/integral')->commit('site',  $this->MEMBER,'发布工地');
                    $this->err->add('添加内容成功');
                    $this->err->set_data('forward', $this->mklink('member/site:index', array(), array(), true));
                }
            }
        } else {
            $this->tmpl = 'member/site/create.html';
        }
    }

    public function diary($site_id = null)
    {
        $this->check_company();
        if (!($site_id = (int) $site_id) && !($site_id = (int)$this->GP('site_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('home/site')->detail($site_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } elseif ($detail['company_id'] != $this->company['company_id']) {
            $this->err->add('小子皮又痒痒了么？', 212);
        } else {
            $filter['site_id'] = $site_id;

            $this->pagedata['status'] = K::M('home/site')->get_status();
            $this->pagedata['items'] = K::M('home/notes')->items($filter, null, 1, 50, $count);
            $this->pagedata['site_id'] = $site_id;
            $this->pagedata['site'] = $detail;
            $this->tmpl = 'member/site/diary.html';
        }
    }

    public function diaryCreate($site_id = null)
    {
        $this->check_company();
        if (!($site_id = (int) $site_id) && !($site_id = (int)$this->GP('site_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('home/site')->detail($site_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } elseif ($detail['company_id'] != $this->company['company_id']) {
            $this->err->add('小子皮又痒痒了么？', 212);
        } else {
            if ($data = $this->checksubmit('data')) {
                if (!$data = $this->check_fields($data, $this->_notes_create_allower_fields)) {
                    $this->err->add('非法的数据提交', 201);
                } else {
                    if ($data['status'] < $detail['status']) {
                        $this->err->add('工地步骤不正确', 201);
                    } else {
                        $data['site_id'] = $site_id;
                        $data['create_ip'] = __IP;
                        $data['dateline'] = __TIME;
                        if ($notes_id = K::M('home/notes')->create($data)) {
                            K::M('home/site')->update($site_id, array('status' => $data['status']));
                            $this->err->add('添加内容成功');
                            $this->err->set_data('forward', $this->mklink('member/site:diary', array($site_id), array(), true));
                        }
                    }
                }
            } else {
                $this->pagedata['status'] = K::M('home/site')->get_status();
                $this->pagedata['site_id'] = $site_id;
                $this->tmpl = 'member/site/diaryCreate.html';
            }
        }
    }

    public function diaryEdit($notes_id = null)
    {
        $this->check_company();
        if (!($notes_id = (int) $notes_id) && !($notes_id = (int)$this->GP('notes_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('home/notes')->detail($notes_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } else if (!$site = K::M('home/site')->detail($detail['site_id'])) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } elseif ($site['company_id'] != $this->company['company_id']) {
            $this->err->add('小子皮又痒痒了么？', 212);
        } else {
            if ($data = $this->checksubmit('data')) {
                if (!$data = $this->check_fields($data, $this->_notes_edit_allower_fields)) {
                    $this->err->add('非法的数据提交', 201);
                } else {
                    if(K::M('home/notes')->update($notes_id, $data)){
                        $this->err->add('修改内容成功');
                    }  
                }
            } else {
                $this->pagedata['status'] = K::M('home/site')->get_status();
                $this->pagedata['detail'] = $detail;
                $this->tmpl = 'member/site/diaryEdit.html';
            }
        }
    }

    public function edit($site_id = null)
    {
        $this->check_company();
        if (!($site_id = (int) $site_id) && !($site_id = (int)$this->GP('site_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('home/site')->detail($site_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } elseif ($detail['company_id'] != $this->company['company_id']) {
            $this->err->add('小子皮又痒痒了么？', 212);
        } else if ($data = $this->checksubmit('data')) {
            if (!$data = $this->check_fields($data, $this->_site_create_allower_fields)) {
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
                            if ($a = $upload->upload($attach, 'home')) {
                                $data[$k] = $a['photo'];
                                $size['photo'] = $cfg['site']['photo'] ? $cfg['site']['photo'] : 200;
                                $oImg->thumbs($a['file'], array($size['photo'] => $a['file']));
                            }
                        }
                    }
                }

                if (K::M('home/site')->update($site_id, $data)) {
                    if($detail['home_id'] != $data['home_id']){
                        if($home_id = (int) $data['home_id']){
                            K::M('home/main')->update_count($home_id, 'site_num', 1);
                        }
                        if($home_id = (int)$detail['home_id']){
                             K::M('home/main')->update_count($home_id, 'site_num', -1);
                        }
                    }
                    
                    $this->err->add('修改内容成功');
                }
            }
        } else {

            if ($home_id = (int) $detail['home_id']) {
                $this->pagedata['home'] = K::M('home/main')->detail($home_id);
            }
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'member/site/edit.html';
        }
    }

    public function index($page = 1)
    {
        $this->check_company();
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 20;
        $filter['company_id'] = $this->company['company_id'];
        if ($items = K::M('home/site')->items($filter, null, $page, $limit, $count)) {
            $home_ids = array();
            foreach ($items as $k => $v) {
                if ($v['home_id']) {
                    $home_ids[$v['home_id']] = $v['home_id'];
                }
            }
            if (!empty($home_ids)) {
                $this->pagedata['home_list'] = K::M('home/main')->items_by_ids($home_ids);
            }
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}'), array(), true), array());
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['status'] = K::M('home/site')->get_status();
        $this->pagedata['areaList'] = K::M("data/area")->fetch_all();
        $this->tmpl = 'member/site/index.html';
    }

}
