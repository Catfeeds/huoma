<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: verify.ctl.php 9372 2015-11-26 06:32:36  xinghuali
 */

class Ctl_Member_Member_Verify extends Ctl_Ucenter
{
    
    public function name()
    {
        $detail = K::M('member/verify')->detail($this->uid);
        if ($data = $this->checksubmit('data')) {
            if ($this->MEMBER['verify_name']) {
                $this->err->add('您已经通过实名认证不能修改', 211);
            }else if(!$data = $this->check_fields($data, 'name,mobile,id_number,id_photo')) {
                $this->err->add('非法的数据提交', 212);
            }else{
                if ($attach = $_FILES['id_photo']) {
                    if (UPLOAD_ERR_OK == $attach['error']) {
                        if ($a = K::M('magic/upload')->upload($attach, 'memberVerify')) {
                            $data['id_photo'] = $a['photo'];
                        }
                    }
                }
                if (empty($detail)) {
                    $data['uid'] = $this->uid;
                    if (K::M('member/verify')->create($data)) {
                        $this->err->add('提交申请成功');
                    }
                } else {
                    $data['request_ip'] = __IP;
                    $data['request_time'] = __CFG::TIME;
                    if (K::M('member/verify')->update($this->uid, $data)) {
                        $this->err->add('提交申请成功');
                    }
                }
            }
        } else {
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'mobile:member/member/verify/name.html';
        }
    }

    public function mobile($loc=null)
    {
        if($loc == 'send'){
            if(K::M('member/magic')->send_verify_mobile($this->uid)){
                $this->err->add('验证码已经发出，请注意查收');
            }
        }else if($data = $this->checksubmit('data')){
            if(!$data['code']) {
                $this->err->add('验证码不能为空', 201);
            }else if (K::M('member/magic')->verify_mobile($this->uid,$data['code'])) {
                K::M('system/integral')->commit('mobile', $this->MEMBER, '手机验证通过');
                $this->err->add('恭喜您，验证手机成功');
            }
        } else {
            $this->tmpl = 'mobile:member/member/verify/mobile.html';
        }
    }

    public function mail($loc=null)
    {
        if($loc == 'verify'){
            if(!$this->MEMBER['verify_mail']){
                if(K::M('member/magic')->send_verify_mail($this->uid)){
                     $this->err->add('验证邮件已经发出，请注意查收');
                }
            }else{
                $this->err->add('您的邮箱已经验证过了', 212);
            }            
        }else{
            if(!$this->MEMBER['verify_mail']){
                if(!K::M('member/magic')->send_verify_mail($this->uid)){
                    $this->pagedata['verify_send_error'] = true;
                }
            }
            $this->pagedata['mailLogin'] = K::M('mail/view')->weblogin($this->MEMBER['mail']);
            $this->tmpl = 'mobile:member/member/verify/mail.html';
        }        
    }

}