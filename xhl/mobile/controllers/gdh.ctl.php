<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: index.ctl.php 2335 2015-11-18 17:15:56  xinghuali
 */
class Ctl_Gdh extends Ctl
{ 
    public function index()
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
            $this->pagedata['page_time'] = __TIME.rand(100000,9999999);
            $this->tmpl = 'mobile:member/gdh/create.html';
        }        
    }
	

}