<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: widget.php 6072 2015-08-12 12:23:29  xinghuali
 */

class Widget_Member extends Model
{

    public function index(&$params)
    {
        
    }

    public function from(&$params)
    {
        if(!$params['tpl']){
            if(!in_array($params['type'], array('label', 'checkbox', 'radio', 'option'))){
                $params['type'] = 'option';
            }
            $params['tpl'] = 'widget:default/'.$params['type'].'.html';
        }
        $data['value'] = $params['value'] ? $params['value'] : 'member';
        $data['options'] = K::M('member/member')->from_list();
        return $data;        
    }

    public function group(&$params)
    {
        if(!$params['tpl']){
            if(!in_array($params['type'], array('label', 'checkbox', 'radio', 'option'))){
                $params['type'] = 'option';
            }
            $params['tpl'] = 'widget:default/'.$params['type'].'.html';
        }
        $data['from'] = $params['from'] ? $params['from'] : 'member';
        $data['value'] = $params['value'] ? $params['value'] : '';
        $data['options'] = K::M('member/group')->options($data['from']);
        return $data;
    }

    public function group_by_privs(&$params)
    {
        if(!$params['tpl']){
            if(!in_array($params['type'], array('label', 'checkbox', 'radio', 'option'))){
                $params['type'] = 'option';
            }
            $params['tpl'] = 'widget:default/'.$params['type'].'.html';
        }
        $data['name'] = $params['name'];
        $data['value'] = $params['value'] ? explode(',', $params['value']) : '';
        $data['options'] = K::M('member/group')->items_by_privs($params['privs']);
        return $data;
    }

    public function tendersfrom(&$params)
    {
        if(!$params['tpl']){
            if(!in_array($params['type'], array('label', 'checkbox', 'radio', 'option'))){
                $params['type'] = 'option';
            }
            $params['tpl'] = 'widget:default/'.$params['type'].'.html';
        }
        $data['name'] = $params['name'];        
        $data['value'] = $params['value'] ? explode(',', $params['value']) : '';
        $data['all'] = $params['value'] ? 0:1;
        $data['options'] = K::M('member/member')->from_list();
        unset($data['options'][array_search('参展商', $data['options'])]);
        return $data;        
    }
}