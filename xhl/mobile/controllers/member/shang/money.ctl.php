<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: money.ctl.php 9372 2015-11-26 06:32:36  xinghuali
 */

class Ctl_Member_Shop_Money extends Ctl_Ucenter
{
    
    public function shop($type='all', $page=1)
    {
        $shop = $this->ucenter_shop();
        $filter = $pager = array();
        $filter['shop_id'] = $shop['shop_id'];
        if(is_numeric($type)){
            $page = $type;
        }
        if($type == 'in'){
            $filter['money'] = '>:0';
        }else if($type == 'out'){
            $filter['money'] = '<:0';
        }else{
            $type = 'all';
        }
        $pager['type'] = $type;
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        if($items = K::M('shop/money')->items($filter, null, $page, $limit, $count)){
            $pgaer['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array($type, '{page}')));
            $this->pagedata['items'] = $items;            
        }
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile:member/shop/money/items.html';
    }

    public function tixian()
    {
        $shop = $this->ucenter_shop();
        if($data = $this->checksubmit('data')){
            if(!is_numeric($data['money'])){
                $this->err->add('提现金额不合法', 211);
            }else if(!$money = round($data['money'], 2)){
                $this->err->add('提现金额不合法', 212);
            }else if($money > $shop['money']){
                $this->err->add('提现金额不能大于你的账户余额', 213);
            }else if(K::M('shop/money')->request_tixian($shop_id, $money)){
                $this->err->add('申请提现成功，等待财务审核');
            }
        }else{
            $this->tmpl = 'mobile:member/shop/money/tixian.html';
        }
    }
}