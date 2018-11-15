<?php
/**
 * Copy Right 16-expo.com
 * 人要活得优雅,代码更需要优雅
 * $Id: home.ctl.php 10025 2015-05-05 11:56:23  xinghuali
 */

class Ctl_Entry extends Ctl
{

	public function wxapp()
	{
		$_GPC = $this->_GPC;
		$_W = $this->_W;
		$entry = array(
			'module' => $this->_GPC['m'],
			'do' => $this->_GPC['do'],
			'state' => $this->_GPC['state'],
			'direct' => 0,
		);


		$method = 'doPage' . ucfirst($entry['do']);

		if (!empty($_GPC['state']) && (empty($_W['openid']) || empty($_SESSION['openid']))) {
			$this->result(41009, '请登录');
		}

		if (!empty($_W['uniacid'])) {
			$version = trim($_GPC['v']);

			$where = "'uniacid='".$_W['uniacid']."' and version = '$version'";
			$version_info = K::M('card/version')->find($where);
			if (!empty($version_info['modules'])) {
				$connection = unserializer($version_info['modules'], true);
				if (!empty($connection[$entry['module']])) {
					$uniacid = intval($connection[$entry['module']]['uniacid']);
					if (!empty($uniacid)) {
						$_W['uniacid'] = $uniacid;
						$_W['account']['link_uniacid'] = $uniacid;
					}
				}
			}
		}

		exit($this->$method());


	}
	//获取排行信息
	public function doPageApiGetTop()
	{
		$_GPC = $this->_GPC;
		$_W = $this->_W;
		$uniacid = $_W["uniacid"];
		$type = $_GPC["type"];
		$pindex = max(1, intval($_GPC["pageIndex"]));
		$psize = max(10, intval($_GPC["psize"]));

		$orderby = '';
		switch ($type) {
			case 'view':
			case 'zan':
			case 'collect':
				$orderby = [$type=>'desc'];
				break;
			default :
				$orderby = "";
				break;
		}
		$fileter = array('uniacid'=>$uniacid);



		$list = K::M('card/card')->items($fileter,$orderby,$pindex,$psize,$total);
		$tpage = ceil($total / $psize);
		$return = array();
		if (count($list) > 0) {
			foreach ($list as $key => $value) {
				$list[$key]["avater"] = empty($value["avater"]) ? tomedia($value["weixinImg"]) : tomedia($value["avater"]);

			}
			$return["list"] = $list;
			$return["gtotal"] = $tpage;
			return $this->result(0, '', $return);
		} else {
			return $this->result(1, '', 0);
		}


	}

	//搜索
	public function doPageApiGetSearchCard(){
        $_GPC = $this->_GPC;
        $searchValue = $_GPC["searchValue"];
        if(!empty($searchValue)){

            $where = "username LIKE '%{$searchValue}%' or company LIKE '%{$searchValue}%' or job LIKE '%{$searchValue}%' or `desc` LIKE '%{$searchValue}%' or service LIKE '%{$searchValue}%' or product LIKE '%{$searchValue}%'";
        }
        $sql = "SELECT * from " . tablename("amouse_wxapp_card") . " where $where";
        $list = K::M('card/card')->querySql($sql);
        if(count($list)>0){
            foreach ($list as $key => $value) {
                $list[$key]["weixinImg"] = tomedia($value["weixinImg"]);
                $list[$key]["avater"] = tomedia($value["avater"]);

            }
            return $this->result(0, '', $list);
        }else{
            return $this->result(1, '', 0);
        }
    }

    //搜索返回数据
    public function doPageApiSearchKy(){
        $list  = K::M('card/card')->items();
        foreach ($list as $k=>$v){
            $lists[$k][] = $v['username'];
            $lists[$k][] = $v['comoany'];
            $lists[$k][] = $v['desc'];
            $lists[$k][] = $v['service'];
            $lists[$k][] = $v['product'];
        }
//        foreach ($list as $kk=>$item) {
//            $lists['name'][$kk] = $item['username'];
//        }
        $where = array('tuijian'=>1);
        $cardkeyword  = K::M('card/keyword')->items($where);
        foreach ($cardkeyword as $kk=>$item) {
            $lists['name'][$kk] = $item['title'];
        }
        return $this->result(0, '', $lists);
    }

