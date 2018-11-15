<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: blog.ctl.php 9372 2015-11-26 06:32:36  xinghuali
 */

class Ctl_Member_Designer_Blog extends Ctl_Ucenter
{
    
    protected $_allower_fields = 'article_id,city_id,uid,title,content,is_top,views,audit,clientip,dateline';

    public function index($page = 1)
    {
        $designer = $this->ucenter_designer();
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 20;
        $filter['uid'] = $designer['designer_id'];
        $filter['closed'] = 0;
        if ($items = K::M('designer/article')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
            $this->pagedata['items'] = $items;
        }        
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile:member/designer/blog/items.html';
    }
	
	public function listcon($page = 0)
    {
		if(!$page = $this->GP('page')){
			$page=1;
		}
        $designer = $this->ucenter_designer();
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 20;
        $filter['uid'] = $designer['designer_id'];
        $filter['closed'] = 0;
        if ($items = K::M('designer/article')->items($filter, null, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink(null, array('{page}')));
            $this->pagedata['items'] = $items;
        }        
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'mobile:member/designer/blog/listcon.html';
    }

    public function create()
    {
        $designer = $this->ucenter_designer();
        if(K::M('system/integral')->check('blog',  $this->MEMBER) === false){
            $this->err->add('很抱歉您的账户余额不足！', 201);
        }else if($data = $this->checksubmit('data')){
            $allow_blog = K::M('member/group')->check_priv($designer['group_id'], 'allow_blog');
            if($allow_blog<0){
				$this->err->add('您是【'.$designer['group_name'].'】没有权限上传文章', 333);
			}else if(!$data = $this->check_fields($data, $this->_allower_fields)){
                $this->err->add('非法的数据提交', 201);
            }else{
					$data['city_id'] = $this->request['city_id'];
					$data['uid'] = $uid = $this->uid;
					$data['audit'] = $allow_blog;
					if($article_id = K::M('designer/article')->create($data)){
						K::M('designer/designer')->blog_count($uid);
						$this->err->add('文章发布成功');
						$this->err->set_data('forward', $this->mklink('member/designer/blog:index'));
					} 
                }
        } else {
            $this->pagedata['pager'] = $pager;
            $this->tmpl = 'mobile:member/designer/blog/create.html';
        }
    }

    public function edit($article_id = null)
    {
        $designer = $this->ucenter_designer();
        if (!($article_id = (int) $article_id) && !($article_id = (int)$this->GP('article_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('designer/article')->detail($article_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } elseif ($detail['uid'] != $designer['designer_id']) {
            $this->err->add('不许越权管理别人的内容', 212);
        } else if ($data = $this->checksubmit('data')) {
            $allow_blog = K::M('member/group')->check_priv($designer['group_id'], 'allow_blog');
            if($allow_blog<0){
				$this->err->add('您是【'.$designer['group_name'].'】没有权限修改文章', 333);
			}elseif (!$data = $this->check_fields($data,  $this->_allower_fields)) {
                $this->err->add('非法的数据提交', 201);
            } else {
				unset($data['city_id'],$data['uid']);
				if(K::M('designer/article')->update($article_id, $data)){
					$this->err->add('修改内容成功');
					$this->err->set_data('forward', $this->mklink('member/designer/blog:index'));
				}
            }
        } else {
           
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'mobile:member/designer/blog/edit.html';
        }
    }

   
    public function delete($article_id= null)
    {
        $designer = $this->ucenter_designer();
        if (!($article_id = (int) $article_id) && !($article_id = (int)$this->GP('article_id'))) {
            $this->error(404);
        }else if(!$case = K::M('designer/article')->detail($article_id)){
            $this->err->add('文章不存在或已经删除', 212);
        }else if ($case['uid'] != $designer['designer_id']) {
            $this->err->add('不许越权管理别人的文章', 212);
        }else if(K::M('designer/article')->delete($article_id)){
            $this->err->add('删除文章成功');
        }   
    }

}