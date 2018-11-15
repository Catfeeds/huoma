<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: hui.ctl.php 2015-12-01 14:56:23  xinghuali
 */

class Ctl_Detail extends Ctl
{
    public function __construct(&$system)
    {
        parent::__construct($system);
        if(preg_match('/detail-(\d+)(\.html)?/i', $this->request['uri'], $m)){
            $this->request['act'] = 'index';
            $this->request['args'] = array($m[1]);

        }
    }

   public function index($xiangmu_id,$page = 1)
    {
        $info = array();
        $info['error'] = 0;
        $pager = $photos = $filter = array();
        $filter['xiangmu_id'] = $xiangmu_id;
        $photos = K::M('xiangmu/photo')->items($filter);
        
		$xiangmu = K::M('xiangmu/xiangmu')->detail($xiangmu_id);
		$xiangmu['desc'] = mb_substr($xiangmu['desc'], 0, 9999, 'UTF-8');
        $designer = K::M('designer/designer')->detail($xiangmu['uid']);
        $info['xiangmu'] = $xiangmu;

        K::M('xiangmu/xiangmu') -> update($xiangmu['xiangmu_id'],array('views'=>intval($xiangmu['views'])+1),true);

        $xmdetail = K::M('xiangmu/xiangmu')->xiangmudetail($xiangmu_id);

        $fitler = array();
        $pager['page'] = $page = max((int)$page, 1);
        $pager['limit'] = $limit = 4;
        $pager['count'] = $count = 0;
        $filter = array('xiangmu_id'=>$xiangmu_id);
        $orderby = array('uid'=>'DESC');

        $filter1 = array(
            'uid'=>'NOTIN:1'
        );
        $info['tjjishu'] = K::M('xiangmu/sheji')->items($filter1, $orderby, $page, $limit, $count);
        $info['tjjishu'] = K::M('designer/designer')->items_by_attr($filter1, $orderby, 1, $limit);
        $pager['countcoment'] = $count = 0;
        $comment = K::M('xiangmu/comment')->items_by_xiangmu($xiangmu_id, $page, $limit, $count);
        $pager['countcoment'] = $count;
        $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('detail-index', array($xiangmu_id, '{page}')));
        $uids = array();
        foreach($comment as $v){
            $uids[$v['uid']] = $v['uid'];
        }
        if($uids){
            $info['member_list'] = K::M('member/member')->items_by_ids($uids);
        }else{
            $info['member_list'] = array();
        }
        $info['comment'] = $comment;
        $pcount = count($comment);

        $info['xmarticle'] = K::M('designer/article')->items(array('xiangmu_id'=>$xiangmu_id), array('dateline'=>'DESC'), $page, $limit, $count);

        //本月下载排行
        $thismonth_start=mktime(0,0,0,date('m'),1,date('Y'));
        $thismonth_end=mktime(23,59,59,date('m'),date('t'),date('Y'));
        $filt['dateline'] = "<:".$thismonth_end;
        $filt['dateline'] = ">:".$thismonth_start;
        $info['items'] = K::M('xiangmu/xiangmu')->items($filt, array('xnum'=>'DESC'), $page, 20, $count);
        //获取团队信息
        $filt['xiangmu_id'] = $xiangmu_id;
        if ($items = K::M('xiangmu/xiangmuteam')->team_list(array('team_id'=> array($xmdetail['teamid'])), array('team_id'=>'DESC'), $page, 3, $count)) {
            foreach($items as $k => $v){
                $items[$k]['team_task_short'] = mb_substr(strip_tags($v['team_task']), 0, 15, 'UTF-8') . '...';
            }
        }
        $info['team'] = $items;
        //获取项目经验
        $filt['xiangmu_id'] = $xiangmu_id;
        $info['exp'] = K::M('xiangmu/xiangmuexp')->items($filt, null, $page, 2, $count);
        //是否关注过
        $sheji = K::M('xiangmu/sheji')->shejidetail();
        $arr_uid = array('uid'=>$this->uid);
        if(!empty($this->uid) && in_array($arr_uid,$sheji)) {
//            $this->pagedata['guanzhu'] = true;
            $info['guanzhu'] = 1;
        }else{
            $info['guanzhu'] = 0;
        }

        //相似项目
        $xiangsi_map = array(
            'xiangmu_id'=>"<>:".$xiangmu_id,
            'cat_id'=>$xiangmu['cat_id'],
            'closed'=>0
        );

