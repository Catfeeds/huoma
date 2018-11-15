<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/20
 * Time: 11:16
 */

Class Log{
    public static function Info($content){
        self::write("3",$content);
    }
    public static function Error($content){
        self::write("1",$content);
    }
    public static function write($type,$content){
        Import::L('log/initlog.class.php');
        $log =Init_Log::get_instance();
        $log->log($type,$content, date('Y-n-j H:m:s'));
        $log->close();
    }

}