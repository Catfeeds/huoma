<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author @xinghuali<xinghuali@126.com>
 * $Id: index.ctl.php 2335 2015-11-18 17:15:56  xinghuali
 */
class Ctl_Member_Sheji_Project extends Ctl_Ucenter
{ 
    public function index($page=0)
    {
        $designer = $this->ucenter_designer();
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 20;
        $pager['count'] = $count = 0;
        $filter['uid'] = $designer['designer_id'];
        $filter['closed'] = 0;
        if ($items = K::M('project/project')->items_by_attr($filter, array('project_id'=>'DESC'), $page, $limit)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('member/sheji/zhantai:index', array('{page}')));
            $this->pagedata['items'] = $items;
        }

        //var_dump($items);die();
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'member/sheji/project/items.html';
    }

    public function create()
    {

        $designer = $this->ucenter_designer();
       //获取用户提交数据
        $data = $this->GP('data');
        if($data){
            //var_dump($data);die;
            //获取当前项目信息 判读是否为当前用户项目
            $xiangmu_uid = $detail = K::M('xiangmu/xiangmu')->detail($data['xiangmu_id']);   
            if($xiangmu_uid['uid'] == $designer['uid']){
                //遍历数据
                $url = $_FILES['data'];
                $url_addr = K::M('xiangmu/project')->url_address($url);
                
                $data['photo'] = $url_addr;
                 
                $pro = K::M('xiangmu/project')->create($data);
              // var_dump($pro);die;
                if($pro){
                    $this->err->add('添加成功');
                    $this->err->set_data('forward', $this->mklink('member/sheji/project:index'));

                }else{

                    $this->err->add('添加失败');
                }
               
            }else{
                $this->err->add('这不是您的项目');
            }

        }else{

            //获取项目id 如果有是从项目添加
            $uri = $this->request['uri'];
            if(preg_match('/project-create(-[\d\-]+)?(-(\d+)).html/i', $uri, $m)){
                //获取当前项目的uid
                $xiangmu_id = $m['3'];
            }
            if($xiangmu_id){
                $this->pagedata['xiangmu_id'] = $xiangmu_id;
                }
            //获取用户下的项目
            $xiangmu  = K::M('xiangmu/xiangmu')->xiangmu_all($designer['uid']);
            //var_dump($xiangmu);die;
            $this->pagedata['xiangmu'] = $xiangmu;
            $this->tmpl = 'member/sheji/project/create.html';
        }
      
        
    }


    public function edit()
    {   
        //获取用户信息
        $designer = $this->ucenter_designer();

        //获取方案ID
        $uri = $this->request['uri'];
        if(preg_match('/project-edit(-[\d\-]+)?(-(\d+)).html/i', $uri, $m)){

            $project_id = $m['3'];
            //获取当前方案的uid
           
            //var_dump($project_uid['uid']);die;
        }
        
        if($data = $this->GP('data')){
             $project_uid = K::M('project/project')->items_by_getone($data['project_id']);
          //var_dump($project_uid);die;
             if($project_uid['uid'] == $designer['uid']){
                unset($data['project_uid']);
                //设置附件属性
                //遍历数据
                $url = $_FILES['data'];
                if($url){
                    $url_addr = K::M('xiangmu/project')->url_address($url);
                    $data['photo'] = $url_addr;
                 }

                $pro = K::M('xiangmu/project')->edit($data);
                $this->err->add('修改成功');
                $this->err->set_data('forward', $this->mklink('member/sheji/project:index'));
            }else{
                $this->err->add('修改失败');
            }

        }else{

            //获取域名 进行地址填写
            $this->pagedata['img_url'] = 'http://'.$_SERVER["HTTP_HOST"].'/';
            //获取当前方案信息
            $project = K::M('project/project')->project_find($project_id);
            //获取用户下的项目
            $xiangmu  = K::M('xiangmu/xiangmu')->xiangmu_all($designer['uid']);
            $this->pagedata['designer'] = $designer;
            $this->pagedata['xiangmu'] = $xiangmu;
            $this->pagedata['project'] = $project;
          //  var_dump($project['project_id']);die;
             $this->tmpl = 'member/sheji/project/edit.html';                                
        }
       
    }


    public function delete($project_id= null)
    {      
       //获取方案id
        $uri = $this->request['uri'];
        if(preg_match('/project-delete(-[\d\-]+)?(-(\d+)).html/i', $uri, $m)){
            $project_id = $m['3'];
        }
        //获取用户信息
        $designer = $this->ucenter_designer();
        //获取当前方案信息 判读是否当前登陆用户操作
        $project = K::M('project/project')->items_by_getone($project_id);
        if($project['uid'] == $designer['uid']){

             $pro = K::M('xiangmu/project')->delete($project_id);
             if($pro){
                     $this->err->add('删除项目成功');
             }else{
                    $this->err->add('删除项目失败');
             }

        }else{

            $this->err->add('您无权操作他人方案');
        }
       

    }

}


