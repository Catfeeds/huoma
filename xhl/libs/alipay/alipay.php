<?php
/**
 * Copy Right jisunet.com
 * 人要活得优雅,代码更需要优雅
 * $Id: alipay.php 3053 2015-01-15 02:00:13  xinghuali
 */

class Payment_Alipay extends Payment 
{

    //支付宝网关地址（新）
    private $gateway = 'https://mapi.alipay.com/gateway.do?';

    //消息验证地址
    private $https_verify_url = 'https://mapi.alipay.com/gateway.do?service=notify_verify&';
    
    private $http_verify_url = 'http://notify.alipay.com/trade/notify_query.do?';

    private $cacert_url = dirname(__FILE__).DIRECTORY_SEPARATOR.'cacert.pem';

    //支付接口标识
    private $code      = 'alipay';

    private $sign_type = 'MD5';
    //支付接口配置信息
    private $config = array();
    //订单信息
    private $order = array();
    //发送至支付宝的参数
    private $parameter = array();   
    
    public function __construct($cfg)
    {
        $this->config['_input_charset'] = 'utf-8';
        $this->config = $cfg;
        $this->_parameter = array();
        $this->_parameter['service'] = 'create_direct_pay_by_user';
        $this->_parameter['payment_type'] = 1;
        $this->_parameter['partner'] = $this->config['partner'];
        $this->_parameter['seller_email'] = $this->config['saller_email'];
        $this->_parameter['return_url'] = $this->config['return_url'];
        $this->_parameter['notify_url'] = $this->config['notify_url'];        
    }

    public function build_url($params)
    {
        $parameter = $this->build_parameter($params);
        $url = $this->gateway ."_input_charset=".$this->config['_input_charset']."&". $this->build_query($parameter);
        return $url;
    }

    public function build_form($params)
    {      
        //待请求参数数组
        $parameter = $this->build_parameter($params);        
        $html = "<form id='alipaysubmit' name='alipaysubmit' action='".$this->gateway."_input_charset=".trim(strtolower($this->config['_input_charset']))."' method='".$method."'>";
        while (list ($key, $val) = each ($parameter)) {
            $html.= "<input type='hidden' name='".$key."' value='".$val."'/>";
        }
        //submit按钮控件请不要含有name属性
        $html .= "<input type='submit' value='立即支付'></form>";        
        $html .= "<script>document.forms['alipaysubmit'].submit();</script>";        
        return $html;
    }

    public function return_verify()
    {

    }

    public function notify_verify()
    {

    }


    public function http($url, $params=array(), $mothed='POST')
    {
        $ci = curl_init();
        curl_setopt($ci, CURLOPT_HEADER, 0 ); // 过滤HTTP头
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);// 显示输出结果          
        curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, true);//SSL证书认证
        curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, 2);//严格认证
        curl_setopt($ci, CURLOPT_CAINFO,$this->cacert_url);//证书地址
        if(strtoupper($mothed) == 'POST'){// post传输数据
            curl_setopt($ci, CURLOPT_POST, true); 
            if (!empty($params)) {
                curl_setopt($ci, CURLOPT_POSTFIELDS, $params);
            }            
        }else if(!empty($params)){ // get传输数据
            $url .= $this->build_query($params);
        }
        curl_setopt($ci, CURLOPT_URL, $url );
        curl_setopt($ci, CURLINFO_HEADER_OUT, TRUE);
        $res = curl_exec($ci);
        curl_close($ci);
        return $res;
    }

    /**
     * 生成要请求给支付宝的参数数组
     * @param $params 请求前的参数数组
     * @return 要请求的参数数组
     */
    public function build_parameter($params)
    {
        $parameter = $this->_parameter;
        $parameter['out_trade_no'] = $params['order_no'];
        $parameter['subject'] = $params['title'];
        $parameter['body'] = $params['body'];
        $parameter['total_fee'] = $params['amount'];
        if($params['show_url']){
            $parameter['show_url'] = $params['show_url'];
        }
        if($params['extra_param']){
            $parameter['extra_common_param'] = $this->_encode_params($params['extra_param']);
        }
        $parameter = $this->_filter_params($params);
        $parameter = $this->_sort_params($params);
        $sign = $this->_create_sign($params);
        $parameter['sign'] = $sign;
        $parameter['sign_type'] = strtoupper(trim($this->_sign_type));        
        return $parameter;
    }

    protected function build_query($params, $urlencode=true)
    {
        $query_string = "";
        while (list ($key, $val) = each ($params)) {
            if($urlencode){
                $query_string .= $key."=".urlencode($val)."&";
            }else{
                $query_string .= $key."=".$val."&";  
            }
        }
        $query_string = rtrim($query_string, '&');
        if(get_magic_quotes_gpc()){$query_string = stripslashes($query_string);}
        return $query_string;
    }

    private function _filter_params($params)
    {
        $para = array();
        while (list ($key, $val) = each ($params)) {
            if($key == "sign" || $key == "sign_type" || $val == "") continue;
            else $para[$key] = $parameter[$key];
        }
        $this->_return_data['TRADENO'] = $para['trade_no']; //交易号
        $this->_return_data['IDCARD'] = $para['buyer_id']; //买家帐号
        return $para;
    }


    //对数组排序 用作生成签名
    private function _sort_params($params)
    {
        ksort($params);
        reset($params);
        return $params;
    }

    /**
     *  生成签名结果
     *  $array  要签名的数组
     *  return  签名结果字符串
     */
    private function create_sign($array)
    {   
        $array  = $this->_sort_params($array);
        $prestr = $this->_array_to_string($array);  //把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串
        $prestr = $prestr.$this->config['key'];    //把拼接后的字符串再与安全校验码直接连接起来
        $mysgin = md5($prestr); //把最终的字符串签名，获得签名结果
        return $mysgin;
    }

    protected function _encode_params($param)
    {
        //$param = serialize($param);
        $hex = '';
        foreach((array)$param as $k=>$v){
            $_K = $_V = '';
            $k = strval($k);
            $v = strval($v);
            for($i=0; $i<strlen($k); $i++)  
                $_K .= dechex(ord($k[$i]));
            for($i=0; $i<strlen($v); $i++)  
                $_V .= dechex(ord($v[$i]));
            $hex .= strtoupper($_K).'O'.strtoupper($_V).'I';
        }
        return trim($hex,'I');  
    }

    protected function _decode_params($hex)
    {
        $param = ''; 
        foreach(explode('I',$hex) as $h){
            list($_K,$_V) = explode('O',$h);
            $k = $v = '';
            for($i=0; $i<strlen($_K)-1; $i+=2)
                $k .= chr(hexdec($_K[$i].$_K[$i+1]));
            for($i=0; $i<strlen($_V)-1; $i+=2)
                $v .= chr(hexdec($_V[$i].$_V[$i+1]));
            $param[$k] = $v;
        }
        return  $param;         
    }        
}