	//获取我的名片
	public function doPageApiGetMyCard()
	{
		$_W = $this->_W;
		$_GPC = $this->_GPC;
		$uniacid = $_W["uniacid"];
		$login_success = $this->checkLogin();
		$openid = $_W["openid"];
		$cardId = intval($_GPC["cardid"]);
		$fredidId = intval($_GPC["fcardid"]);
		$contion = "  `uniacid`='$uniacid' and `openid`='$openid' ";

		if ($cardId <= 0) {

			$card = K::M('card/card')->find($contion);

			if (!empty($card)) {
				//介绍图片
				$imgs = iunserializer($card["imgs"]);
				$imgsarra = [];
				foreach ($imgs as $key => $imgid) {
				    if(!empty($imgid)){
                        $imgsarra[$key] = tomedia("https://card.wordhuo.com//".$imgid);
                    }
				}
				$card["imgs"] = $imgsarra;

				//产品图片图片
				$cimgsarrb = [];
				$cimgs = unserialize($card["cimgs"]);
				foreach ($cimgs as $key => $cimgid) {
				    if(!empty($cimgid)){
                        $cimgsarrb[$key] = tomedia("https://card.wordhuo.com//".$cimgid);
                    }
				}
				$card["cimgs"] = $cimgsarrb;

                //产品图片图片
                $pimgsarrb = [];
                $pimgs = unserialize($card["pimgs"]);
                foreach ($pimgs as $key => $cimgid) {
                    if(!empty($cimgid)){
                        $pimgsarrb[$key] = tomedia("https://card.wordhuo.com//".$cimgid);
                    }
                }
                $card["pimgs"] = $pimgsarrb;



				$card["avater"] = tomedia($card["avater"]);
				$card["weixinImg"] = tomedia($card["weixinImg"]);
				return $this->result(0, '', $card);
			} else {

				return $this->result(0, '', 0);
			}
		}else {

			$card = K::M('card/card')->detail($cardId);
			if (!empty($card)) {
				$imgs = iunserializer($card["imgs"]);
				$cimgs = iunserializer($card["cimgs"]);
				$pimgs = iunserializer($card["pimgs"]);
                $imgsa = [];
				foreach ($imgs as $key => $imgid) {
				    if(!empty($imgid)){
                        $imgsa[$key] = tomedia("https://card.wordhuo.com//".$imgid);
                    }
				}

				$cimgsa = [];
				foreach ($cimgs as $key => $imgid) {
				    if(!empty($imgid)){
                        $cimgsa[$key] = tomedia("https://card.wordhuo.com//".$imgid);
                    }

				}
                $pimgsa = [];
                foreach ($pimgs as $key => $imgid) {
                    if(!empty($imgid)){
                        $pimgsa[$key] = tomedia("https://card.wordhuo.com//".$imgid);
                    }

                }
				$card["imgs"] = $imgsa;
				$card["cimgs"] = $cimgsa;
				$card["pimgs"] = $pimgsa;
				$card["avater"] = tomedia($card["avater"]);
				$card["weixinImg"] = tomedia($card["weixinImg"]);
				return $this->result(0, '', $card);
			} else {
				return $this->result(0, '', 0);
			}

		}

	}
	//获取设置信息
	public function doPageApiGetSys()
	{

		$uniacid = $this->w["uniacid"];

		$set = K::M('card/sysset')->find("`uniacid`= '$uniacid'");
		$return = array();
		$return['logo']=tomedia($set["logo"]);
		$return['set']=$set;
		return $this->result(0, '', $return);

	}

	//上传名片
	public function doPageWxUpload()
	{
		//文件上传函数
		$url = $this->_W['siteroot'];
		$filename = K::M('card/card')->upload($_FILES['file'],$url);
		if($filename['code']){
			return $this->result(0, '',$filename['data']);
		} else {
			return $this->result(1, $filename['msg'], '');


		}

	}

