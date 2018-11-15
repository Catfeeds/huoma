<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: canzhan.ctl.php 9372 2015-11-26 06:32:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Member_Shang_Canzhan extends Ctl_Ucenter 
{
    public function canzhan($page=0)
    {
        if(!$page = $this->GP('page')){
            $page=1;
        }
        $shang = $this->ucenter_shang();
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 5;
        $pager['count'] = $count = 0;
        $filter['shang_id'] = $shang['shang_id'];
        if($items = K::M('canzhan/canzhan')->items($filter,array('cz_id'=>'DESC'), $page, $limit, $count)){
            $cz_ids = $case_ids = $sheji = array();
            foreach($items as $k=>$v){
                $cz_ids[$v['cz_id']] = $v['cz_id'];
            }
            if($sheji_list = K::M('canzhan/sheji')->items_by_ids($cz_ids,1)){
                foreach($sheji_list as $k=>$v){
                    $case_ids[$v['case_id']]=$v['case_id'];
                }
                if($case_list = K::M('case/case')->items_by_ids($case_ids)){
                    foreach($sheji_list as $k=>$v){
                        $v['case'] = $case_list[$v['case_id']];
                        $v['tjprice'] = K::M('chao/baojia')->tuijian_price($v['case_id']);
                        $sheji[$v['cz_id']][$v['uid']] = $v;
                     }
                    foreach($items as $k=>$v){
                        $v['sheji'] = $sheji[$k];
                        $items[$k]=$v;
                    }
                }
            }
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('member/shang/canzhan:canzhan', array('{page}')));
            $this->pagedata['items'] = $items;
        }

        if($qy = K::M('canzhan/canzhan')->items(array('shang_id'=>$shang['shang_id'],'company_id'=>'>:0'),array('cz_id'=>'DESC'), $page, $limit, $count)){
            $cz_ids = $case_ids = $sheji = array();
            foreach($qy as $k=>$v){
                $cz_ids[$v['cz_id']] = $v['cz_id'];
            }
            if($sheji_list = K::M('canzhan/sheji')->items_by_ids($cz_ids,1)){
                foreach($sheji_list as $k=>$v){
                    $case_ids[$v['case_id']]=$v['case_id'];
                }
                if($case_list = K::M('case/case')->items_by_ids($case_ids)){
                    foreach($sheji_list as $k=>$v){
                        $v['case'] = $case_list[$v['case_id']];
                        $v['tjprice'] = K::M('chao/baojia')->tuijian_price($v['case_id']);
                        $sheji[$v['cz_id']][$v['uid']] = $v;
                    }
                    foreach($qy as $k=>$v){
                            $cz_ids[$v['cz_id']] = $v['cz_id'];
                            $case_ids[$v['case_id']] = $v['case_id'];
                            $baojia_ids[$v['baojia_id']] = $v['baojia_id'];
                    }
                if($baojia_list = K::M('chao/baojia')->items_by_ids($baojia_ids)){
                }
                if($jindu_list = K::M('canzhan/jindu')->items_canzhan_ids($cz_ids)){
                }
                    foreach($qy as $k=>$v){
                        $v['case'] = $case_list[$v['case_id']];
                        $v['baojia'] = $baojia_list[$v['baojia_id']];
                        $v['jindu'] = $jindu_list[$v['cz_id']];
                        $v['sheji'] = $sheji[$k];
                        $qy[$k]=$v;
                    }
                }
            }
            $this->pagedata['qy'] = $qy;
        }
         if($wtg = K::M('canzhan/canzhan')->items(array('shang_id'=>$shang['shang_id'],'status'=>0),array('cz_id'=>'DESC'), $page, $limit, $count)){
            $this->pagedata['wtg'] = $wtg;
        }
        $this->pagedata['type_list'] = K::M('canzhan/jindu')->get_type_means();
        $this->pagedata['type']= 1;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['status_list']= K::M('canzhan/canzhan')->status_list();
        $this->tmpl = 'mobile:member/shang/canzhan/canzhan.html';
    }
    public function qianyue($page=1)
    {
        $shang = $this->ucenter_shang();
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 5;
        $pager['count'] = $count = 0;
        $filter['shang_id'] = $shang['shang_id'];
        $filter['status'] = 5;
        if($qy = K::M('canzhan/canzhan')->items(array('shang_id'=>$shang['shang_id'],'company_id'=>'>:0'),array('cz_id'=>'DESC'), $page, $limit, $count)){
            $cz_ids = $case_ids = $sheji = array();
            foreach($qy as $k=>$v){
                $cz_ids[$v['cz_id']] = $v['cz_id'];
                $case_ids[$v['case_id']] = $v['case_id'];
                $baojia_ids[$v['baojia_id']] = $v['baojia_id'];
            }
            if($case_list = K::M('case/case')->items_by_ids($case_ids)){
            }
            if($baojia_list = K::M('chao/baojia')->items_by_ids($baojia_ids)){
            }
            if($jindu_list = K::M('canzhan/jindu')->items_canzhan_ids($cz_ids)){
            }
            foreach($qy as $key=>$val){
                $val['case'] = $case_list[$val['case_id']];
                $val['baojia'] = $baojia_list[$val['baojia_id']];
                $val['jindu'] = $jindu_list[$val['cz_id']];
                $qy[$key] = $val;
            }
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('/member/shang/canzhan:qy', array('{page}')));
            $this->pagedata['qy'] = $qy;
        }
        $this->pagedata['type_list'] = K::M('canzhan/jindu')->get_type_means();
        $this->pagedata['type']= 1;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['status_list']= K::M('canzhan/canzhan')->status_list();
        $this->tmpl = 'mobile:member/shang/canzhan/qianyue.html';
    }

    public function qy($page=0)
    {
        if(!$page = $this->GP('page')){
            $page=1;
        }
        $shang = $this->ucenter_shang();
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 5;
        $pager['count'] = $count = 0;
        $filter['shang_id'] = $shang['shang_id'];
        $filter['status'] = 5;
        if($qy = K::M('canzhan/canzhan')->items($filter,array('cz_id'=>'DESC'), $page, $limit, $count)){
            $cz_ids = $case_ids = $sheji = array();
            foreach($qy as $k=>$v){
                $cz_ids[$v['cz_id']] = $v['cz_id'];
                $case_ids[$v['case_id']] = $v['case_id'];
                $baojia_ids[$v['baojia_id']] = $v['baojia_id'];
            }
            if($case_list = K::M('case/case')->items_by_ids($case_ids)){
            }
            if($baojia_list = K::M('chao/baojia')->items_by_ids($baojia_ids)){
            }
            if($jindu_list = K::M('canzhan/jindu')->items_canzhan_ids($cz_ids)){
            }
            foreach($qy as $key=>$val){
                $val['case'] = $case_list[$val['case_id']];
                $val['baojia'] = $baojia_list[$val['baojia_id']];
                $val['jindu'] = $jindu_list[$val['cz_id']];
                $qy[$key] = $val;
            }
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('/member/shang/canzhan:qy', array('{page}')));
            $this->pagedata['qy'] = $qy;
        }
        $this->pagedata['type_list'] = K::M('canzhan/jindu')->get_type_means();
        $this->pagedata['type']= 1;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['status_list']= K::M('canzhan/canzhan')->status_list();
        $this->tmpl = 'mobile:member/shang/canzhan/qy.html';
    }

    public function canzhanlist($page=0)
    { 
        if(!$page = $this->GP('page')){
            $page=1;
        }
        $shang = $this->ucenter_shang();
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 5;
        $pager['count'] = $count = 0;
        $filter['shang_id'] = $shang['shang_id'];
        if($items = K::M('canzhan/canzhan')->items($filter,array('cz_id'=>'DESC'), $page, $limit, $count)){
            $cz_ids = $case_ids = $sheji = array();
            foreach($items as $k=>$v){
                $cz_ids[$v['cz_id']] = $v['cz_id'];
            }
            if($sheji_list = K::M('canzhan/sheji')->items_by_ids($cz_ids,1)){
                foreach($sheji_list as $k=>$v){
                    $case_ids[$v['case_id']]=$v['case_id'];
                }
                if($case_list = K::M('case/case')->items_by_ids($case_ids)){
                    foreach($sheji_list as $k=>$v){
                        $v['case'] = $case_list[$v['case_id']];
                        $v['tjprice'] = K::M('chao/baojia')->tuijian_price($v['case_id']);
                        $sheji[$v['cz_id']][$v['uid']] = $v;
                    }
                    foreach($items as $k=>$v){
                        $v['sheji'] = $sheji[$k];
                        $items[$k]=$v;
                    }
                }
            }
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('member/shang/canzhan:canzhan', array('{page}')));
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['type']= 1;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['status_list']= K::M('canzhan/canzhan')->status_list();
        $this->tmpl = 'mobile:member/shang/canzhan/canzhanlist.html';
    }

    public function weitongguo($page=1)
    {
        if(!$page = $this->GP('page')){
            $page=1;
        }
        $shang = $this->ucenter_shang();
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        $filter['shang_id'] = $shang['shang_id'];
        $filter['status'] = 0;
        if($wtg = K::M('canzhan/canzhan')->items($filter,array('cz_id'=>'DESC'), $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('canzhan:canzhan', array('{page}')));
            $this->pagedata['wtg'] = $wtg;
        }
        $this->pagedata['pager'] = $pager;
        $this->pagedata['type']= 0;
        $this->pagedata['status_list']= K::M('canzhan/canzhan')->status_list();
        $this->tmpl = 'mobile:member/shang/canzhan/weitongguo.html';
    }
 
    public function create()
    {
        $shang = $this->ucenter_shang();
        if($data = $this->checksubmit('canzhan')){
            if(!isset($data['mianji']) || empty($data['mianji'])){
                $this->err->add('面积不能为空！', 212);
            }else{
              $data['uid'] =$shang['uid'];
              $data['shang_id'] =$shang['shang_id'];
              $data['clientip'] = __IP;
              $data['dateline'] = __CFG :: TIME;
              if($shang['zhixing_id']){
                if($zhixing = K::M('admin/base')->detail($shang['zhixing_id'])){
                    $data['zhixing_id'] =$zhixing['admin_id'];
                    $data['zhixing_name'] =$zhixing['realname'];
                    $data['zhixing_mobile'] =$zhixing['mobile'];
                    $data['zhixing_qq'] =$zhixing['qq'];
                    $data['status'] = 2;
                }
              }

              if($id = K::M('canzhan/canzhan')->create($data)){
                    $log = array(
                                    'cz_id'=>$id,
                                    'uid'=>$shang['uid'],
                                    'username'=>$shang['title'],
                                );
                    K::M('canzhan/log')->create($log,'add');
                    if($data['isoem']){
                         $case['cz_id'] = $id;
                          $case['istz'] = 0;
                          $case['uid'] = $shang['uid'];
                          $case['mianji'] = $data['mianji'];
                          $case['title'] = $data['cname'];
                          $case['clientip'] = __IP;
                          $case['dateline'] = __TIME;
                          if ($case_id = K::M('case/case')->create($case)) {
                              $datas['case_id'] = $case_id;
                              $datas['cz_id'] = $id;
                              $datas['uid'] = $shang['uid']; 
                              $datas['uname'] = $shang['title']; 
                              $datas['isshow'] = 1; 
                              $datas['addtime'] = __TIME;
                              $datas['price'] = 0;
                              $datas['endtime'] = __TIME;
                              $datas['clientip'] = __IP;
                              if($shejiid = K::M('canzhan/sheji')->create($datas)){
                                $this->err->set_data('forward', $this->mklink('member/member:index',array($case_id,$id)));
                                $this->err->add('订单发布成功！报价设计稿请在pc端上传！');
                              }
                          }
                    }else{
                        $this->err->set_data('forward', $this->mklink('member/member:index',array($id)));
                        $this->err->add('订单发布成功！问询表信息请在pc端完善！');
                    }
                }else{
                   $this->err->add('数据保存失败！请联系在线客服解决！', 212);
                }
            }
        }else{
            $this->pagedata['shang'] = $shang;
            $this->tmpl = 'mobile:member/shang/canzhan/create.html';
        }        
    }
    
    public function wenxunbiao($id=null)
    {
        $shang = $this->ucenter_shang();
        if(!($id = (int)$id) && !($id = (int)$this->GP('id'))){
            $this->error(404);
        }else if(!$detail = K::M('canzhan/canzhan')->detail($id)){
            $this->err->add('查看的订单不存在或已经删除', 211);
        }else if($detail['shang_id'] != $shang['shang_id']){
            $this->err->add('您没有权限操作该订单', 212);
        }else if($data = $this->checksubmit('canzhan')){
            if($expo = $this->GP('expo')){
                $data['wenxun'] = serialize($expo);
            }
            
            if(K::M('canzhan/canzhan')->update($id, $data)){
                $log = array(
                                'cz_id'=>$id,
                                'uid'=>$shang['uid'],
                                'username'=>$shang['title'],
                            );
                K::M('canzhan/log')->create($log,'edit',$detail,$data);
                $this->err->set_data('forward', $this->mklink('member/shang/canzhan:wendang',array($id)));
               $this->err->add('设计问询表提交成功！请上传需求文档！');
            }
        }else{
            $detail['expo'] = unserialize($detail['wenxun']);
            unset($detail['wenxun']);
            
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'mobile:member/shang/canzhan/wenxunbiao.html';
        }        
    }

    public function wendang($cid=null, $page=1)
    {
        $shang = $this->ucenter_shang();
        if (!($cid = (int) $cid) && !($cid = (int)$this->GP('cid'))) {
            $this->error(404);
        } else if (!$detail = K::M('canzhan/canzhan')->detail($cid)) {
            $this->err->add('您要查看的内容不存在或已经删除', 212);
        } else if ($detail['uid'] != $shang['uid']) {
            $this->err->add('您没有权限查看该内容', 212);
        } else {
            
            $pager = array('cz_id'=>$cid);
            $pager['page'] = (int)$page;
            $pager['limit'] = $limit = 20;
            $pager['count'] = $count = 0;
            $this->pagedata['detail'] = $detail;
            if($items = K::M('canzhan/file')->items_by_file($cid, $page, $limit, $count)){
                $this->pagedata['items'] = $items;
                $pager['count'] = $count;
                $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink("member/shang/canzhan:canzhanfile", array($cid,'{page}')));
            }
            $this->pagedata['pager'] = $pager;
            $this->tmpl = 'mobile:member/shang/canzhan/canzhanfile.html';
        }        
    }

   public function xiaoguotu($case_id=null,$cz_id=0,$group=0, $page=1)
    {
        $shang = $this->ucenter_shang();
        if (!($case_id = (int) $case_id) && !($case_id = (int)$this->GP('case_id'))) {
            $this->error(404);
        }else if(!$detail = K::M('canzhan/canzhan')->detail($cz_id)){
            $this->err->add('查看的订单不存在或已经删除', 211);
        } else if (!$case = K::M('case/case')->detail($case_id)) {
            $this->err->add('您要查看的内容不存在或已经删除', 212);
        } else {
            $pager = array('case_id'=>$case_id);
            $pager['page'] = (int)$page;
            $pager['limit'] = $limit = 20;
            $pager['count'] = $count = 0;
            if($items = K::M('case/photo')->items_by_case($case_id, 1, 50, $count)){
                $this->pagedata['items'] = $items;
                $pager['count'] = $count;
                $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink("member/designer/case:detail", array($case_id,'{page}')));
            }
                if($baoguan = K::M('case/baoguan')->items_by_case($case_id, 1, 50, $count)){
                    $this->pagedata['baoguan'] = $baoguan;
                }
                if($shigong = K::M('case/shigong')->items_by_case($case_id, 1, 50, $count)){
                    $this->pagedata['shigong'] = $shigong;
                }
                if($moxing = K::M('case/moxing')->items_by_case($case_id, 1, 50, $count)){
                    $this->pagedata['moxing'] = $moxing;
                }
            $this->pagedata['case'] = $case;
            $this->pagedata['detail'] = $detail;
            $this->pagedata['pager'] = $pager;
            $this->tmpl = 'mobile:member/shang/canzhan/xiaoguotu.html';
        }
    }

    public function upload_xiaoguotu($case_id = null,$group = 0)
    {
        if(!$group = (int)$this->GP('group')){
            $group = 0;
        }
        if(!($case_id = (int)$case_id) && !($case_id = (int)$this->GP('case_id'))){
            $this->err->add('非法的参数请求', 201);
        }else if(!$case = K::M('case/case')->detail($case_id)){
            $this->err->add('案例不存在或已经删除', 202);
        }else if(!$attach = $_FILES['Filedata']){
            $this->err->add('上传图片失败', 401);
        }else if(UPLOAD_ERR_OK != $attach['error']){
            $this->err->add('上传图片失败', 402);
        }else{
            $attach['group'] = $group;
            if($data = K::M('case/photo')->upload($case_id, $attach)){
                if($allow_case != $case['audit'] && empty($case['photos'])){
                    K::M('case/case')->update($case_id, array('audit'=>$allow_case));
                }
                $cfg = $this->system->config->get('attach');
                $this->err->set_data('photo', $cfg['attachurl'].'/'.$data['photo']);
                $this->err->add('上传图片成功');
            }
        }
        $this->err->json();
    }    
    public function upload_baoguan($case_id = null)
    {
       if(!($case_id = (int)$case_id) && !($case_id = (int)$this->GP('case_id'))){
            $this->err->add('非法的参数请求', 201);
        }else if(!$case = K::M('case/case')->detail($case_id)){
            $this->err->add('案例不存在或已经删除', 202);
        }else if(!$attach = $_FILES['Filedata']){
            $this->err->add('上传图片失败', 401);
        }else if(UPLOAD_ERR_OK != $attach['error']){
            $this->err->add('上传图片失败', 402);
        }else{
            if($data = K::M('case/baoguan')->upload($case_id, $attach)){
                $cfg = $this->system->config->get('attach');
                $this->err->set_data('photo', $cfg['attachurl'].'/'.$data['photo']);
                $this->err->add('上传图片成功');
            }
        }
        $this->err->json();
    }    
    public function upload_shigong($case_id = null)
    {
        if(!($case_id = (int)$case_id) && !($case_id = (int)$this->GP('case_id'))){
            $this->err->add('非法的参数请求', 201);
        }else if(!$case = K::M('case/case')->detail($case_id)){
            $this->err->add('案例不存在或已经删除', 202);
        }else if(!$attach = $_FILES['Filedata']){
            $this->err->add('上传图片失败', 401);
        }else if(UPLOAD_ERR_OK != $attach['error']){
            $this->err->add('上传图片失败', 402);
        }else{
            if($data = K::M('case/shigong')->upload($case_id, $attach)){
                $cfg = $this->system->config->get('attach');
                $this->err->set_data('photo', $cfg['attachurl'].'/'.$data['photo']);
                $this->err->add('上传图片成功');
            }
        }
        $this->err->json();
    }
    public function upload_moxing($case_id = null)
    {
        if(!($case_id = (int)$case_id) && !($case_id = (int)$this->GP('case_id'))){
            $this->err->add('非法的参数请求', 201);
        }else if(!$case = K::M('case/case')->detail($case_id)){
            $this->err->add('案例不存在或已经删除', 202);
        }else if(!$attach = $_FILES['Filedata']){
            $this->err->add('上传图片失败', 401);
        }else if(UPLOAD_ERR_OK != $attach['error']){
            $this->err->add('上传图片失败', 402);
        }else{
            if($data = K::M('case/moxing')->upload($case_id, $attach)){
                $this->err->set_data('photo', $cfg['attachurl'].'/'.$data['photo']);
                $this->err->add('上传图片成功');
            }
        }
        $this->err->json();
    }    
    public function deletephoto($photo_id= null)
    {
        $shang = $this->ucenter_shang();
        if (!($photo_id = (int) $photo_id) && !($photo_id = (int)$this->GP('photo_id'))) {
            $this->error(404);
        }else if(!$detail = K::M('case/photo')->detail($photo_id)) {
            $this->err->add('效果图不存在或已经删除', 211);
        }else if(!$case = K::M('case/case')->detail($detail['case_id'])){
            $this->err->add('不存在或已经删除', 212);
        }else if ($case['uid'] != $shang['uid']) {
            $this->err->add('不许越权管理别人的内容', 213);
        } else{
            if(K::M('case/photo')->delete($photo_id)){
                $this->err->add('删除效果图成功');
            }
        }   
    }
    public function dinggao($case_id= null,$cz_id= null)
    {
        $shang = $this->ucenter_shang();
        if(!$case_id && !$cz_id){
             $this->err->add('来源有误', 211);
        }elseif(!$case = K::M('case/case')->detail($case_id)){
            $this->err->add('来源有误', 211);
        }elseif(!$canzhan = K::M('canzhan/canzhan')->detail($cz_id)){
            $this->err->add('来源有误', 211);
        }elseif($canzhan['case_id']){
            $this->err->add('已经定稿！如有修改请联系执行经理！', 211);
        }else{
            $data['sj_uid'] = $case['uid'];
            $data['status'] = 3;
            $data['case_id'] = $case_id;
            $data['dgtime'] = __TIME;
            if(K::M('canzhan/canzhan')->update($cz_id, $data)){
                $log = array(
                                'cz_id'=>$cz_id,
                                'uid'=>$shang['uid'],
                                'username'=>$shang['title'],
                                'ctrl'=>'设计稿ID:'.$case_id.'设计师ID:'.$case['uid']
                            );
                K::M('canzhan/log')->create($log,'dinggao');
//             $this->err->set_data('forward', $this->mklink('member/shang/canzhan:canzhanDetail',array($id)));
               $this->err->add('定稿成功');
            }
        }   
    }
    public function qiandan($baojia_id= null,$cz_id= null)
    {
        $shang = $this->ucenter_shang();
        if(!$baojia_id && !$cz_id){
             $this->err->add('来源有误', 211);
        }elseif(!$baojia = K::M('chao/baojia')->detail($baojia_id)){
            $this->err->add('来源有误', 211);
        }elseif(!$canzhan = K::M('canzhan/canzhan')->detail($cz_id)){
            $this->err->add('来源有误', 211);
        }elseif($canzhan['sign_company_id']){
            $this->err->add('已经签约！如有修改请联系执行经理！', 211);
        }else{
            $data['baojia_id'] = $baojia_id;
            $data['company_id'] = $baojia['company_id'];
            $data['status'] = 4;
            $data['sign_time'] = __TIME;
            if(K::M('canzhan/canzhan')->update($cz_id, $data)){
                $info = unserialize($baojia['info']);
                $log = array(
                                'cz_id'=>$cz_id,
                                'uid'=>$shang['uid'],
                                'username'=>$shang['title'],
                                'ctrl'=>'签约工厂ID:'.$baojia['company_id'].'工厂名称:'.$info['title']
                            );
               $this->err->set_data('forward', $this->mklink('member/shang/canzhan:qianyue',array($id)));
                K::M('canzhan/log')->create($log,'qiandan');
               $this->err->add('签单成功！');
            }
        }   
    }
   public function deletebaoguan($photo_id= null)
    {
        $shang = $this->ucenter_shang();
        if (!($photo_id = (int) $photo_id) && !($photo_id = (int)$this->GP('photo_id'))) {
            $this->error(404);
        }else if(!$detail = K::M('case/baoguan')->detail($photo_id)) {
            $this->err->add('报馆图不存在或已经删除', 211);
        }else if(!$case = K::M('case/case')->detail($detail['case_id'])){
            $this->err->add('案例不存在或已经删除', 212);
        }else if ($case['uid'] != $shang['uid']) {
            $this->err->add('不许越权管理别人的内容', 213);
        } else{
            if(K::M('case/baoguan')->delete($photo_id)){
                $this->err->add('删除报馆图成功');
            }
        }   
    }
    public function deleteshigong($photo_id= null)
    {
        $shang = $this->ucenter_shang();
        if (!($photo_id = (int) $photo_id) && !($photo_id = (int)$this->GP('photo_id'))) {
            $this->error(404);
        }else if(!$detail = K::M('case/shigong')->detail($photo_id)) {
            $this->err->add('施工图不存在或已经删除', 211);
        }else if(!$case = K::M('case/case')->detail($detail['case_id'])){
            $this->err->add('案例不存在或已经删除', 212);
        }else if ($case['uid'] != $shang['uid']) {
            $this->err->add('不许越权管理别人的内容', 213);
        } else{
            if(K::M('case/shigong')->delete($photo_id)){
                $this->err->add('删除施工图成功');
            }
        }   
    }
    public function deletemoxing($photo_id= null)
    {
        $shang = $this->ucenter_shang();
        if (!($photo_id = (int) $photo_id) && !($photo_id = (int)$this->GP('photo_id'))) {
            $this->error(404);
        }else if(!$detail = K::M('case/moxing')->detail($photo_id)) {
            $this->err->add('模型不存在或已经删除', 211);
        }else if(!$case = K::M('case/case')->detail($detail['case_id'])){
            $this->err->add('案例不存在或已经删除', 212);
        }else if ($case['uid'] != $shang['uid']) {
            $this->err->add('不许越权管理别人的内容', 213);
        } else{
            if(K::M('case/moxing')->delete($photo_id)){
                $this->err->add('删除模型成功');
            }
        }   
    }
  
    
    public function upload($cid = null)
    {
       $shang = $this->ucenter_shang();
        if(!($cid = (int)$cid) && !($cid = (int)$this->GP('cid'))){
            $this->err->add('非法的参数请求', 201);
        }else if(!$canzhan = K::M('canzhan/canzhan')->detail($cid)){
            $this->err->add('计划不存在或已经删除', 202);
        }elseif ($canzhan['uid'] != $shang['uid']) {
            $this->err->add('不许越权管理别人的内容', 212);
        } else if(!$attach = $_FILES['Filedata']){
            $this->err->add('上传文件失败', 401);
        }else if(UPLOAD_ERR_OK != $attach['error']){
            $this->err->add('上传文件失败', 402);
        }else{
            if($data = K::M('canzhan/file')->upload($cid, $attach)){
                $cfg = $this->system->config->get('attach');
                $this->err->set_data('file', $cfg['attachurl'].'/'.$data['file']);
                $this->err->add('上传文件成功');
            }
        }
        $this->err->json();
    }    
    
    public function update($cid = null)
    {
        $shang = $this->ucenter_shang();
        if (!($cid = (int) $cid) && !($cid = (int)$this->GP('cid'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('canzhan/canzhan')->detail($cid)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } else if ($detail['uid'] != $shang['uid']) {
            $this->err->add('不许越权管理别人的内容', 212);
        } else if ($data = $this->checksubmit('data')) {
            $photo_ids = array();
            foreach($data as $k=>$v){
                $photo_ids[$k] = $k;
            }
            if(empty($photo_ids)){
                $this->err->add('没有您要更新的内容', 212);
            }else if(!$photoinfos = K::M('canzhan/file')->items_by_ids($photo_ids)){
                $this->err->add('没有您要更新的内容', 212); 
            }else{
               $obj = K::M('canzhan/file');
                foreach($data as $k=>$v){
                    if($photoinfos[$k]['cid'] == $cid){
                        if($v['filename'] != $photoinfos[$k]['filename']){
                            $obj->update($k, array('filename'=>$v['filename']));
                        }
                    }
                }
                $this->err->add('更新成功');
            }
        }    
    }    

    public function deletefile($file_id= null)
    {
        $shang = $this->ucenter_shang();
        if (!($file_id = (int) $file_id)) {
            $this->error(404);
        }else if(!$detail = K::M('canzhan/file')->detail($file_id)) {
            $this->err->add('文件不存在或已经删除', 211);
        }else{
            if(K::M('canzhan/file')->delete($file_id)){
                $this->err->add('删除文件成功');
            }
        }   
    }

    public function canzhanDetail($id=null,$page=1)
    {
        if(!$id = (int)$id){
            $this->error(404);
        }else if(!$detail = K::M('canzhan/canzhan')->detail($id)){
            $this->err->add('查看的订单不存在或已经删除', 211);
        }else if($detail['uid'] != $this->uid){
            $this->err->add('您没有权限查看该订单', 212);
        }else{
            $wenxun = K::M('canzhan/wenxunbiao')->detail($id);
            //查看有没有选择设计师
            if($sheji_list = K::M('canzhan/sheji')->items_by_ids($id,1)){
                foreach($sheji_list as $k=>$v){
                    $case_ids[$v['case_id']]=$v['case_id'];
                }
                if($case_list = K::M('case/case')->items_by_ids($case_ids)){
                   if($shejigao = K::M('case/photo')->items_by_cases($case_ids)){
                        $xiugainum=0;
                        foreach($shejigao as $v){
                              foreach($v as $key=>$num){
                                    if($key!=0){
                                        $xiugainum++;
                                    }
                              }  
                        }
                        $countnum=0;
                        foreach($shejigao as $vv){
                              foreach($vv as $keys=>$nums){
                                    if($keys==0){
                                        $countnum++;
                                    }
                              }  
                        }
                   }
                    foreach($sheji_list as $k=>$v){
                        $v['case'] = $case_list[$v['case_id']];
                        if($shejigao){
                            $v['case']['group'] = $shejigao[$v['case_id']];
                        }
                        $detail['sheji'][$v['uid']] = $v;
                    }
                   // $shejigaonum = count($shejigao);
                   if($casep = K::M('case/photo')->casephotos($v['case_id'])){
                        $this->pagedata['casep'] = $casep;
                   } 

                }
                if($baojia_list = K::M('chao/baojia')->items_case_ids($case_ids)){

              }

            }
            if($file_list = K::M('canzhan/file')->items_by_file($id, 1, 50, $count)){
                $this->pagedata['file_list'] = $file_list;
            }
            if($baoguan = K::M('case/baoguan')->items_by_case($detail['case_id'], 1, 50, $count)){
                $this->pagedata['baoguan'] = $baoguan;
            }
            if($jindu_list = K::M('canzhan/jindu')->items_canzhan_id($id)){
            }
            //var_dump($jindu_list );die;

            if($cases = K::M('case/case')->detail($detail['case_id'])){
               $shejishi = K::M('designer/designer')->detail($cases['uid']);
                    $this->pagedata['cases'] = $cases;
                    $this->pagedata['shejishi'] = $shejishi;
                
            }
           if($status = K::M('canzhan/log')->zhuangtai($id)){
                 $statu = reset($status);
           }else{
                $statu = 0;
           }
           //var_dump( $statu);die;
            $zhuchangbaoguan = K::M('canzhan/log')->baoguan($id);
            $dingdanjieshu = K::M('canzhan/log')->dingdanjieshu($id);
            $count = 0;
            $filter['status'] = 1;
            $filter['cz_id'] = $id;
            $caiwuxinxi = K::M('canzhan/caiwu')->items($filter, array('cz_id'=>'DESC'), 1, 20, $count);
            
            $qianyue = K::M('canzhan/qianyue')->getList($id);
            //推荐设计师条件 按面积推荐 目前没有限制
            $wenxun['expo'] = unserialize($wenxun['wenxun']);
            unset($wenxun['wenxun']);
            $count_sj = count($look_list_t);
            $this->pagedata['count_sj'] = $count_sj;
            $this->pagedata['pager'] = $pager;
            $this->pagedata['detail'] = $detail;
            $this->pagedata['caiwuxinxi'] = $caiwuxinxi;
            $this->pagedata['qianyue'] = $qianyue;
            $this->pagedata['status'] = $status;
            $this->pagedata['jindu_list'] = $jindu_list;
            $this->pagedata['zhuchangbaoguan'] = $zhuchangbaoguan;
            $this->pagedata['dingdanjieshu'] = $dingdanjieshu;
            $this->pagedata['countnum'] = $countnum;
            $this->pagedata['wenxun'] = $wenxun;
            $this->pagedata['shejigaonum'] = $shejigaonum;
            $this->pagedata['xiugainum'] = $xiugainum;
            $this->pagedata['statu'] = $statu;
            $this->pagedata['status_list'] = K::M('canzhan/canzhan')->status_list($detail['status']);
            $this->pagedata['type_list'] = K::M('canzhan/jindu')->get_type_means();
            $this->tmpl = 'mobile:member/shang/canzhan/canzhanDetail.html';
        }
    }
    

    public function selectdashejishi($id=0,$page=1)
    {
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        $filter = array();
        $filter['closed'] = 0;
        $filter['audit'] = 1;
        if($items = K::M('designer/designer')->items($filter, null, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('canzhan:canzhan', array('{page}')));
            $this->pagedata['items'] = $items;
        }
/*      $num = ceil($count/$limit);
        if($page>=$num){
            $pager['left'] = $page-1;
            $pager['right'] = 1;
        }elseif($page<=1){
            $pager['left'] = $num;
            $pager['right'] = 2;
        }else{
            $pager['left'] = $page-1;
            $pager['right'] = $page+1;
        }
*/      $pager['id'] = $id;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile:member/shang/canzhan/selectdashejishi.html';
    }

    public function selectdesigner($id=0)
    {   
    
        if(!$id){
            $this->err->add('非法访问！', 211);
        }else if(!$detail = K::M('canzhan/canzhan')->detail($id)){
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        }elseif($detail['uid']!=$this->uid){
            $this->err->add('无权进行当前操作', 212);
        }elseif($detail['status']<2){
            $this->err->add('该计划还未审核通过，不可操作', 214);
        }elseif($data = $this->checksubmit('sheji')){
            $cheng =0;
            $chong = 0;
            foreach($data['uid'] as $uid){
                if(!$looked = K::M('canzhan/look')->items(array('uid'=>$uid,'cz_id'=>$id))){
                
                    $datas = K::M('canzhan/look')->getdata($uid);
                    $datas['uid'] = $uid;
                    $datas['cz_id'] = $id; 
                    $datas['status'] = 1; 
                    $datas['dateline'] = __TIME;
                    $rule = K::M('canzhan/rule')->rule($detail['mianji']);
                    $datas['endtime'] = __TIME + $rule['sheji']*24*3600;
                    $datas['clientip'] = __IP;
                    $canzhan_look = true;
                    
                    if($canzhan_look == true && $look_id = K::M('canzhan/look')->create($datas)){
                        $cheng++;
/*                      if($sms = $this->GP('sms')){
                            $smsdata = array('designer'=>$designer['name'],'dateline'=> __TIME);
                            K::M('sms/sms')->designer($designer, 'admin_designer_renwu', $smsdata);
                       }*/
//                      $this->err->set_data('forward', '?canzhan/canzhan-detail-'.$id.'.html');
                    }
                    
                } else{
                    $chong++;
                }
            }
            $this->err->add('预约设计师成功！');
        }
    }  

    
    public function canzhanEdit($id=null)
    {
        $shang = $this->ucenter_shang();
        if(!($id = (int)$id) && !($id = (int)$this->GP('id'))){
            $this->error(404);
        }else if(!$detail = K::M('canzhan/canzhan')->detail($id)){
            $this->err->add('查看的订单不存在或已经删除', 211);
        }else if($detail['shang_id'] != $shang['shang_id']){
            $this->err->add('您没有权限操作该订单', 212);
        }else if($data = $this->checksubmit('canzhan')){
            if($expo = $this->GP('expo')){
                $data['wenxun'] = serialize($expo);
            }
            
            if(K::M('canzhan/canzhan')->update($id, $data)){
                $log = array(
                                'cz_id'=>$id,
                                'uid'=>$shang['uid'],
                                'username'=>$shang['title'],
                            );
                K::M('canzhan/log')->create($log,'edit',$detail,$data);
               $this->err->set_data('forward', $this->mklink('member/shang/canzhan:canzhanDetail',array($id)));
               $this->err->add('完善订单信息成功');
            }
        }else{
            $detail['expo'] = unserialize($detail['wenxun']);
            unset($detail['wenxun']);
            
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'mobile:member/shang/canzhan/canzhanEdit.html';
        }        
    }

    public function signLook($look_id)
    {
        if(!$look_id = (int)$look_id){
            $this->error(404);
        }else if(!$look = K::M('canzhan/look')->detail($look_id)){
            $this->err->add('竞标不存在或已经删除', 211);
        }else if(!$canzhan = K::M('canzhan/canzhan')->detail($look['id'])){
            $this->err->add('订单不存或已经删除', 212);
        }else if($canzhan['uid'] != $this->uid){
            $this->err->add('你没有权限操作该订单信息', 213);
        }else if(empty($canzhan['audit'])){
            $this->err->add('该订单还在审核中，不可操作', 214);
        }else if($canzhan['sign_uid']){
            $this->err->add('已经有中标者，不可重复设置', 215);
        }else if(!$member = K::M('member/member')->detail($look['uid'])){
            $this->err->add('该投标用户不存在', 216);
        }else if(K::M('canzhan/look')->sign($look_id)){
             switch ($member['from']) {
                case 'designer':
                    K::M('designer/designer')->update_count($look['uid'], 'canzhan_sign'); break;
                case 'mechanic':
                    K::M('mechanic/mechanic')->update_count($look['uid'], 'canzhan_sign'); break;
                case 'company':
                    $company = K::M('company/company')->items(array('uid'=>$look['uid']));
                    foreach($company as $k => $v){
                        $this->company['company_id'] = $v['company_id'];
                    }
                    K::M('company/company')->update_count($this->company['company_id'], 'canzhan_sign'); 
                case 'shop':
                    $shop = K::M('shop/shop')->items(array('uid'=>$look['uid']));
                    foreach($shop as $k => $v){
                        $this->company['shop_id'] = $v['shop_id'];
                    }
                    K::M('shop/shop')->update_count($this->shop['shop_id'], 'canzhan_sign'); break;
            }
            
            $this->err->add('设置中标成功');
        }
    }

    public function company($page=1)
    {
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        $filter['uid'] = $this->uid;
        if($items = K::M('company/yuyue')->items($filter, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
            $company_ids = array();
            foreach($items as $k=>$v){
                $company_ids[$v['company_id']] = $v['company_id'];
            }
            if($company_ids){
                $this->pagedata['company_list'] = K::M('company/company')->items_by_ids($company_ids);
            }
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;        
        $this->tmpl = 'mobile:member/shang/canzhan/company.html';
    }

    public function companyDetail($yuyue_id=null)
    {
        if(!$yuyue_id = (int)$yuyue_id){
            $this->error(404);
        }else if(!$detail = K::M('company/yuyue')->detail($yuyue_id)){
            $this->err->add('您要查看的预约不存在或已经删除', 212);
        }else if($detail['uid'] != $this->uid){
            $this->err->add('您没有权限查看该预约', 213);
        }else{
            if($detail['company_id']){
                $this->pagedata['company'] = K::M('company/company')->detail($detail['company_id']);
            }
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'mobile:member/shang/canzhan/companyDetail.html';
        }
    }

    public function designer($page=1)
    {
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        $filter['uid'] = $this->uid;
        if($items = K::M('designer/yuyue')->items($filter, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
            $designer_ids = array();
            foreach($items as $k=>$v){
                $designer_ids[$v['designer_id']] = $v['designer_id'];
            }
            if($designer_ids){
                $this->pagedata['designer_list'] = K::M('designer/designer')->items_by_ids($designer_ids);
            }
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;        
        $this->tmpl = 'mobile:member/shang/canzhan/designer.html';
    }

    public function designerDetail($yuyue_id=null)
    {
        if(!$yuyue_id = (int)$yuyue_id){
            $this->error(404);
        }else if(!$detail = K::M('designer/yuyue')->detail($yuyue_id)){
            $this->err->add('您要查看的预约不存在或已经删除', 212);
        }else if($detail['uid'] != $this->uid){
            $this->err->add('您没有权限查看该预约', 213);
        }else{
            if($detail['designer_id']){
                $this->pagedata['designer'] = K::M('designer/designer')->detail($detail['designer_id']);
            }
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'mobile:member/shang/canzhan/designerDetail.html';
        }
    }

    public function mechanic($page=1)
    {
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        $filter['uid'] = $this->uid;
        if($items = K::M('mechanic/yuyue')->items($filter, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
            $mechanic_ids = array();
            foreach($items as $k=>$v){
                $mechanic_ids[$v['mechanic_id']] = $v['mechanic_id'];
            }
            if($mechanic_ids){
                $this->pagedata['mechanic_list'] = K::M('mechanic/mechanic')->items_by_ids($mechanic_ids);
            }
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;        
        $this->tmpl = 'mobile:member/shang/canzhan/mechanic.html';
    }

    public function mechanicDetail($yuyue_id=null)
    {
        if(!$yuyue_id = (int)$yuyue_id){
            $this->error(404);
        }else if(!$detail = K::M('mechanic/yuyue')->detail($yuyue_id)){
            $this->err->add('您要查看的预约不存在或已经删除', 212);
        }else if($detail['uid'] != $this->uid){
            $this->err->add('您没有权限查看该预约', 213);
        }else{
            if($detail['mechanic_id']){
                $mechanic = K::M('mechanic/mechanic')->detail($detail['mechanic_id']);
                $mechanic['attrvalues'] = K::M('mechanic/attr')->attrs_ids_by_mechanic($mechanic['mechanic_id']);
                $this->pagedata['mechanic'] = $mechanic;
            }
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'mobile:member/shang/canzhan/mechanicDetail.html';
        }
    }

    public function shop($page=1)
    {
        $pager = $filter = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        $filter['uid'] = $this->uid;
        if($items = K::M('shop/yuyue')->items($filter, $page, $limit, $count)){
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
            $shop_ids = $product_ids = array();
            foreach($items as $k=>$v){
                $shop_ids[$v['shop_id']] = $v['shop_id'];
                if($v['product_id']){
                    $product_ids[$v['product_id']] = $v['product_id'];
                }
            }
            if($shop_ids){
                $this->pagedata['shop_list'] = K::M('shop/shop')->items_by_ids($shop_ids);
            }
            if($product_ids){
                $this->pagedata['product_list'] = K::M('product/product')->items_by_ids($product_ids);
            }
            $this->pagedata['items'] = $items;
        }
        $this->pagedata['pager'] = $pager;        
        $this->tmpl = 'mobile:member/shang/canzhan/shop.html';
    }

    public function shopDetail($yuyue_id=null)
    {
        if(!$yuyue_id = (int)$yuyue_id){
            $this->err->add('未指定要查看的预约', 211);
        }else if(!$detail = K::M('shop/yuyue')->detail($yuyue_id)){
            $this->err->add('您要查看的预约不存在或已经删除', 212);
        }else if($detail['uid'] != $this->uid){
            $this->err->add('您没有权限查看该预约', 213);
        }else{
            if($detail['product_id']){
                $this->pagedata['product'] = K::M('product/product')->detail($detail['product_id']);
            }
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'mobile:member/shang/canzhan/shopDetail.html';
        }        
    }
    
   public function show($case_id=null,$cz_id=null,$type='')
    {
        if(!$case_id && !$cz_id){
             $this->err->add('来源有误', 211);
        }elseif(!$zhantai = K::M('case/case')->detail($case_id)){
            $this->err->add('信息已过时', 211);
        }elseif(!$canzhan = K::M('canzhan/canzhan')->detail($cz_id)){
            $this->err->add('信息已过时', 211);
        }else{
            $pager = array('case_id'=>$case_id);
            $pager['page'] = (int)$page;
            $pager['limit'] = $limit = 20;
            $pager['count'] = $count = 0;
            if($items = K::M('case/photo')->items_by_case($case_id, 1, 50, $count)){
                    $xiaoguotu = array();
                    foreach($items as $key=>$val){
                        $xiaoguotu[$val['group']][$key]=$val;
                    }
                    $this->pagedata['xiaoguotu'] = $xiaoguotu;
                 //   $this->pagedata['shejigao'] = count($xiaoguotu);

            }
                $this->pagedata['shejigao'] = $group;
                if($baoguan = K::M('case/baoguan')->items_by_case($case_id, 1, 50, $count)){
                    $this->pagedata['baoguan'] = $baoguan;
                }
                if($shigong = K::M('case/shigong')->items_by_case($case_id, 1, 50, $count)){
                    $this->pagedata['shigong'] = $shigong;
                }
                if($moxing = K::M('case/moxing')->items_by_case($case_id, 1, 50, $count)){
                    $this->pagedata['moxing'] = $moxing;
                }

            $this->pagedata['cz_id'] = $cz_id;
            $this->pagedata['detail'] = $detail;
            $this->pagedata['pager'] = $pager;
            
            $this->pagedata['list_pic'] = $list_pic;
            $this->pagedata['zhantai'] = $zhantai;
            $this->pagedata['canzhan'] = $canzhan;
            $this->pagedata['type'] = $type;
            $this->tmpl = 'mobile:member/shang/canzhan/show.html';
        }
    }

    public function showimg($case_id=null,$cz_id=null)
    {
        if(!$case_id && !$cz_id){
             $this->err->add('来源有误', 211);
        }elseif(!$zhantai = K::M('case/case')->detail($case_id)){
            $this->err->add('信息已过时', 211);
        }elseif(!$canzhan = K::M('canzhan/canzhan')->detail($cz_id)){
            $this->err->add('信息已过时', 211);
        }else{
            $pager = array('case_id'=>$case_id);
            $pager['page'] = (int)$page;
            $pager['limit'] = $limit = 20;
            $pager['count'] = $count = 0;
            if($items = K::M('case/photo')->items_by_case($case_id, 1, 50, $count)){
                    $xiaoguotu = array();
                    foreach($items as $key=>$val){
                        $xiaoguotu[$val['group']][$key]=$val;
                    }
                    $this->pagedata['xiaoguotu'] = $xiaoguotu;
                    $this->pagedata['shejigao'] = count($xiaoguotu);

            }
                if($baoguan = K::M('case/baoguan')->items_by_case($case_id, 1, 50, $count)){
                    $this->pagedata['baoguan'] = $baoguan;
                }
                if($shigong = K::M('case/shigong')->items_by_case($case_id, 1, 50, $count)){
                    $this->pagedata['shigong'] = $shigong;
                }
                if($moxing = K::M('case/moxing')->items_by_case($case_id, 1, 50, $count)){
                    $this->pagedata['moxing'] = $moxing;
                }
            $this->pagedata['cz_id'] = $cz_id;
            $this->pagedata['detail'] = $detail;
            $this->pagedata['pager'] = $pager;
            
            $this->pagedata['list_pic'] = $list_pic;
            $this->pagedata['zhantai'] = $zhantai;
            $this->pagedata['canzhan'] = $canzhan;
            $this->tmpl = 'mobile:member/shang/canzhan/showimg.html';
        }
    }
    
    public function baojia($case_id,$cz_id=null)
    {
        if(!$case_id && !$cz_id){
            $this->err->add('访问来源有问题', 211);
        }else if(!$case = K::M('case/case')->detail($case_id)){
            $this->err->add('特装超市不存在或已经删除', 212);
        }elseif(!$canzhan = K::M('canzhan/canzhan')->detail($cz_id)){
            $this->err->add('信息已过时', 211);
        }else{
            if($cz_id){
                if($changdi = K::M('canzhan/changdi')->detail($cz_id)){
                    $changdi['data'] = unserialize($changdi['data']);
                    $this->pagedata['changdi'] = $changdi;
                }
            }
            $pager = array('case_id'=>$case_id);
            $pager['page'] = (int)$page;
            $pager['limit'] = $limit = 50;
            $pager['count'] = $count = 0;
            $this->pagedata['detail'] = $detail;
            $where =" b.case_id={$case_id} ";
             if($items = K::M('chao/baojia')->shang_baojia($case_id,$cz_id)){
                 foreach($items as $key=>$val){
                        $yuanheji = $xmheji = 0;
                        foreach($val['data'] as $v){
                            $v['price'] = $v['price']*(1+$val['bili']/100);
                            $xmheji += $v['price'];
                        }
                        $val['xmheji'] = $xmheji;
                    if($val['yuandata']){
                        foreach($val['yuandata'] as $v){
                            $v['price'] = $v['price']*(1+$val['bili']/100);
                            $yuanheji += $v['price'];
                        }
                        $val['yuanheji'] = $yuanheji;
                    }
                    $items[$key]=$val;
                }
                $this->pagedata['items'] = $items;
                $pager['count'] = $count;
                $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink("chao/chao:baojia", array('{page}')));
            }
            $this->pagedata['cz_id'] = $cz_id;
            $this->pagedata['pager'] = $pager;
            $this->pagedata['case'] = $case;
            $this->pagedata['canzhan'] = $canzhan;
            $this->tmpl = 'mobile:member/shang/canzhan/baojia.html';
        }
    }

    public function yijia($case_id,$cz_id=null)
    {
        $shang = $this->ucenter_shang();
        if(!$case_id && !$cz_id){
             $this->err->add('来源有误', 211);
        }else if(!$case = K::M('case/case')->detail($case_id)){
            $this->err->add('特装超市不存在或已经删除', 212);
        }elseif(!$canzhan = K::M('canzhan/canzhan')->detail($cz_id)){
            $this->err->add('信息已过时', 211);
        }elseif($canzhan['yijia']){
            $this->err->add('已经议过价，不可重复操作！', 211);
        }else{
            if($data = $this->checksubmit('baojia')){
                if($yijia = K::M('chao/baojia')->baojia_yijia($data)){
                    $datas['yijia'] = 1;
                    if(K::M('canzhan/canzhan')->update($cz_id, $datas)){
                        $this->err->set_data('forward', $this->mklink('member/shang/canzhan:canzhan'));
                        $this->err->add('提交议价成功，请等待工厂二次报价！');
                    }

                }else{
                }
            }else{
              $this->err->add('议价失败，请管理客服处理！', 211);
            }
        }   
    }
}