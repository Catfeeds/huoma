<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: index.ctl.php 2015-11-26 06:32:36  xinghuali
 */

if(!defined('__CORE_DIR')){
    exit("Access Denied");
}

class Ctl_Ewm extends Ctl
{
	//加载活码页面
    public function index()
    {
        $uid = $this->cookie->get('uid');
        if (!$uid) {
            $this->err->add('请先登录', 201);
        } else {
            $data = K::M('code/content')->codeAll($uid);
            $num = K::M('code/fangwen')->chaxun('uid', $uid);
            foreach ($num as $k=>$v) {
                $nums[$v['code_id']] = $v;
            }
            foreach ($data as $k=>&$v) {
                $v['num'] = $nums[$k]['num'];
            }
            $this->pagedata['data'] = $data;

            $this->tmpl = 'ewm.html';
        }
    }

    //加载选择码类型页面
    public function code()
    {
        $a = K::M('code/type')->all();
        $code = $this->getlink(9);
        $this->pagedata['data'] = $a;
        $this->pagedata['code'] = $code['code'];

    	$this->tmpl = 'ewm_class.html';
    }

    //选择码类型 展示相应的模板文件
    //同时生成码 认领
    public function codeType()
    {
        $data = $this->getlink(13);
        $arr = K::M('code/content')->cfg();
        $uid = $this->cookie->get('uid');
        if (!$arr[$data['type']]) {
            $this->err->add('分类待完善', 201);
        } elseif ($uid) {
            $code = $data['code'];
            if (!$code) {
                $code = K::M('code/content')->mkCode();
            }
            $codeData = K::M('code/content')->chaxun('code', $code);
            foreach ($codeData as $v) {
                $codeId = $v['id'];
            }
            $a = K::M('code/content')->moveCode($data['type'], $codeId);
            $link = $arr[$data['type']];
            if ($a) {
                $this->pagedata['tid'] = $codeId;
                $this->tmpl = $link . '.html';
            } else {
                $this->err->add('生成二维吗失败', 201);
            }
        } else {
            $this->err->add('请先登陆', 201);
        }
    }

    //子表内容添加 第一个
    public function addContent()
    {
    	$data = $this->GP('data');
        $dataBianqian = K::M('code/bianqian')->addBianqian($data);
        $a = K::M('code/bianqian')->codeData($dataBianqian);
        if ($dataBianqian) {
            $this->index();
            // $this->pagedata['data'] = $a;
            // $this->tmpl = 'ewm_information.html';
        } else {
            $this->err->add('生成二维吗失败', 201);
        }
    }


    //子表内容添加 回忆码
    public function huiyi()
    {
        $data = $this->GP('data');
        
        $dir = $_SERVER['DOCUMENT_ROOT'].'/static/imgs';
        if (!file_exists($dir)) {
            mkdir($dir);
        }
        $dir = $dir = $dir .'/'.date('Y');
        if (!file_exists($dir)) {
            mkdir($dir);
        }
        $dir = $dir .'/'.date('m');
        if (!file_exists($dir)) {
            mkdir($dir);
        }
        $dir = $dir .'/'. date('d');
        if (!file_exists($dir)) {
            mkdir($dir);
        }
        $imgLink = $dir .'/'. $_FILES["img"]["name"];
        move_uploaded_file($_FILES["img"]["tmp_name"], $imgLink);
        $imgLink = str_replace($_SERVER['DOCUMENT_ROOT'], '', $imgLink);
        
        $data['img'] = $imgLink;
        $dataHuiyi = K::M('code/huiyi')->addHuiyi($data);
        $a = K::M('code/huiyi')->codeData($dataHuiyi);
        if ($dataHuiyi) {
            $this->index();
            // $this->pagedata['data'] = $a;
            // $this->tmpl = 'ewm_information.html';
        } else {
            $this->err->add('生成二维吗失败', 201);
        }
    }

    //加载子表内容编辑页面
    public function edit()
    {
        $id = $this->getlink(9);
        $arr = K::M('code/content')->cfg();
        $data = K::m('code/bianqian')->chaxun('tid', $id['id']);
        if (!$data) {
            $data = K::m('code/huiyi')->chaxun('tid', $id['id']);
        }
        // var_dump($data);die;
        foreach ($data as $v) {
            $data = $v;
        }
        if (empty($data)) {
            $data['tid'] = $id['id'];
        }
        $v = K::M('code/content')->chaxun('id', $id['id']);
        foreach ($v as $val) {
            $vv = $val;
        }
        $link = $arr[$val['type_id']];
        $this->pagedata['data'] = $data;

        $this->tmpl = $link . '_edit.html';
    }