	//上传个人的卡片信息
	public function doPageApiPostMyCard()
	{
		$_GPC=$this->_GPC;
		$_W = $this->_W;
		$login_success = $this->checkLogin();

		$res = !$this->is_error($login_success);
		if ($res) {
			$from = $_W["fans"]["openid"];
			$uniacid = $_W["uniacid"];
			$nickname = $_W["fans"]["nickname"];
			$avatar = empty($_GPC["avatarUrl"]) ? $_W["fans"]["avatar"] : $_GPC["avatarUrl"];
			$apiCardid = $_GPC["cardid"];
			//我的介绍图片
			$images = $_GPC["imgs"];
			$imgs = explode("|", $images);
			$down_images = array();
			foreach ($imgs as $imgid) {
				$down_images[] = str_replace('https://card.wordhuo.com//','',$imgid);
			}
			$images = serialize($down_images);

			//获取公司图片
			$cimages = $_GPC["cimgs"];
			$cimgs = explode("|", $cimages);;
			$down_cimages = array();
			foreach ($cimgs as $cimgid) {
				$down_cimages[] = str_replace('https://card.wordhuo.com//','',$cimgid);
			}
            $cimages = serialize($down_cimages);

            //服务介绍图片
            $pimgs = $_GPC["pimgs"];
            $pimgsass = explode("|", $pimgs);;
            $down_pimgs = array();
            foreach ($pimgsass as $cimgid) {
                $down_pimgs[] = str_replace('https://card.wordhuo.com//','',$cimgid);
            }
			$pimages = serialize($down_pimgs);



			$data = array("uniacid" => $uniacid, "openid" => $from, "mobile" => $_GPC["mobile"], "status" => 0, "avater" => $avatar, "email" => $_GPC["email"], "job" => $_GPC["job"], "username" => $_GPC["username"], "weixin" => $_GPC["weixin"], "company" => $_GPC["company"], "weixinImg" => $_GPC["weixinImg"], "desc" => $_GPC["desc"], "imgs" => $images, "cimgs" => $cimages, "service" => $_GPC["service"], "product" => $_GPC["product"],"qq"=> $_GPC["qq"],"address" => $_GPC["address"],"pimgs" => $pimages);

			if ($apiCardid > 0) {

				$where = "id=$apiCardid and uniacid=$uniacid";
				$card = K::M('card/card')->find($where);
				$data["imgs"] = empty($images) ? $card["imgs"] : $images;
				$data["cimgs"] = empty($cimages) ? $card["cimgs"] : $cimages;
				$data["weixinImg"] = empty($_GPC["weixinImg"]) ? $card["weixinImg"] : $_GPC["weixinImg"];
//				pdo_update("amouse_wxapp_card", $data, array("id" => $apiCardid));
				K::M('card/card')->update($apiCardid,$data);
				return $this->result(0, '', $apiCardid);
			} else{

				$apiCardid = K::M('card/card')->create($data);
				return $this->result(0, '', $apiCardid);

			}
		} else {
			return $this->result($login_success["errno"], $login_success["message"]);
		}
	}

	public function doPageApiGetSlide()
	{
		$message = "success";
		$uniacid = $this->_W["uniacid"];

		$slides = K::M('card/cardslide')->items();


		return $this->result(0, $message, $slides);

	}

	private function checkLogin()
	{
		$_W = $this->_W;
		$res  = !empty($_W["fans"]);
		if ($res) {
			return true;
		} else {
			return $this->error(1, "请先登录 " . $_W["fans"]);
		}

	}

	public function doPageApiGetMyHolder()
	{

		$_GPC=$this->_GPC;
		$_W = $this->_W;
		$uniacid = intval($_W["uniacid"]);
		$openid = $_W["openid"];
		$key = $_GPC["s_key"];

		if (!empty($key)) {

			$where = " AND card.username LIKE '%{$key}%' or card.company LIKE '%{$key}%'  ";
		}
		$sql = "SELECT card.* from " . tablename("amouse_wxapp_card") . " as card where card.openid in ( SELECT h.to_user  FROM " . tablename("amouse_wxapp_card_history") . "  as h ," . tablename("amouse_wxapp_card") . "  as c where h.from_user=c.openid and h.uniacid =$uniacid and h.from_user='$openid' and h.sms_type=2 )" . $where;

		$list = K::M('card/card')->querySql($sql);
		if (count($list) > 0) {
			foreach ($list as $key => $value) {
				$list[$key]["weixinImg"] = tomedia($value["weixinImg"]);
				$list[$key]["avater"] = tomedia($value["avater"]);

			}
			return $this->result(0, '', $list);
		} else {
			return $this->result(1, '', 0);
		}

	}


