<?php
/**
 * Copy	Right jisunet.com
 * $Id json.mdl.php xinghuali<xinghuali@126.com>
 */

class Mdl_Helper_Json
{
	public function encode($data)
	{
		return json_encode($data);
	}

	public function decode($data)
	{
		return json_decode($data);
	}
}