<?php
/*
  title =>  显示标题
  ctl       =>  ctl:act
  priv  => 权限,默认全部权限(gz,hotel,shop)
  menu  => 是否显示菜单, 只有有相应权限并且这里设置true才会显示在菜单上
 */
return
array(
    ///设计师
    'designer' => array( 
        array('title'=>'订单管理', 'menu'=>false,'biao'=>'icon-orderList',
            'items'=>array(
                array('title'=>'我的订单', 'ctl'=>'member/sheji/canzhan:sheji', 'menu'=>true), 
                array('title'=>'订单详情', 'ctl'=>'member/sheji/canzhan:track', 'nav'=>'member/sheji/canzhan:looked'),
                array('title'=>'查看', 'ctl'=>'member/designer/chao:show', 'nav'=>'member/sheji/canzhan:track'),
                array('title'=>'任务留言', 'ctl'=>'member/sheji/canzhan:comment', 'nav'=>'member/sheji/canzhan:looked'),
                array('title'=>'添加设计稿', 'ctl'=>'member/canzhan/case:sjcreate', 'nav'=>'member/canzhan/case:sjcreate'),
                array('title'=>'修改设计稿', 'ctl'=>'member/canzhan/case:sjedit', 'nav'=>'member/canzhan/case:sjedit'),
                array('title'=>'删除设计稿', 'ctl'=>'member/canzhan/case:delete', 'nav'=>'member/canzhan/case:delete'),
                array('title'=>'删除图片', 'ctl'=>'member/canzhan/case:deletephoto', 'nav'=>'member/canzhan/case:deletephoto'),
                array('title'=>'添加设计图', 'ctl'=>'member/canzhan/case:sjupload', 'nav'=>'member/canzhan/case:update'),
                array('title'=>'确认完成', 'ctl'=>'member/sheji/canzhan:status', 'nav'=>'member/sheji/canzhan:status'),
                array('title'=>'上传图片', 'ctl'=>'member/sheji/zhantai:upload_dingdan', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'添加设计图', 'ctl'=>'member/canzhan/case:upload', 'nav'=>'member/canzhan/case:update'),
                array('title'=>'添加设计图', 'ctl'=>'member/canzhan/case:update', 'nav'=>'member/canzhan/case:update'),
                array('title'=>'设计稿', 'ctl'=>'member/sheji/canzhan:xiaoguotu', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'展示', 'ctl'=>'member/sheji/canzhan:show', 'nav'=>'member/sheji/zhantai:index'),
            )
        ), 
        array('title'=>'帐户管理111', 'menu'=>true,'biao'=>'icon-people',
            'items'=>array(
                array('title'=>'个人中心', 'ctl'=>'member/designer:index', 'menu'=>false),
                array('title'=>'基本信息', 'ctl'=>'member/member:info', 'nav'=>'member/member:info'),
                array('title'=>'资料设置', 'ctl'=>'member/designer:info', 'menu'=>true),
                array('title'=>'属性设置', 'ctl'=>'member/designer:attr', 'nav'=>'member/designer:index'),
                array('title'=>'修改密码', 'ctl'=>'member/member:passwd', 'menu'=>true),
                array('title'=>'更换邮箱', 'ctl'=>'member/member:mail', 'nav'=>'member/member:info'),
                array('title'=>'修改头像', 'ctl'=>'member/member:face', 'nav'=>'member/member:info'),
                array('title'=>'上传头像', 'ctl'=>'member/member:upload', 'nav'=>'member/member:info'),
                array('title'=>'实名认证', 'ctl'=>'member/member/verify:name', 'nav'=>'member/member:info'),
                array('title'=>'手机认证', 'ctl'=>'member/member/verify:mobile', 'nav'=>'member/member/verify:name'),
                array('title'=>'手机认证', 'ctl'=>'member/member/verify:code', 'nav'=>'member/member/verify:name'),
                array('title'=>'EMAIL认证', 'ctl'=>'member/member/verify:mail', 'nav'=>'member/member/verify:name'),
                array('title'=>'提现申请', 'ctl'=>'member/designer:rmb', 'nav'=>'member/designer:logs'),
                array('title'=>'提现支付', 'ctl'=>'member/designer:rmbzhi', 'nav'=>'member/designer:logs'),
                array('title'=>'我的展币', 'ctl'=>'member/member:gold', 'nav'=>'member/member:logs'),
				array('title'=>'刷新置顶', 'ctl'=>'member/designer:refresh', 'nav'=>'member/designer:index'),
                array('title'=>'文章管理', 'ctl'=>'member/designer/blog:index', 'menu'=>false),
                array('title'=>'添加文章', 'ctl'=>'member/designer/blog:create', 'nav'=>'member/designer/blog:index'),
                array('title'=>'编辑文章', 'ctl'=>'member/designer/blog:edit', 'nav'=>'member/designer/blog:index'),
                array('title'=>'删除文章', 'ctl'=>'member/designer/blog:delete', 'nav'=>'member/designer/blog:index'),
                array('title'=>'关注的项目', 'ctl'=>'member/designer/blog:delete', 'menu'=>true),
                array('title'=>'关注的用户', 'ctl'=>'member/designer/blog:delete', 'menu'=>true),
            )
        ),
        array('title'=>'团队', 'menu'=>true,
            'items'=>array(
                array('title'=>'团队管理', 'ctl'=>'member/sheji/team:index', 'menu'=>true),
                array('title'=>'团队列表', 'ctl'=>'member/sheji/team:teamlist', 'nav'=>'member/sheji/team:teamlist'),
                array('title'=>'团队列表', 'ctl'=>'member/sheji/team:lists', 'nav'=>'member/sheji/team:lists'),
                array('title'=>'团队列表', 'ctl'=>'member/sheji/team:team', 'nav'=>'member/sheji/team:team'),
                array('title'=>'团队列表添加', 'ctl'=>'member/sheji/team:teamadd', 'nav'=>'member/sheji/team:team'),
                array('title'=>'团队列表删除', 'ctl'=>'member/sheji/team:delete', 'nav'=>'member/sheji/team:team'),
                array('title'=>'团队列表修改', 'ctl'=>'member/sheji/team:edit', 'nav'=>'member/sheji/team:team'),
                array('title'=>'团队管理', 'ctl'=>'member/team:index', 'menu'=>false),
                array('title'=>'团队列表', 'ctl'=>'member/team:team', 'nav'=>'member/team:team'),
                array('title'=>'团队列表添加', 'ctl'=>'member/team:teamadd', 'nav'=>'member/team:team'),
                array('title'=>'团队列表删除', 'ctl'=>'member/team:delete', 'nav'=>'member/team:team'),
                array('title'=>'团队列表修改', 'ctl'=>'member/team:edit', 'nav'=>'member/team:team'),
                array('title'=>'项目管理', 'ctl'=>'member/sheji/zhantai:index', 'menu'=>true),
                array('title'=>'项目管理', 'ctl'=>'member/sheji/zhantai:tezhuang', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'添加项目', 'ctl'=>'member/sheji/zhantai:create', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'编辑项目', 'ctl'=>'member/sheji/zhantai:edit', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'项目图片', 'ctl'=>'member/sheji/zhantai:xiaoguotu', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'项目图片', 'ctl'=>'member/sheji/zhantai:baoguan', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'项目图片', 'ctl'=>'member/sheji/zhantai:shigong', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'项目图片', 'ctl'=>'member/sheji/zhantai:meigong', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'项目图片', 'ctl'=>'member/sheji/zhantai:moxing', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'删除项目', 'ctl'=>'member/sheji/zhantai:delete', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'更新图片', 'ctl'=>'member/sheji/zhantai:update', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'上传图片', 'ctl'=>'member/sheji/zhantai:upload', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'上传图片', 'ctl'=>'member/sheji/zhantai:upload_baoguan', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'上传图片', 'ctl'=>'member/sheji/zhantai:upload_shigong', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'上传图片', 'ctl'=>'member/sheji/zhantai:upload_meigong', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'上传图片', 'ctl'=>'member/sheji/zhantai:upload_moxing', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'删除图片', 'ctl'=>'member/sheji/zhantai:deletephoto', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'删除图片', 'ctl'=>'member/sheji/zhantai:deletebaoguan', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'删除图片', 'ctl'=>'member/sheji/zhantai:deleteshigong', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'删除美工文件', 'ctl'=>'member/sheji/zhantai:deletemeigong', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'删除模型', 'ctl'=>'member/sheji/zhantai:deletemoxing', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'封面', 'ctl'=>'member/sheji/zhantai:defaultphoto', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'项目团队', 'ctl'=>'member/sheji/zhantai:teamlist', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'项目团队添加', 'ctl'=>'member/sheji/zhantai:teamadd', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'项目团队删除', 'ctl'=>'member/sheji/zhantai:teamdelete', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'技术点', 'ctl'=>'member/sheji/zhantai:exp', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'验证', 'ctl'=>'member/sheji/zhantai:check', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'下载文件', 'ctl'=>'member/sheji/zhantai:downauthfile', 'nav'=>'member/sheji/zhantai:index'),
            )
        ),
        array('title'=>'个人', 'menu'=>false,
            'items'=>array(
                array('title'=>'需求管理', 'ctl'=>'member/demand:index', 'menu'=>true),
                array('title'=>'偏好设置', 'ctl'=>'member/member:index', 'menu'=>true),
                array('title'=>'需求添加', 'ctl'=>'member/demand:add'),
                array('title'=>'需求修改', 'ctl'=>'member/demand:edit'),
                array('title'=>'需求删除', 'ctl'=>'member/demand:del'),
            )
        ),
    ),

             
    ///会员菜单
    'member' => array(
   /*     array('title'=>'帐户管理', 'menu'=>true,'biao'=>'icon-people',
            'items'=>array(
                array('title'=>'个人中心', 'ctl'=>'member/index:index', 'nav'=>'member/member:index'),
                array('title'=>'个人中心', 'ctl'=>'member/member:index', 'menu'=>true),
                array('title'=>'修改资料', 'ctl'=>'member/member:info', 'menu'=>true),
                array('title'=>'上传头像', 'ctl'=>'member/member:passwd', 'nav'=>'member/member:info'),
                array('title'=>'更换邮箱', 'ctl'=>'member/member:mail', 'nav'=>'member/member:info'),
                array('title'=>'修改头像', 'ctl'=>'member/member:face', 'nav'=>'member/member:info'),
                array('title'=>'上传头像', 'ctl'=>'member/member:upload', 'nav'=>'member/member:info'),
                array('title'=>'实名认证', 'ctl'=>'member/member/verify:name', 'menu'=>true),
                array('title'=>'手机认证', 'ctl'=>'member/member/verify:mobile', 'nav'=>'member/member/verify:name'),
                array('title'=>'手机认证', 'ctl'=>'member/member/verify:code', 'nav'=>'member/member/verify:name'),
                array('title'=>'邮箱认证', 'ctl'=>'member/member/verify:mail', 'nav'=>'member/member/verify:name'),
                array('title'=>'帐号绑定', 'ctl'=>'member/member:bindaccount', 'menu'=>true),
                array('title'=>'展币日志', 'ctl'=>'member/member:logs', 'menu'=>true),
                array('title'=>'我的展币', 'ctl'=>'member/member:gold', 'nav'=>'member/member:logs'),
            )
        ),*/
/*        array('title'=>'内容管理', 'menu'=>true,
            'items'=>array(
                array('title'=>'装修日记', 'ctl'=>'member/member/diary:index', 'menu'=>true),
                array('title'=>'创建日记', 'ctl'=>'member/member/diary:create', 'nav'=>'member/member/diary:index'),
                array('title'=>'修改日记', 'ctl'=>'member/member/diary:edit', 'nav'=>'member/member/diary:index'),
                array('title'=>'删除日记', 'ctl'=>'member/member/diary:delete', 'nav'=>'member/member/diary:index'),
                array('title'=>'日记文章', 'ctl'=>'member/member/diary:detail', 'nav'=>'member/member/diary:index'),
                array('title'=>'添加文章', 'ctl'=>'member/member/diary:createDiary', 'nav'=>'member/member/diary:index'),
                array('title'=>'修改文章', 'ctl'=>'member/member/diary:editDiary', 'nav'=>'member/member/diary:index'),
                array('title'=>'删除文章', 'ctl'=>'member/member/diary:deleteDiary', 'nav'=>'member/member/diary:index'),
                
                array('title'=>'装修问答', 'ctl'=>'member/member/ask:index', 'menu'=>true),
                array('title'=>'我的回答', 'ctl'=>'member/member/ask:answer', 'nav'=>'member/member/ask:index'),
                
                array('title'=>'我的评论', 'ctl'=>'member/member/ask:index', 'menu'=>true),
                array('title'=>'我的回答', 'ctl'=>'member/member/ask:answer', 'nav'=>'member/member/diary:index'),
                
            )
        ), */       
        array('title'=>'常用功能', 'menu'=>false,
            'items'=>array(
                array('title'=>'选择展会', 'ctl'=>'member/misc/select:home'),
                array('title'=>'选择工厂', 'ctl'=>'member/misc/select:company'),
                array('title'=>'选择户型', 'ctl'=>'member/misc/select:huxing'),
                array('title'=>'我的案例', 'ctl'=>'member/misc/select:mycase'),
                array('title'=>'访问主页', 'ctl'=>'member/member:home'),
                array('title'=>'我的权限', 'ctl'=>'member/member:group'),
            )
        ),
    ),
    ///微信设置
    'weixin' => array(
        array('title'=>'微信设置', 'menu'=>true,
            'items'=>array(
                array('title'=>'微信设置', 'ctl'=>'member/weixin:index', 'menu'=>true),
                array('title'=>'公众号设置', 'ctl'=>'member/weixin:info', 'nav'=>'member/weixin:index'),
                array('title'=>'接口配置', 'ctl'=>'member/weixin:config', 'nav'=>'member/weixin:index'),
                array('title'=>'关注回复', 'ctl'=>'member/weixin:welcome', 'nav'=>'member/weixin:index'),
                array('title'=>'宣传页面', 'ctl'=>'member/weixin:leaflets', 'nav'=>'member/weixin:index'),
                array('title'=>'微信菜单', 'ctl'=>'member/weixin/menu:index', 'menu'=>true),
                array('title'=>'添加菜单', 'ctl'=>'member/weixin/menu:create', 'nav'=>'member/weixin/menu:index'),
                array('title'=>'修改菜单', 'ctl'=>'member/weixin/menu:edit', 'nav'=>'member/weixin/menu:index'),
                array('title'=>'删除菜单', 'ctl'=>'member/weixin/menu:delete', 'nav'=>'member/weixin/menu:index'),
                array('title'=>'同步到微信', 'ctl'=>'member/weixin/menu:towechat', 'nav'=>'member/weixin/menu:index'),

                array('title'=>'微信素材', 'ctl'=>'member/weixin/reply:index', 'menu'=>true),
                array('title'=>'添加素材', 'ctl'=>'member/weixin/reply:create', 'nav'=>'member/weixin/reply:index'),
                array('title'=>'修改素材', 'ctl'=>'member/weixin/reply:edit', 'nav'=>'member/weixin/reply:index'),
                array('title'=>'删除素材', 'ctl'=>'member/weixin/reply:delete', 'nav'=>'member/weixin/reply:index'),
                array('title'=>'选择素材', 'ctl'=>'member/weixin/reply:dialog', 'nav'=>'member/weixin/reply:index'),
                array('title'=>'关键字设置', 'ctl'=>'member/weixin/keyword:index', 'menu'=>true),
                array('title'=>'添加关键字', 'ctl'=>'member/weixin/keyword:create', 'nav'=>'member/weixin/keyword:index'),
                array('title'=>'修改关键字', 'ctl'=>'member/weixin/keyword:edit', 'nav'=>'member/weixin/keyword:index'),
                array('title'=>'删除关键字', 'ctl'=>'member/weixin/keyword:delete', 'nav'=>'member/weixin/keyword:index'),
            )
        ),
    ),	
);
