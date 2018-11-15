<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: hui.ctl.php 2015-12-01 14:56:23  xinghuali
 */

class Ctl_Center extends Ctl
{
   public function index($uid,$page = 1)
    {
        if(!$uid = (int)$uid){
            $this->error(404);
        }else if(!$designer = K::M('designer/designer')->detail($uid)){
            $this->err->add('此工程师不存在！', 212);
        }else{
//            $this->dump($designer);
            $fitler = array();
            $pager['page'] = $page = max((int)$page, 1);
            $pager['limit'] = $limit = 10;
            $pager['count'] = $count = 0;
            $filter = array('audit'=>1, 'closed'=>0, 'uid'=>$uid);
            $orderby = array('dateline'=>'DESC');
            if ($items = K::M('xiangmu/xiangmu')->items($filter, $orderby, $page, $limit, $count)) {
                        $pager['count'] = $count;
                        $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('list', array('{page}'), $params));
                        $this->pagedata['items'] = $items;
            }
            $xmcount = count($items);
        }
        $skills = explode(',',$designer['skills']);
        $this->pagedata['pager'] = $pager;
        $this->pagedata['designer'] = $designer;
        $this->pagedata['xmcount'] = $xmcount;
        $this->pagedata['skills'] = $skills;
        $this->pagedata['fans_num'] = K::M('designer/sheji')->fans_num($uid);
        $this->pagedata['follow_num'] = K::M('designer/sheji')->follow_num($uid);
        $this->tmpl = 'mobile:index/center.html';
    }

    public function follow($xiangmu_id){
        $sheji = K::M('designer/sheji')->shejidetail();
        $arr_uid = array('uid'=>$this->uid);

        if (empty($this->uid)){
            $this->err->add('请登录', 101);
        }elseif(in_array($arr_uid,$sheji)){
            $this->err->add('您已关注过此用户',1);
        }elseif (!$xiangmu_id = (int) $xiangmu_id){
            $this->error(404);
        }else {
            $data = array(
                'xiangmu_id' => $xiangmu_id,
                'uid' => $this->uid,
                'dateline' => __TIME
            );
            if(K::M('designer/sheji')->create($data)){
                $this->err->add('成功关注此用户');
            }
        }
    }
    
}