<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * Author xinghuali<xinghuali@126.com>
 * $Id: modifier.amount.php 2335 2015-11-18 17:15:56  xinghuali
 */

function smarty_modifier_amount($amount, $precision=2, $prefix='￥')
{
	$precision = (int)$precision;
	return $prefix.round($amount, $precision);
}