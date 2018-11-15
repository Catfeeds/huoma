<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: zhantai.ctl.php  2016-01-12 22:07:36  xinghuali
 */

class Ctl_Member_Sheji_Zhantai extends Ctl_Ucenter
{

    protected $_allower_fields = 'mianji,title,intro,istz';

    public function index($page = 1)
    {
        $designer = $this->ucenter_designer();
        $filter = $pager = array();
        $pager['page'] = max(intval($page), 1);
        $pager['limit'] = $limit = 20;
        $filter['uid'] = $designer['designer_id'];
        $filter['closed'] = 0;
        $orderby = array('orderby'=>'ASC','xiangmu_id'=>'DESC');
        if ($items = K::M('xiangmu/xiangmu')->items($filter, $orderby, $page, $limit, $count)) {
            $pager['count'] = $count;
            $pager['pagebar'] = $this->mkpage($count, $limit, $page, $this->mklink('member/sheji/zhantai:index', array('{page}')));
            $this->pagedata['items'] = $items;
        }
       // echo "<pre>";
       // var_dump($items);die;
        $this->pagedata['pager'] = $pager;
        $this->tmpl = 'member/sheji/zhantai/items.html';
    }

    public function create()
    {

       
     
        $designer = $this->ucenter_designer();
        if($data = $this->checksubmit('data')){
            if(!$data = $this->GP('data')){
                $this->err->add('非法的数据提交', 201);
            }else{

                 if ($_FILES['data']) {
                   // echo "<pre>";
                    //var_dump($_FILES['data']);die;
                    foreach ($_FILES['data'] as $k => $v) {
                        foreach ($v as $kk => $vv) {
                            $attachs[$kk][$k] = $vv;
                        }
                    }
                    $cfg = K::$system->config->get('attach');
                  // 
                    $oImg = K::M('image/gd');
                    $upload = K::M('magic/upload');
                    foreach ($attachs as $k => $attach) {
                        if ($attach['error'] == UPLOAD_ERR_OK) {
                            if ($a = $upload->upload($attach, 'company')) {
                                $data[$k] = $a['photo'];
                                if ($k === 'logo') {
                                    $size['photo'] = $cfg['company']['logo'] ? $cfg['company']['logo'] : '200X100';
                                } else {
                                    $size['photo'] = $cfg['company']['thumb'] ? $cfg['company']['thumb'] : '300X300';
                                }
                                $oImg->thumbs($a['file'], array($size['photo'] => $a['file']));
                            }
                        }
                    }
                }
               // $data['from'] = $this->xiangmu_from;
                $data['uid'] = $designer['uid'];
                //获取图片介绍
                $data['photo'] =   K::M('xiangmu/xiangmu')->photofetch($data['photo[']);

                //var_dump($data);die;
                $data['audit'] = 1;
                if($xiangmu_id = K::M('xiangmu/xiangmu')->create($data)){
                    $this->err->add('添加项目成功');
                    $this->err->set_data('forward', $this->mklink('member/sheji/zhantai:index'));
                }
            }
        }else {
            //获取行业分类
            $hangye =  K::M('xiangmu/cate')->hangye_all();
            //获取开发语言
            $yuyan =  K::M('xiangmu/cate')->yuyan_all();
            //获取开发原型
            $yuanxing =  K::M('xiangmu/cate')->yuanxing_all();
            //echo " <pre>";
           //var_dump($yuyan);die; 
            $this->pagedata['img_url'] = 'http://'.$_SERVER["HTTP_HOST"].'/';
            $this->pagedata['hangye'] = $hangye;
            $this->pagedata['yuyan'] = $yuyan;
            $this->pagedata['yuanxing'] = $yuanxing;
            $this->tmpl = 'member/sheji/zhantai/create.html';
        }
    }

