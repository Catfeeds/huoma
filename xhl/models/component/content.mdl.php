<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: content.mdl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Component_Content extends Mdl_Table
{   
  
    protected $_table = 'component_content';
    protected $_pk = 'component_id';
    protected $_cols = 'component_id,seo_title,seo_keywords,seo_description,content,clientip';

    public function create($xiangmu_id, $data)
    {
        if(!$xiangmu_id = intval($xiangmu_id)){
            return false;
        }else if(!$data = $this->_check($data)){
            return false;
        }
        $data['component_id'] = $xiangmu_id;
        $data['clientip'] = __IP;
        return $this->db->insert($this->_table, $data);
    }

    public function update($xiangmu_id, $data, $checked=false)
    {
        if(!$xiangmu_id = intval($xiangmu_id)){
            return false;
        }else if($checked && !($data = $this->_check($data,  $xiangmu_id))){
            return false;
        }
        return $this->db->update($this->_table, $data, $this->field($this->_pk, $xiangmu_id));
    }
}