	public function doPageApiGetCardById()
	{
		$_GPC=$this->_GPC;
		$_W = $this->_W;
		$uniacid = $_W["uniacid"];
		$openid = $_W["openid"];
		$cardId = intval($_GPC["_card_id"]);
		$contion = " `uniacid`=$uniacid   ";

		if ($cardId > 0) {
			$contion .= " and id='{$cardId}'  ";
		}
		$card = K::M('card/card')->find($contion);
		$mywhere = "`uniacid`=$uniacid and `openid`='$openid' ";
		$mcard = K::M('card/card')->find($mywhere);

		if (!(!empty($card) && $mcard)) {
			$card["avater"] = tomedia($card["avater"]);
			$card["curr_openid"] = $openid;
			return $this->result(0, '', $card);
		} else {
			if (!($openid != $card["openid"])) {
				$imgs = iunserializer($card["imgs"]);
				foreach ($imgs as $key => $imgid) {
				    if(!empty($imgid)){
                        $imgs[$key] = tomedia("https://card.wordhuo.com//".$imgid);
                    }


				}
				$card["weixinImg"] = tomedia($card["weixinImg"]);
				$card["imgs"] = $imgs;
				$card["avater"] = tomedia($card["avater"]);
				$card["curr_openid"] = $openid;
				return $this->result(0, '', $card);
			} else {
				$view = K::M('card/cardhistory')->count("from_user='$openid' and cardid='$cardId' and uniacid='$uniacid' and sms_type=0 ");
				$zan =  K::M('card/cardhistory')->count("from_user='$openid' and cardid='$cardId' and uniacid='$uniacid' and sms_type=1");
				$collect =  K::M('card/cardhistory')->count("from_user='$openid' and cardid='$cardId' and uniacid='$uniacid' and sms_type=2");

				if ($view <=0) {
					$insert = array("cardid" => $cardId, "sms_type" => 0, "uniacid" => $_W["uniacid"], "from_user" => $openid, "to_user" => $card["openid"]);
					//更新历史数据
					K::M('card/cardhistory')->create($insert);
					K::M('card/cardhistory')->update_count($cardId,'view');
				}
				$is_zan = $zan > 0 ? 1 : 0;
				$is_collect = $collect > 0 ? 1 : 0;
				$card["is_like"] = $is_zan;
				$card["is_collect"] = $is_collect;
				$imgs = iunserializer($card["imgs"]);
				foreach ($imgs as $key => $imgid) {
				    if(!empty($imgid)){
                        $imgs[$key] = tomedia("https://card.wordhuo.com//".$imgid);
                    }


				}

				$cimgs = iunserializer($card["cimgs"]);
				foreach ($cimgs as $key => $imgid) {
				    if(!empty($imgid)){
                        $cimgs[$key] = tomedia("https://card.wordhuo.com//".$imgid);
                    }


				}
                $pimgs = iunserializer($card["pimgs"]);
                foreach ($pimgs as $key => $imgid) {
                    if(!empty($imgid)){
                        $pimgs[$key] = tomedia("https://card.wordhuo.com//".$imgid);
                    }


                }
				$card["weixinImg"] = tomedia($card["weixinImg"]);
				$card["imgs"] = $imgs;
				$card["cimgs"] = $cimgs;
				$card["pimgs"] = $pimgs;
				$card["avater"] = tomedia($card["avater"]);
				$card["curr_openid"] = $openid;
				return $this->result(0, '', $card);

			}

		}


	}


	public function doPageApiPostClick()
	{
		$_GPC=$this->_GPC;
		$_W = $this->_W;

		$uniacid = $_W["uniacid"];
		$curr_openid = $_GPC["my_user_id"];
		$openid = $_W["openid"];
		$friend_user_id = intval($_GPC["friend_user_id"]);
		$view_type = $_GPC["view_type"];
		$fcard = K::M('card/card')->find("`uniacid`='$uniacid'  and id='$friend_user_id'");
		$mcard = K::M('card/card')->find(" `uniacid`=$uniacid  and openid='$openid'");

		if ($fcard["id"] != $mcard["id"]) {
			$zan = K::M('card/cardhistory')->find("from_user='$openid' and cardid='$friend_user_id' and uniacid='$uniacid' and sms_type=1");
			$collect = K::M('card/cardhistory')->find(" from_user='$openid'and cardid='$friend_user_id' and uniacid='$uniacid' and sms_type=2");

			if ($view_type == "collect") {
				if (empty($collect)) {
					$insert = array("cardid" => $friend_user_id, "sms_type" => 2, "uniacid" => $_W["uniacid"], "zan_cid" => $zan["zan_cid"] + 1, "from_user" => $openid, "to_user" => $fcard["openid"]);
					K::M('card/cardhistory')->create($insert);
					K::M('card/card')->update_count($friend_user_id,'collect');

					$fcard["is_collect"] = 1;
					$fcard["collect"] = $fcard["collect"] + 1;

				}else {
					K::M('card/card')->update_down($friend_user_id,'collect');
					K::M('card/cardhistory')->delete($collect["id"]);
					$fcard["is_collect"] = 0;
					$fcard["collect"] = $fcard["collect"] - 1;

				}
				if (!empty($zan)) {
					$fcard["is_like"] = 1;
				}

			} else if ($view_type == "zan") {
				if (empty($zan)) {
					$fcard["is_delete"] = 0;
					$insert = array("cardid" => $friend_user_id, "sms_type" => 1, "uniacid" => $_W["uniacid"], "zan_mid" => $zan["zan_mid"] + 1, "from_user" => $openid, "to_user" => $fcard["openid"]);
					K::M('card/cardhistory')->create($insert);
					K::M('card/card')->update_count($friend_user_id,'zan');
					$fcard["is_like"] = 1;
					$fcard["zan"] = $fcard["zan"] + 1;
				} else {
					$fcard["is_delete"] = 1;
					K::M('card/card')->update_down($friend_user_id,'zan');
					K::M('card/cardhistory')->delete($zan["id"]);
					$fcard["is_like"] = 0;
					$fcard["zan"] = $fcard["zan"] - 1;
				}
				if (!empty($collect)) {
					$fcard["is_collect"] = 1;
				}


			}
			$imgs = iunserializer($fcard["imgs"]);
			foreach ($imgs as $key => $imgid) {
				$imgs[$key] = tomedia($imgid);

			}
			$fcard["weixinImg"] = tomedia($fcard["weixinImg"]);
			$fcard["imgs"] = $imgs;
			return $this->result(0, '', $fcard);

		} else{
			return $this->result(1, '', $fcard);
		}


	}


