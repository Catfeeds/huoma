<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: index.ctl.php 9372 2015-11-26 06:32:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Member_Index extends Ctl_Ucenter 
{
    protected $_allow_fields = 'mail,gender,from,mobile,Y,M,D,city_id,realname';
    public function index()
    {
        //var_dump(1111);die;
		header("Location:/member/{$this->MEMBER['from']}-index.html");
		exit;
        $this->pagedata['order_count'] = K::M('trade/order')->count_by_uid($this->uid);
        $this->pagedata['yuyue_company_count'] = K::M('company/yuyue')->count(array('uid'=>$this->uid));
        $this->pagedata['yuyue_designer_count'] = K::M('designer/yuyue')->count(array('uid'=>$this->uid));
        $this->pagedata['yuyue_mechanic_count'] = K::M('mechanic/yuyue')->count(array('uid'=>$this->uid));
        $this->pagedata['yuyue_shop_count'] = K::M('shop/yuyue')->count(array('uid'=>$this->uid));
        $this->pagedata['tenders_count'] = K::M('tenders/tenders')->count(array('uid'=>$this->uid));
        $this->tmpl = 'mobile:member/member/index.html';
    }

}