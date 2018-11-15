<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: comment.ctl.php 2015-09-27 02:07:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Xiangmu_Comment extends Ctl
{
    
    public function index($page=1)
    {
    	$filter = $pager = array();
    	$pager['page'] = max(intval($page), 1);
    	$pager['limit'] = $limit = 50;
        if($SO = $this->GP('SO')){
            $pager['SO'] = $SO;
            if($SO['comment_id']){$filter['comment_id'] = $SO['comment_id'];}
            if($SO['xiangmu_id']){$filter['xiangmu_id'] = $SO['xiangmu_id'];}
            if($SO['uid']){$filter['uid'] = $SO['uid'];}
            if($SO['content']){$filter['content'] = "LIKE:%".$SO['content']."%";}
            if($SO['closed']){$filter['closed'] = $SO['closed'];}
            if(is_array($SO['dateline'])){if($SO['dateline'][0] && $SO['dateline'][1]){$a = strtotime($SO['dateline'][0]); $b = strtotime($SO['dateline'][1]);$filter['dateline'] = $a."~".$b;}}
        }
        $filter['closed'] = 0;
        if($items = K::M('xiangmu/comment')->items($filter, array('dateline'=>'DESC'), $page, $limit, $count)){
        	$pager['count'] = $count;
        	$pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')), array('SO'=>$SO));;
        }
        $this->pagedata['items'] = $items;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'admin:xiangmu/comment/items.html';
    }

    public function so()
    {
        $this->tmpl = 'admin:xiangmu/comment/so.html';
    }

    public function detail($pk)
    {
    	$this->pagedata['detail'] = K::M('xiangmu/comment')->detail($pk);
    	$this->tmpl = 'admin:xiangmu/comment/detail.html';
    }

    public function create()
    {
        if($this->checksubmit()){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{
                $data['replytime'] = __TIME;
                $data['replyip']   = __IP;
                if($comment_id = K::M('xiangmu/comment')->create($data)){
                    $this->err->add('添加评论成功');
                    $this->err->set_data('forward', '?xiangmu/comment-index.html');
                }
            } 
        }else{
           $this->tmpl = 'admin:xiangmu/comment/create.html';
        }
    }

    public function edit($pk=null)
    {
        if($this->checksubmit()){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else if(!$comment_id = $this->GP('comment_id')){
                $this->err->add('未指要修改ID', 202);
            }else{
                $data['replytime'] = __TIME;
                $data['replyip']   = __IP;
                if(K::M('xiangmu/comment')->update($comment_id, $data)){
                    $this->err->add('修改评论成功');
                }  
            } 
        }else{
        	$this->pagedata['detail'] = K::M('xiangmu/comment')->detail($pk);
        	$this->tmpl = 'admin:xiangmu/comment/edit.html';
        }
    }

    public function delete($pk=null)
    {
        if(!empty($pk)){
            if(K::M('xiangmu/comment')->delete($pk)){
                $this->err->add('删除成功');
            }
        }else if($pks = $this->GP('comment_id')){
            if(K::M('xiangmu/comment')->delete($pks)){
                $this->err->add('批量删除成功');
            }
        }else{
            $this->err->add('未指定要删除的内容ID', 401);
        }
    }

}