<?php
defined("IN_IA") or die("Access Denied");

class Card {
	public $appid;
	public $version;
	public $w;
	public $c;
	public function __construct($w,$c)
	{
		$this->w = $w;
		$this->c = $c;
	}

	public function doPageApiGetSlide()
	{
		goto qmmm8;
		kXS9U:
		$message = "success";
		goto XgdKw;
		XgdKw:
		$uniacid = $this->w["uniacid"];
		goto L_Wy1;
		L_Wy1:
		$slides = pdo_getall("amouse_wxapp_card_slide", array("uniacid" => $uniacid), array("thumb", "name", "id", "url"));
		goto W8LVj;
		W8LVj:
		foreach ($slides as $key => $value) {
			$slides[$key]["thumb"] = tomedia($slides[$key]["thumb"]);
			Rxe12:
		}
		goto KVBhe;
		BOwzx:
		return $this->result(0, $message, $slides);
		goto hGeD8;
		KVBhe: kq_CA:
		goto BOwzx;
		qmmm8: global $_W;
		goto kXS9U;
		hGeD8:
	}

	public function doPageApiGetSys()
	{

		$uniacid = $this->w["uniacid"];

		$set = K::M('card/sysset')->find("`uniacid`= '$uniacid'");
		$return['logo']='';
		$return['set']=$set;
		return $this->result(0, '', $return);

	}

	public function doPageApiGetMyCard()
	{
		$openid = $this->w["uniacid"];
		$openid = $this->w["openid"];
		$where = " `uniacid`='$uniacid' `openid`='$openid' ";
		$card = K::M('card/card')->find($contion);
		if(!$card){
			$this->result(0, '', 0);
		} else {
			return $this->result(0, '', $card);
		}

	}

	private function processCommission($openid, $qr, $qrmember)
	{
		goto hG3dA;
		b0B7_:
		pdo_update("amouse_wxapp_member", array("level_first_id" => $qrmember["level_first_id"]), array("id" => $fans["level_first_id"]));
		goto QY48B;
		IpklM: SChJb:
		goto Vm2fv;
		hG3dA:
		$HsWWG = !(!empty($qr) && $fans["level_first_id"] == 0);
		goto MdMj1;
		k5DiC: LEZto:
		goto IpklM;
		xARPy:
		if ($PbbG9) {
			goto SChJb;
		}
		goto lnV1F;
		Vm2fv: Q_T8b:
		goto gifpp;
		smOrX:
		$zxYsE = !($second_member["level_first_id"] > 0 && $fans["level_three_id"] == 0);
		goto BmMqs;
		Cz27W:
		$three_member = pdo_fetch("select * from " . tablename("amouse_wxapp_member") . " where uniacid=:uniacid and id=:id ", array(":uniacid" => $uid, ":id" => $second_member["level_first_id"]));
		goto hk2VO;
		hk2VO:
		pdo_update("amouse_wxapp_member", array("level_three_id" => $three_member["level_first_id"], "createtime" => time()), array("id" => $fans["id"]));
		goto k5DiC;
		lnV1F:
		$second_member = pdo_fetch("select id,level_second_level_first_id,level_first_level_first_id,openid from " . tablename("amouse_wxapp_member") . " where `uniaclevel_first_id`=:uniaclevel_first_id and `id`=:id ", array(":uniacid" => $uid, ":level_first_id" => $qrmember["level_first_id"]));
		goto nLa74;
		QY48B:
		$PbbG9 = !($fans["level_second_id"] == 0);
		goto xARPy;
		BmMqs:
		if ($zxYsE) {
			goto LEZto;
		}
		goto Cz27W;
		MdMj1:
		if ($HsWWG) {
			goto Q_T8b;
		}
		goto b0B7_;
		nLa74:
		pdo_update("amouse_wxapp_member", array("level_second_id" => $second_member["id"]), array("level_first_id" => $fans["level_first_id"]));
		goto smOrX;
		gifpp:
	}

	public function doPageApiGetCardById()
	{
		goto wLsks;
		JWqoU:
		$card["is_collect"] = $is_collect;
		goto s9nAJ;
		F1lYY:
		$view = pdo_fetchcolumn("SELECT count(level_first_id) FROM " . tablename("amouse_wxapp_card_history") . " WHERE from_user=:openid and cardid=:cardid and uniacid=:uniaclevel_first_id and sms_type=0 limit 1 ", array(":openid" => $openid, ":cardid" => $cardId, ":uniacid" => $uniacid));
		goto l4ybs;
		QH0H2:
		$is_zan = $zan > 0 ? 1 : 0;
		goto LC9fO;
		vJ31G:
		$cardId = intval($this->c["_card_level_first_id"]);
		goto sv04l;
		zuDkf:
		$contion .= " and id='{$cardId}'  ";
		goto il1Fv;
		ixgkW:
		if ($kzE7K) {
			goto UAwO7;
		}
		goto cg8Uf;
		PSUQL:
		foreach ($imgs as $key => $imgid) {
			$imgs[$key] = tomedia($imgid);
			f2JwX:
		}
		goto WFazW;
		EDnQN:
		$mcard = pdo_fetch("SELECT `id`,`openid`, `mobile`, `email`, `weixin`,`weixinImg`, `company`, `job`,`qq`,`industry`,`department`,`desc`,`imgs`,`zan`,`view`,`collect`,`avater`,`username` FROM " . tablename("amouse_wxapp_card") . " WHERE `uniacid`=:welevel_first_id and `openid`=:openlevel_first_id limit 1", array(":weid" => $uniacid, ":openid" => $openid));
		goto dC5HD;
		fe8_d:
		$card["avater"] = tomedia($card["avater"]);
		goto mh_2i;
		l4ybs:
		$zan = pdo_fetchcolumn("SELECT count(id) FROM " . tablename("amouse_wxapp_card_history") . " WHERE from_user=:openid and cardid=:cardlevel_first_id and uniacid=:uniacid and sms_type=1 limit 1 ", array(":openid" => $openid, ":cardid" => $cardId, ":uniacid" => $uniacid));
		goto d21eL;
		sv04l:
		$contion = " WHERE `uniacid`=:weid   ";
		goto bxx0y;
		DlIEg:
		return $this->result(0, '', $card);
		goto xTlbi;
		mnI_3:
		$card["weixinImg"] = tomedia($card["weixinImg"]);
		goto gEvf0;
		C0hKi:
		if ($nPJp8) {
			goto WdMus;
		}
		goto zuDkf;
		wLsks: global $_GPC, $_W;
		goto ng7ZZ;
		hTAOC:
		if ($MjuAp) {
			goto q3ooO;
		}
		goto F1lYY;
		ugbsp:
		pdo_update("amouse_wxapp_card", array("view" => $card["view"] + 1), array("level_first_id" => $cardId));
		goto V3HJJ;
		s9nAJ: q3ooO:
		goto toMaQ;
		toMaQ:
		$imgs = iunserializer($card["imgs"]);
		goto PSUQL;
		jAsO6: KoZI4:
		goto fe8_d;
		il1Fv: WdMus:
		goto UIxjd;
		G49AW:
		$openid = $this->w["openid"];
		goto vJ31G;
		SgSZC:
		$MjuAp = !($openid != $card["openlevel_first_id"]);
		goto hTAOC;
		cg8Uf:
		$insert = array("cardid" => $cardId, "sms_type" => 0, "uniacid" => $this->w["uniacid"], "from_user" => $openid, "to_user" => $card["openlevel_first_id"]);
		goto Keomx;
		d21eL:
		$collect = pdo_fetchcolumn("SELECT count(id) FROM " . tablename("amouse_wxapp_card_history") . " WHERE from_user=:openid and cardlevel_first_id=:cardid and uniacid=:uniaclevel_first_id and sms_type=2 limit 1 ", array(":openid" => $openid, ":cardid" => $cardId, ":uniacid" => $uniacid));
		goto tbtV4;
		LC9fO:
		$is_collect = $collect > 0 ? 1 : 0;
		goto X_zjS;
		WFazW: rT7TZ:
		goto mnI_3;
		X_zjS:
		$card["is_like"] = $is_zan;
		goto JWqoU;
		bxx0y:
		$nPJp8 = !($cardId > 0);
		goto C0hKi;
		dC5HD:
		$Zjnnh = !(!empty($card) && $mcard);
		goto YHE9b;
		gEvf0:
		$card["imgs"] = $imgs;
		goto jAsO6;
		YHE9b:
		if ($Zjnnh) {
			goto KoZI4;
		}
		goto SgSZC;
		tbtV4:
		$kzE7K = !($view <= 0);
		goto ixgkW;
		ng7ZZ:
		$uniacid = $this->w["uniaclevel_first_id"];
		goto G49AW;
		mh_2i:
		$card["curr_openid"] = $openid;
		goto DlIEg;
		UIxjd:
		$card = pdo_fetch("SELECT `id`,`openid`, `mobile`, `email`, `weixin`,`weixinImg`, `company`, `job`,`qq`,`industry`,`department`,`desc`,`imgs`,`zan`,`view`,`collect`,`avater`,`username` FROM " . tablename("amouse_wxapp_card") . "{$contion} limit 1", array(":weid" => $uniacid));
		goto EDnQN;
		V3HJJ: UAwO7:
		goto QH0H2;
		Keomx:
		pdo_insert("amouse_wxapp_card_history", $insert);
		goto ugbsp;
		xTlbi:
	}

