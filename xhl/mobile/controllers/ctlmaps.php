<?php
/*
  title =>  显示标题
  ctl       =>  ctl:act
  priv  => 权限,默认全部权限(gz,hotel,shop)
  menu  => 是否显示菜单, 只有有相应权限并且这里设置true才会显示在菜单上
 */
return
array(
    //设计师
    'designer' => array(
        array('title'=>'订单管理', 'menu'=>true,
            'items'=>array(
                array('title'=>'我的订单', 'ctl'=>'member/sheji/canzhan:sheji', 'menu'=>true), 
                array('title'=>'订单列表', 'ctl'=>'member/sheji/canzhan:shejilist', 'nav'=>'member/sheji/canzhan:sheji'),
                array('title'=>'设计稿详情', 'ctl'=>'member/sheji/canzhan:show', 'nav'=>'member/sheji/canzhan:sheji'),
                array('title'=>'任务跟踪', 'ctl'=>'member/sheji/canzhan:track', 'nav'=>'member/sheji/canzhan:looked'),
                array('title'=>'查看', 'ctl'=>'member/designer/chao:show', 'nav'=>'member/sheji/canzhan:track'),
                array('title'=>'任务留言', 'ctl'=>'member/sheji/canzhan:comment', 'nav'=>'member/sheji/canzhan:looked'),
                array('title'=>'添加设计稿', 'ctl'=>'member/canzhan/case:sjcreate', 'nav'=>'member/canzhan/case:sjcreate'),
                array('title'=>'修改设计稿', 'ctl'=>'member/canzhan/case:sjedit', 'nav'=>'member/canzhan/case:sjedit'),
                array('title'=>'删除设计稿', 'ctl'=>'member/canzhan/case:delete', 'nav'=>'member/canzhan/case:delete'),
                array('title'=>'删除图片', 'ctl'=>'member/canzhan/case:deletephoto', 'nav'=>'member/canzhan/case:deletephoto'),
                array('title'=>'添加设计图', 'ctl'=>'member/canzhan/case:sjupload', 'nav'=>'member/canzhan/case:update'),
                array('title'=>'确认完成', 'ctl'=>'member/sheji/canzhan:status', 'nav'=>'member/sheji/canzhan:status'),
                array('title'=>'添加设计图', 'ctl'=>'member/canzhan/case:upload', 'nav'=>'member/canzhan/case:update'),
                array('title'=>'添加设计图', 'ctl'=>'member/canzhan/case:update', 'nav'=>'member/canzhan/case:update'),
            )
        ), 
        array('title'=>'帐户管理', 'menu'=>true,
            'items'=>array(
                array('title'=>'个人中心', 'ctl'=>'member/designer:index', 'nav'=>'member/member:index'),
                array('title'=>'个人中心', 'ctl'=>'member/member:index', 'menu'=>true),
                array('title'=>'总基本信息', 'ctl'=>'member/member:infos', 'nav'=>'member/member:info'),
                array('title'=>'基本信息', 'ctl'=>'member/member:info', 'menu'=>true),
                array('title'=>'修改密码', 'ctl'=>'member/member:passwd', 'menu'=>true),
                array('title'=>'更换邮箱', 'ctl'=>'member/member:mail',  'menu'=>true),
                array('title'=>'修改头像', 'ctl'=>'member/member:face',  'nav'=>'member/member:index'),
                array('title'=>'上传头像', 'ctl'=>'member/member:upload', 'nav'=>'member/member:info'),
                array('title'=>'资料设置', 'ctl'=>'member/designer:info', 'menu'=>true),
                array('title'=>'设计管理规范', 'ctl'=>'member/designer:shejiguanli', 'menu'=>true),
                array('title'=>'资料设置', 'ctl'=>'member/designer:info', 'nav'=>'member/designer:index'),
               //array('title'=>'属性设置', 'ctl'=>'member/designer:attr', 'menu'=>true),
                array('title'=>'刷新置顶', 'ctl'=>'member/designer:refresh', 'nav'=>'member/designer:index'),
               //array('title'=>'实名认证', 'ctl'=>'member/member/verify:name', 'menu'=>true),
                array('title'=>'手机认证', 'ctl'=>'member/member/verify:mobile', 'nav'=>'member/member/verify:name'),
                array('title'=>'手机认证', 'ctl'=>'member/member/verify:code', 'nav'=>'member/member/verify:name'),
                array('title'=>'EMAIL认证', 'ctl'=>'member/member/verify:mail', 'nav'=>'member/member/verify:name'),
                array('title'=>'帐号绑定', 'ctl'=>'member/member:bindaccount', 'nav'=>'member/member:index'),
                array('title'=>'财务管理', 'ctl'=>'member/designer:logs', 'menu'=>true),
               
                array('title'=>'现金日志', 'ctl'=>'member/designer:listcon', 'nav'=>'member/designer:logs'),
                array('title'=>'收入记录', 'ctl'=>'member/designer:shouru', 'nav'=>'member/designer:logs'),
                array('title'=>'提现记录', 'ctl'=>'member/designer:tixian', 'nav'=>'member/designer:logs'),
               
               // array('title'=>'展币日志', 'ctl'=>'member/member:logs', 'menu'=>true),
                array('title'=>'提现申请', 'ctl'=>'member/designer:rmb', 'nav'=>'member/designer:logs'),
                array('title'=>'提现支付', 'ctl'=>'member/designer:rmbzhi', 'nav'=>'member/designer:logs'),
                array('title'=>'我的展币', 'ctl'=>'member/member:gold', 'nav'=>'member/member:logs'),
               // array('title'=>'文章管理', 'ctl'=>'member/designer/blog:index', 'menu'=>true),
                array('title'=>'文章列表', 'ctl'=>'member/designer/blog:listcon', 'nav'=>'member/designer/blog:index'),
                array('title'=>'添加文章', 'ctl'=>'member/designer/blog:create', 'nav'=>'member/designer/blog:index'),
                array('title'=>'编辑文章', 'ctl'=>'member/designer/blog:edit', 'nav'=>'member/designer/blog:index'),
                array('title'=>'删除文章', 'ctl'=>'member/designer/blog:delete', 'nav'=>'member/designer/blog:index'),
               // array('title'=>'案例管理', 'ctl'=>'member/sheji/zhantai:index', 'menu'=>true),
                array('title'=>'案例列表', 'ctl'=>'member/sheji/zhantai:listcon', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'效果图', 'ctl'=>'member/sheji/zhantai:xiaoguotu', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'添加案例', 'ctl'=>'member/sheji/zhantai:create', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'编辑案例', 'ctl'=>'member/sheji/zhantai:edit', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'案例图片', 'ctl'=>'member/sheji/zhantai:detail', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'删除案例', 'ctl'=>'member/sheji/zhantai:delete', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'更新图片', 'ctl'=>'member/sheji/zhantai:update', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'上传图片', 'ctl'=>'member/sheji/zhantai:upload', 'nav'=>'member/sheji/zhantai:index'),
                array('title'=>'删除图片', 'ctl'=>'member/sheji/zhantai:deletephoto', 'nav'=>'member/sheji/zhantai:index'),
				array('title'=>'封面', 'ctl'=>'member/sheji/case:defaultphoto', 'nav'=>'member/sheji/zhantai:index')
            )
        ),
        /*array('title'=>'特装超市', 'menu'=>true,
            'items'=>array(
                array('title'=>'模型管理', 'ctl'=>'member/designer/chao:index', 'menu'=>true),
                array('title'=>'添加模型', 'ctl'=>'member/designer/chao:create', 'nav'=>'member/designer/chao:index'),
                array('title'=>'编辑模型', 'ctl'=>'member/designer/chao:edit', 'nav'=>'member/designer/chao:index'),
                array('title'=>'模型图片', 'ctl'=>'member/designer/chao:detail', 'nav'=>'member/designer/chao:index'),
                array('title'=>'删除模型', 'ctl'=>'member/designer/chao:delete', 'nav'=>'member/designer/chao:index'),
                array('title'=>'更新文件', 'ctl'=>'member/designer/chao:update', 'nav'=>'member/designer/chao:index'),
                array('title'=>'上传文件', 'ctl'=>'member/designer/chao:upload', 'nav'=>'member/designer/chao:index'),
                array('title'=>'删除文件', 'ctl'=>'member/designer/chao:deletephoto', 'nav'=>'member/designer/chao:index'),
				array('title'=>'封面', 'ctl'=>'member/designer/chao:defaultphoto', 'nav'=>'member/designer/chao:index'),
            )
        ),*/
    ),

    ///工厂菜单
    'company' => array(
        array('title'=>'订单中心', 'menu'=>true,
			'items'=>array(
                array('title'=>'展台报价', 'ctl'=>'member/chao/baojia:index', 'menu'=>true), 
                array('title'=>'查看详情', 'ctl'=>'member/chao/baojia:ajaxchao', 'nav'=>'member/chao/baojia:index'),
                array('title'=>'马上报价', 'ctl'=>'member/chao/baojia:create', 'nav'=>'member/chao/baojia:index'),
                array('title'=>'完成查看报价', 'ctl'=>'member/chao/baojia:wanchengcreate', 'nav'=>'member/chao/baojia:index'),
                array('title'=>'过期查看报价', 'ctl'=>'member/chao/baojia:guoqicreate', 'nav'=>'member/chao/baojia:index'),
                array('title'=>'报价详情', 'ctl'=>'member/chao/baojia:baojiadetail', 'nav'=>'member/chao/baojia:index'),
                array('title'=>'报价详情图片', 'ctl'=>'member/chao/baojia:baojiaimg', 'nav'=>'member/chao/baojia:index'),
                array('title'=>'完成报价', 'ctl'=>'member/chao/baojia:wancheng', 'nav'=>'member/chao/baojia:index'),
                array('title'=>'完成报价详情', 'ctl'=>'member/chao/baojia:wanchengdetail', 'nav'=>'member/chao/baojia:index'),
                array('title'=>'完成报价详情图片', 'ctl'=>'member/chao/baojia:wanchengimg', 'nav'=>'member/chao/baojia:index'),
                array('title'=>'过期报价详情', 'ctl'=>'member/chao/baojia:guoqidetail', 'nav'=>'member/chao/baojia:index'),
                array('title'=>'过期报价详情图片', 'ctl'=>'member/chao/baojia:guoqiimg', 'nav'=>'member/chao/baojia:index'),
                array('title'=>'过期报价', 'ctl'=>'member/chao/baojia:guoqi', 'nav'=>'member/chao/baojia:index'),
                array('title'=>'急需报价', 'ctl'=>'member/chao/baojia:conclock', 'nav'=>'member/chao/baojia:index'),


                array('title'=>'报价单', 'ctl'=>'member/misc/baojia:baojia', 'nav'=>'member/chao/baojia:looked'),
                array('title'=>'查看报价单', 'ctl'=>'member/misc/baojia:show', 'nav'=>'member/chao/baojia:track'),
                array('title'=>'提交报价单', 'ctl'=>'member/misc/baojia:bstatus', 'nav'=>'member/chao/baojia:show'),
                array('title'=>'保存报价', 'ctl'=>'member/misc/baojia:updatebaojia', 'nav'=>'member/chao/baojia:looked'),
                array('title'=>'删除项目', 'ctl'=>'member/misc/baojia:deletebxm', 'nav'=>'member/chao/baojia:baojia'),
                array('title'=>'竞标留言', 'ctl'=>'member/misc/baojia:comment', 'nav'=>'member/chao/baojia:looked'),
                array('title'=>'签约项目', 'ctl'=>'member/chao/baojia:qiandan', 'menu'=>true), 
                array('title'=>'开工', 'ctl'=>'member/chao/baojia:kaigong', 'nav'=>'member/chao/baojia:qiandan'),
                array('title'=>'完工', 'ctl'=>'member/chao/baojia:wangong', 'nav'=>'member/chao/baojia:qiandan'),
                array('title'=>'签约项目列表', 'ctl'=>'member/chao/baojia:qiandanlist','nav'=>'member/chao/baojia:qiandan'), 
                //array('title'=>'进行中订单', 'ctl'=>'member/chao/baojia:qiandanlist', 'nav'=>'member/chao/baojia:qiandan'),
                array('title'=>'进行中订单', 'ctl'=>'member/chao/baojia:jinxing', 'nav'=>'member/chao/baojia:qiandan'),
                array('title'=>'已完成订单', 'ctl'=>'member/chao/baojia:yiwancheng', 'nav'=>'member/chao/baojia:qiandan'),
                array('title'=>'添加进度', 'ctl'=>'member/chao/jindu:tianjiajindu', 'nav'=>'member/chao/baojia:qiandan'),
            )
        ),
        array('title'=>'帐户管理', 'menu'=>true,
            'items'=>array(
                array('title'=>'管理中心', 'ctl'=>'member/company:index', 'menu'=>true),
                array('title'=>'工厂信息', 'ctl'=>'member/company:info', 'menu'=>true),
				array('title'=>'刷新置顶', 'ctl'=>'member/company:refresh', 'nav'=>'member/company:index'),
                array('title'=>'模板设置', 'ctl'=>'member/company:skin', 'nav'=>'member/company:info'),
                array('title'=>'轮转广告', 'ctl'=>'member/company/banner:index', 'nav'=>'member/company:info'),
                array('title'=>'上传图片', 'ctl'=>'member/company/banner:upload', 'nav'=>'member/company:info'),
                array('title'=>'更新广告', 'ctl'=>'member/company/banner:update', 'nav'=>'member/company:info'),
                array('title'=>'删除广告', 'ctl'=>'member/company/banner:delete', 'nav'=>'member/company:info'),
                array('title'=>'工厂设备', 'ctl'=>'member/company/photo:index', 'menu'=>true),
                array('title'=>'添加图片', 'ctl'=>'member/company/photo:create', 'nav'=>'member/company/photo:index'),
                array('title'=>'更新图片', 'ctl'=>'member/company/photo:update', 'nav'=>'member/company/photo:index'),
                array('title'=>'删除图片', 'ctl'=>'member/company/photo:delete', 'nav'=>'member/company/photo:index'),
                array('title'=>'工厂设备列表', 'ctl'=>'member/company/photo:listcon', 'nav'=>'member/company/photo:index'),

//                array('title'=>'团队管理', 'ctl'=>'member/company/team:index', 'menu'=>true),
//                array('title'=>'绑定设计师', 'ctl'=>'member/company/team:bind', 'nav'=>'member/company/team:index'),
//                array('title'=>'解雇设计师', 'ctl'=>'member/company/team:unbind', 'nav'=>'member/company/team:index'),
                array('title'=>'工厂动态', 'ctl'=>'member/company/news:index', 'menu'=>true),
                array('title'=>'发布新闻', 'ctl'=>'member/company/news:create', 'nav'=>'member/company/news:index'),
                array('title'=>'编辑新闻', 'ctl'=>'member/company/news:edit','nav'=>'member/company/news:index'),               
                array('title'=>'删除新闻', 'ctl'=>'member/company/news:delete','nav'=>'member/company/news:index'),
                array('title'=>'工厂动态列表', 'ctl'=>'member/company/news:listcon', 'nav'=>'member/company/news:index'),

                array('title'=>'案例管理', 'ctl'=>'member/company/case:index', 'menu'=>true),
                array('title'=>'添加案例', 'ctl'=>'member/company/case:create', 'nav'=>'member/company/case:index'),
                array('title'=>'编辑案例', 'ctl'=>'member/company/case:edit', 'nav'=>'member/company/case:index'),
                array('title'=>'案例图片', 'ctl'=>'member/company/case:detail', 'nav'=>'member/company/case:index'),
                array('title'=>'添加案例图片', 'ctl'=>'member/company/case:imgcreate', 'nav'=>'member/company/case:index'),
                array('title'=>'删除案例', 'ctl'=>'member/company/case:delete', 'nav'=>'member/company/case:index'),
                array('title'=>'更新图片', 'ctl'=>'member/company/case:update', 'nav'=>'member/company/case:index'),
                array('title'=>'上传图片', 'ctl'=>'member/company/case:upload', 'nav'=>'member/company/case:index'),
                array('title'=>'删除图片', 'ctl'=>'member/company/case:deletephoto', 'nav'=>'member/company/case:index'),
                array('title'=>'案例管理列表', 'ctl'=>'member/company/case:listcon', 'nav'=>'member/company/case:index'),

				array('title'=>'封面', 'ctl'=>'member/company/case:defaultphoto', 'nav'=>'member/company/case:index')
               // array('title'=>'点评管理', 'ctl'=>'member/company/comment:company', 'menu'=>true),
               // array('title'=>'查看点评', 'ctl'=>'member/company/comment:detail', 'nav'=>'member/company/comment:company'),
               // array('title'=>'回复点评', 'ctl'=>'member/company/comment:reply', 'nav'=>'member/company/comment:company')               
            )
        ),
    ),

    ///企业菜单
    'shang' => array(
        array('title'=>'我的订单', 'menu'=>true,
            'items'=>array(
                array('title'=>'审核未通过', 'ctl'=>'member/shang/canzhan:weitongguo', 'nav'=>'member/shang/canzhan:canzhan'),
                array('title'=>'发布订单', 'ctl'=>'member/shang/canzhan:create', 'menu'=>true),
                array('title'=>'设计稿管理', 'ctl'=>'member/shang/canzhan:xiaoguotu', 'nav'=>'member/shang/canzhan:canzhan'),
                array('title'=>'查看设计稿', 'ctl'=>'member/shang/canzhan:show', 'nav'=>'member/shang/canzhan:canzhan'),
                array('title'=>'查看设计稿图片', 'ctl'=>'member/shang/canzhan:showimg', 'nav'=>'member/shang/canzhan:canzhan'),
                array('title'=>'查看计划', 'ctl'=>'member/shang/canzhan:canzhanDetail', 'nav'=>'member/shang/canzhan:canzhan'),
                array('title'=>'我的订单', 'ctl'=>'member/shang/canzhan:canzhan', 'menu'=>true),
                array('title'=>'设计中', 'ctl'=>'member/shang/canzhan:dingdan', 'nav'=>'member/shang/canzhan:canzhan'),
                array('title'=>'设计中', 'ctl'=>'member/shang/canzhan:baojia', 'nav'=>'member/shang/canzhan:canzhan'),
                array('title'=>'订单列表', 'ctl'=>'member/shang/canzhan:canzhanlist', 'nav'=>'member/shang/canzhan:canzhan'),
                array('title'=>'报价列表', 'ctl'=>'member/shang/canzhan:baojialist', 'nav'=>'member/shang/canzhan:canzhan'),
                array('title'=>'报价列表分页', 'ctl'=>'member/shang/canzhan:bjlistcon', 'nav'=>'member/shang/canzhan:canzhan'),
                array('title'=>'签约监督', 'ctl'=>'member/shang/canzhan:qianyue', 'menu'=>true),
                array('title'=>'签约监督列表', 'ctl'=>'member/shang/canzhan:qy', 'nav'=>'member/shang/canzhan:canzhan'),
             // array('title'=>'报价签约', 'ctl'=>'member/shang/canzhan:qianyue', 'nav'=>'member/shang/canzhan:canzhan'),
                array('title'=>'附件管理', 'ctl'=>'member/shang/canzhan:canzhanfile', 'nav'=>'member/shang/canzhan:canzhan'),
                array('title'=>'上传文件', 'ctl'=>'member/shang/canzhan:upload', 'nav'=>'member/shang/canzhan:canzhan'),
                array('title'=>'更新文件名', 'ctl'=>'member/shang/canzhan:update', 'nav'=>'member/shang/canzhan:canzhan'),
                array('title'=>'删除文件', 'ctl'=>'member/shang/canzhan:deletefile', 'nav'=>'member/shang/canzhan:canzhan'),
				
                array('title'=>'选择设计师', 'ctl'=>'member/shang/canzhan:selectdesigner', 'nav'=>'member/shang/canzhan:canzhan'),
                array('title'=>'选择设计师', 'ctl'=>'member/shang/canzhan:selectdashejishi', 'nav'=>'member/shang/canzhan:canzhanDetail'),
                array('title'=>'待审核', 'ctl'=>'member/shang/canzhan:daishenhe', 'nav'=>'member/shang/canzhan:canzhan'),
                array('title'=>'未通过', 'ctl'=>'member/shang/canzhan:weitongguo', 'nav'=>'member/shang/canzhan:canzhan'),
                array('title'=>'进行中', 'ctl'=>'member/shang/canzhan:jinxingzhong', 'nav'=>'member/shang/canzhan:canzhan'),
                array('title'=>'已完成', 'ctl'=>'member/shang/canzhan:wancheng', 'nav'=>'member/shang/canzhan:canzhan'),
				array('title'=>'查看设计稿', 'ctl'=>'canzhan:show', 'nav'=>'member/shang/canzhan:canzhanDetail'),
                array('title'=>'查看计划', 'ctl'=>'member/shang/canzhan:canzhanEdit', 'nav'=>'member/shang/canzhan:canzhanDetail'),
                array('title'=>'查看报价', 'ctl'=>'member/shang/baojia:show', 'nav'=>'member/shang/canzhan:looked'),
                array('title'=>'签单', 'ctl'=>'member/shang/baojia:qiandan', 'nav'=>'member/shang/baojia:show'),
				
				
 //               array('title'=>'我的招标', 'ctl'=>'member/member/yuyue:tenders', 'menu'=>true),
//                array('title'=>'查看招标', 'ctl'=>'member/member/yuyue:tendersDetail', 'nav'=>'member/member/yuyue:tendersx'),
//                array('title'=>'完善招标', 'ctl'=>'member/member/yuyue:tendersEdit', 'nav'=>'member/member/yuyue:tenders'),
//                array('title'=>'设置中标', 'ctl'=>'member/member/yuyue:signLook', 'nav'=>'member/member/yuyue:tenders'),
//                array('title'=>'我的预约', 'ctl'=>'member/member/yuyue:company', 'menu'=>true),
//                array('title'=>'查看预约', 'ctl'=>'member/member/yuyue:companyDetail', 'nav'=>'member/member/yuyue:company'),
//                array('title'=>'预约设计师', 'ctl'=>'member/member/yuyue:designer', 'nav'=>'member/member/yuyue:company'),
//                array('title'=>'查看预约', 'ctl'=>'member/member/yuyue:designerDetail', 'nav'=>'member/member/yuyue:company'),
//                array('title'=>'预约技工', 'ctl'=>'member/member/yuyue:mechanic', 'nav'=>'member/member/yuyue:company'),               
//                array('title'=>'查看技工', 'ctl'=>'member/member/yuyue:mechanicDetail', 'nav'=>'member/member/yuyue:company'),   
//                array('title'=>'企业预约', 'ctl'=>'member/member/yuyue:shop', 'nav'=>'member/member/yuyue:company'),
//                array('title'=>'查看预约', 'ctl'=>'member/member/yuyue:shopDetail', 'nav'=>'member/member/yuyue:company'),
//                array('title'=>'我的优惠券', 'ctl'=>'member/member:coupon', 'menu'=>true)
//               array('title'=>'参展计划', 'ctl'=>'member/member/order:index', 'menu'=>true),
//                array('title'=>'更新订单', 'ctl'=>'member/member/order:update', 'nav'=>'member/member/order:index'),
            )
        ),
       /*array('title'=>'我的监督', 'menu'=>true,
            'items'=>array(
                array('title'=>'车间制作', 'ctl'=>'member/member/canzhan:wei', 'menu'=>true),
                array('title'=>'现场布展', 'ctl'=>'member/member/canzhan:create', 'menu'=>true),
                array('title'=>'展期服务', 'ctl'=>'member/member/canzhan:canzhan', 'menu'=>true),
                array('title'=>'已完成', 'ctl'=>'member/member/canzhan:canzhan', 'menu'=>true),
            )
        ),
        array('title'=>'我要评价', 'menu'=>true,
            'items'=>array(
                array('title'=>'对执行人员', 'ctl'=>'member/member/canzhan:wei', 'menu'=>true),
                array('title'=>'对设计方案', 'ctl'=>'member/member/canzhan:create', 'menu'=>true),
                array('title'=>'对工程监理', 'ctl'=>'member/member/canzhan:canzhan', 'menu'=>true),
                array('title'=>'对加工厂', 'ctl'=>'member/member/canzhan:canzhan', 'menu'=>true),
            )
        ),*/
        array('title'=>'企业中心', 'menu'=>false,
            'items'=>array(
                array('title'=>'中心首页', 'ctl'=>'member/shang:index', 'menu'=>true),
                array('title'=>'基本信息', 'ctl'=>'member/shang:info', 'menu'=>true),
                array('title'=>'委托书', 'ctl'=>'member/shang:book',  'nav'=>'member/shang:info'),
                array('title'=>'发票信息', 'ctl'=>'member/shang:piao', 'menu'=>true),
                array('title'=>'管理人员', 'ctl'=>'member/shang:user', 'menu'=>true),
//              array('title'=>'资料设置', 'ctl'=>'member/shang:info', 'nav'=>'member/shang:base'),
                array('title'=>'添加管理人员', 'ctl'=>'member/shang:reg', 'nav'=>'member/shang:user'),
                array('title'=>'修改密码', 'ctl'=>'member/shang:passwd', 'nav'=>'member/shang:user'),
                array('title'=>'保存管理人员', 'ctl'=>'member/shang:create', 'nav'=>'member/shang:user'),
                array('title'=>'企业子分类', 'ctl'=>'member/shang:catechildren', 'nav'=>'member/shang:base'),
				
                array('title'=>'个人中心', 'ctl'=>'member/index:index', 'nav'=>'member/member:index'),
//              array('title'=>'个人中心', 'ctl'=>'member/member:index', 'menu'=>true),
//              array('title'=>'修改资料', 'ctl'=>'member/member:info', 'menu'=>true),
                array('title'=>'上传头像', 'ctl'=>'member/member:passwd', 'nav'=>'member/member:info'),
                array('title'=>'更换邮箱', 'ctl'=>'member/member:mail', 'nav'=>'member/member:info'),
                array('title'=>'修改头像', 'ctl'=>'member/member:face', 'nav'=>'member/member:info'),
                array('title'=>'上传头像', 'ctl'=>'member/member:upload', 'nav'=>'member/member:info'),
//              array('title'=>'实名认证', 'ctl'=>'member/member/verify:name', 'menu'=>true),
//              array('title'=>'委托书', 'ctl'=>'member/member/weituo', 'menu'=>true),
                array('title'=>'手机认证', 'ctl'=>'member/member/verify:mobile', 'nav'=>'member/member/verify:name'),
                array('title'=>'手机认证', 'ctl'=>'member/member/verify:code', 'nav'=>'member/member/verify:name'),
                array('title'=>'EMAIL认证', 'ctl'=>'member/member/verify:mail', 'nav'=>'member/member/verify:name'),
                array('title'=>'管理人员列表', 'ctl'=>'member/shang:listcon', 'nav'=>'member/shang:user')
            )
        ),
    ),
    ///会员菜单
    'member' => array(
        array('title'=>'帐户管理', 'menu'=>true,
            'items'=>array(
                array('title'=>'个人中心', 'ctl'=>'member/index:index', 'nav'=>'member/member:index'),
                array('title'=>'个人中心', 'ctl'=>'member/member:index', 'menu'=>true),
              //array('title'=>'修改资料', 'ctl'=>'member/member:infos', 'menu'=>true),
                array('title'=>'基本信息', 'ctl'=>'member/member:info', 'menu'=>true),
                array('title'=>'修改密码', 'ctl'=>'member/member:passwd','menu'=>true),
                array('title'=>'更换邮箱', 'ctl'=>'member/member:mail', 'menu'=>true),
             // array('title'=>'修改头像', 'ctl'=>'member/member:face', 'menu'=>true),
                array('title'=>'上传头像', 'ctl'=>'member/member:upload', 'nav'=>'member/member:info'),
             // array('title'=>'实名认证', 'ctl'=>'member/member/verify:name', 'menu'=>true),
                array('title'=>'手机认证', 'ctl'=>'member/member/verify:mobile', 'nav'=>'member/member/verify:name'),
                array('title'=>'手机认证', 'ctl'=>'member/member/verify:code', 'nav'=>'member/member/verify:name'),
                array('title'=>'EMAIL认证', 'ctl'=>'member/member/verify:mail', 'nav'=>'member/member/verify:name'),
             // array('title'=>'帐号绑定', 'ctl'=>'member/member:bindaccount', 'menu'=>true),
             // array('title'=>'展币日志', 'ctl'=>'member/member:logs', 'menu'=>true),
                array('title'=>'我的展币', 'ctl'=>'member/member:gold', 'nav'=>'member/member:logs'),
                array('title'=>'展币日志列表', 'ctl'=>'member/member:listcon', 'nav'=>'member/member:logs'),
                array('title'=>'充值记录', 'ctl'=>'member/member:chongzhi', 'nav'=>'member/member:logs'),
                array('title'=>'消费记录', 'ctl'=>'member/member:xiaofei', 'nav'=>'member/member:logs')
            )
        ),
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