	public function doPageApiGetMyList()
	{

		$_GPC=$this->_GPC;
		$_W = $this->_W;

		$uniacid = intval($_W["uniacid"]);
		$type = $_GPC["type"];
		$openid = $_W["openid"];
		$pindex = max(1, intval($_GPC["pageIndex"]));
		$psize = max(10, intval($_GPC["psize"]));
		$start = ($pindex - 1) * $psize;

		$where = " and h.uniacid =$uniacid and h.to_user='$openid' ";
		if ($type == "zan") {
			$where .= " and h.sms_type=1 ";

		} else if ($type == "collect") {
			$where .= " and h.sms_type=2 ";

		}else if($type=='view'){
			$where .= " and h.sms_type=0  ";
		}

		$sql = "SELECT c.* FROM " . tablename("amouse_wxapp_card_history") . " as h ," . tablename("amouse_wxapp_card") . " as c where h.from_user=c.openid " . $where;
//		echo $sql;die;
		$list = K::M('card/card')->querySql($sql);

		if (count($list) > 0) {
			foreach ($list as $key => $value) {
				$list[$key]["weixinImg"] = tomedia($value["weixinImg"]);

				$list[$key]["avater"] = tomedia($value["avater"]);

			}
			return $this->result(0, '', $list);
		} else {
			return $this->result(1, '', 0);
		}

	}


	public function doPageApiGetUserInfo()
	{
		$_W = $this->_W;
		$uniacid = $_W["uniacid"];
		$login_success = $this->checkLogin();
		if (!is_error($login_success)) {
			$openid = $_W["openid"];
			$member = K::M('card/appmember')->find("`uniacid`='$uniacid' and `openid`='$openid'");

			if (!empty($member)) {
				return $this->result(0, '', $member);
			} else {
				return $this->result(1, '', $openid);
			}

		} else {
			return $this->result($login_success["errno"], $login_success["message"]);
		}

	}


	public function doPageApiPostUser()
	{
		$_GPC=$this->_GPC;
		$_W = $this->_W;
		$login_success = $this->checkLogin();
		if (!is_error($login_success)) {
			$from = $_W["fans"]["openid"];
			$uniacid = intval($_W["uniacid"]);
			$uid = intval($_GPC["uid"]);
			$data = array("realname" => trim($_GPC["realname"]), "mobile" => trim($_GPC["mobile"]), "address" => trim($_GPC["address"]), "openid" => $from, "status" => 0, "sex" => trim($_GPC["sex"]), "desc" => trim($_GPC["desc"]));
			if ($uid > 0) {
				K::M('card/appmember')->update($uid,$data);
				return $this->result(0, '', $uid);
			} else {
				$data["uniacid"] = $uniacid;
				$data["createtime"] = time();
				$uid = K::M('card/appmember')->create($data);
				return $this->result(0, '', $uid);
			}

		} else {
			return $this->result($login_success["errno"], $login_success["message"]);
		}

	}


	public function doPageApiPostChangeMobile()
	{
		$_GPC=$this->_GPC;
		$_W = $this->_W;
		$apiCardid = intval($_GPC["cardid"]);
		if ($apiCardid > 0) {
			$data = array("mobile" => trim($_GPC["mobile"]));
			K::M('card/card')->update($apiCardid,$data);
			return $this->result(0, '', $apiCardid);
		} else {
			return $this->result(1, '', $apiCardid);
		}


	}

	//分类 搜索
    public function doPageApiKeyword(){
        $sql = K::M('card/keyword')->items();
        return $this->result(1, '', $sql);
    }



}