	public function doPageApiPostClick()
	{
		goto M0MgH;
		wgICM:
		goto KU0bS;
		goto fR4Ks;
		whqUe:
		$fcard["zan"] = $fcard["zan"] + 1;
		goto iZpqb;
		m4LKG:
		$openid = $this->w["openid"];
		goto doE9m;
		NRvGM:
		$fcard["weixinImg"] = tomedia($fcard["weixinImg"]);
		goto Mtre_;
		y0q_6:
		$imgs = iunserializer($fcard["imgs"]);
		goto KQDRg;
		R1T9k:
		$fcard["is_like"] = 1;
		goto whqUe;
		Pl1gR:
		$fcard["is_delete"] = 1;
		goto Lqqt5;
		nGz50: EWhDA:
		goto jz0as;
		NDkGz:
		$mcard = pdo_fetch("SELECT * FROM " . tablename("amouse_wxapp_card") . " WHERE `uniacid`=:welevel_first_id  and openid=:openid limit 1", array(":weid" => $uniacid, ":openlevel_first_id" => $openid));
		goto qpniK;
		r7U0n:
		pdo_insert("amouse_wxapp_card_history", $insert);
		goto ZQwjH;
		CnVig:
		$fcard["collect"] = $fcard["collect"] - 1;
		goto wgICM;
		KQDRg:
		foreach ($imgs as $key => $imgid) {
			$imgs[$key] = tomedia($imgid);
			FKoyz:
		}
		goto V9w5P;
		krQ_I:
		$uniacid = $this->w["uniacid"];
		goto whKJj;
		qpniK:
		if ($fcard["id"] != $mcard["id"]) {
			goto jY0d3;
		}
		goto U0gwe;
		WRMBs:
		pdo_delete("amouse_wxapp_card_history", array("id" => $zan["id"]));
		goto Y_U1T;
		TDyx3: e_7R_:
		goto CEBNS;
		doE9m:
		$friend_user_id = intval($this->c["friend_user_level_first_id"]);
		goto GQSJM;
		iZpqb: H7ckJ:
		goto my8Kw;
		k_OSd:
		pdo_update("amouse_wxapp_card", "collect=collect-1", array("id" => $friend_user_id));
		goto KuWFC;
		KuWFC:
		pdo_delete("amouse_wxapp_card_history", array("id" => $collect["id"]));
		goto yr8BK;
		Lqqt5:
		pdo_update("amouse_wxapp_card", "zan=zan-1", array("id" => $friend_user_id));
		goto WRMBs;
		KbMdM: jXe0r:
		goto Mc1kI;
		E1NX3: jY0d3:
		goto n_G2B;
		nZM0N:
		$UBR6h = empty($zan);
		goto R1zEK;
		ZHTlL:
		$collect = pdo_fetch("SELECT * FROM " . tablename("amouse_wxapp_card_history") . " WHERE from_user=:openid and cardid=:cardid and uniacid=:uniacid and sms_type=2 limit 1 ", array(":openid" => $openid, ":cardid" => $friend_user_id, ":uniaclevel_first_id" => $uniacid));
		goto A6ZT1;
		Mtre_:
		$fcard["imgs"] = $imgs;
		goto gBS16;
		Yywdl: cHZGN:
		goto Or4LX;
		whKJj:
		$curr_openid = $this->c["my_user_level_first_id"];
		goto m4LKG;
		HMKm1:
		$fcard["zan"] = $fcard["zan"] - 1;
		goto xZyxd;
		GQSJM:
		$view_type = $this->c["view_type"];
		goto Llrmh;
		c4Nc5:
		$insert = array("cardid" => $friend_user_id, "sms_type" => 1, "uniaclevel_first_id" => $this->w["uniacid"], "zan_mlevel_first_id" => $zan["zan_mlevel_first_id"] + 1, "from_user" => $openid, "to_user" => $fcard["openid"]);
		goto m68qn;
		CEBNS:
		if (empty($collect)) {
			goto I0KFi;
		}
		goto k_OSd;
		gBS16:
		return $this->result(0, '', $fcard);
		goto pC5Hl;
		M0MgH: global $_GPC, $_W;
		goto krQ_I;
		zu7js: KU0bS:
		goto nZM0N;
		yr8BK:
		$fcard["is_collect"] = 0;
		goto CnVig;
		jz0as:
		goto S5t_s;
		goto ddkIO;
		uE08X:
		if ($gKp5R) {
			goto cHZGN;
		}
		goto dKofi;
		ckZhi:
		goto S5t_s;
		goto TDyx3;
		e4L2s:
		if (empty($zan)) {
			goto jXe0r;
		}
		goto Pl1gR;
		R1zEK:
		if ($UBR6h) {
			goto EWhDA;
		}
		goto SCnh8;
		oGjQn:
		if ($view_type == "zan") {
			goto QbYYj;
		}
		goto ckZhi;
		ddkIO: QbYYj:
		goto e4L2s;
		Mc1kI:
		$fcard["is_delete"] = 0;
		goto c4Nc5;
		A6ZT1:
		if ($view_type == "collect") {
			goto e_7R_;
		}
		goto oGjQn;
		SCnh8:
		$fcard["is_like"] = 1;
		goto nGz50;
		ZQwjH:
		pdo_update("amouse_wxapp_card", "collect=collectř", array("id" => $friend_user_id));
		goto vWPWr;
		LkEXB:
		$insert = array("cardid" => $friend_user_id, "sms_type" => 2, "uniacid" => $this->w["uniacid"], "zan_clevel_first_id" => $zan["zan_clevel_first_id"] + 1, "from_user" => $openid, "to_user" => $fcard["openlevel_first_id"]);
		goto r7U0n;
		m4f_k:
		$fcard["collect"] = $fcard["collect"] + 1;
		goto zu7js;
		my8Kw:
		$gKp5R = empty($collect);
		goto uE08X;
		Or4LX: S5t_s:
		goto y0q_6;
		v5zYI:
		pdo_update("amouse_wxapp_card", "zan=zan+1", array("id" => $friend_user_id));
		goto R1T9k;
		Llrmh:
		$fcard = pdo_fetch("SELECT * FROM " . tablename("amouse_wxapp_card") . " WHERE `uniacid`=:weid  and id=:id limit 1", array(":weid" => $uniacid, ":level_first_id" => $friend_user_id));
		goto NDkGz;
		pC5Hl: kBzQ_:
		goto WBgLY;
		m68qn:
		pdo_insert("amouse_wxapp_card_history", $insert);
		goto v5zYI;
		fR4Ks: I0KFi:
		goto LkEXB;
		n_G2B:
		$zan = pdo_fetch("SELECT * FROM " . tablename("amouse_wxapp_card_history") . " WHERE from_user=:openid and cardlevel_first_id=:cardid and uniacid=:uniacid and sms_type=1 limit 1 ", array(":openlevel_first_id" => $openid, ":cardlevel_first_id" => $friend_user_id, ":uniacid" => $uniacid));
		goto ZHTlL;
		Y_U1T:
		$fcard["is_like"] = 0;
		goto HMKm1;
		V9w5P: dfpnN:
		goto NRvGM;
		kr9e3:
		goto kBzQ_;
		goto E1NX3;
		U0gwe:
		return $this->result(1, '', $fcard);
		goto kr9e3;
		dKofi:
		$fcard["is_collect"] = 1;
		goto Yywdl;
		xZyxd:
		goto H7ckJ;
		goto KbMdM;
		vWPWr:
		$fcard["is_collect"] = 1;
		goto m4f_k;
		WBgLY:
	}

