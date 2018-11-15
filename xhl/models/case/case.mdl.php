<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: case.mdl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Mdl_Case_Case extends Mdl_Table
{   
  
    protected $_table = 'case';
    protected $_pk = 'case_id';
    protected $_cols = 'case_id,cz_id,istz,uid,company_id,intro,caizhi,mianji,title,photo,size,views,likes,orderby,lastphotos,lasttime,audit,tzaudit,closed,clientip,dateline';
    protected $_orderby = array('orderby'=>'ASC', 'lasttime'=>'DESC');

    protected $_hot_orderby = array('likes'=>'DESC','orderby'=>'ASC');
    protected $_hot_filter = array('audit'=>'1', 'closed'=>'0');
    protected $_new_orderby = array('lasttime'=>'DESC');
    protected $_new_filter = array('audit'=>'1', 'closed'=>'0');
    protected $_mianji_list = array(
									'1'=>array('title'=>'0-36平','val'=>1,'where'=>' AND mianji<37'),
									'2'=>array('title'=>'37-54平','val'=>2,'where'=>' AND mianji>36 AND mianji<55'),
									'3'=>array('title'=>'55-72平','val'=>3,'where'=>' AND mianji>54 AND mianji<73'),
									'4'=>array('title'=>'73-100平','val'=>4,'where'=>' AND mianji>72 AND mianji<101'),
									'5'=>array('title'=>'101-200平','val'=>5,'where'=>' AND mianji>100 AND mianji<201'),
									'6'=>array('title'=>'201-300平','val'=>6,'where'=>' AND mianji>200 AND mianji<301'),
									'7'=>array('title'=>'301-800平','val'=>7,'where'=>' AND mianji>300 AND mianji<801'),
									'8'=>array('title'=>'801-1500平','val'=>8,'where'=>' AND mianji>800 AND mianji<1501'),
									'9'=>array('title'=>'1500平以上','val'=>9,'where'=>' AND mianji>1500')
								);
    public function mianji_list()
    {
        return $this->_mianji_list;
    }

    public function items($filter=array(), $orderby=null, $p=1, $l=50, &$count=0)
    {
        if($attrs = $filter['attrs']){
            $attr_ids = join(',',$attrs);
            $attr_count = array_sum($attrs);
            $attr_sql = "SELECT case_id FROM ".$this->table('case_attr')." WHERE attr_value_id IN($attr_ids) GROUP BY case_id HAVING SUM(attr_value_id)=$attr_count";
			$ids = array();
			if($rs = $this->db->query($attr_sql)){
				 while($row = $rs->fetch()){
					$ids[$row['case_id']] = $row['case_id'];
				}
			}
			if(!empty($ids)){
				$str = join(',',$ids);
				$datasql=" AND case_id IN($str) ";
			}else{
				$datasql =  false;
			}
			
		}
        unset($filter['attrs']);
		if($mianji=$filter['mianji']){
			$mjsql = $this->_mianji_list[$mianji]['where'];
		}else{
			$mjsql =  false;
		}
        unset($filter['mianji']);
        $where = $this->where($filter);
        if($datasql !== false){
            $where .= $datasql;
        }if($mjsql !== false){
            $where .= $mjsql;
        }
	
        $orderby = $this->order($orderby);
        $limit = $this->limit($p, $l);
        $items = array();
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM ".$this->table($this->_table)." WHERE $where  and photo<>'' $orderby $limit";
//		echo $sql;
//		exit;
        if($rs = $this->db->query($sql)){
            $count = $this->db->GetOne("SELECT FOUND_ROWS()");
            while($row = $rs->fetch()){
                $row = $this->_format_row($row);
                $items[$row[$this->_pk]] = $row;
            }
        }
        return $items;
    }
    public function items_rand($filter=array(), $orderby=null, $p=1, $l=50, &$count=0)
    {
        if($attrs = $filter['attrs']){
            $attr_ids = join(',',$attrs);
            $attr_count = array_sum($attrs);
            $attr_sql = "SELECT case_id FROM ".$this->table('case_attr')." WHERE attr_value_id IN($attr_ids) GROUP BY case_id HAVING SUM(attr_value_id)=$attr_count";
			$ids = array();
			if($rs = $this->db->query($attr_sql)){
				 while($row = $rs->fetch()){
					$ids[$row['case_id']] = $row['case_id'];
				}
			}
			if(!empty($ids)){
				$str = join(',',$ids);
				$datasql=" AND case_id IN($str) ";
			}else{
				$datasql =  false;
			}
			
		}
        unset($filter['attrs']);
		if($mianji=$filter['mianji']){
			$mjsql = $this->_mianji_list[$mianji]['where'];
		}else{
			$mjsql =  false;
		}
        unset($filter['mianji']);
        $where = $this->where($filter);
        if($datasql !== false){
            $where .= $datasql;
        }if($mjsql !== false){
            $where .= $mjsql;
        }
	
        $orderby = $this->order($orderby);
        $limit = $this->limit($p, $l);
        $items = array();
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM ".$this->table($this->_table)." WHERE $where  and photo<>'' order by rand() $limit";
//		echo $sql;
//		exit;
        if($rs = $this->db->query($sql)){
            $count = $this->db->GetOne("SELECT FOUND_ROWS()");
            while($row = $rs->fetch()){
                $row = $this->_format_row($row);
                $items[$row[$this->_pk]] = $row;
            }
        }
        return $items;
    }
    public function tz_items_tj($filter=array(), $orderby=null, $p=1, $l=50, &$count=0)
    {

        $where = $this->where($filter);
	
        $limit = $this->limit($p, $l);
        $items = array();
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM ".$this->table($this->_table)." WHERE $where and photo<>'' order by rand() $limit";
//		echo $sql;
//		exit;
        if($rs = $this->db->query($sql)){
            $count = $this->db->GetOne("SELECT FOUND_ROWS()");
            while($row = $rs->fetch()){
                $row = $this->_format_row($row);
                $items[$row[$this->_pk]] = $row;
            }
        }
        return $items;
    }
    public function items_by_ids($ids)
    {
        if(!$ids = K::M('verify/check')->ids($ids)){
            return false;
        }

        $sql = "SELECT * FROM ".$this->table($this->_table)." WHERE case_id IN($ids) AND closed=0  order by case_id ASC";
        $items = array();
        if($rs = $this->db->Execute($sql)){
            while($row = $rs->fetch()){
                $items[$row['case_id']] = $this->_format_row($row);
            }
        }
        return $items;
    }
    
    public function create($data, $checked=false)
    {
        if(!$checked && !$data = $this->_check_schema($data)){
            return false;
        }
        $data['dateline'] = __TIME;
        $data['clientip'] = __IP;
        if($case_id = $this->db->insert($this->_table, $data, true)){
            $this->update_ext_count($data);
        }
        return $case_id;
    }

	public function case_count($val)
	{
	    if($case = K::M('case/case')->detail($val)){
            if($company_id = (int)$case['company_id']){
				$this->company_count($company_id);
			}
			if($uid = (int)$case['uid']){
				$member = K::M('member/member')->detail($uid);
				if($member['from'] == 'designer'){
					$this->uid_count($uid,$member['from']);
				}
			}
			if ($home_id = (int) $case['home_id']) {
				$this->home_count($home_id);
			}
        }
	}

	public function down_count($case)
	{
		if($company_id = (int)$case['company_id']){
			$this->company_count($company_id);
		}
		if($uid = (int)$case['uid']){
			$member = K::M('member/member')->detail($uid);
			if($member['from'] == 'designer'){
				$this->uid_count($uid,$member['from']);
			}
		}
		if ($home_id = (int) $case['home_id']) {
			$this->home_count($home_id);
		}
	}

	public function downs_count($items)
	{
		$company_ids = $homes_id = $uids = array();
		foreach($items as $v){
			$company_ids[$v['company_id']] = $v['company_id'];
			$uids[$v['uid']] = $v['uid'];
			$homes_id[$v['home_id']] = $v['home_id'];
		}

		if($company_ids){
			$this->company_count($company_ids);
		}
		if($homes_id){
			$this->home_count($homes_id);
		}
		if($uids){
			$member = K::M('member/member')->items_by_ids($uids);
			$designers = array();
			foreach($member as $k => $v){
				if($v['from'] == 'designer'){
					$designers[$v['uid']] = $v['uid'];
				}
			}
			if(!empty($designers)){
				$this->uid_count($designers,'designer');
			}			
		}
	}

	public function company_count($val)
	{
		$count = 0;
        if(!$ids = K::M('verify/check')->ids($val)){
            return false;
        }
        $counts = array_fill_keys(explode(',', $ids), 0);
        $sql = "SELECT company_id, COUNT(1) c FROM ".$this->table($this->_table)." WHERE ". self::field('company_id', $val)." and closed = 0 GROUP BY company_id";
        if($rs = $this->db->Execute($sql)){
            while($row = $rs->fetch()){
                $counts[$row['company_id']] = $row['c'];
            }
            foreach($counts as $k=>$v){
                K::M('company/company')->update($k, array('case_num'=>$v), true);
                $count ++;
            }            
        }
		K::M('company/company')->update($val, array('last_case' => __TIME));
        return $count;
	}

	public function uid_count($val,$table)
	{
		$count = 0;
        if(!$ids = K::M('verify/check')->ids($val)){
            return false;
        }
        $counts = array_fill_keys(explode(',', $ids), 0);
        $sql = "SELECT uid, COUNT(1) c FROM ".$this->table($this->_table)." WHERE ". self::field('uid', $val)." and closed = 0 GROUP BY uid";
        if($rs = $this->db->Execute($sql)){
            while($row = $rs->fetch()){
                $counts[$row['uid']] = $row['c'];
            }
            foreach($counts as $k=>$v){
                K::M($table.'/'.$table)->update($k, array('case_num'=>$v), true);
                $count ++;
            }            
        }
        return $count;
	}

	public function home_count($val)
	{
		$count = 0;
        if(!$ids = K::M('verify/check')->ids($val)){
            return false;
        }
        $counts = array_fill_keys(explode(',', $ids), 0);
        $sql = "SELECT home_id, COUNT(1) c FROM ".$this->table($this->_table)." WHERE ". self::field('home_id', $val)." and closed = 0 GROUP BY home_id";
        if($rs = $this->db->Execute($sql)){
            while($row = $rs->fetch()){
                $counts[$row['home_id']] = $row['c'];
            }
            foreach($counts as $k=>$v){
                K::M('home/home')->update($k, array('case_num'=>$v), true);
                $count ++;
            }            
        }
        return $count;
	}


    public function update($case_id, $data, $checked=false)
    {
        if(!$checked && !$data = $this->_check_schema($data,  $case_id)){
            return false;
        }else if(!$case = $this->detail($case_id)){
            return false;
        }
        if($ret = $this->db->update($this->_table, $data, $this->field($this->_pk, $case_id))){
            $this->update_ext_count($data, $case);
        }
        return $ret;
    }
    
    
    public function up_detail($pk, $audit = 1,$closed=false)
	{
		if(!$pk = (int)$pk){
			return false;
		}
		$this->_checkpk();	
        $audit = (int) $audit;
		$where = $this->_pk." < {$pk} AND audit={$audit}";
		if($closed && $this->field_exists('closed')){
			$where .= " AND closed='0'";
		}
		$sql = "SELECT * FROM ".$this->table($this->_table)." WHERE $where  ORDER BY ".$this->_pk." DESC LIMIT 1";
		if($detail = $this->db->GetRow($sql)){
			$detail = $this->_format_row($detail);
		}
		return $detail;
	}
    
    public function next_detail($pk,$audit = 1, $closed=false){
        if(!$pk = (int)$pk){
			return false;
		}
		$this->_checkpk();		
        $audit = (int) $audit;
		$where = $this->_pk." > {$pk} AND audit={$audit}";
		if($closed && $this->field_exists('closed')){
			$where .= " AND closed='0'";
		}
		$sql = "SELECT * FROM ".$this->table($this->_table)." WHERE $where  ORDER BY ".$this->_pk." ASC LIMIT 1";
		if($detail = $this->db->GetRow($sql)){
			$detail = $this->_format_row($detail);
		}
		return $detail;
    }
    

    public function delete($val, $force=false)
    {
        if(!$ids = K::M('verify/check')->ids($val)){
            return false;
        }
        $ret = false;
        if($items = $this->items_by_ids($ids)){
            $case_ids = $designer_ids = $home_ids = $company_ids = array();
            foreach($items as $k=>$v){
                if(empty($v['closed'])){
                    if($v['designer_id']){
                        $designer_id[$v['designer_id']] ++; 
                    }
                    if($v['home_id']){
                        $designer_id[$v['home_id']] ++; 
                    }
                    if($v['company_id']){
                        $designer_id[$v['company_id']] ++; 
                    }
                    $case_ids[$v['case_id']] = $v['case_id'];
                }
            }
            if($case_ids){
                if($ret = parent::delete($case_ids, $force)){
                    if($designer_ids){
                        foreach($designer_ids as $k=>$v) {
                            K::M('designer/designer')->update_count($k, 'case_num', -(int)$v);
                        }
                    }
                    if($company_ids){
                        foreach($company_ids as $k=>$v) {
                            K::M('company/company')->update_count($k, 'case_num', -(int)$v);
                        }
                    }
                    if($home_ids){
                        foreach($home_ids as $k=>$v) {
                            K::M('home/home')->update_count($k, 'case_num', -(int)$v);
                        }
                    }                                        
                }
            }
        }
        return $ret;       
    }

    public function update_ext_count($data, $case=array())
    {
        if(isset($data['home_id']) || isset($data['company_id']) || isset($data['designer_id'])){
            if(isset($data['home_id'])){
                if($case['home_id'] != $data['home_id']){
                    if($case['home_id']){
                        K::M('home/home')->update_count($case['home_id'], 'case_num', -1);
                    }
                    if($data['home_id']){
                        K::M('home/home')->update_count($data['home_id'], 'case_num', 1);
                    }
                }
            }
            if(isset($data['company_id'])){
                if($case['company_id'] != $data['company_id']){
                    if($case['company_id']){
                        K::M('company/company')->update_count($case['company_id'], 'case_num', -1);
                    }
                    if($data['company_id']){
                        K::M('company/company')->update_count($data['company_id'], 'case_num', 1);
                    }
                }
            }
            if(isset($data['designer_id'])){
                if($case['designer_id'] != $data['designer_id']){
                    if($case['designer_id']){
                        K::M('designer/designer')->update_count($case['designer_id'], 'case_num', -1);
                    }
                    if($data['designer_id']){
                        K::M('designer/designer')->update_count($data['designer_id'], 'case_num', 1);
                    }                        
                }
            }
        }       
    }

    public function update_last($case_id, $size=0, $num=1)
    {
        $lastpids = array(); 
        if(!$size = (int)$size){
            return false;
        }else if(!$num = (int)$num){
            return false;
        }else if(!$case_id = (int)$case_id){
            return false;
        }
        $filter = array('closed'=>0, 'case_id'=>$case_id);
        $photo = '';
        if($items = K::M('case/photo')->items($filter, array('photo_id'=>'DESC'), 1, 10)){
            foreach($items as $v){
                $lastpids[$v['photo_id']] = $v['photo_id'];
            }
            $last = array_shift($items);
            $photo = $last['photo'];
        }
        $pids = implode(',', $lastpids);
        $time = __CFG::TIME;
        $sql = "UPDATE ".$this->table($this->_table)." SET photo='{$photo}', lastphotos='{$pids}', lasttime='{$time}',`photos`=`photos`+$num,`size`=`size`+$size WHERE case_id='$case_id'";
        return $this->db->Execute($sql);
    }

    /**
     * 重置案例统计数
     */
    public function reset_count($case_id)
    {
        if(!$case_id = (int)$case_id){
            return false;
        }else if(!$data = K::M('case/photo')->count_by_case($case_id)){
            $data = array('case_id'=>$case_id, 'photos'=>0, 'size'=>0);
        }
        return $this->db->update($this->_table, array('photos'=>$data['photos'], 'size'=>$data['size']), "case_id='{$case_id}'");
    }

    public function format_items_ext($items)
    {
        if(empty($items)){
            return false;
        }
        $case_ids = $photo_ids = $home_ids = $designer_ids = array();
        foreach((array)$items as $k=>$v){
            $case_ids[$v['case_id']] = $v['case_id'];
            if($v['lastphotos']){
                foreach(explode(',', $v['lastphotos']) as $id){
                    $photo_ids[$id] = $id;
                }
            }
            if($v['home_id']){
                $home_ids[$v['home_id']] = $v['home_id'];
            }
            if($v['designer_id']){
                $designer_ids[$v['designer_id']] = $v['designer_id'];
            }
        }
        if($photo_ids){
            $photo_list = K::M('case/photo')->items_by_ids($photo_ids);
        }
        if($home_ids){
            $home_list = K::M('home/home')->items_by_ids($home_ids);
        }
        if($designer_ids){
            $designer_list = K::M('designer/designer')->items_by_ids($designer_ids);
        }
        if($case_ids){
            $attr_list = K::M('case/attr')->items(array('case_id'=>$case_ids), null, 1, 500);
        }
        foreach((array)$items as $k=>$v){
            $photos = $designer = $home = array();
            if($v['lastphotos']){                    
                foreach(explode(',', $v['lastphotos']) as $id){
                    if($photo = $photo_list[$id]){
                        $photos[$id] = $photo;
                    }
                }
            }
            if(!$home = $home_list[$v['home_id']]){
                $home = array();
            }
            if(!$designer = $designer_list[$v['designer_id']]){
                $designer = array();
            }
            $v['ext'] = array('photos'=>$photos, 'home'=>$home, 'designer'=>$designer, 'attrs'=>array());
            $items[$k] = $v;            
        }
        $obj = K::M('data/attrvalue');
        foreach($attr_list as $k=>$v){
            if($items[$v['case_id']]){
                if($val = $obj->attrvalue($v['attr_value_id'])){
                    $items[$v['case_id']]['ext']['attrs'][$v['attr_value_id']] = $val['title'];
                }
            }
        }
        return $items;
    }
	public function items_order($filter=array(), $orderby=null, $p=1, $l=20, &$count=0)
	{
        $orderby = $this->order($orderby, null);
        $limit = $this->limit($p, $l);
        $items = array();
		$time = __TIME;
        $sql = "SELECT SQL_CALC_FOUND_ROWS c.case_id,c.cz_id,c.uid,c.title,c.photo,c.tzaudit,c.audit,c.closed,c.dateline,o.order_sn,o.isoem,o.cname,o.startime,o.endtime,o.case_id as chengdan_id FROM ".$this->table($this->_table)." c LEFT JOIN ".$this->table('canzhan')." o ON c.cz_id=o.cz_id WHERE c.cz_id<>0 and c.photo<>'' and o.endtime<{$time} ORDER BY o.endtime DESC,c.case_id DESC  $limit";
		if($rs = $this->db->query($sql)){
            $count = $this->db->GetOne("SELECT FOUND_ROWS()");
            while($row = $rs->fetch()){
                $row = $this->_format_row($row);
                $items[] = $row;
            }
        }
        return $items;
	}
	
	
	public function download($case_id,$type='photo',$group=0)
    {
		if (!$case_id = (int) $case_id) {
            $this->error(404);
        }if(!$case = K::M('case/case')->detail($case_id)){
			$this->error(404);
		}
		$gendir = dirname(dirname(dirname(dirname(__file__))));
		$zipfile = $gendir.'/czfiles/zip/';
		if(!is_dir($zipfile)){
			if(!mkdir($zipfile)) return 0;
		}
		$zipfile = $zipfile.date('Ym',$case['dateline']).'/';
		if(!is_dir($zipfile)){
			if(!mkdir($zipfile)) return 0;
		}
		$zipfile = $zipfile.$case['case_id'].'/';
		if(!is_dir($zipfile)){
			if(!mkdir($zipfile)) return 0;
		}
		
		if($type=='photo'){
			$zipfile = $zipfile.$type.'_'.$case['case_id'].'_'.$group.'.zip';
		}else{
			$zipfile = $zipfile.$type.'_'.$case['case_id'].'.zip';
		}
		if(0 && file_exists($zipfile)){
			$this->todown($zipfile);
		}else{
			if($type=='photo'){
				$photos = K::M('case/photo')->items_by_case_group($case_id,$group, 1, 50);
			}elseif($type=='baoguan'){
				$photos = K::M('case/baoguan')->items_by_case($case_id, 1, 50);
			}elseif($type=='meigong'){
				$photos = K::M('case/meigong')->items_by_case($case_id, 1, 50);
			}elseif($type=='shigong'){
				$photos = K::M('case/shigong')->items_by_case($case_id, 1, 50);
			}
			$pl = array();
			foreach($photos as $val){
				$pl[] = $gendir.'/czfiles/'.$val['photo'];
			}
			$this->tozip($pl,$zipfile);
		}
		exit;
    }
	
	public function tozip($items=array(),$filename = null){ 
		if(!$filename){
			$filename = "./" . date ( 'YmdH' ) . ".zip"; // 最终生成的文件名（含路径）
		}
		// 生成文件
		$zip = new ZipArchive (); // 使用本类，linux需开启zlib，windows需取消php_zip.dll前的注释
		if ($zip->open ( $filename, ZIPARCHIVE::CREATE ) !== TRUE) {
			exit ( '无法打开文件，或者文件创建失败' );
		}
		 
		//$fileNameArr 就是一个存储文件路径的数组 比如 array('/a/1.jpg,/a/2.jpg....');
		//  $fileNameArr = array('files/image/1-150G61519503K.jpg');
		foreach ( $items as $val ) {
			$zip->addFile ( $val, basename ( $val ) ); // 第二个参数是放在压缩包中的文件名称，如果文件可能会有重复，就需要注意一下
		}
		$zip->close (); // 关闭
		 
		$this->todown($filename);
		return true;

	}
	public function todown($filename = null){ 
 
		//下面是输出下载;
		header ( "Cache-Control: max-age=0" );
		header ( "Content-Description: File Transfer" );
		header ( 'Content-disposition: attachment; filename=' . basename ( $filename ) ); // 文件名
		header ( "Content-Type: application/zip" ); // zip格式的
		header ( "Content-Transfer-Encoding: binary" ); // 告诉浏览器，这是二进制文件
		header ( 'Content-Length: ' . filesize ( $filename ) ); // 告诉浏览器，文件大小
		@readfile ( $filename );//输出文件;
		exit;
	}

}