<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: index.ctl.php  2015-12-01 13:02:23  xinghuali
 */

class Ctl_Website_collect extends Ctl
{
    public function index()
    {
        $this->tmpl = 'website/collect.html';
    }

    public function cai(){
        $password = $_GET['p'];
        if($password!='qazxswedcvfrtgbnhyujm') {
            exit( "<h1>非法访问！</h1>");
        }
        include(dirname(__file__).'/bangcommon.php');
        $dbConfig = include_once(dirname(__file__).'/config.php');
        $conn=mysql_connect($dbConfig['dbHost'],$dbConfig['dbUser'],$dbConfig['dbPass'],$dbConfig['dbName']);
        mysql_select_db($dbConfig['dbName'],$conn);
        mysql_query('set names \'utf8\'');

        ob_start(); //打开输出缓冲区
        ob_end_flush();
        ob_implicit_flush(true); //立即输出

        //获取当前网址
        $now_domain = $_SERVER['HTTP_HOST'];
//	$site_url =  'http://lxh/';//修改为部署时的子域名
        $num=0;
        $url_shuaxin = 'http://'.$now_domain.'/1qiso_cai.php?p=qazxswedcvfrtgbnhyujm';

        $sql_zhu = "CREATE TABLE IF NOT EXISTS `xhl_1qiso` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `host` varchar(200) DEFAULT NULL,
	  `statu` int(1) DEFAULT '0',
	  `addtime` int(11) DEFAULT '0',
	  `listtime` int(11) DEFAULT '0',
	  PRIMARY KEY (`id`)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;
	";
        mysql_query($sql_zhu);
        //如果session是空的列表
        $html_str = $_POST['html_str'];
        $html_str = "https://www.baidu.com";
        if(!empty($html_str)){
//			$_SESSION['mrcharset'] = $_POST['charset'];
//			$charset = $_POST['charset'];
            $url_list = $tmp_list = $host_arr = $host_array_url = array();
            $tmp_list = explode("\n",$_POST['html_str']);
            foreach($tmp_list as $urlval){
                $urlval = str_replace("\r",'',$urlval);
                $urlval = str_replace("\n",'',$urlval);
                $host_arr[] = get_domain($urlval);
                $url_list []=strtolower($urlval);
            }
            $sql = "SELECT id,host FROM xhl_1qiso where host in ('".implode("','",$host_arr)."')";
            $result=mysql_query($sql);
            while($row=mysql_fetch_array($result)){
                $host_array_url[]=$row['host'];
            }
            if(count($host_array_url)<count($url_list)){
                $sql_values = 'insert into xhl_1qiso(host,addtime,listtime)values';
                foreach($url_list as $key=>$urlval){
                    $val = get_domain($urlval);
                    if(!in_array($val,$host_array_url)){
                        $t = time();
                        $sql_values.="('".$val."',".$t.",".$t."),";
                        $tname = 'xhl_'.str_replace('.','_',$val);
                        $tname = str_replace('-','_',$tname);
                        $sql = "CREATE TABLE IF NOT EXISTS `{$tname}_url` (
                                  `id` int(11) NOT NULL AUTO_INCREMENT,
                                  `title` varchar(300) DEFAULT NULL,
                                  `url` varchar(300) DEFAULT NULL,
                                  `cfnum` int(10) DEFAULT '0',
                                  `statu` int(2) DEFAULT '0',
                                  PRIMARY KEY (`id`)
                                ) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
                        mysql_query($sql);
                        $sql = "CREATE TABLE IF NOT EXISTS `{$tname}_url_ly` (
                                  `id` int(11) NOT NULL AUTO_INCREMENT,
                                  `url_ly` varchar(300) DEFAULT NULL,
                                  `title` varchar(300) DEFAULT NULL,
                                  `url` varchar(300) DEFAULT NULL,
                                  PRIMARY KEY (`id`)
                                ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
                                ";
                        mysql_query($sql);
                        $sql = "CREATE TABLE IF NOT EXISTS `{$tname}_html` (
                                  `id` int(11) NOT NULL AUTO_INCREMENT,
                                  `url` varchar(200) DEFAULT NULL,
                                  `unum` int(4) NOT NULL DEFAULT '0',
                                  `cnum` int(4) DEFAULT NULL,
                                  `statu` int(4) NOT NULL DEFAULT '0',
                                  `html` text,
                                  PRIMARY KEY (`id`)
                                ) ENGINE=MyISAM DEFAULT CHARSET=utf8;
                                ";
                        mysql_query($sql);
                    }
                }
                $sql_values = substr($sql_values,0,strlen($sql_values)-1);
                mysql_query($sql_values);
            }
        }else{

            $charset = $_SESSION['mrcharset'];
            $sql = "SELECT id,host FROM xhl_1qiso where statu=0";
            $result=mysql_query($sql);
            while($row1=mysql_fetch_array($result)){
                $tname = 'xhl_'.str_replace('.','_',$row1['host']).'_url';
                $tname = str_replace('-','_',$tname);
                $host_array_url[]=$row['host'];
                $sql = "SELECT url FROM {$tname} where statu=0 ORDER BY id ASC";
                $result=mysql_query($sql);
                while($row=mysql_fetch_array($result)){
                    $url_list[]=$row['url'];
                }
            }
        }
        if(count($url_list)==0){
            echo "获取可采集列表为空 <a href='1qiso.php'>back</a>";
            exit;
        }
        foreach($url_list as $urlval){
            echo $urlval.'<br>';
            //主网站目录
            $url_array = explode("/",$urlval);
            $url_file = $url_zhu = '';
            if(count($url_array)>3){
                array_pop($url_array);
            }
            foreach($url_array as $key=>$uval){
                if($key<3){
                    $url_zhu.=$uval.'/';
                }
                $url_file.=$uval.'/';
            }
            $urlhost = get_domain($urlval);
            $tname = 'xhl_'.str_replace('.','_',$urlhost).'_';
            $tname = str_replace('-','_',$tname);
            $ref=$urlval;

            $html = get_contents($urlval,1,$ref);


            preg_match("/charset=([\w|\-]+);?/", $html, $match);
            if (isset($match[1])) {
                $charset = $match[1];
                $charset = strtolower($charset);
            }
            if($charset!='utf-8'){
                $html = str_replace($match[1], "utf-8", $html);

                $html = iconv($charset, 'utf-8//IGNORE', $html);
            }
            $url_all = get_all_url($html);
            //	$url_all = $url_all['url'];
            //去重
            $url_list = array_unique($url_all['url']);
            //连接处理
            $zhan_url=array();

            foreach($url_list as $key=>$val){
                $val=trim($val);
                $val=strtolower($val);
                $jval = substr($val,0,10);
                if(!empty($val) && $val != '#' && $jval != 'javascript'){
                    //如果包含http 再判断是否当前域名
                    if(strstr($val,'http://') || strstr($val,'https://')){
                        $host = get_domain($val);
                        if($urlhost==$host){
                            $zhan_url[$key]=$val;
                        }else{

                        }
                    }else{
                        $fstr = substr($val,0,1);
                        if($fstr=='/'){
                            $zhan_url[$key] = $url_zhu.substr($val,1);
                        }else{
                            $zhan_url[$key] = $url_file.$val;
                        }
                    }
                }
            }
            $zhan_url = array_unique($zhan_url);
            $url_array_url = array();
            $url_array_id = array();
            $sql = "SELECT id,url FROM {$tname}url where url in ('".implode("','",$zhan_url)."')";
            $result=mysql_query($sql);
            while($row=mysql_fetch_array($result)){
                $url_array_url[]=$row['url'];
                $url_array_id[]=$row['id'];
            }
            //是否存在重复
            $sql_values = "insert into {$tname}url(title,url)values";
//				$sql_url_ly = 'insert into url_ly(url_ly,title,url,similar)values';
            $sql_url_ly = "insert into {$tname}url_ly(url_ly,title,url)values";
            $cnum = count($url_array_url); //重复url
            $unum = count($zhan_url);  //页面存在url
            foreach($zhan_url as $key=>$val){
                $title = strip_tags($url_all['name'][$key]);
                $title = trim($title);
                if(!in_array($val,$url_array_url)){
                    $sql_values.="('".$title."','".$val."'),";
                }
                //保存网址相似度
                if($urlval!=$val){
                    //	similar_text($urlval, $val, $percent); //比较相似度 存放于$percent
                    //	$sql_url_ly.="('".$urlval."','".$title."','".$val."',".$percent."),";
                    $sql_url_ly.="('".$urlval."','".$title."','".$val."'),";
                }
            };
            $sql_values = substr($sql_values,0,strlen($sql_values)-1);
            $sql_url_ly = substr($sql_url_ly,0,strlen($sql_url_ly)-1);
            mysql_query($sql_values);
            mysql_query($sql_url_ly);


            preg_match("/charset=([\w|\-]+);?/", $html, $match);
            $match[1] = strtolower($match[1]);
            if($match[1]!='utf-8'){
                $html = iconv($match[1],"utf-8//IGNORE",$html);
            }

            $sql="insert into {$tname}html(url,unum,cnum,html)values('".$urlval."',".$unum.",".$cnum.',"'.addslashes($html).'")';
            if($cnum>0){
                mysql_query("UPDATE {$tname}url SET cfnum=cfnum+1 where id in (".implode(",",$url_array_id).")");
            }
            mysql_query($sql);
            mysql_query("UPDATE {$tname}url SET statu=1 where url='".$urlval."'");
        }


        echo "<script language='javascript' type='text/javascript'>";
        echo "window.location.href='$url_shuaxin'";
        echo "</script>";
    }
}