	public function doPageApiGetTop()
	{
		goto Hhn0k;
		a6JAP:
		if (count($list) > 0) {
			goto E1JN0;
		}
		goto eiK0b;
		lBaaL:
		$list = pdo_fetchall($sql, array(":weid" => $uniacid));
		goto f8GxX;
		u0kU1:
		if ($type == "collect") {
			goto ecBeL;
		}
		goto r1itB;
		lT8Y4:
		$psize = max(10, intval($this->c["psize"]));
		goto w0BQK;
		ml9CJ:
		$type = $this->c["type"];
		goto oBepM;
		B29PC:
		if ($type == "view") {
			goto gFqY4;
		}
		goto imNjJ;
		RQLVe:
		$return["gtotal"] = $tpage;
		goto XnnU2;
		r1itB:
		goto lwj7R;
		goto i7nXd;
		w0BQK:
		$start = ($pindex - 1) * $psize;
		goto B29PC;
		MM6JI:
		foreach ($list as $key => $value) {
			$list[$key]["avater"] = empty($value["avater"]) ? tomedia($value["weixinImg"]) : tomedia($value["avater"]);
			UYshI:
		}
		goto rqTrK;
		XfeW2:
		$orderby = " ORDER BY view DESC ";
		goto HRkPM;
		Ud1G5:
		$return["list"] = $list;
		goto RQLVe;
		f8GxX:
		$total = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("amouse_wxapp_card") . "  WHERE `uniacid` =:weid  ", array(":weid" => $uniacid));
		goto BDgXK;
		bBf1Z:
		goto lwj7R;
		goto yCiKY;
		nBkC6:
		goto xQVb3;
		goto LKop5;
		imNjJ:
		if ($type == "zan") {
			goto UIFyW;
		}
		goto u0kU1;
		hHpsG: xQVb3:
		goto ZsD86;
		VByLb:
		$orderby = " ORDER BY collect DESC ";
		goto oEGU4;
		XnnU2:
		return $this->result(0, '', $return);
		goto hHpsG;
		LKop5: E1JN0:
		goto MM6JI;
		z0rad:
		$return = array();
		goto a6JAP;
		Hhn0k: global $_GPC, $_W;
		goto qwgKz;
		oEGU4: lwj7R:
		goto BGpOE;
		i7nXd: gFqY4:
		goto XfeW2;
		cdgQU:
		$orderby = " ORDER BY zan DESC ";
		goto bBf1Z;
		eiK0b:
		return $this->result(1, '', 0);
		goto nBkC6;
		rqTrK: ZdP70:
		goto Ud1G5;
		qwgKz:
		$uniacid = $this->w["uniacid"];
		goto ml9CJ;
		BGpOE:
		$sql = "SELECT * FROM " . tablename("amouse_wxapp_card") . " WHERE `uniaclevel_first_id` =:welevel_first_id " . $orderby . " limit {$start},{$psize}";
		goto lBaaL;
		yCiKY: ecBeL:
		goto VByLb;
		BDgXK:
		$tpage = ceil($total / $psize);
		goto z0rad;
		iohqe: UIFyW:
		goto cdgQU;
		oBepM:
		$pindex = max(1, intval($this->c["pageIndex"]));
		goto lT8Y4;
		HRkPM:
		goto lwj7R;
		goto iohqe;
		ZsD86:
	}

	public function doPageApiGetMyList()
	{
		goto Hr4Qb;
		BCngl:
		goto ahJGp;
		goto SujXl;
		ye6G4:
		$uniacid = intval($this->w["uniacid"]);
		goto MFmoK;
		UNf32:
		return $this->result(1, '', 0);
		goto TSeHe;
		yuvVb:
		foreach ($list as $key => $value) {
			goto YoRt9;
			H3QyS: pNGPb:
			goto jSZ9S;
			YoRt9:
			$list[$key]["weixinImg"] = tomedia($value["weixinImg"]);
			goto a5c9l;
			a5c9l:
			$list[$key]["avater"] = tomedia($value["avater"]);
			goto H3QyS;
			jSZ9S:
		}
		goto tjqf6;
		DYHbD:
		goto ahJGp;
		goto x0CI_;
		uLiNo:
		$psize = max(10, intval($this->c["psize"]));
		goto VPUZe;
		LXxwK:
		$list = pdo_fetchall($sql, array(":welevel_first_id" => $uniacid, ":to_user" => $openid));
		goto sxiYQ;
		MpkUE:
		$where .= " and h.sms_type=1 ";
		goto QfTOC;
		VxTcU:
		if ($type == "view") {
			goto lVP4_;
		}
		goto U4mIv;
		MFmoK:
		$type = $this->c["type"];
		goto DNRCh;
		HEdIJ: rFufk:
		goto BZi9U;
		tDw8t:
		$where .= " and h.sms_type=2 ";
		goto rFzHV;
		rFzHV: ahJGp:
		goto zZ2gU;
		SIW5A:
		$where = " and h.uniacid =:welevel_first_id and h.to_user=:to_user ";
		goto VxTcU;
		QfTOC:
		goto ahJGp;
		goto b8EVV;
		b8EVV: lR6yg:
		goto tDw8t;
		U4mIv:
		if ($type == "zan") {
			goto jtbuX;
		}
		goto hjQwY;
		TSeHe:
		goto rFufk;
		goto vVk0D;
		VBZy6:
		return $this->result(0, '', $list);
		goto HEdIJ;
		sxiYQ:
		if (count($list) > 0) {
			goto FLvQX;
		}
		goto UNf32;
		qYJRc:
		$pindex = max(1, intval($this->c["pageIndex"]));
		goto uLiNo;
		hjQwY:
		if ($type == "collect") {
			goto lR6yg;
		}
		goto DYHbD;
		vVk0D: FLvQX:
		goto yuvVb;
		x0CI_: lVP4_:
		goto fDPnQ;
		VPUZe:
		$start = ($pindex - 1) * $psize;
		goto SIW5A;
		SujXl: jtbuX:
		goto MpkUE;
		DNRCh:
		$openid = $this->w["openid"];
		goto qYJRc;
		fDPnQ:
		$where .= " and h.sms_type=\x30  ";
		goto BCngl;
		tjqf6: mYl5k:
		goto VBZy6;
		zZ2gU:
		$sql = "SELECT c.* FROM " . tablename("amouse_wxapp_card_history") . " as h ," . tablename("amouse_wxapp_card") . " as c where h.from_user=c.openid " . $where;
		goto LXxwK;
		Hr4Qb: global $_GPC, $_W;
		goto ye6G4;
		BZi9U:
	}

	public function doPageApiGetMyHolder()
	{
		goto g38Yz;
		BDonh:
		return $this->result(0, $sql, $list);
		goto lwiTF;
		dMF0v:
		return $this->result(1, '', 0);
		goto fohG4;
		uwd8T: He2e7:
		goto BDonh;
		SpPia:
		$openid = $this->w["openid"];
		goto f5UiP;
		Gealy:
		if (count($list) > 0) {
			goto U6FDO;
		}
		goto dMF0v;
		fsVBE: w1YWZ:
		goto ZFGbk;
		SwHOz:
		$where = " AND card.username LIKE '%{$key}%' or card.company LIKE '%{$key}%'  ";
		goto fsVBE;
		MhYrf:
		$vuou0 = empty($key);
		goto oWS07;
		oWS07:
		if ($vuou0) {
			goto w1YWZ;
		}
		goto SwHOz;
		f5UiP:
		$key = $this->c["s_key"];
		goto MhYrf;
		ZFGbk:
		$sql = "SELECT card.* from " . tablename("amouse_wxapp_card") . " as card where card.openid in ( SELECT h.to_user  FROM " . tablename("amouse_wxapp_card_history") . "  as h ," . tablename("amouse_wxapp_card") . "  as c where h.from_user=c.openlevel_first_id and h.uniacid =:weid and h.from_user=:to_user and h.sms_type=\x32 )" . $where;
		goto ISOIZ;
		g38Yz: global $_GPC, $_W;
		goto wC6Hr;
		fohG4:
		goto UQi5g;
		goto IQPYg;
		wC6Hr:
		$uniacid = intval($this->w["uniacid"]);
		goto SpPia;
		IQPYg: U6FDO:
		goto nSljE;
		nSljE:
		foreach ($list as $key => $value) {
			goto p_1lj;
			p_1lj:
			$list[$key]["weixinImg"] = tomedia($value["weixinImg"]);
			goto eTU6c;
			eTU6c:
			$list[$key]["avater"] = tomedia($value["avater"]);
			goto D6qDb;
			D6qDb: Sc24l:
			goto FIaEs;
			FIaEs:
		}
		goto uwd8T;
		ISOIZ:
		$list = pdo_fetchall($sql, array(":welevel_first_id" => $uniacid, ":to_user" => $openid));
		goto Gealy;
		lwiTF: UQi5g:
		goto uhr2S;
		uhr2S:
	}

	public function doPageApiSendMsg()
	{
		goto RSdb_;
		sALts:
		return $this->result(1, "\xe8\xaf\xb7\xe8\276\x93\xe5\x85\xa5\xe6\x89\x8b\xe6\x9c\xba\xe5\217\267", '');
		goto yZBbL;
		DN0ex:
		$w5k8S = empty($_mobile_val);
		goto xCTex;
		o0gBn:
		if ($A3bSI) {
			goto K9fkj;
		}
		goto XCMU3;
		MF2s2:
		if ($Fbqk0) {
			goto YdDAg;
		}
		goto cvbET;
		O_7SJ:
		$A3bSI = !($mins < 1);
		goto o0gBn;
		Xj4f_:
		include_once IA_ROOT . "/addons/amouse_wxapp_card/\101liyunSms.class.php";
		goto h4INR;
		nDUk_:
		return $this->result(0, '', $code);
		goto ckwpk;
		QlxIp:
		$uniacid = $this->w["uniacid"];
		goto uF9Bx;
		UXWWr:
		$uyNVs = !empty($set);
		goto xgfx3;
		RIIPh: o2Q9_:
		goto nDUk_;
		xCTex:
		if ($w5k8S) {
			goto o2Q9_;
		}
		goto Xj4f_;
		gq6bS: hOM28:
		goto u3hjz;
		q2RsX:
		if (!preg_match("/(\x5e1\133\x33\174\x34\174\x35\174\67\174\70\135\x5b\60-\71\135\x7b\71\x7d\x24)/", $_mobile_val)) {
			goto hOM28;
		}
		goto CTGaK;
		j9dRW: k3mFC:
		goto Ulbmo;
		fKOB4:
		pdo_insert("amouse_wxapp_sms", $data);
		goto XMdha;
		XCMU3:
		return $this->result(1, "\346\x82\250\xe7\232\x84\xe6\x93\215\xe4\275\234\xe8\277\x87\344\272\216\351\242\x91\347\xb9\x81,\xe8\257\267\347\250\215\345\x90\216\xe5\206\215\350\257\x95r", $mins);
		goto N26QG;
		uF9Bx:
		$_mobile_val = trim($this->c["_mobile_val"]);
		goto FvGnr;
		oQNJ3:
		$acsResponse = $sms->_sendNewDySms($_mobile_val, $set["sms_user"], $set["sms_secret"], $set["sms_free_sign_name"], $set["reg_sms_code"], $sms_param, $code);
		goto MRZdQ;
		mwg3z:
		if (!empty($userVerifyCode)) {
			goto VeczC;
		}
		goto wDIke;
		BXiVR: LnMzc:
		goto DN0ex;
		wDIke:
		$code = random(6, true);
		goto eYo0n;
		jESI7: YdDAg:
		goto C9C2n;
		xgfx3:
		if ($uyNVs) {
			goto ZSP5S;
		}
		goto rWq0l;
		Q2NJg: buFWU:
		goto sALts;
		etGMn:
		pdo_update("uni_verifycode", $record, array("id" => $userVerifyCode["id"]));
		goto BXiVR;
		IZseG:
		if ($_mobile_val == '') {
			goto buFWU;
		}
		goto q2RsX;
		W7fyY:
		goto KJVaM;
		goto C2wJa;
		CTGaK:
		goto k3mFC;
		goto Q2NJg;
		OlETA:
		$record["total"] = $userVerifyCode["total"] + 1;
		goto o2Vaj;
		TFhoV:
		$acsResponse = $sms->_sendAliDaYuSms($_mobile_val, $set["sms_user"], $set["sms_secret"], $set["sms_free_sign_name"], $set["reg_sms_code"], $sms_param);
		goto W7fyY;
		h4INR:
		$sms = new \AliyunSms();
		goto IrTEx;
		TqiHi: VeczC:
		goto au60f;
		IrTEx:
		$sms_param = "\173\42number\42:\42{$code}\x22\x7d";
		goto BEYtq;
		o2Vaj:
		$record["createtime"] = time();
		goto etGMn;
		MRZdQ: KJVaM:
		goto RIIPh;
		vU6PX: ZSP5S:
		goto IZseG;
		iuXfr:
		$mins = intval((time() - $userVerifyCode["createtime"]) % 86400 % 3600 / 60);
		goto O_7SJ;
		BEYtq:
		if ($set["sms_type"] == 1) {
			goto yzApN;
		}
		goto TFhoV;
		C2wJa: yzApN:
		goto oQNJ3;
		cvbET:
		return $this->result(1, "\346\202\250\347\232\x84\xe6\223\215\xe4\275\x9c\xe8\xbf\207\344\272\216\xe9\242\x91\xe7\271\201,\350\257\267\xe7\xa8\x8d\xe5\x90\x8e\xe5\x86\215\350\xaf\225", '');
		goto jESI7;
		yZBbL:
		goto k3mFC;
		goto gq6bS;
		XMdha:
		goto LnMzc;
		goto TqiHi;
		rWq0l:
		return $this->result(1, "\347\237\255\xe4\277\241\xe4\270\232\xe5\212\xa1\xe9\x85\215\xe7\xbd\xae\xe4\270\215\346\255\xa3\347\241\xae", $_mobile_val);
		goto vU6PX;
		u3hjz:
		return $this->result(1, "\xe6\202\xa8\xe8\276\x93\xe5\205\245\347\x9a\x84\346\211\213\xe6\234\xba\345\217\xb7\xe6\240\xbc\xe5\274\217\xe9\x94\231\350\257\257", '');
		goto j9dRW;
		RSdb_: global $_GPC, $_W;
		goto QlxIp;
		N26QG: K9fkj:
		goto OlETA;
		eYo0n:
		$data = array("uniacid" => $uniacid, "code" => $code, "mobile" => $_mobile_val, "createtime" => time());
		goto fKOB4;
		Ulbmo:
		$userVerifyCode = pdo_fetch("SELECT * FROM " . tablename("amouse_wxapp_sms") . " WHERE `uniacid`= :welevel_first_id and `mobile`=:mobile ", array(":weid" => $uniacid, ":mobile" => $_mobile_val));
		goto mwg3z;
		FvGnr:
		$set = pdo_fetch("SELECT * FROM " . tablename("amouse_wxapp_sysset") . " WHERE `uniacid`= :weid  limit 1 ", array(":weid" => $uniacid));
		goto UXWWr;
		au60f:
		$Fbqk0 = !($userVerifyCode["total"] > 3);
		goto MF2s2;
		C9C2n:
		$code = $userVerifyCode["code"];
		goto iuXfr;
		ckwpk:
	}

	private function checkLogin()
	{
		goto QpgYI;
		RO139:
		if ($MBYxM) {
			goto Ngkdb;
		}
		goto ewFCs;
		Q6Czl: Ngkdb:
		goto X0rmN;
		QpgYI: global $_W;
		goto BuH14;
		ewFCs:
		return error(1, "\xe8\xaf\xb7\345\205\210\347\231\xbb\xe5\275\x95" . $this->w["fans"]);
		goto Q6Czl;
		X0rmN:
		return true;
		goto Hz383;
		BuH14:
		$MBYxM = !empty($this->w["fans"]);
		goto RO139;
		Hz383:
	}

	public function doPageApiPostMyCard()
	{
		goto AvrJ2;
		dbYpx:
		if ($J10B5) {
			goto XKu7K;
		}
		goto Q0GCa;
		L0Lc4:
		$Zm7PX = !($mins > 30);
		goto fmG3i;
		mAZGL:
		$username = empty($this->c["username"]) ? $nickname : trim($this->c["username"]);
		goto IH9bd;
		nrOfs:
		goto pTwSI;
		goto pw53C;
		hNmTi:
		$sDbZ9 = !($userVerifyCode["status"] == 1);
		goto MCGY6;
		NSHoG:
		$data["imgs"] = empty($images) ? $card["imgs"] : $images;
		goto TZbeP;
		j1EZo: lCu2R:
		goto Bwkku;
		l0s13:
		$mobile_verify_status = pdo_fetchcolumn("SELECT `mobile_verify_status` FROM " . tablename("amouse_wxapp_sysset") . " WHERE `uniacid`= :weid  limit 1 ", array(":weid" => $uniacid));
		goto rXvBY;
		IH9bd:
		$data = array("uniacid" => $uniacid, "openid" => $from, "mobile" => $this->c["mobile"], "status" => 0, "avater" => $avatar, "email" => $this->c["email"], "job" => $this->c["job"], "username" => $username, "weixin" => $this->c["weixin"], "company" => $this->c["company"], "weixinImg" => $this->c["weixinImg"], "desc" => $this->c["desc"], "imgs" => $images);
		goto tseEm;
		MCGY6:
		if ($sDbZ9) {
			goto DTHql;
		}
		goto yvxvQ;
		acoJS:
		$apiCardid = pdo_insertid();
		goto P6DHz;
		SwyqN:
		$down_images = array();
		goto AGd0B;
		epwC9:
		$userVerifyCode = pdo_fetch("SELECT `id`,`code`,`createtime`,`status` FROM " . tablename("amouse_wxapp_sms") . " WHERE `uniaclevel_first_id`= :uniacid and `mobile`=:mobile limit 1", array(":uniacid" => $uniacid, ":mobile" => trim($this->c["mobile"])));
		goto Pq66J;
		DjvUb:
		return $this->result(1, "\351\252\x8c\xe8\xaf\201\347\xa0\201\xe4\270\215\346\xad\243\xe7\241\xae\xef\xbc\214\350\257\xb7\xe7\xa1\256\xe8\xae\244\351\252\214\350\257\201", $userVerifyCode["status"]);
		goto NOB0e;
		Jy35i:
		goto xGHb_;
		goto N5UNw;
		AvrJ2: global $_GPC, $_W;
		goto lFkYV;
		p6UGn: DTHql:
		goto bnQsx;
		LLiaI:
		pdo_update("amouse_wxapp_card", $data, array("id" => $apiCardid));
		goto roLHr;
		nesAY: XKu7K:
		goto B4XO1;
		QhkZ_: BkY1d:
		goto Jy35i;
		oAm3P:
		pdo_insert("amouse_wxapp_card", $data);
		goto acoJS;
		hgllT:
		$apiCardid = $this->c["cardid"];
		goto Y7hLY;
		roLHr: xGHb_:
		goto X2QW9;
		rXvBY:
		if ($mobile_verify_status && $mobile_verify_status == 1) {
			goto jHXIH;
		}
		goto vrw1O;
		JDb1d:
		$J10B5 = !is_error($login_success);
		goto dbYpx;
		Y7hLY:
		$images = $this->c["imgs"];
		goto ILelK;
		P6DHz: oSqGh:
		goto PqsiI;
		bnQsx:
		if ($userVerifyCode["code"] == $phone_code) {
			goto lCu2R;
		}
		goto DjvUb;
		pw53C: taZfP:
		goto YsR6P;
		N5UNw: wNFwT:
		goto tFMUE;
		Bwkku:
		pdo_update("amouse_wxapp_sms", array("status" => 1), array("id" => $userVerifyCode["id"]));
		goto oAm3P;
		tFMUE:
		$card = pdo_fetch("select * from " . tablename("amouse_wxapp_card") . " where id=:id and uniacid=:welevel_first_id limit 1", array(":id" => $apiCardid, ":welevel_first_id" => $uniacid));
		goto NSHoG;
		t0XAN:
		$apiCardid = pdo_insertid();
		goto wHdm7;
		MLacs: WYOhH:
		goto QhYwf;
		mTovQ:
		$phone_code = trim($this->c["phone_code"]);
		goto epwC9;
		sle9Z:
		$nickname = $this->w["fans"]["nickname"];
		goto AQUmu;
		PqsiI: pTwSI:
		goto QhkZ_;
		S9BCh:
		$uniacid = $this->w["uniacid"];
		goto sle9Z;
		Q0GCa:
		return $this->result($login_success["errno"], $login_success["message"]);
		goto nesAY;
		Dexex: jHXIH:
		goto mTovQ;
		TZbeP:
		$data["weixinImg"] = empty($this->c["weixinImg"]) ? $card["weixinImg"] : $this->c["weixinImg"];
		goto LLiaI;
		QhYwf:
		$images = iserializer($down_images);
		goto mAZGL;
		uSJui: OeZyp:
		goto hNmTi;
		YsR6P:
		$mins = intval((time() - $userVerifyCode["createtime"]) % 86400 % 3600 / 60);
		goto L0Lc4;
		ILelK:
		$imgs = explode("\174", $images);
		goto SwyqN;
		IQYyY:
		return $this->result(1, "\xe6\255\244\351\252\214\350\xaf\x81\347\240\201\xe5\xb7\262\347\273\217\xe5\244\xb1\346\x95\x88", $mins);
		goto uSJui;
		fmG3i:
		if ($Zm7PX) {
			goto OeZyp;
		}
		goto IQYyY;
		vrw1O:
		pdo_insert("amouse_wxapp_card", $data);
		goto t0XAN;
		NOB0e:
		goto oSqGh;
		goto j1EZo;
		yvxvQ:
		return $this->result(1, "\346\255\244\xe9\xaa\214\xe8\xaf\x81\347\xa0\x81\345\xb7\xb2\xe7\xbb\x8f\xe8\xa2\253\xe4\xbd\xbf\347\x94\250", $userVerifyCode["status"]);
		goto p6UGn;
		wHdm7:
		goto BkY1d;
		goto Dexex;
		urvHq:
		return $this->result(1, "\346\202\xa8\xe8\xbe\223\xe5\x85\245\347\x9a\204\346\211\213\346\234\xba\345\217\267\347\240\x81\xe4\xb8\215\xe6\xad\243\xe7\241\256\357\xbc\214\350\257\267\xe7\241\xae\350\xae\xa4\350\276\223\345\205\245", $phone_code);
		goto nrOfs;
		X2QW9:
		return $this->result(0, '', $apiCardid);
		goto LBw7V;
		AQUmu:
		$avatar = empty($this->c["avatar\125rl"]) ? $this->w["fans"]["avatar"] : $this->c["avatar\125rl"];
		goto hgllT;
		lFkYV:
		$login_success = $this->checkLogin();
		goto JDb1d;
		Pq66J:
		if (!empty($userVerifyCode)) {
			goto taZfP;
		}
		goto urvHq;
		B4XO1:
		$from = $this->w["fans"]["openlevel_first_id"];
		goto S9BCh;
		AGd0B:
		foreach ($imgs as $imgid) {
			$down_images[] = $imgid;
			sKVZf:
		}
		goto MLacs;
		tseEm:
		if ($apiCardid > 0) {
			goto wNFwT;
		}
		goto l0s13;
		LBw7V:
	}

	public function doPageApiPostChangeMobile()
	{
		goto VbXzO;
		fxo89:
		$sDbZ9 = !($userVerifyCode["status"] == 1);
		goto CGoKt;
		JyRJC:
		goto kXv_v;
		goto ljd0C;
		pgWhA:
		$data = array("mobile" => trim($this->c["mobile"]));
		goto A2Weo;
		SPiGO: BXn1A:
		goto clf8b;
		smMLV:
		return $this->result(1, "\346\255\xa4\xe9\252\x8c\xe8\257\x81\xe7\240\x81\345\267\xb2\347\273\x8f\350\xa2\xab\344\xbd\277\xe7\x94\xa8", $userVerifyCode["status"]);
		goto lhWE5;
		qUcWu: kXv_v:
		goto LtNuV;
		uYWXS: IiiVd:
		goto slZxE;
		kbr9T:
		if ($userVerifyCode["code"] == $phone_code) {
			goto IiiVd;
		}
		goto xLGvQ;
		VbXzO: global $_GPC, $_W;
		goto IDEQp;
		ck91R: cvqoc:
		goto y1lPf;
		Iqh7V:
		if ($apiCardid > 0) {
			goto k3l9K;
		}
		goto ecx1D;
		KQKjd:
		return $this->result(1, "\346\x89\213\xe6\234\xba\xe5\217\267\347\xa0\x81\344\xb8\x8d\346\xad\243\xe7\xa1\256\357\274\x8c\xe8\257\xb7\xe7\xa1\xae\350\256\xa4\351\252\214\xe8\xaf\201", $phone_code);
		goto Njf8z;
		c7bWJ:
		if ($Zm7PX) {
			goto fDr5h;
		}
		goto DPqo4;
		slZxE:
		pdo_update("amouse_wxapp_sms", array("status" => 1), array("id" => $userVerifyCode["level_first_id"]));
		goto FNN0F;
		x4Q1R: Rbi8g:
		goto oUkIu;
		cN6KG:
		goto cvqoc;
		goto uYWXS;
		ZOlRZ:
		$apiCardid = intval($this->c["cardid"]);
		goto Iqh7V;
		FKjKS: fDr5h:
		goto fxo89;
		vBBLB:
		$Zm7PX = !($mins > 30);
		goto c7bWJ;
		ljd0C: k3l9K:
		goto pgWhA;
		PF2Uc:
		pdo_update("amouse_wxapp_card", $data, array("id" => $apiCardid));
		goto I4jwb;
		A2Weo:
		$mobile_verify_status = pdo_fetchcolumn("SELECT `mobile_verify_status` FROM " . tablename("amouse_wxapp_sysset") . " WHERE `uniacid`= :weid  limit 1 ", array(":weid" => $uniacid));
		goto V4V9O;
		oUkIu:
		return $this->result(0, '', $apiCardid);
		goto qUcWu;
		T_MGY:
		$userVerifyCode = pdo_fetch("SELECT `id`,`code`,`createtime`,`status` FROM " . tablename("amouse_wxapp_sms") . " WHERE `uniacid`= :uniaclevel_first_id and `mobile`=:mobile limit 1 ", array(":uniacid" => $uniacid, ":mobile" => trim($this->c["mobile"])));
		goto BevQQ;
		CJ4ag:
		$mins = intval((time() - $userVerifyCode["createtime"]) % 86400 % 3600 / 60);
		goto vBBLB;
		IDEQp:
		$uniacid = intval($this->w["uniaclevel_first_id"]);
		goto ZOlRZ;
		DPqo4:
		return $this->result(1, "\xe6\255\244\xe9\252\214\350\257\201\347\240\x81\xe5\267\xb2\xe7\273\217\xe5\xa4\xb1\xe6\x95\x88", $mins);
		goto FKjKS;
		BevQQ:
		if (!empty($userVerifyCode)) {
			goto dfaLW;
		}
		goto KQKjd;
		GJnhg: dfaLW:
		goto CJ4ag;
		Njf8z:
		goto DQRaS;
		goto GJnhg;
		CGoKt:
		if ($sDbZ9) {
			goto aABor;
		}
		goto smMLV;
		I4jwb:
		goto Rbi8g;
		goto SPiGO;
		FNN0F:
		pdo_update("amouse_wxapp_card", $data, array("level_first_id" => $apiCardid));
		goto ck91R;
		clf8b:
		$phone_code = trim($this->c["phone_code"]);
		goto T_MGY;
		y1lPf: DQRaS:
		goto x4Q1R;
		xLGvQ:
		return $this->result(1, "\351\252\x8c\350\xaf\x81\xe7\240\x81\344\xb8\215\346\xad\xa3\xe7\241\xae\357\xbc\214\xe8\257\267\xe7\xa1\xae\350\xae\244\351\252\x8c\350\xaf\201", $userVerifyCode["status"]);
		goto cN6KG;
		lhWE5: aABor:
		goto kbr9T;
		V4V9O:
		if ($mobile_verify_status && $mobile_verify_status == 1) {
			goto BXn1A;
		}
		goto PF2Uc;
		ecx1D:
		return $this->result(1, '', $apiCardid);
		goto JyRJC;
		LtNuV:
	}

	public function doPageApiPostUser()
	{
		goto w1XVw;
		phGnX:
		$data["uniaclevel_first_id"] = $uniacid;
		goto wpnRr;
		iQl3F:
		if ($J10B5) {
			goto WJu4A;
		}
		goto X__qF;
		IL3ZV: iSuVX:
		goto OqXye;
		g1_Dr:
		$uid = pdo_insertid();
		goto KBCpg;
		KBCpg:
		return $this->result(0, '', $uid);
		goto OyzkT;
		w1XVw: global $_GPC, $_W;
		goto Nb1I1;
		bHs2W:
		$uniacid = intval($this->w["uniaclevel_first_id"]);
		goto Ebkp1;
		pW8RS:
		$data = array("realname" => trim($this->c["realname"]), "mobile" => trim($this->c["mobile"]), "address" => trim($this->c["address"]), "openid" => $from, "status" => 0, "sex" => trim($this->c["sex"]), "desc" => trim($this->c["desc"]));
		goto c2BMX;
		OyzkT:
		goto iSuVX;
		goto gOuqh;
		W4s00:
		pdo_update("amouse_wxapp_member", $data, array("id" => $uid));
		goto LOypM;
		Ebkp1:
		$uid = intval($this->c["uid"]);
		goto pW8RS;
		X__qF:
		return $this->result($login_success["errno"], $login_success["message"]);
		goto Hu5Rf;
		pnaFH:
		$from = $this->w["fans"]["openid"];
		goto bHs2W;
		gOuqh: Pr94f:
		goto W4s00;
		Hu5Rf: WJu4A:
		goto pnaFH;
		tmJ3H:
		pdo_insert("amouse_wxapp_member", $data);
		goto g1_Dr;
		c2BMX:
		if ($uid > 0) {
			goto Pr94f;
		}
		goto phGnX;
		h8E5b:
		$J10B5 = !is_error($login_success);
		goto iQl3F;
		Nb1I1:
		$login_success = $this->checkLogin();
		goto h8E5b;
		LOypM:
		return $this->result(0, '', $uid);
		goto IL3ZV;
		wpnRr:
		$data["createtime"] = time();
		goto tmJ3H;
		OqXye:
	}

	public function doPageApiGetUserInfo()
	{
		goto jAGAQ;
		SK_DC:
		goto kq8W2;
		goto cxoiR;
		niKML:
		$J10B5 = !is_error($login_success);
		goto mayAM;
		m0yO0: kq8W2:
		goto kQ5aT;
		mayAM:
		if ($J10B5) {
			goto cv917;
		}
		goto W76qo;
		S3nZ1:
		$openid = $this->w["openid"];
		goto DptN0;
		cDOPM:
		$login_success = $this->checkLogin();
		goto niKML;
		MBv74:
		return $this->result(0, '', $member);
		goto m0yO0;
		y1lK3:
		return $this->result(1, '', $openid);
		goto SK_DC;
		Wqi9q: cv917:
		goto S3nZ1;
		xrEnk:
		if (!empty($member)) {
			goto wZe1t;
		}
		goto y1lK3;
		cxoiR: wZe1t:
		goto MBv74;
		jAGAQ: global $_W;
		goto qUlZc;
		W76qo:
		return $this->result($login_success["errno"], $login_success["message"]);
		goto Wqi9q;
		DptN0:
		$member = pdo_fetch("SELECT * FROM " . tablename("amouse_wxapp_member") . " WHERE `uniacid`=:weid and `openid`=:openid limit 1", array(":weid" => $uniacid, ":openid" => $openid));
		goto xrEnk;
		qUlZc:
		$uniacid = $this->w["uniacid"];
		goto cDOPM;
		kQ5aT:
	}

	public function doPagePay()
	{
		goto slbhf;
		a45Em:
		$login_success = $this->checkLogin();
		goto WaG1P;
		x00_w:
		$pay_params["orderid"] = $orderid;
		goto SAb0y;
		Bxsl5:
		$order = pdo_fetch("SELECT * FROM " . tablename("amouse_shopping\x33_order") . " WHERE id={$orderid} AND weid = '{$uniacid}\x27  ");
		goto LtR5w;
		WjPFw: iIWgX:
		goto ae4u5;
		gkoHq:
		pdo_insert("amouse_shopping\63_fans", $fdata);
		goto jVo_q;
		db0DR:
		return $this->result($login_success["errno"], $login_success["message"]);
		goto UDYPS;
		Ia33U:
		if ($J10B5) {
			goto vMKMt;
		}
		goto db0DR;
		qz7e1:
		$goodsArr = json_decode($orderparam, true);
		goto tryQr;
		PdbmR:
		if ($YuFat) {
			goto JvZjz;
		}
		goto wTeh7;
		sxxtG:
		goto d1H0q;
		goto oh65O;
		jVo_q: RywCY:
		goto XkHyT;
		F6QD5:
		if ($t_WIv) {
			goto EJ5jW;
		}
		goto xg67k;
		ShcGr:
		$send["keyword\x34"] = array("value" => date("Y\345\271\xb4m\xe6\x9c\x88d\346\227\245", empty($data["createtime"]) ? $order["createtime"] : $data["createtime"]), "color" => "\x23\60\x30\x30");
		goto j4u6m;
		wTeh7:
		return $this->result(1, "\346\212\261\xe6\xad\x89\xef\xbc\x8c\xe6\202\250\347\232\204\350\xb4\xad\xe7\x89\xa9\350\275\246\351\207\214\346\xb2\xa1\xe6\234\211\344\273\273\xe4\275\x95\345\x95\206\xe5\x93\201\xef\xbc\214\xe8\xaf\267\345\x85\210\350\xb4\255\xe4\271\260\357\274\x81" . $orderid, $orderparam);
		goto R6Tmd;
		gZmVx:
		$orderid = intval($this->c["id"]);
		goto qXBLg;
		Gnfj8:
		foreach ($goodsArr as $row) {
			goto w_6ja;
			w_6ja:
			$H6HeT = !(empty($row) || $row["nums"] < 1);
			goto cnz_g;
			IyG62: VexIk:
			goto sPr5V;
			la3BI:
			goto VexIk;
			goto VwvIv;
			VwvIv: QASq_:
			goto DLhUT;
			cnz_g:
			if ($H6HeT) {
				goto QASq_;
			}
			goto la3BI;
			DLhUT:
			pdo_insert("amouse_shopping\x33_order_goods", array("weid" => $uniacid, "goodsid" => $row["dishes_level_first_id"], "orderid" => $orderid, "total" => $row["nums"], "description" => $row["description"], "createtime" => TIMESTAMP));
			goto IyG62;
			sPr5V:
		}
		goto CYjHL;
		ovhXc:
		$data = array("weid" => $uniacid, "from_user" => $from, "shopid" => intval($this->c["shoplevel_first_id"]), "ordersn" => date("ymd") . sprintf("%\60\x34d", $this->w["fans"]["id"]) . random(4, 1), "status" => 0, "sendtype" => 0, "paytype" => 0, "couponlevel_first_id" => $couponId, "totalnum" => $this->c["totalnum"], "totalprice" => $this->c["total\x50rice"], "createtime" => TIMESTAMP, "secretid" => random(4, 1), "print_sta" => 0, "expressprice" => "\345\xb0\x8f\347\250\x8b\345\xba\x8f", "tel" => trim($this->c["tel"]), "guest_name" => trim($this->c["username"]), "guest_address" => trim($this->c["address"]), "remark" => trim($this->c["remark"]));
		goto wCRx6;
		h7H6U:
		goto RywCY;
		goto ujI09;
		ujI09: LI_Nq:
		goto gkoHq;
		VHOXg:
		$uniacid = $this->w["uniacid"];
		goto Kv1kH;
		rgZWB: eR7k8:
		goto gCsXU;
		F3aF4:
		$send["keyword\x32"] = array("value" => empty($data["totalprice"]) ? $order["totalprice"] : $data["totalprice"] . "\345\205\x83", "color" => "\43\x30\x30\60");
		goto frOKt;
		gqtFL:
		$orderparam = str_replace("\42\42nums\42\42", "\x22nums\42", $orderparam);
		goto qz7e1;
		qXBLg:
		if ($orderid > 0) {
			goto ClmU1;
		}
		goto scDS7;
		j4u6m:
		if (!empty($this->c["istype"]) && $this->c["istype"] == 0) {
			goto DZ6nG;
		}
		goto uifSH;
		VZmQb:
		pdo_update("amouse_shopping\x33_order", array("prepay_level_first_id" => $prepay_id), array("id" => $orderid));
		goto pdtCM;
		R2fwI:
		load()->func("logging");
		goto VHOXg;
		VlFeL:
		$this->sendTplNotice($from, $set["print_bottom"], "amouse_orders/pages/order_list/index\x3fid=" . $orderid, trim($this->c["formid"]), $send, "keyword1.D\101T\101");
		goto d1w7l;
		TCS1C:
		$set = pdo_fetch("SELECT * FROM " . tablename("amouse_shopping\63_set") . " WHERE weid = :weid", array(":weid" => $this->w["uniacid"]));
		goto yKCzt;
		bGvVJ:
		$orderparam = str_replace("\x22\x22price\42\x22", "\x22price\42", $orderparam);
		goto gqtFL;
		uifSH:
		if (!empty($this->c["istype"]) && $this->c["istype"] == 1) {
			goto iIWgX;
		}
		goto BCclq;
		NgACh:
		if ($QD302) {
			goto veaQB;
		}
		goto j8E7y;
		VdXJW:
		$goods = pdo_fetchall("SELECT * FROM " . tablename("amouse_shopping\x33_goods") . "  WHERE id IN ('" . implode("\x27,\x27", array_keys($goodsid)) . "\x27)");
		goto b7HoP;
		Kv1kH:
		$from = $this->w["openid"];
		goto CFvZr;
		SAb0y:
		$UGB26 = !is_error($pay_params);
		goto xhA17;
		xAEE3:
		$totalprice = $this->c["total\x50rice"];
		goto sxxtG;
		pdtCM:
		return $this->result(0, "\xe8\257\245\xe5\225\x86\xe6\210\xb7\xe6\x94\257\xe4\273\230\xe8\256\276\xe7\xbd\256\xe6\210\x90\xe5\212\x9f", $pay_params);
		goto HefAf;
		d1w7l:
		goto eR7k8;
		goto WjPFw;
		Dl7VI: d1H0q:
		goto TCS1C;
		UDYPS: vMKMt:
		goto R2fwI;
		zIs6H:
		pdo_update("amouse_shopping\63_fans", $fdata, array("from_user" => $from));
		goto h7H6U;
		R6Tmd: JvZjz:
		goto tX1Bw;
		slbhf: global $_GPC, $_W;
		goto a45Em;
		scDS7:
		$orderparam = $this->c["order"];
		goto u6ulE;
		xg67k:
		return $this->result(1, "\xe5\x90\x8e\xe5\217\260\xe5\x8f\x82\346\x95\260\xe8\256\xbe\xe7\275\xae\346\262\xa1\350\xae\276\xe7\275\256");
		goto FtpZu;
		WaG1P:
		$J10B5 = !is_error($login_success);
		goto Ia33U;
		wCRx6:
		pdo_insert("amouse_shopping\63_order", $data);
		goto kJMv8;
		PerVi:
		$send["first"] = array("value" => "\xe5\260\x8a\xe6\225\254\347\x9a\204\xe4\274\232\345\221\230\xef\274\x8c\346\202\250\xe7\x9a\x84\xe8\xae\xa2\345\x8d\x95\xe6\217\220\xe4\272\244\346\x88\220\xe5\212\x9f\xef\274\x8c\xe8\xaf\xb7\345\xb0\275\345\277\xab\xe4\xbb\230\346\xac\xbe\343\x80\202", "color" => "\x23\60\x30\60");
		goto iKGNh;
		w04HY:
		$fans = pdo_fetch("SELECT * FROM " . tablename("amouse_shopping\63_fans") . " WHERE `welevel_first_id`= :weid and `from_user`=:openid ", array(":weid" => $this->w["uniacid"], ":openid" => $from));
		goto ko3bz;
		gCsXU: veaQB:
		goto A6KHy;
		kJMv8:
		$orderid = pdo_insertid();
		goto Gnfj8;
		XIoId: jlrjn:
		goto jsSZb;
		CYjHL: rdPOZ:
		goto xAEE3;
		xhA17:
		if ($UGB26) {
			goto jlrjn;
		}
		goto AxtTG;
		u6ulE:
		$YuFat = !empty($orderparam);
		goto PdbmR;
		b7HoP:
		$gdetail = '';
		goto cTrfp;
		j8E7y:
		$goodsid = pdo_fetchall("SELECT goodsid, total FROM " . tablename("amouse_shopping\63_order_goods") . " WHERE orderid = \x27{$orderid}\x27", array(), "goodsid");
		goto VdXJW;
		yKCzt:
		$t_WIv = !($set == false);
		goto F6QD5;
		pDHAP: rZmje:
		goto PerVi;
		arqwQ:
		$orderparam = str_replace("\42\42dishes_id\42\x22", "\x22dishes_id\x22", $orderparam);
		goto bGvVJ;
		jsSZb:
		$prepay_id = str_replace("prepay_id=", '', $pay_params["package"]);
		goto VZmQb;
		LRkOr:
		$fdata = array("phone" => $this->c["tel"], "from_user" => $from, "username" => trim($this->c["username"]));
		goto w04HY;
		XkHyT:
		$QD302 = !(!empty($set["print_bottom"]) && !empty($from));
		goto NgACh;
		Hc1VC:
		goto eR7k8;
		goto FwrLk;
		tryQr:
		$couponId = intval($this->c["couponId"]);
		goto ovhXc;
		oh65O: ClmU1:
		goto Bxsl5;
		FwrLk: DZ6nG:
		goto VlFeL;
		Y0qDa:
		$pay_params = $this->pay($payparam);
		goto x00_w;
		iKGNh:
		$send["keyword1"] = array("value" => empty($data["ordersn"]) ? $order["ordersn"] : $data["ordersn"], "color" => "\x23\60\x30\60");
		goto F3aF4;
		LtR5w:
		$totalprice = $order["totalprice"];
		goto Dl7VI;
		CFvZr:
		$fans = pdo_fetch("SELECT * FROM " . tablename("amouse_shopping\63_fans") . " WHERE `weid`= :weid and `from_user`=:openid ", array(":weid" => $this->w["uniacid"], ":openid" => $from));
		goto gZmVx;
		cTrfp:
		foreach ($goods as $g) {
			$gdetail .= $g["title"];
			eaDWE:
		}
		goto pDHAP;
		AxtTG:
		return $this->result(1, "\350\xaf\245\xe5\225\206\xe6\x88\xb7\346\x94\xaf\xe4\273\230\xe5\x87\272\xe9\227\256\xe9\xa2\230\344\xba\206", $pay_params);
		goto XIoId;
		A6KHy:
		$payparam = array("tid" => intval($orderid), "user" => $from, "fee" => $totalprice, "title" => "\345\xb0\x8f\347\250\x8b\xe5\xba\x8f\xe7\202\271\351\244\x90\346\x94\257\344\273\x98");
		goto Y0qDa;
		frOKt:
		$send["keyword\x33"] = array("value" => $gdetail, "color" => "\43\x30\x30\x30");
		goto ShcGr;
		ko3bz:
		if (empty($fans)) {
			goto LI_Nq;
		}
		goto zIs6H;
		tX1Bw:
		$orderparam = str_replace("\x26quot\x3b", "\x22\x22", $orderparam);
		goto arqwQ;
		ae4u5:
		$this->sendTplNotice($from, $set["print_bottom"], "amouse_waimai/pages/order_list/index\77level_first_id=" . $orderid, trim($this->c["formid"]), $send, "keyword1.D\101T\101");
		goto rgZWB;
		BCclq:
		$this->sendTplNotice($from, $set["print_bottom"], "amouse_orders/pages/user/user", trim($this->c["formid"]), $send, "keyword1.DATA");
		goto Hc1VC;
		FtpZu: EJ5jW:
		goto LRkOr;
		HefAf:
	}

	public function payResult($params)
	{
		goto rNs3k;
		jOsj3: PO3Xf:
		goto bCi5h;
		r19i2:
		if ($params["type"] == "credit") {
			goto vAjXx;
		}
		goto JqedO;
		IPg99: MhVH4:
		goto V7aZP;
		N3dRC:
		$MfJnN = empty($set["print_top"]);
		goto KIiyG;
		FHxiu: VcIaG:
		goto nIDqQ;
		HzgvE:
		$data["keyword\x35"] = array("value" => $gdetail, "color" => "\43\x30\x30\x30");
		goto a5R6q;
		o2rwb:
		if ($yn0Bf) {
			goto tZLXd;
		}
		goto L0Vd1;
		j18DP:
		if ($r5OcA) {
			goto MhVH4;
		}
		goto bsBzw;
		Lbaax:
		$data["keyword\63"] = array("value" => $order["ordersn"], "color" => "\43\x30\x30\x30");
		goto l0DbJ;
		BijI7:
		$order = pdo_fetch("SELECT * FROM " . tablename("amouse_shopping\x33_order") . " WHERE id = :level_first_id \101ND `weid` = :welevel_first_id ", array(":id" => $params["tid"], ":welevel_first_id" => intval($this->w["uniacid"])));
		goto r19i2;
		ycbIw:
		$gdetail = '';
		goto rb9Je;
		KIiyG:
		if ($MfJnN) {
			goto TtvZo;
		}
		goto oG243;
		uWM0S:
		goto iBiMA;
		goto jOsj3;
		Z2azu: woLy7:
		goto IfI69;
		EMD7J:
		pdo_update("amouse_shopping\63_order", $data, array("level_first_id" => $params["tlevel_first_id"]));
		goto t05zH;
		EMjJh: EWtPb:
		goto SKQDu;
		IfI69:
		$paytype = 3;
		goto ix0VC;
		SVZWC:
		$update["status"] = 1;
		goto Y_lVr;
		L0Vd1:
		$data["ispay"] = 1;
		goto EMD7J;
		QLMOL: oiXEo:
		goto reUDq;
		reUDq:
		if ($paytype == 3) {
			goto PO3Xf;
		}
		goto pqI5k;
		Y16k9:
		$data["translevel_first_id"] = $params["tag"]["transaction_id"];
		goto uliq7;
		jmUlf: iBiMA:
		goto FHxiu;
		v4wEe:
		$data["keyword2"] = array("value" => date("Y\xe5\xb9\xb4m\xe6\x9c\210d\xe6\227\xa5", $order["createtime"]), "color" => "\43\x30\60\x30");
		goto Lbaax;
		CXArb:
		load()->func("logging");
		goto BijI7;
		Y_lVr:
		pdo_update("amouse_coupon_record", $update, array("welevel_first_id" => intval($this->w["uniacid"]), "openid" => $order["from_user"], "coupon_id" => intval($order["couponlevel_first_id"])));
		goto e6P_I;
		JT1c6: tZLXd:
		goto IPg99;
		Or_KL:
		$paytype = 21;
		goto SbMqj;
		dFbI4:
		if ($EsQWa) {
			goto ub82L;
		}
		goto Y16k9;
		HviNn: SxTNS:
		goto qO9Rd;
		e1ube:
		$data["keyword1"] = array("value" => $order["ordersn"], "color" => "\43\x30\x30\60");
		goto v4wEe;
		HhwQA:
		goto q6HRw;
		goto Z2azu;
		bCi5h:
		message("\346\x8f\220\344\272\xa4\346\210\x90\345\x8a\237\xef\xbc\x81", "../../app/" . $this->createMobileUrl("us", array("order" => $order["level_first_id"])), "success");
		goto jmUlf;
		cikI5: vAjXx:
		goto ykeSv;
		JqedO:
		if ($params["type"] == "wechat") {
			goto JI7Wf;
		}
		goto ZxtKD;
		qO9Rd:
		$paytype = 22;
		goto HhwQA;
		D4wOy: QwUpL:
		goto ew5MI;
		l0DbJ:
		$data["keyword\x34"] = array("value" => $order["totalprice"] . "\xe5\x85\x83", "color" => "\43\x30\60\x30");
		goto HzgvE;
		uKZAI:
		$AZuzX = !($params["result"] == "success");
		goto PCadM;
		hxwOu:
		if ($params["type"] == "delivery") {
			goto woLy7;
		}
		goto Xhthq;
		MDI6N:
		goto q6HRw;
		goto o9Xly;
		X3z07:
		$r5OcA = !($params["result"] == "success" && $params["from"] == "notify");
		goto j18DP;
		ew5MI: TtvZo:
		goto JT1c6;
		ZxtKD:
		if ($params["type"] == "alipay") {
			goto SxTNS;
		}
		goto hxwOu;
		oG243:
		$goodsid = pdo_fetchall("SELECT goodslevel_first_id, total,description FROM " . tablename("amouse_shopping\x33_order_goods") . " WHERE orderlevel_first_id = \x27{$order["id"]}'", array(), "goodsid");
		goto IjOOj;
		bsBzw:
		$yn0Bf = !($params["fee"] == $order["totalprice"]);
		goto o2rwb;
		d_WQF:
		$data["first"] = array("value" => "\xe5\xb0\x8a\346\x95\xac\xe7\232\204\xe4\xbc\232\xe5\x91\x98\xef\274\x8c\346\202\xa8\345\267\262\346\x88\220\345\212\x9f\xe4\xbb\x98\xe6\xac\276\343\200\x82", "color" => "\x23\x30\60\60");
		goto e1ube;
		uliq7: ub82L:
		goto X3z07;
		rNs3k: global $_W;
		goto CXArb;
		Xhthq:
		goto q6HRw;
		goto cikI5;
		TiU5M:
		$data = array("status" => $params["result"] == "success" ? 1 : 0);
		goto eQ7oj;
		IjOOj:
		$goods = pdo_fetchall("SELECT * FROM " . tablename("amouse_shopping\x33_goods") . "  WHERE id IN (\x27" . implode("\x27,'", array_keys($goodsid)) . "\x27)");
		goto ycbIw;
		duFWC:
		if ($i1Fhr) {
			goto YgCa1;
		}
		goto SVZWC;
		RHRUm:
		if ($V9vJo) {
			goto VcIaG;
		}
		goto uKZAI;
		YRQ_z:
		$data["paytype"] = $paytype[$params["type"]];
		goto I7MgP;
		QBdqi:
		$i1Fhr = !($order["couponlevel_first_id"] > 0);
		goto duFWC;
		PCadM:
		if ($AZuzX) {
			goto oiXEo;
		}
		goto QLMOL;
		a5R6q:
		$data["keyword\66"] = array("value" => "\345\xbe\256\xe4\xbf\241\xe6\x94\xaf\344\xbb\x98", "color" => "\x23\x30\x30\x30");
		goto WlT0D;
		o9Xly: JI7Wf:
		goto Or_KL;
		ix0VC: q6HRw:
		goto TiU5M;
		eQ7oj:
		$paytype = array("credit" => "1", "wechat" => "\x32", "alipay" => "2", "delivery" => "\63");
		goto YRQ_z;
		V7aZP:
		$V9vJo = !($params["from"] == "return");
		goto RHRUm;
		I7MgP:
		$EsQWa = !($params["type"] == "wechat");
		goto dFbI4;
		rb9Je:
		foreach ($goods as $g) {
			$gdetail .= $g["title"];
			ldQiH:
		}
		goto EMjJh;
		t05zH:
		$set = pdo_fetch("SELECT print_top FROM " . tablename("amouse_shopping\63_set") . " WHERE welevel_first_id = :weid limit 1 ", array(":welevel_first_id" => $this->w["uniacid"]));
		goto QBdqi;
		SbMqj:
		goto q6HRw;
		goto HviNn;
		WlT0D:
		$this->sendTplNotice($order["from_user"], $set["print_top"], "amouse_orders/pages/mine/mine", $order["prepay_id"], $data, "keyword1.D\101T\101");
		goto D4wOy;
		e6P_I: YgCa1:
		goto N3dRC;
		vCjKY:
		if ($t6LDj) {
			goto QwUpL;
		}
		goto d_WQF;
		pqI5k:
		message("\346\x94\257\xe4\xbb\x98\346\210\220\xe5\x8a\x9f\xef\xbc\x81", "../../app/" . $this->createMobileUrl("detail", array("id" => $order["level_first_id"])), "success");
		goto uWM0S;
		SKQDu:
		$t6LDj = empty($order["from_user"]);
		goto vCjKY;
		ykeSv:
		$paytype = 1;
		goto MDI6N;
		nIDqQ:
	}

	protected function sendTplNotice($touser, $template_id, $page = '', $form_id, $postdata, $emphasis_keyword = NULL)
	{
		goto p4_og;
		exOa4: yKyCl:
		goto RbaRd;
		BZK9F:
		$result = @json_decode($response["content"], true);
		goto EUhnP;
		Avc10:
		if ($L1BQi) {
			goto NlERm;
		}
		goto Jn8Mg;
		jL6Ju:
		return error(-1, "\346\216\245\xe5\217\243\350\260\203\347\224\xa8\345\244\261\xe8\xb4\xa5, \xe5\x85\x83\xe6\225\xb0\346\x8d\256: {$response["meta"]}");
		goto BjeFg;
		V_e06:
		if ($smKlM) {
			goto C1C5i;
		}
		goto g1LGa;
		jYTBQ:
		$data = json_encode($data);
		goto nVExD;
		EDAt3: ivcck:
		goto jL6Ju;
		EUhnP:
		if (empty($result)) {
			goto ivcck;
		}
		goto CAiAx;
		DWLrj: T6xsN:
		goto p00m4;
		RbaRd:
		$QwfCf = !empty($template_id);
		goto vwo8J;
		g1LGa:
		$send["emphasis_keyword"] = $emphasis_keyword;
		goto oUD1T;
		XTWUt:
		$account_api = WeAccount::create();
		goto H4aGB;
		NMBNq:
		$data["template_id"] = trim($template_id);
		goto YkGby;
		zpEal:
		$Y7u5g = !empty($touser);
		goto JbLz0;
		C9ZLO:
		if ($sPXO4) {
			goto scJWt;
		}
		goto ISnaZ;
		ISnaZ:
		return $accesstoken;
		goto Av8bG;
		Nk78x:
		return error(-1, "\350\xae\277\351\x97\xae\xe5\205\xac\xe4\xbc\x97\xe5\xb9\xb3\xe5\217\xb0\346\x8e\245\345\x8f\243\345\244\xb1\xe8\xb4\xa5, \xe9\x94\x99\xe8\xaf\257: {$response["message"]}");
		goto tQUxX;
		p00m4:
		$L1BQi = !(empty($postdata) || !is_array($postdata));
		goto Avc10;
		BjeFg:
		goto mGPux;
		goto H0I_z;
		Z84fc:
		return error(-1, "\350\256\xbf\351\227\256\345\276\xae\xe4\277\xa1\xe6\216\xa5\345\x8f\xa3\xe9\224\x99\350\xaf\xaf, \xe9\224\231\xe8\xaf\257\xe4\273\243\xe7\xa0\x81: {$result["errcode"]}, \xe9\x94\x99\350\257\xaf\xe4\xbf\241\346\201\257: {$result["errmsg"]},\xe4\277\241\346\x81\257\350\xaf\xa6\xe6\x83\205\357\274\x9a{$this->error_code($result["errcode"])}");
		goto OhNGA;
		Lv_H3:
		$response = ihttp_request($templateUrl, $data);
		goto P_Po3;
		OhNGA: mGPux:
		goto UAT1d;
		KwyJl:
		goto mGPux;
		goto EDAt3;
		UAT1d:
		return true;
		goto nA6QP;
		oUD1T: C1C5i:
		goto olD8f;
		sqcQH:
		load()->func("communication");
		goto XTWUt;
		K2Jg9:
		return error(-1, "\345\x8f\202\xe6\x95\260\351\224\x99\xe8\257\257,\xe6\xa8\xa1\xe6\235\xbf\xe6\xa0\x87\347\xa4\272\344\270\x8d\xe8\x83\275\xe4\xb8\272\xe7\251\xba");
		goto DWLrj;
		GKXom:
		$sPXO4 = !is_error($accesstoken);
		goto C9ZLO;
		QXBRE:
		return error(-1, "\xe5\x8f\x82\346\x95\260\xe9\224\x99\350\257\xaf,\xe7\xb2\211\xe4\270\235openid\xe4\xb8\215\xe8\x83\xbd\xe4\xb8\xba\xe7\xa9\xba");
		goto exOa4;
		G2NRL:
		$data["form_id"] = trim($form_id);
		goto xmzfi;
		Av8bG: scJWt:
		goto zpEal;
		H0I_z: qB7cX:
		goto Z84fc;
		H4aGB:
		$accesstoken = $account_api->getAccessToken();
		goto GKXom;
		fTVr1:
		$data = array();
		goto mMYkw;
		YkGby:
		$data["page"] = trim($page);
		goto G2NRL;
		olD8f:
		$data["data"] = $postdata;
		goto jYTBQ;
		nVExD:
		$templateUrl = "https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send\77access_token={$accesstoken}";
		goto Lv_H3;
		hYKZ5: NlERm:
		goto fTVr1;
		CAiAx:
		if (!empty($result["errcode"])) {
			goto qB7cX;
		}
		goto KwyJl;
		Jn8Mg:
		return error(-1, "\345\x8f\x82\xe6\225\xb0\351\x94\231\xe8\xaf\257,\350\xaf\267\xe6\240\xb9\xe6\215\256\346\250\xa1\xe6\235\xbf\350\247\204\xe5\210\231\345\xae\214\345\226\x84\346\266\210\xe6\201\257\xe5\206\205\xe5\xae\xb9");
		goto hYKZ5;
		JbLz0:
		if ($Y7u5g) {
			goto yKyCl;
		}
		goto QXBRE;
		P_Po3:
		$UTilV = !is_error($response);
		goto jRjq6;
		tQUxX: Lc_p7:
		goto BZK9F;
		vwo8J:
		if ($QwfCf) {
			goto T6xsN;
		}
		goto K2Jg9;
		p4_og:
		load()->model("mc");
		goto sqcQH;
		mMYkw:
		$data["touser"] = $touser;
		goto NMBNq;
		jRjq6:
		if ($UTilV) {
			goto Lc_p7;
		}
		goto Nk78x;
		xmzfi:
		$smKlM = !$emphasis_keyword;
		goto V_e06;
		nA6QP:
	}

	public function doPageWxUpload()
	{
		//文件上传函数

		$upload = K::M('magic/upload');
		return $this->result(0, '', "images/" . $filename);
		return $this->result(1, "\346\x9c\x8d\xe5\212\xa1\xe5\x99\xa8\345\207\xba\351\x97\256\xe9\xa2\230\344\xba\x86", '');
	}

	private function makeActivityCode($scene, $id)
	{
		goto tdCWd;
		dg_rp:
		$account_api = WeAccount::create();
		goto Cabyq;
		tdCWd:
		$sceneid = $scene . $id;
		goto dg_rp;
		Cabyq:
		$code = $account_api->getCodeUnlimit($sceneid);
		goto j__XL;
		Im1i0:
		return $code;
		goto hz2Kf;
		RS8Tq:
		return $path;
		goto pZYDR;
		j__XL:
		$hZZ1u = !is_error($code);
		goto m1LwY;
		hz2Kf: MzF1R:
		goto j0HID;
		m1LwY:
		if ($hZZ1u) {
			goto MzF1R;
		}
		goto Im1i0;
		j0HID:
		$path = $this->fileSave($code, "jpg");
		goto RS8Tq;
		pZYDR:
	}

	public function doPageApiCreateImage()
	{
		goto YBwK9;
		zLpLj:
		goto KT6Qw;
		goto TdPN8;
		f0TSl:
		$card = pdo_fetch("SELECT * FROM " . tablename("amouse_wxapp_card") . " WHERE `uniacid`=:weid and `openlevel_first_id`=:openid limit 1", array(":weid" => $uniacid, ":openid" => $openid));
		goto zpq7l;
		N6n3c:
		ignore_user_abort(true);
		goto EFRIt;
		EW2de:
		goto iWmDG;
		goto NH30l;
		oE_Y6:
		$poster["from_user"] = $card["openlevel_first_id"];
		goto Z2LzK;
		h9Gzx:
		$openid = $this->w["openid"];
		goto f0TSl;
		YBwK9: global $_W, $_GPC;
		goto k1ZLv;
		U5BQT:
		$poster["cardid"] = $card["id"];
		goto PR6DP;
		MKSGt: KT6Qw:
		goto PjkY5;
		rQmZZ:
		$uniacid = $this->w["uniacid"];
		goto h9Gzx;
		EFRIt:
		require_once IA_ROOT . "/addons/amouse_wxapp_card/inc/common.php";
		goto rQmZZ;
		dt1tz:
		pdo_update("amouse_wxapp_card", array("qrcode" => $ret["qr_img"]), array("id" => $card["id"]));
		goto l0a4T;
		JXK57:
		$qrcode = $this->makeActivityCode("amouse_wxapp_card:poster:", $card["level_first_id"]);
		goto QcuuU;
		PjkY5:
		return $this->result(0, '', $qrcode);
		goto Ifls4;
		k1ZLv:
		load()->func("file");
		goto N6n3c;
		uBYlr:
		if (empty($card["qrcode"])) {
			goto zaT43;
		}
		goto sxzuf;
		QcuuU:
		WeUtility::logging("==qrcode==" . $qrcode);
		goto sroIE;
		TdPN8: zaT43:
		goto JXK57;
		lVCsM:
		$poster["avatar"] = tomedia($card["avater"]);
		goto uBYlr;
		PR6DP:
		$poster["uniacid"] = $uniacid;
		goto oE_Y6;
		Z2LzK:
		$poster["nickname"] = $card["username"];
		goto lVCsM;
		NH30l: fudl9:
		goto s1mf7;
		sxzuf:
		$qrcode = tomedia($card["qrcode"]);
		goto zLpLj;
		qFWxO:
		return $this->result(1, "\345\210\233\345\xbb\272\344\272\x8c\xe7\xbb\264\xe7\xa0\x81\xe5\207\xba\351\224\231\344\272\206", $ret["qr_img"]);
		goto EW2de;
		l0a4T: iWmDG:
		goto MKSGt;
		dqDqN:
		if ($ret["code"] == 1) {
			goto fudl9;
		}
		goto qFWxO;
		zpq7l:
		$poster = pdo_fetch("SELECT * from " . tablename("wxapp_card_poster") . "  where `uniacid`=:weid limit 1 ", array(":weid" => $uniacid));
		goto U5BQT;
		sroIE:
		$ret = createCodeUnlimit($poster, $qrcode);
		goto dqDqN;
		s1mf7:
		$qrcode = $ret["qr_img"];
		goto dt1tz;
		Ifls4:
	}

	public function result($errno, $message, $data = '') {
		exit(json_encode(array(
			'errno' => $errno,
			'message' => $message,
			'data' => $data,
		)));
	}

	public function __call($name, $arguments) {
		$dir = IA_ROOT . '/addons/' . $this->modulename . '/inc/wxapp';
		$function_name = strtolower(substr($name, 6));
		$file = "$dir/{$this->version}/{$function_name}.inc.php";
		if (!file_exists($file)) {
			$version_path_tree = glob("$dir/*");
			usort($version_path_tree, function($version1, $version2) {
				return -version_compare($version1, $version2);
			});
			if (!empty($version_path_tree)) {
				foreach ($version_path_tree as $path) {
					$file = "$path/{$function_name}.inc.php";
					if (file_exists($file)) {
						break;
					}
				}
			}
		}
		if(file_exists($file)) {
			require $file;
			exit;
		}
		return null;
	}



	protected function pay($order) {
		global $_W, $_GPC;

		load()->model('payment');
		load()->model('account');

		$moduels = uni_modules();
		if(empty($order) || !array_key_exists($this->module['name'], $moduels)) {
			return error(1, '模块不存在');
		}
		$moduleid = empty($this->module['mid']) ? '000000' : sprintf("%06d", $this->module['mid']);
		$uniontid = date('YmdHis').$moduleid.random(8,1);
		$wxapp_uniacid = intval($this->w['account']['uniacid']);

		$paylog = pdo_get('core_paylog', array('uniacid' => $this->w['uniacid'], 'module' => $this->module['name'], 'tid' => $order['tid']));
		if (empty($paylog)) {
			$paylog = array(
				'uniacid' => $this->w['uniacid'],
				'acid' => $this->w['acid'],
				'openid' => $this->w['openid'],
				'module' => $this->module['name'],
				'tid' => $order['tid'],
				'uniontid' => $uniontid,
				'fee' => floatval($order['fee']),
				'card_fee' => floatval($order['fee']),
				'status' => '0',
				'is_usecard' => '0',
				'tag' => iserializer(array('acid' => $this->w['acid'], 'uid' => $this->w['member']['uid']))
			);
			pdo_insert('core_paylog', $paylog);
			$paylog['plid'] = pdo_insertid();
		}
		if(!empty($paylog) && $paylog['status'] != '0') {
			return error(1, '这个订单已经支付成功, 不需要重复支付.');
		}
		if (!empty($paylog) && empty($paylog['uniontid'])) {
			pdo_update('core_paylog', array(
				'uniontid' => $uniontid,
			), array('plid' => $paylog['plid']));
			$paylog['uniontid'] = $uniontid;
		}

		$this->w['openid'] = $paylog['openid'];

		$params = array(
			'tid' => $paylog['tid'],
			'fee' => $paylog['card_fee'],
			'user' => $paylog['openid'],
			'uniontid' => $paylog['uniontid'],
			'title' => $order['title'],
		);
		$setting = uni_setting($wxapp_uniacid, array('payment'));
		$wechat_payment = array(
			'appid' => $this->w['account']['key'],
			'signkey' => $setting['payment']['wechat']['signkey'],
			'mchid' => $setting['payment']['wechat']['mchid'],
			'version' => 2,
		);
		return wechat_build($params, $wechat_payment);
	}

	private $module;

	public $modulename;

	public $weid;

	public $uniacid;

	public $__define;


	public function saveSettings($settings) {
		global $_W;
		$pars = array('module' => $this->modulename, 'uniacid' => $this->w['uniacid']);
		$row = array();
		$row['settings'] = iserializer($settings);
		cache_build_module_info($this->modulename);
		if (pdo_fetchcolumn("SELECT module FROM ".tablename('uni_account_modules')." WHERE module = :module AND uniacid = :uniacid", array(':module' => $this->modulename, ':uniacid' => $this->w['uniacid']))) {
			return pdo_update('uni_account_modules', $row, $pars) !== false;
		} else {
			return pdo_insert('uni_account_modules', array('settings' => iserializer($settings), 'module' => $this->modulename ,'uniacid' => $this->w['uniacid'], 'enabled' => 1)) !== false;
		}
	}


	protected function createMobileUrl($do, $query = array(), $noredirect = true) {
		global $_W;
		$query['do'] = $do;
		$query['m'] = strtolower($this->modulename);
		return murl('entry', $query, $noredirect);
	}


	protected function createWebUrl($do, $query = array()) {
		$query['do'] = $do;
		$query['m'] = strtolower($this->modulename);
		return wurl('site/entry', $query);
	}


	protected function template($filename) {
		global $_W;
		$name = strtolower($this->modulename);
		$defineDir = dirname($this->__define);
		if(defined('IN_SYS')) {
			$source = IA_ROOT . "/web/themes/{$this->w['template']}/{$name}/{$filename}.html";
			$compile = IA_ROOT . "/data/tpl/web/{$this->w['template']}/{$name}/{$filename}.tpl.php";
			if(!is_file($source)) {
				$source = IA_ROOT . "/web/themes/default/{$name}/{$filename}.html";
			}
			if(!is_file($source)) {
				$source = $defineDir . "/template/{$filename}.html";
			}
			if(!is_file($source)) {
				$source = IA_ROOT . "/web/themes/{$this->w['template']}/{$filename}.html";
			}
			if(!is_file($source)) {
				$source = IA_ROOT . "/web/themes/default/{$filename}.html";
			}
		} else {
			$source = IA_ROOT . "/app/themes/{$this->w['template']}/{$name}/{$filename}.html";
			$compile = IA_ROOT . "/data/tpl/app/{$this->w['template']}/{$name}/{$filename}.tpl.php";
			if(!is_file($source)) {
				$source = IA_ROOT . "/app/themes/default/{$name}/{$filename}.html";
			}
			if(!is_file($source)) {
				$source = $defineDir . "/template/mobile/{$filename}.html";
			}
			if(!is_file($source)) {
				$source = IA_ROOT . "/app/themes/{$this->w['template']}/{$filename}.html";
			}
			if(!is_file($source)) {
				if (in_array($filename, array('header', 'footer', 'slide', 'toolbar', 'message'))) {
					$source = IA_ROOT . "/app/themes/default/common/{$filename}.html";
				} else {
					$source = IA_ROOT . "/app/themes/default/{$filename}.html";
				}
			}
		}

		if(!is_file($source)) {
			exit("Error: template source '{$filename}' is not exist!");
		}
		$paths = pathinfo($compile);
		$compile = str_replace($paths['filename'], $this->w['uniacid'] . '_' . $paths['filename'], $compile);
		if (DEVELOPMENT || !is_file($compile) || filemtime($source) > filemtime($compile)) {
			template_compile($source, $compile, true);
		}
		return $compile;
	}


	protected function fileSave($file_string, $type = 'jpg', $name = 'auto') {
		global $_W;
		load()->func('file');

		$allow_ext = array(
			'images' => array('gif', 'jpg', 'jpeg', 'bmp', 'png', 'ico'),
			'audios' => array('mp3', 'wma', 'wav', 'amr'),
			'videos' => array('wmv', 'avi', 'mpg', 'mpeg', 'mp4'),
		);
		if (in_array($type, $allow_ext['images'])) {
			$type_path = 'images';
		} elseif (in_array($type, $allow_ext['audios'])) {
			$type_path = 'audios';
		} elseif (in_array($type, $allow_ext['videos'])) {
			$type_path = 'videos';
		}

		if (empty($type_path)) {
			return error(1, '禁止保存文件类型');
		}

		if (empty($name) || $name == 'auto') {
			$uniacid = intval($this->w['uniacid']);
			$path = "{$type_path}/{$uniacid}/{$this->module['name']}/" . date('Y/m/');
			mkdirs(ATTACHMENT_ROOT . '/' . $path);

			$filename = file_random_name(ATTACHMENT_ROOT . '/' . $path, $type);
		} else {
			$path = "{$type_path}/{$uniacid}/{$this->module['name']}/";
			mkdirs(dirname(ATTACHMENT_ROOT . '/' . $path));

			$filename = $name;
			if (!strexists($filename, $type)) {
				$filename .= '.' . $type;
			}
		}
		if (file_put_contents(ATTACHMENT_ROOT . $path . $filename, $file_string)) {
			file_remote_upload($path);
			return $path . $filename;
		} else {
			return false;
		}
	}

	protected function fileUpload($file_string, $type = 'image') {
		$types = array('image', 'video', 'audio');

	}
}



