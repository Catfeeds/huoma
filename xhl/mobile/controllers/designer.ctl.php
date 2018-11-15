<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: index.ctl.php 2335 2015-11-18 17:15:56  xinghuali
 */
class Ctl_Designer extends Ctl
{ 
    public function index()
    {
       
        $this->system->config->load(array("site", "bulletin", "attach"));
        $attachurl =  Mdl_System_Config::$_CFG["attach"]["attachurl"];
        $filter = array();
        $filter['closed'] = 0;
        $filter['audit'] = 1;
        $page = 1;
        if($this->GP('page')){
            $page = $this->GP('page');
        }
        if($this->GP('keywords')){
            $filter['name'] = "LIKE:%".$this->GP('keywords')."%";
        }
        $project = K::M('designer/designer')->items_by_attr($filter, array('uid'=>'DESC'), $page, 8);
        foreach($project as $k => $v){
            $project[$k]['about'] = mb_substr(strip_tags($v['about']), 0, 24, 'UTF-8');
            if(strlen($project[$k]['about']) > 20){
                $project[$k]['about'] .= '...';
            }
            $project[$k]['uname'] = $v['uname']?$v['uname']:'匿名';
            if($v['face']){
                $project[$k]['thumb_url'] = $attachurl."/".$v['face'];
            }else{
                $project[$k]['thumb_url'] = $attachurl."/face/face.jpg";
            }
        }
//        $this->dump($project);
        $res = array(
            'info' =>$project,
            'attachurl' => $attachurl
        );
//        $this->dump($res);
        echo json_encode($res);die;

    }
    public function follow_designer()
    {

        $this->system->config->load(array("site", "bulletin", "attach"));
        $attachurl =  Mdl_System_Config::$_CFG["attach"]["attachurl"];
        $filter = array();
        $filter['closed'] = 0;
        $filter['audit'] = 1;
        $page = 1;
        $member = $this->MEMBER;
        $map = array(
            'uid'=>$member['uid'],
            'type'=>2
        );
        $follow_project = K::M('xiangmu/sheji')->get_all($map);
        $ids = "";
        foreach($follow_project as $k=>$v){
            $ids .= $ids?",":"";
            $ids .= $v['xiangmu_id'];
        }
        if($ids){
            $filter['uid']=array(
                'in'=>$ids
            );
        }else{
            $filter['uid'] = 0;
        }
        if($this->GP('page')){
            $page = $this->GP('page');
        }
        if($this->GP('keywords')){
            $filter['name'] = "LIKE:%".$this->GP('keywords')."%";
        }
        $project = K::M('designer/designer')->items_by_attr($filter, array('uid'=>'DESC'), $page, 8);
        foreach($project as $k => $v){
            $project[$k]['about'] = mb_substr(strip_tags($v['about']), 0, 24, 'UTF-8');
            if(strlen($project[$k]['about']) > 20){
                $project[$k]['about'] .= '...';
            }
            $project[$k]['uname'] = $v['uname']?$v['uname']:'匿名';
            if($v['face']){
                $project[$k]['thumb_url'] = $attachurl."/".$v['face'];
            }else{
                $project[$k]['thumb_url'] = $attachurl."/face/face.jpg";
            }
        }
//        $this->dump($project);
        $res = array(
            'info' =>$project,
            'attachurl' => $attachurl
        );
//        $this->dump($res);
        echo json_encode($res);die;

    }

    public function detail($uid){
        $info = array();
        $this->system->config->load(array("site", "bulletin", "attach"));
        $info['attachurl'] =  Mdl_System_Config::$_CFG["attach"]["attachurl"];
        if(!$uid = (int)$uid){
            $info['error'] = 1;
            $info['message'] = "此工程师不存在";
            $this->ajaxReturn($info);
        }
        if(!$designer = K::M('designer/designer')->detail($uid)){
            $info['error'] = 1;
            $info['message'] = "此工程师不存在";
            $this->ajaxReturn($info);
        }
        $count = 0;
        $filter = array('audit'=>1, 'closed'=>0, 'uid'=>$uid);
        $orderby = array('dateline'=>'DESC');
        $items = K::M('xiangmu/xiangmu')->items($filter, $orderby, 1, 10, $count);
        $info['items'] = $items;
        $info['designer'] = $designer;
        $info['xmcount'] = count($items);
        $info['skills'] = explode(',',$designer['skills']);
        $info['fans_num'] = K::M('designer/sheji')->fans_num($uid);
        $info['follow_num'] = K::M('designer/sheji')->follow_num($uid);
        $this->ajaxReturn($info);
    }

