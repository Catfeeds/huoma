<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: gold.mdl.php 2016-09-27 02:07:36  xinghuali
 */

Import::M('member/member');
class Mdl_Member_Gold extends Mdl_Member_Member
{   
    

    public function update($uids, $gold, $log='')
    {

        if(!$gold = (int)$gold){
            $this->err->add('更变的展币值非法', 411);
        }else if(empty($log)){
            $this->err->add('未指定展币充值日志', 412);
        }else{
            if($uids = K::M('verify/check')->ids($uids)){
                foreach(explode(',', $uids) as $uid){
                    $sql = "UPDATE ".$this->table($this->_table)." SET `gold`=`gold`+{$gold} WHERE uid='$uid'";
                    if($this->db->Execute($sql)){
                        K::M('member/log')->log($uid, 'gold', $gold, $log);                        
                    }
                }
                return true;
            }          
        }
        return false;
    }
}