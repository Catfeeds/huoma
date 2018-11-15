<?php
// +----------------------------------------------------------------------
// | layerIM + Workerman + ThinkPHP5 即时通讯
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2012 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: NickBai <1902822973@qq.com>
// +----------------------------------------------------------------------
namespace app\mobile\controller;

use think\Controller;

class Index extends Controller
{
	public function _initialize()
	{
	    $uid = cookie('uid');
	    if($uid == '' && isset($_COOKIE['uid'])){
            $uid = $_COOKIE['uid'];
        }
		if( empty($uid) ){
			$this->redirect( url('login/index',array('id'=>input('id'))), 302 );
		}
	}
	
    public function index()
    {
        $uid = cookie('uid');
    	$mine = db('chatuser')->where('id', $uid)->find();
    	if($mine == ''){
    	    $designer = db('member m')->join('xhl_designer d','d.uid=m.uid')->field('d.name,m.uid,m.uname,m.mobile,m.face,m.passwd,d.about')->find();
            $designer['face'] = $designer['face']?$designer['face']:"face/face.jpg";
            $data = array(
                'id'=>$designer['uid'],
                'username'=>$designer['uname'],
                'pwd'=>$designer['passwd'],
                'status'=>'online',
                'sign'=>strip_tags($designer['about']),
                'avatar'=>config('attach_url') . $designer['face'],
                'groupid'=>1
            );
            db('chatuser')->insert($data);
            $mine = db('chatuser')->where('id', $uid)->find();
        }
    	$this->assign([
    			'uinfo' => $mine
    	]);
    	//当前用户点进来的项目，如果项目没有对应的聊天分组，则添加
        $xiangmu_id = input('id');
        $xiangmu = db('xiangmu x')->join('xhl_designer d','d.uid=x.uid')->join('xhl_member m','m.uid=x.uid')->where('x.xiangmu_id',$xiangmu_id)->field('x.xiangmu_id,x.uid,x.title,x.thumb,d.name,d.about,m.face')->find();
        if($xiangmu){
            $xiangmu['face'] = $xiangmu['face']?$xiangmu['face']:"face/face.jpg";
            $xiangmu['thumb'] = $xiangmu['thumb']?$xiangmu['thumb']:"default/xiangmu_thumb.jpg";
            $data = array(
                'groupname'=>$xiangmu['title'],
                'avatar'=>config('attach_url') . $xiangmu['thumb'],
                'owner_name'=>$xiangmu['name'],
                'owner_id'=>$xiangmu['uid'],
                'owner_avatar'=>config('attach_url') . $xiangmu['face'],
                'owner_sign'=>strip_tags($xiangmu['about'])
            );
            $chatgroup = db('chatgroup')->where('id',$xiangmu_id)->find();
            if($chatgroup){
                db('chatgroup')->where('id',$xiangmu_id)->update($data);
            }else{
                $data['id'] = $xiangmu['xiangmu_id'];
                db('chatgroup')->insert($data);
            }
            $map_groupdetail = array(
                'userid'=>$mine['id'],
                'groupid'=>$xiangmu['xiangmu_id']
            );
            $groupdetail = db('groupdetail')->where($map_groupdetail)->find();
            $data1 = array(
                'userid'=>$mine['id'],
                'username'=>$mine['username'],
                'useravatar'=>$mine['avatar'],
                'usersign'=>$mine['sign'],
                'groupid'=>$xiangmu['xiangmu_id']
            );
            if($groupdetail){
                db('groupdetail')->where($map_groupdetail)->update($data1);
            }else{
                db('groupdetail')->insert($data1);
            }
        }
        return $this->fetch();
    }
    
    //获取列表
    public function getList()
    {
    	//查询自己的信息
    	$mine = db('chatuser')->where('id', cookie('uid'))->find();
    	$other = db('chatuser')->select();
        $replay = db('autoreplay')->select();
//        dump($replay);die;

        //查询当前用户的所处的群组
        $groupArr = [];
        $groups = db('groupdetail')->field('groupid')->where('userid', cookie('uid'))->group('groupid')->select();
        if( !empty( $groups ) ){
            foreach( $groups as $key=>$vo ){
                $ret = db('chatgroup')->where('id', $vo['groupid'])->find();
                if( !empty( $ret ) ){
                    $groupArr[] = $ret;
                }
            }
        }
        unset( $ret, $groups );

        $online = 0;
        $group = [];  //记录分组信息
        $userGroup = config('user_group');
        $list = [];  //群组成员信息
        $autoReplay = [];
        $i = 0;
        $j = 0;

        foreach($replay as $k=>$v){
            $autoReplay[] = $v['text'];
        }

        foreach( $userGroup as $key=>$vo ){
            $group[$i] = [
                'groupname' => $vo,
                'id' => $key,
                'online' => 0,
                'list' => []
            ];
            $i++;
        }
        unset( $userGroup );

        foreach( $group as $key=>$vo ){

            foreach( $other as $k=>$v ) {

                if ($vo['id'] == $v['groupid']) {

                    $list[$j]['username'] = $v['username'];
                    $list[$j]['id'] = $v['id'];
                    $list[$j]['avatar'] = $v['avatar'];
                    $list[$j]['sign'] = $v['sign'];

                    if ('online' == $v['status']) {
                        $online++;
                    }

                    $group[$key]['online'] = $online;
                    $group[$key]['list'] = $list;

                    $j++;
                }
            }
            $j = 0;
            $online = 0;
            unset($list);
        }
       //print_r($group);die;
        unset( $other );

        //当前项目
        $xiangmu = db('xiangmu')->where('xiangmu_id',input('id'))->field('xiangmu_id,title,thumb')->find();
        $xiangmu['thumb'] = $xiangmu['thumb']?$xiangmu['thumb']:"default/xiangmu_thumb.jpg";
        $xiangmu['thumb'] = config('attach_url') . $xiangmu['thumb'];
    			
        $return = [
       		'code' => 0,
       		'msg'=> '',
       		'data' => [
       			'mine' => [
	       				'username' => $mine['username'],
	       				'id' => $mine['id'],
	       				'status' => 'online',
       					'sign' => $mine['sign'],
       					'avatar' => $mine['avatar']	
       			],
       			'friend' => $group,
				'group' => $groupArr
       		],
            'autoReplay' => $autoReplay,
            'xiangmu' => $xiangmu
        ];

    	return json( $return );

    }
    
    //获取组员信息
    public function getMembers()
    {
    	$id = input('param.id');
    	
    	//群主信息
    	$owner = db('chatgroup')->field('owner_name,owner_id,owner_avatar,owner_sign')->where('id = ' . $id)->find();
    	//群成员信息
    	$list = db('groupdetail')->field('userid id,username,useravatar avatar,usersign sign')
    	->where('groupid = ' . $id)->select();
    	
    	$return = [
    			'code' => 0,
    			'msg' => '',
    			'data' => [
    				'owner' => [
    						'username' => $owner['owner_name'],
    						'id' => $owner['owner_id'],
    						'owner_id' => $owner['owner_avatar'],
    						'sign' => $owner['owner_sign']
    				],
    				'list' => $list	
    			]
    	];
    	
    	return json( $return );
    }
    
    
    
}
