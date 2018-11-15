<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: dianping.mdl.php 2155 2015-11-13 10:30:51Z xinghuali $
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Company_Dianping extends Mdl_Table
{   
  
    protected $_table = 'company_dianping';
    protected $_pk = 'id';
    protected $_cols = 'id,company_id,uid,score1,score2,score3,score4,score5,content,dateline,create_ip,mobile,name,home_name,is_rec,audit,reply,reply_time,reply_ip';
    protected $_orderby = array('id'=>'DESC');

    protected $_hot_orderby = array('reply_time'=>'DESC','id'=>'DESC');
    protected $_hot_filter = array('audit'=>'1');
    protected $_new_orderby = array('id'=>'DESC');
    protected $_new_filter = array('audit'=>'1');
    
    public function create($data, $checked=false)
    {
        if(!$checked && !$data = $this->_check_schema($data)){
            return false;
        }
        return $this->db->insert($this->_table, $data, true);
    }
    
    public function get_last_dianping_by_company_ids($company_ids){
        if(empty($company_ids)) return array();
        foreach ($company_ids as $k=>$v){
            $company_ids[$k] = (int)$v;
        }
        $company_str = join(',',$company_ids);
        
        $sql = "SELECT max(id),".$this->table($this->_table).".* FROM ".$this->table($this->_table)." where company_id in({$company_str}) AND audit = 1 group by company_id;";
        $items = array();
        if($rs = $this->db->Execute($sql)){
            while($row = $rs->fetch()){
                $row = $this->_format_row($row);
                $items[$row['company_id']] = $row;
            }
        }
        return $items;  
    }
    
    public function get_count_by_company_id($company_id){
        $company_id = (int)$company_id;
        
        $sql = "SELECT COUNT(1) AS num ,SUM(score1) as sc1,SUM(score2) as sc2,SUM(score3) as sc3,SUM(score4) as sc4,SUM(score5) as sc5  FROM ".$this->table($this->_table)."  WHERE company_id = '{$company_id}' ";
       
        $row = $this->db->GetRow($sql);
        
        $return  = array();
        if(!empty($row)){
            $return = array(
                'score_num' => $row['num'],
                'score1' => $this->_score_format($row['num'], $row['sc1']),
                'score2' => $this->_score_format($row['num'], $row['sc2']),
                'score3' => $this->_score_format($row['num'], $row['sc3']),
                'score4' => $this->_score_format($row['num'], $row['sc4']),
                'score5' => $this->_score_format($row['num'], $row['sc5']),
            );
            $local = array();
            foreach($row as $k=>$v){
                if(!empty($v) && $k!='num'){
                   $local[] = $v;
                }
            }
         
            $return['scores'] = $this->_score_format($row['num'] * count($local), array_sum($local)); 
        }
        return  $return;
    }
    
    private function _score_format($count,$score){
       
        if(empty($count)) return 0; 
       
        return (int)($score * 10/$count);
    }
    
    public function update($pk, $data, $checked=false)
    {
        $this->_checkpk();
        if(!$checked && !$data = $this->_check_schema($data,  $pk)){
            return false;
        }
        return $this->db->update($this->_table, $data, $this->field($this->_pk, $pk));
    }
}