    public function edit($xiangmu_id = null)
    {



       $designer = $this->ucenter_designer();
        
        if (!($xiangmu_id = (int) $xiangmu_id) && !($xiangmu_id = (int)$this->GP('xiangmu_id'))) {
         
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('xiangmu/xiangmu')->detail($xiangmu_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } elseif ($detail['uid'] != $designer['uid']) {

            $this->err->add('不许越权管理别人的内容', 212);
        } else if ($data = $this->checksubmit('data')) {
				if ($_FILES['data']) {
                    foreach ($_FILES['data'] as $k => $v) {
                        foreach ($v as $kk => $vv) {
                            $attachs[$kk][$k] = $vv;
                        }
                    }
                    $cfg = K::$system->config->get('attach');
                    $oImg = K::M('image/gd');
                    $upload = K::M('magic/upload');
                    foreach ($attachs as $k => $attach) {
                        if ($attach['error'] == UPLOAD_ERR_OK) {
                            if ($a = $upload->upload($attach, 'company')) {
                                $data[$k] = $a['photo'];
                                if ($k === 'logo') {
                                    $size['photo'] = $cfg['company']['logo'] ? $cfg['company']['logo'] : '200X100';
                                } else {
                                    $size['photo'] = $cfg['company']['thumb'] ? $cfg['company']['thumb'] : '300X300';
                                }
                                $oImg->thumbs($a['file'], array($size['photo'] => $a['file']));
                            }
                        }
                    }
                }

                
                if($data['photo[']){
                        $data['photo'] =   K::M('xiangmu/xiangmu')->photofetch($data['photo[']);
                }else{

                        unset( $data['photo']);
                }
                if (K::M('xiangmu/xiangmu')->update($xiangmu_id, $data)) {
                   $this->err->set_data('forward', $this->mklink('member/sheji/zhantai:edit', array($xiangmu_id)));
                   $this->err->add('修改内容成功');
                }

        } else {

              //获取行业分类
            $hangye =  K::M('xiangmu/cate')->hangye_all();
            //获取开发语言
            $yuyan =  K::M('xiangmu/cate')->yuyan_all();
            //获取开发原型
            $yuanxing =  K::M('xiangmu/cate')->yuanxing_all();
            //获取图片
            $pic = K::M('xiangmu/photo')->tupian_all($detail['photo']);
            //==echo "<pre>";
            //var_dump($pic);die;
            $this->pagedata['hangye'] = $hangye;
            $this->pagedata['yuyan'] = $yuyan;
            $this->pagedata['yuanxing'] = $yuanxing;
            $this->pagedata['pic'] = $pic;
            $this->pagedata['img_url1'] = 'http://'.$_SERVER["HTTP_HOST"].'/files/';
            $this->pagedata['img_url2'] = 'http://'.$_SERVER["HTTP_HOST"].'/';
            $this->pagedata['detail'] = $detail;
            $this->tmpl = 'member/sheji/zhantai/edit.html';
        }
    }


    public function upload($case_id = null,$group = 0)
    {
		if(!$group = (int)$this->GP('group')){
			$group = 0;
		}
        $designer = $this->ucenter_designer();
        $allow_case = K::M('member/group')->check_priv($designer['group_id'], 'allow_case');
        if($allow_case < 0){
             $this->err->add('您是【'.$designer['group_name'].'】没有权限上传案例', 333);
        }else if(!($case_id = (int)$case_id) && !($case_id = (int)$this->GP('case_id'))){
            $this->err->add('非法的参数请求', 201);
        }else if(!$case = K::M('case/case')->detail($case_id)){
            $this->err->add('案例不存在或已经删除', 202);
        }elseif ($case['uid'] != $designer['designer_id']) {
            $this->err->add('不许越权管理别人的内容', 212);
        } else if(!$attach = $_FILES['Filedata']){
            $this->err->add('上传图片失败', 401);
        }else if(UPLOAD_ERR_OK != $attach['error']){
            $this->err->add('上传图片失败', 402);
        }else{
			$attach['group'] = $group;
            if($data = K::M('case/photo')->upload($case_id, $attach)){
                if($allow_case != $case['audit'] && empty($case['photos'])){
                    K::M('case/case')->update($case_id, array('audit'=>$allow_case));
                }
                $cfg = $this->system->config->get('attach');
                $this->err->set_data('photo', $cfg['attachurl'].'/'.$data['photo']);
                $this->err->add('上传图片成功');
            }
        }
        $this->err->json();
    }

    public function update($case_id = null)
    {
        $designer = $this->ucenter_designer();
        if (!($case_id = (int) $case_id) && !($case_id = (int)$this->GP('case_id'))) {
            $this->err->add('未指定要修改的内容ID', 211);
        } else if (!$detail = K::M('case/case')->detail($case_id)) {
            $this->err->add('您要修改的内容不存在或已经删除', 212);
        } else if ($detail['uid'] != $designer['designer_id']) {
            $this->err->add('不许越权管理别人的内容', 212);
        } else if ($data = $this->checksubmit('data')) {
            $photo_ids = array();
            foreach($data as $k=>$v){
                $photo_ids[$k] = $k;
            }
            if(empty($photo_ids)){
                $this->err->add('没有您要更新的内容', 212);
            }else if(!$photoinfos = K::M('case/photo')->items_by_ids($photo_ids)){
                $this->err->add('没有您要更新的内容', 212);
            }else{
                $obj = K::M('case/photo');
                foreach($data as $k=>$v){
                    if($photoinfos[$k]['case_id'] == $case_id){
                        if($v['title'] != $photoinfos[$k]['title']){
                            $obj->update($k, array('title'=>$v['title']));
                        }
                    }
                }
                $this->err->add('更新成功');
            }
        }
    }

    public function delete($xiangmu_id= null)
    {

        $designer = $this->ucenter_designer();
        if (!($xiangmu_id = (int) $xiangmu_id) && !($xiangmu_id = (int)$this->GP('xiangmu_id'))) {
            $this->error(404);
        }else if(!$xiangmu = K::M('xiangmu/xiangmu')->detail($xiangmu_id)){
            //$this->err->add('项目不存在或已经删除', 212);
        }else if ($xiangmu['uid'] != $designer['uid']) {
            $this->err->add('不许越权管理别人的内容', 212);
        }else if(K::M('xiangmu/xiangmu')->delete($xiangmu_id)){
            $this->err->add('删除项目成功');
        }
    }

	public function defaultphoto($photo_id= null)
	{
		$designer = $this->ucenter_designer();
		if (!($photo_id = (int) $photo_id) && !($photo_id = (int)$this->GP('photo_id'))) {
            $this->error(404);
        }else if(!$detail = K::M('case/photo')->detail($photo_id)) {
            $this->err->add('工程案例不存在或已经删除', 211);
        }else if(!$case = K::M('case/case')->detail($detail['case_id'])){
            $this->err->add('案例不存在或已经删除', 212);
        }else if ($case['uid'] != $designer['designer_id']) {
            $this->err->add('不许越权管理别人的内容', 213);
        } else{
            if(K::M('case/case')->update($detail['case_id'],array('photo'=>$detail['photo']))){
                $this->err->add('修改封面成功');
            }
        }
	}

    public function deletephoto($photo_id= null)
    {
        $designer = $this->ucenter_designer();
        if (!($photo_id = (int) $photo_id) && !($photo_id = (int)$this->GP('photo_id'))) {
            $this->error(404);
        }else if(!$detail = K::M('case/photo')->detail($photo_id)) {
            $this->err->add('工程案例不存在或已经删除', 211);
        }else if(!$case = K::M('case/case')->detail($detail['case_id'])){
            $this->err->add('案例不存在或已经删除', 212);
        }else if ($case['uid'] != $designer['designer_id']) {
            $this->err->add('不许越权管理别人的内容', 213);
        } else{
            if(K::M('case/photo')->delete($photo_id)){
                $this->err->add('删除工程案例成功');
            }
        }
    }
    public function teamlist($xiangmu_id=null){
        $designer = $this->ucenter_designer();
        if(!$detail = K::M('xiangmu/xiangmu')->detail($xiangmu_id)) {
            $this->err->add('工程案例不存在或已经删除', 211);
        }else if ($detail['uid'] != $designer['uid']) {
            $this->err->add('不许越权管理别人的内容', 213);
        }else{
            $teamidarr = explode(',',$detail['teamid']);
            $filt['team_id'] = $teamidarr;
            if ($items = K::M('xiangmu/xiangmuteam')->items($filt, null, 1, 100)) {
                $this->pagedata['items'] = $items;
            }
            $this->pagedata['xiangmu_id'] = $xiangmu_id;
            $this->tmpl = 'member/sheji/team/team.html';
        }
    }

    public function teamadd($xiangmu_id=null){
        $designer = $this->ucenter_designer();
        if(!$detail = K::M('xiangmu/xiangmu')->detail($xiangmu_id)) {
            $this->err->add('工程案例不存在或已经删除', 211);
        }else if ($detail['uid'] != $designer['uid']) {
            $this->err->add('不许越权管理别人的内容', 213);
        }elseif ($data = $this->checksubmit('teamid')) {
            $olduid = $detail['teamid'];
            $filt['uid'] = $designer['uid'];
            $items = K::M('xiangmu/xiangmuteam')->items($filt, null, 1, 100);
            $teamarr = array();
            foreach ($items as $k=>$v){
                $teamarr[] = $v['team_id'];
            }
            $teamid = $this->GP('teamid');
            $error = 0;
            foreach ($teamid as $v){
                if(!in_array($v,$teamarr)){
                    $error = 1;
                    break;
                }
            }
            if($error){
                $this->err->add('选中人员数据有误', 213);
            }
            $teamidstr = implode(',',$teamid);
            if($olduid == ''){
                $datas['teamid'] = $teamidstr;
            }else{
                $datas['teamid'] = $olduid.','.$teamidstr;
            }
            if(K::M('xiangmu/xiangmu')->update($xiangmu_id, $datas)){
                $this->err->set_data('forward', $this->mklink('member/sheji/zhantai:teamlist', array($xiangmu_id)));
                $this->err->add('添加团队成功');
            }else{
                $this->err->set_data('forward', $this->mklink('member/sheji/zhantai:teamlist', array($xiangmu_id)));
                $this->err->add('添加团队失败',121);
            }
        }else{
            $uid = $detail['teamid'];
            $uidarr = explode(',',$uid);
            $filt['uid'] = $designer['uid'];
            $items = K::M('xiangmu/xiangmuteam')->items($filt, null, 1, 100);
            $teamarr = array();
            foreach ($items as $k=>$v){
                $teamarr[] = $v['team_id'];
            }
            $filts['team_id'] = $arr = array_diff($teamarr,$uidarr);
            $item = K::M('xiangmu/xiangmuteam')->items($filts, null, 1, 100);
            $this->pagedata['items'] = $item;
            $this->pagedata['xiangmu_id'] = $xiangmu_id;
            $this->tmpl = 'member/sheji/zhantai/teamadd.html';
        }
    }
    public function teamdelete($xiangmu_id=null,$team_id=null){
        $designer = $this->ucenter_designer();
        if(!$detail = K::M('xiangmu/xiangmu')->detail($xiangmu_id)) {
            $this->err->add('工程案例不存在或已经删除', 211);
        }else if ($detail['uid'] != $designer['uid']) {
            $this->err->add('不许越权管理别人的内容', 213);
        }else {
            $olduid = $detail['teamid'];
            $olduidarr = explode(',',$olduid);
            if(!in_array($team_id,$olduidarr)){
                $this->err->add('此团队人员不在项目中', 211);
            }else{
                $arr = array_diff($olduidarr,array($team_id));
                $arrs['teamid'] = implode(',',$arr);
                if(K::M('xiangmu/xiangmu')->update($xiangmu_id, $arrs)){
                    $this->err->set_data('forward', $this->mklink('member/sheji/zhantai:teamlist', array($xiangmu_id)));
                    $this->err->add('删除团队成功');
                }else{
                    $this->err->set_data('forward', $this->mklink('member/sheji/zhantai:teamlist', array($xiangmu_id)));
                    $this->err->add('删除团队失败',121);
                }
            }
        }
    }
	/**
	 * 添加设计点
	 */
	public function exp($xiangmu_id=0){
		//判断是否有传递项目id
		if(!$detail = K::M('xiangmu/xiangmu')->detail($xiangmu_id)) {
			$this->err->add('项目案例不存在或已经删除', 211);
		}else if ($detail['uid'] != $this->MEMBER['uid']) {
			$this->err->add('不许越权管理别人的内容', 213);
		}else{
			echo 1;die;
		}
		echo 1;die;
	}


	/**
	 * 验证文件
	 */
	public function check($xiangmu_id=0,$step=1){

		if (!$xiangmu_id){
			$xiangmu_id = $this->GP('xiangmu_id');
		}
		if(!$step = $this->GP('step')){
			$step = 1;
		}
		$detail= $this->checkXiangmu($xiangmu_id);
		//判断项目是否验证过
		if ($detail['ischeck']) {
			$this->err->add('该项目已经验证过',110);
			return;
		}
		if ($step==1) {
			$this->pagedata['xiangmu_id'] = $xiangmu_id;
			$this->pagedata['xiangmu'] = $detail;
			$this->tmpl = 'member/sheji/zhantai/check/step1.html';
		} elseif($step==2) {
			if (!$detail['xiangmu_id']){
				$this->err->add('验证地址不能为空',110);
				return false;
			}
			//获取生成验证信息
			$str= date('YmdHis',time());
			//根据用户网址md5加密生成唯一字符串
			$str.=md5($detail['xiangmu_id']);

			//查询是否有重复的验证码
			if (K::M('xiangmu/xiangmu')->count('check_str='.$str)) {
				$this->err->add('存在其他项目在此网址验证过,请您更改其他验证地址',200);
				return false;
			}
			//生成验证文件
			if(K::M('xiangmu/xiangmu')->update($xiangmu_id,array('check_str'=>$str))){
                $this->pagedata['xiangmu_text'] = md5($detail['xiangmu_id']);
				$this->pagedata['xiangmu_id'] = $xiangmu_id;
				$this->pagedata['xiangmu'] = $detail;
				$this->tmpl = 'member/sheji/zhantai/check/step2.html';
				return ;
			} else {
				$this->err->add('验证文件错误,请重新操作',110);
				return false;
			}
		} elseif($step==3) {

			//获取传递的host
			$url = 'http://'.$detail['gurl'].'/gdh/authfile/authfile.txt';

			if (!$res = @file_get_contents($url)) {
				//没有获取到相应信息
				$this->err->add('请把文件放置到服务器指定的位置',110);
			} else {
//				var_dump($detail['check_str']);die();
				//查询信息是否相符
				if ($detail['check_str']!=$res){
					$this->err->add('验证失败,请重新尝试',110);
					return false;
				} else {
					//更改验证信息文件
					K::M('xiangmu/xiangmu')->update($xiangmu_id,array('ischeck'=>1));
					$this->err->add('验证成功');

					$this->err->set_data('forward', $this->mklink('member/sheji/zhantai:index'));
					return true;
				}
			}
		}

	}

	/**
 * @param $xiangmu_id 项目id
 * @return 返回查询的项目详情
 */
	public function checkXiangmu($xiangmu_id){
		if (!$xiangmu_id){
			$this->err->add('请选择项目', 211);
			return false;
		}elseif(!$detail = K::M('xiangmu/xiangmu')->detail($xiangmu_id)) {
			$this->err->add('项目不存在或者已经被删除', 211);
			return false;
		}else if ($detail['uid'] != $this->MEMBER['uid']) {
			$this->err->add('不许越权管理别人的内容', 211);
			return false;
		}else{
			return $detail;
		}
	}

	/**
	 * @param $xiangmu_id 项目id
	 * @return 下载验证文件
	 */
	public function downauthfile($xiangmu_id){
		if (!$xiangmu_id){
			$this->err->set_data('forward', $this->mklink('member/sheji/zhantai:index'));
			$this->err->add('请选择项目', 211);

			return false;
		}elseif(!$detail = K::M('xiangmu/xiangmu')->detail($xiangmu_id)) {
			$this->err->set_data('forward', $this->mklink('member/sheji/zhantai:index'));
			$this->err->add('项目不存在或者已经被删除', 211);
			return false;
		}else if ($detail['uid'] != $this->MEMBER['uid']) {
			$this->err->set_data('forward', $this->mklink('member/sheji/zhantai:index'));
			$this->err->add('不许越权管理别人的内容', 211);
			return false;
		}else{
			$detail = K::M('xiangmu/xiangmu')->detail($xiangmu_id);
			$checkstr = $detail['check_str'];
			if (!$checkstr){
				$this->err->set_data('forward', $this->mklink('member/sheji/zhantai:index'));
				$this->err->add('验证信息错误,请重新进行验证', 211);
				return false;
			}

			$filesize= strlen($checkstr);
			//生成文件并下载
//			header('Content-Type:text/plain'); //指定下载文件类型
//			header('Content-Disposition: attachment; filename=authfile.txt'); //指定下载文件的描述
//			header('Content-Length:'.$filesize); //指定下载文件的大小
			header("Content-Type: application/octet-stream");
			header("Accept-Ranges: bytes");
			header("Accept-Length: ".$filesize);
			header("Content-Disposition: attachment; filename=authfile.txt");

			//将文件内容读取出来并直接输出，以便下载
			echo $checkstr;die;
		}
	}

    public function ajaxpic()
    {           

                $data['name'] = $_FILES['file']['name'];
                $data['size']  = $_FILES['file']['size'];
                $data['tmp_name'] = $_FILES['file']['tmp_name'];
                
                $pic = K::M('xiangmu/photo')->addphoto($data);
                echo  $pic;die;

            
    }

}