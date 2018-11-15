<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: couponDownload.mdl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Shop_CouponDownload extends Mdl_Table
{   
  
    protected $_table = 'shop_coupon_download';
    protected $_pk = 'download_id';
    protected $_cols = 'download_id,coupon_id,city_id,uid,shop_id,contact,mobile,number,used,status,remark,clientip,dateline';

    
    public function create($data, $checked=false)
    {
        if(!$checked && !$data = $this->_check_schema($data)){
            return false;
        }
        $data['clientip'] = __IP;
        $data['dateline'] = __CFG::TIME;
        return $this->db->insert($this->_table, $data, true);
    }

    public function update($pk, $data, $checked=false)
    {
        $this->_checkpk();
        if(!$checked && !$data = $this->_check_schema($data,  $pk)){
            return false;
        }
        return $this->db->update($this->_table, $data, $this->field($this->_pk, $pk));
    }

    public function items_by_coupon($coupon_id,$filter=null,$page=1, $limit=50, &$count)
    {
        if(!$coupon_id = (int)$coupon_id){
            return false;
        }
		$filter['coupon_id']=$coupon_id;
        return $this->items($filter,null, $page, $limit, $count);
    }

    public function items_by_shop($shop_id, $page=1, $limit=50, &$count)
    {
        if(!$shop_id = (int)$shop_id){
            return false;
        }
        return $this->items(array('shop_id'=>$shop_id), null, $page, $limit, $count);
    }

    protected function _format_row($row)
    {
        $row['status_title'] = K::M('misc/data')->yuyue($row['status']);
        return $row;
    }

}