    public function industry(){
        $industry = $this->GP('industry');
        $member =  $this->MEMBER;
        if($member['uid'] == ''){
            $return['error'] = 1;
            $return['message'] = "请先登录";
        }
        $industry_model = K::M('designer/preference');
        $detail = $industry_model->detail($member['uid']);
        // 如果不存在当前用户的偏好设置 , 新生成一个
        if($detail == ''){
            $industry_model->create(array('uid'=>$member['uid']));
            $detail = $industry_model->detail($member['uid']);
        }
        //如果有提交的内容 , 修改字段值 ,字段用json格式保存
        if($industry){
            $industry_arr = json_decode($detail['industry'],true);
            $industry_arr[] = $industry;
            $data['industry'] = addslashes(json_encode((object)$industry_arr));
            $industry_model -> update($detail['id'],$data);
        }
        $return['error'] = 0;
        $return['message'] = "保存成功";
        $this->ajaxReturn($return);
    }

    public function skill(){
        $skillname = $this->GP('skillname');
        $skilllevel = intval($this->GP('skilllevel'));
        $member =  $this->MEMBER;
        if($member['uid'] == ''){
            $return['error'] = 1;
            $return['message'] = "请先登录";
        }
        $preference_model = K::M('designer/preference');
        $detail = $preference_model->detail($member['uid']);
        // 如果不存在当前用户的偏好设置 , 新生成一个
        if($detail == ''){
            $preference_model->create(array('uid'=>$member['uid']));
            $detail = $preference_model->detail($member['uid']);
        }
        //如果有提交的内容 , 修改字段值 ,字段用json格式保存
        if($skillname && $skilllevel){
            $skill_arr = json_decode($detail['skill'],true);
            $skill_arr[] = array(
                'name'=>$skillname,
                'level'=>$skilllevel
            );
            $data['skill'] = addslashes(json_encode((object)$skill_arr));
            $preference_model -> update($detail['id'],$data);
        }
        $return['error'] = 0;
        $return['message'] = "保存成功";
        $this->ajaxReturn($return);
    }

    public function edu(){
        $schoolname = $this->GP('schoolname');
        $majorstr = $this->GP('majorstr');
        $degree = $this->GP('degree');
        $date_start = $this->GP('date_start');
        $date_end = $this->GP('date_end');
        $member =  $this->MEMBER;
        if($member['uid'] == ''){
            $return['error'] = 1;
            $return['message'] = "请先登录";
        }
        $preference_model = K::M('designer/preference');
        $detail = $preference_model->detail($member['uid']);
        // 如果不存在当前用户的偏好设置 , 新生成一个
        if($detail == ''){
            $preference_model->create(array('uid'=>$member['uid']));
            $detail = $preference_model->detail($member['uid']);
        }
        //如果有提交的内容 , 修改字段值 ,字段用json格式保存
        if($schoolname){
            $edu_arr = json_decode($detail['edu'],true);
            $edu_arr[] = array(
                'schoolname'=>$schoolname,
                'majorstr'=>$majorstr,
                'degree'=>$degree,
                'date_start'=>$date_start,
                'date_end'=>$date_end
            );
            $data['edu'] = addslashes(json_encode((object)$edu_arr));
            $preference_model -> update($detail['id'],$data);
        }
        $return['error'] = 0;
        $return['message'] = "保存成功";
        $this->ajaxReturn($return);
    }

    public function job(){
        $orgname = $this->GP('orgname');
        $job = $this->GP('job');
        $workdesc = $this->GP('workdesc');
        $job_start = $this->GP('job_start');
        $job_end = $this->GP('job_end');
        $member =  $this->MEMBER;
        if($member['uid'] == ''){
            $return['error'] = 1;
            $return['message'] = "请先登录";
        }
        $preference_model = K::M('designer/preference');
        $detail = $preference_model->detail($member['uid']);
        // 如果不存在当前用户的偏好设置 , 新生成一个
        if($detail == ''){
            $preference_model->create(array('uid'=>$member['uid']));
            $detail = $preference_model->detail($member['uid']);
        }
        //如果有提交的内容 , 修改字段值 ,字段用json格式保存
        if($orgname){
            $job_arr = json_decode($detail['job'],true);
            $job_arr[] = array(
                'orgname'=>$orgname,
                'job'=>$job,
                'workdesc'=>$workdesc,
                'job_start'=>$job_start,
                'job_end'=>$job_end
            );
            $data['job'] = addslashes(json_encode((object)$job_arr));
            $preference_model -> update($detail['id'],$data);
        }
        $return['error'] = 0;
        $return['message'] = "保存成功";
        $this->ajaxReturn($return);
    }