    //执行子表内容更新或者添加操作 编辑
    public function editup()
    {
        $data = $this->GP('data');
        $bianqian = K::M('code/bianqian')->chaxun('tid', $data['tid']);
        if ($bianqian) {
           $a = K::M('code/bianqian')->edit($data);
        } else {
            if (!empty($_FILES['img'])) {
                
                $dir = $_SERVER['DOCUMENT_ROOT'].'/static/imgs';
                if (!file_exists($dir)) {
                    mkdir($dir);
                }
                $dir = $dir = $dir .'/'.date('Y');
                if (!file_exists($dir)) {
                    mkdir($dir);
                }
                $dir = $dir .'/'.date('m');
                if (!file_exists($dir)) {
                    mkdir($dir);
                }
                $dir = $dir .'/'. date('d');
                if (!file_exists($dir)) {
                    mkdir($dir);
                }
                $imgLink = $dir .'/'. $_FILES["img"]["name"];
                move_uploaded_file($_FILES["img"]["tmp_name"], $imgLink);
                $imgLink = str_replace($_SERVER['DOCUMENT_ROOT'], '', $imgLink);
                
                $data['img'] = $imgLink;
            }
            $huiyi = K::M('code/huiyi')->chaxun('tid', $data['tid']);
            $a = K::M('code/huiyi')->edit($data);
        }
        if ($a) {
            // $this->tmpl = 'ewm.html';//跳转至详情页
            $this->index();
        } else {
            $this->err->add('编辑失败', 201);
        }
    }

    //删除二维码
    public function shanchu()
    {
        
        $data = $_POST['a'];
        $shanchu = K::M('code/content')->shanchu($data);
        $returnData = json_encode($shanchu, JSON_UNESCAPED_UNICODE); 

        echo $returnData;
        exit;
    }

    //扫描二维码进入这个方法
    public function moveCode()
    {
        $data = $this->getlink(13);
        $code = base64_decode($data['code']);
        // $code = 'tvqG4u';   //先用假数据
        $data = K::M('code/content')->chaxun('code', $code);
        foreach ($data as $v) {
            $data = $v;
        }
        if (!empty($data)) {
            if (empty($data['uid'])) {
                $id = $this->cookie->get('uid');
                if (!empty($id)) {
                    $this->pagedata['data'] = $data;
                    $this->tmpl = 'renling.html';
                } else {
                    $this->tmpl = 'login.html';
                }
            } else {
                $saveData['time'] = date('Y-m-d', time());
                $saveData['code_id'] = $data['id'];
                $saveData['uid'] = $data['uid'];
                $fangwen = K::M('code/fangwen')->fangwen('code_id', $data['id'], $saveData['time']);
                if (empty($fangwen)) {
                    $saveData['num'] = 1;
                    K::M('code/fangwen')->create($saveData, true);
                } else {
                    foreach ($fangwen as $v) {
                        $fangwen = $v;
                    }
                    $saveData['num'] = $fangwen['num'] + 1;
                    K::M('code/fangwen')->update($fangwen['id'], $saveData, true);
                }
                //跳转至展示页面  完了写活
                $this->bianqian($code);
            }
        } else {
            $this->err->add('请求错误,请稍后再试'); 
        }
    } 

    //加载便签详情页面
    public function bianqian($code=0)
    {
        if (!$code) {
            $data = $this->getlink(13);
            $code = $data['code'];
        }
        $arr = K::M('code/content')->cfg();
        $codeData = K::M('code/content')->chaxun('code', $code);
        if (!$codeData) {
            $this->err->add('信息不存在');
        } else {
            foreach ($codeData as $v) {
                $id = $v;
            }
            $bianqian = K::M('code/bianqian')->chaxun('tid', $id['id']);
            if (!$bianqian) {
                $bianqian = K::M('code/huiyi')->chaxun('tid', $id['id']);
            }
            foreach ($bianqian as $v) {
                $bianqianData = $v;
            }
            $link = $arr[$id['type_id']];
            $this->pagedata['data'] = $bianqianData;
            $this->pagedata['code'] = $id;

            $this->tmpl = $link . '_y.html'; 
        }
        
    } 

    //截取链接后缀
    public function getlink($num)
    {
        $aa = $this->request;
        $a = substr($aa['uri'], $num);
        $b = explode('&', $a);
        foreach ($b as $k=>$v) {
            $bb[] = explode('=', $v);
        }
        foreach ($bb as $k => $v) {
            $arr[$v[0]] = $v[1];
        }

        return $arr;
    }

    //加载认领页面
    // public function renling($data)
    // {
    //     $codeData = k::M('code/content')->mkcode();
    //     $data = K::M('code/content')->chaxun('code', $codeData);
    //     foreach ($data as $v) {
    //         $data = $v['code_link'];
    //     }

    //     $this->pagedata['data'] = $data;
    //     $this->tmpl = 'renling.html';
    // }

    //认领成功页面
    // public function succ()
    // {
    //     $this->tmpl = 'renling_2.html';
    // }
}