        $this->system->config->load(array("site", "bulletin", "attach"));
        $info['attachurl'] =  Mdl_System_Config::$_CFG["attach"]["attachurl"];
        $info['xiangsi'] = K::M('xiangmu/xiangmu')->items($xiangsi_map, array('xiangmu_id'=>'DESC'), 1, 3, $count);
        $this->ajaxReturn($info);
        $this->pagedata['photos'] = $photos;
        $this->pagedata['xiangmu'] = $xiangmu;
        $this->pagedata['pager'] = $pager;
        $this->pagedata['designer'] = $designer;
        $this->pagedata['xmdetail'] = $xmdetail;
        $this->pagedata['pcount'] = $pcount;
        $this->tmpl = 'mobile:index/detail.html';
    }

    //发表评论
    public function detailcomment($xiangmu_id)
    {
        if (empty($this->uid)){
            $this->err->add('请登录', 101);
        }elseif (!$xiangmu_id = (int) $xiangmu_id){
            $this->error(404);
        }else if (!$detail = K::M('xiangmu/xiangmu')->detail($xiangmu_id)){
            $this->err->add('项目不存在或被删除', 212);
        }elseif($detail['uid'] == $this->uid){
            $this->err->add('自己无法评论自己', 212);
        }elseif (!$data = $this->GP('data')){
            $this->err->add('至少说点什么吧！', 212);
        }elseif($data['content']==''){
            $this->err->add('至少说点什么吧！', 212);
        }else {
            $data = array( 
                'xiangmu_id' => $xiangmu_id,
                'uid' => $this->uid,
                'content' => $data['content']
            );
            if(K::M('xiangmu/comment')->create($data)){
                K::M('xiangmu/xiangmu')->update_count($xiangmu_id, 'comments', 1);
                $this->err->add('评论发表成功！');
            }
        }
    }

    public function article($xiangmu_id,$page = 1)
    {
            if($data = $this->checksubmit('data')){
                if(!$data = $this->GP('data')){
                    $this->err->add('非法的数据提交', 201);
                }else{
                        $data['uid'] = $uid = $this->uid;
                        $data['xiangmu_id'] = $xiangmu_id;
                        if($article_id = K::M('designer/article')->create($data)){
                            K::M('designer/designer')->blog_count($uid);
                            $this->err->add('文章发布成功');
                            $this->err->set_data('forward', $this->mklink('detail',$xiangmu_id));
                        } 
                    }
            }else{
                $fitler = array();
                $pager['page'] = $page = max((int)$page, 1);
                $pager['limit'] = $limit = 5;
                $pager['count'] = $count = 0;
                $filter = array('audit'=>1,  'closed'=>0);
                $orderby = array('orderby'=>'ASC','xiangmu_id'=>'DESC');
                if ($xmarticle = K::M('designer/article')->items(array('xiangmu_id'=>$xiangmu_id), array('dateline'=>'DESC'), $page, $limit, $count)) {
                     $this->pagedata['xmarticle'] = $xmarticle;
                }  

                //本月下载排行
                $thismonth_start=mktime(0,0,0,date('m'),1,date('Y'));
                $thismonth_end=mktime(23,59,59,date('m'),date('t'),date('Y'));
                $filt['dateline'] = "<:".$thismonth_end;
                $filt['dateline'] = ">:".$thismonth_start;
                if ($items = K::M('xiangmu/xiangmu')->items($filt, array('xnum'=>'DESC'), $page, 20, $count)) {
                        $pager['count'] = $count;  
                        $this->pagedata['items'] = $items;
                }
                $xiangmu = K::M('xiangmu/xiangmu')->detail($xiangmu_id);
                $this->pagedata['xiangmu_id'] = $xiangmu_id;
                $this->pagedata['pager'] = $pager;
                $this->pagedata['xiangmu'] = $xiangmu;
                $this->tmpl = 'article.html';
            }
    }

    public function xmsheji($xiangmu_id,$type =1){
        $sheji = K::M('xiangmu/sheji')->shejidetailfollow($xiangmu_id,$this->uid,$type);
        $arr_uid = array('uid'=>$this->uid);

        if (empty($this->uid)){
            $this->err->add('请登录', 101);
        }elseif($sheji>0){
            $this->err->add('不可重复关注',1);
        }elseif (!$xiangmu_id = (int) $xiangmu_id){
            $this->error(404);
        }else {
            $data = array( 
                'xiangmu_id' => $xiangmu_id,
                'uid' => $this->uid,
                'dateline' => __TIME,
                'type' => $type
            );
            if(K::M('xiangmu/sheji')->create($data)){
                $xiangmu = K::M('xiangmu/xiangmu');
                $xiangmu_info = $xiangmu->detail($xiangmu_id);
                $xiangmu->update($xiangmu_id,array('favorites'=>$xiangmu_info['favorites']+1));
                $this->err->add('欢迎关注');
            }
        }
    }
    
}