    public function preference(){
        $industry = $this->GP('industry');
        $member =  $this->MEMBER;
        if($member['uid'] == 0){
            $return['error'] = 1;
            $return['message'] = "请先登录";
            $this->ajaxReturn($return);
        }
        $industry_model = K::M('designer/preference');
        $detail = $industry_model->detail($member['uid']);
        // 如果不存在当前用户的偏好设置 , 新生成一个
        if($detail == ''){
            $industry_model->create(array('uid'=>$member['uid']));
            $detail = $industry_model->detail($member['uid']);
        }
        $detail['industry'] = json_decode($detail['industry'],true);
        $detail['skill'] = json_decode($detail['skill'],true);
        $detail['edu'] = json_decode($detail['edu'],true);
        $detail['job'] = json_decode($detail['job'],true);
        $return['error'] = 0;
        $return['info'] = $detail;
        $this->ajaxReturn($return);
    }
    //删除熟悉的领域
    public function del_industry(){
        $key = $this->GP('key');
        $member =  $this->MEMBER;
        $industry_model = K::M('designer/preference');
        $detail = $industry_model->detail($member['uid']);
        $industry = json_decode($detail['industry'],true);

        $temp_arr = array();
        foreach($industry as $k=>$v){
            if($k != $key){
                $temp_arr[$k] = $v;
            }
        }
        $data['industry'] = addslashes(json_encode((object)$temp_arr));
        $industry_model -> update($detail['id'],$data);
        $return['error'] = 0;
        $return['info'] = $detail;
        $this->ajaxReturn($return);
    }
    //删除专业技能
    public function del_skill(){
        $key = $this->GP('key');
        $member =  $this->MEMBER;
        $preference_model = K::M('designer/preference');
        $detail = $preference_model->detail($member['uid']);
        $skill = json_decode($detail['skill'],true);

        $temp_arr = array();
        foreach($skill as $k=>$v){
            if($k != $key){
                $temp_arr[$k] = $v;
            }
        }
        $data['skill'] = addslashes(json_encode((object)$temp_arr));
        $preference_model -> update($detail['id'],$data);
        $return['error'] = 0;
        $return['info'] = $detail;
        $this->ajaxReturn($return);
    }
    //删除专业技能
    public function del_edu(){
        $key = $this->GP('key');
        $member =  $this->MEMBER;
        $preference_model = K::M('designer/preference');
        $detail = $preference_model->detail($member['uid']);
        $edu = json_decode($detail['edu'],true);

        $temp_arr = array();
        foreach($edu as $k=>$v){
            if($k != $key){
                $temp_arr[$k] = $v;
            }
        }
        $data['edu'] = addslashes(json_encode((object)$temp_arr));
        $preference_model -> update($detail['id'],$data);
        $return['error'] = 0;
        $return['info'] = $detail;
        $this->ajaxReturn($return);
    }
    //删除工作经验
    public function del_job(){
        $key = $this->GP('key');
        $member =  $this->MEMBER;
        $preference_model = K::M('designer/preference');
        $detail = $preference_model->detail($member['uid']);
        $job = json_decode($detail['job'],true);

        $temp_arr = array();
        foreach($job as $k=>$v){
            if($k != $key){
                $temp_arr[$k] = $v;
            }
        }
        $data['job'] = addslashes(json_encode((object)$temp_arr));
        $preference_model -> update($detail['id'],$data);
        $return['error'] = 0;
        $return['info'] = $detail;
        $this->ajaxReturn($return);
    }

    //房间列表
    public function room_list(){
        $filter['closed'] = 0;
        $filter['audit'] = 1;
        $page = 1;
        if($this->GP('page')){
            $page = $this->GP('page');
        }
        if($this->GP('cat_id')){
            $filter['cat_id'] = $this->GP('cat_id');
        }
        if($this->GP('keyword')){
            $filter['title'] = "LIKE:%".$this->GP('keyword')."%";
        }
        if ($project = K::M('xiangmu/xiangmu')->items($filter, array('xiangmu_id'=>'DESC'), $page, 8)) {
            foreach($project as $k => $v){
                $project[$k]['desc'] = mb_substr($v['desc'], 0, 27, 'UTF-8') . '...';
                $project[$k]['title'] = mb_substr($v['title'], 0, 9, 'UTF-8') . '';
            }
            $this->pagedata['project'] = $project;
        }
        $this->system->config->load(array("site", "bulletin", "attach"));
        $attachurl =  Mdl_System_Config::$_CFG["attach"]["attachurl"];
        $project[1] = array('xiangmu_id'=>1,'title'=>'大厅');
        $res = array(
            'info' =>$project,
            'attachurl' => $attachurl
        );
        $this->ajaxReturn($res);
    }

}


