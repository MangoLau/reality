<?php
/**
 * Created by PhpStorm.
 * User: mangolau
 * Date: 2/11/16
 * Time: 9:50 PM
 */

/**
 * 递归重组节点信息为多维数组
 * @param unknown $node  要处理的节点数组
 * @param number $pid	 父级id
 */
function node_merge($node, $access = NULL, $pid = 0) {
    if ( ! is_array($node)) return false;
    $arr = array();

    foreach ($node as $v) {
        if (is_array($access)) {
            $v['access'] = in_array($v['id'], $access) ? 1 : 0;
        }
        if ($v['pid'] == $pid) {
            $v['child'] = node_merge($node, $access, $v['id']);
            $arr[] =$v;
            unset($v);
        }
    }
    return $arr;
}

/**
 * 初始化多级栏目显示，防止递归产生值错误
 * 显示多级栏目层次表
 * @param array $array  栏目数组结构信息 array(栏目ID=>父栏目ID,)
 * @param string $pid   要搜索的父栏目ID 0为顶级栏目
 * @param string $pad   间隔字符
 * @param int $padnum   要间隔的字符数量
 * @return array()
 */
function indent_merge($array,$pid=0,$padnum=0,$pad='&nbsp;&nbsp;'){
    global $clist;
    $list = array();
    foreach ($array as $v){
        if ($v['pid'] == $pid) {
            $list[] = $v;
            unset($v);					//释放词数组键值对
        }
    }
    if (!empty($list)) {
        foreach ($list as $v){
            $v['pad'] = str_repeat($pad,$padnum);
            $clist[] = $v;
            indent_merge($array,$v['id'],$padnum+1,$pad);
        }
    }
    return $clist;
}

/**
 * 获取字符在字符串中第N次出现的位置
 * @param string $text 字符串
 * @param string $key 字符
 * @param int $int N
 * @return int
 */
function strpos_int($text, $key, $int)
{
    $keylen = strlen($key);
    global $textlen;
    if (!$textlen)
        $textlen = strlen($text);
    static $textpos = 0;
    $pos = strpos($text, $key);
    $int--;
    if ($pos)
    {
        if ($int == 0)
            $textpos+=$pos;
        else
            $textpos+=$pos + $keylen;
    }
    else
    {
        $int = 0;
        $textpos = $textlen;
    }
    if ($int > 0)
    {
        strpos_int(substr($text, $pos + $keylen), $key, $int);
    }
    return $textpos;
}

/**
 * 截取HTML
 * @param string $string  HTML 字符串
 * @param int $length 截取的长度
 * @param string $dot
 * @param string $append
 * @return string
 */
function cuthtml($string, $length, $dot = ' ...', $append = "")
{
    $str = strip_tags($string);//先过滤标签
    $new_str = iconv_substr($str, 0, $length, 'utf-8');
    $last = iconv_substr($new_str, -1, 1, 'utf-8');
    $sc = substr_count($new_str, $last);
    $position = strpos_int($string, $last, $sc); //获取截取真实的长度
    if (function_exists('tidy_parse_string'))//服务器开启tidy的话 直接用函数不全html代码即可
    {
        $options = array("show-body-only" => true);
        return tidy_parse_string(mb_substr($string, 0, $position) . $dot . $append, $options, 'UTF8');
    } else //没有开启tidy
    {
        if (strlen($string) <= $position)
        {
            return $string;
        }
        $pre = chr(1);
        $end = chr(1);
        $string = str_replace(array('&', '"', '<', '>'), array($pre . '&' . $end, $pre . '"' . $end, $pre . '<' . $end, $pre . '>' . $end), $string);
        $strcut = '';
        $n = $tn = $noc = 0;
        while ($n < strlen($string))
        {
            $t = ord($string[$n]);
            if ($t == 9 || $t == 10 || (32 <= $t && $t <= 126))
            {
                $tn = 1;
                $n++;
                $noc++;
            } elseif (194 <= $t && $t <= 223)
            {
                $tn = 2;
                $n += 2;
                $noc += 2;
            } elseif (224 <= $t && $t <= 239)
            {
                $tn = 3;
                $n += 3;
                $noc += 2;
            } elseif (240 <= $t && $t <= 247)
            {
                $tn = 4;
                $n += 4;
                $noc += 2;
            } elseif (248 <= $t && $t <= 251)
            {
                $tn = 5;
                $n += 5;
                $noc += 2;
            } elseif ($t == 252 || $t == 253)
            {
                $tn = 6;
                $n += 6;
                $noc += 2;
            } else
            {
                $n++;
            }
            if ($noc >= $position)
            {
                break;
            }
        }
        if ($noc > $position)
        {
            $n -= $tn;
        }
        $strcut = substr($string, 0, $n);
        $strcut = str_replace(array($pre . '&' . $end, $pre . '"' . $end, $pre . '<' . $end, $pre . '>' . $end), array('&', '"', '<', '>'), $strcut);
        $pos = strrpos($strcut, chr(1));
        if ($pos !== false)
        {
            $strcut = substr($strcut, 0, $pos);
        }
        return $strcut . $dot . $append;
    }
}

function cut_html ($html, $limit) {
    $dom = new DOMDocument();
    $dom->loadHTML(mb_convert_encoding("<div>{$html}</div>", "HTML-ENTITIES", "UTF-8"), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    cut_html_recursive($dom->documentElement, $limit);
    return substr($dom->saveHTML($dom->documentElement), 5, -6);
}

function cut_html_recursive ($element, $limit) {
    if($limit > 0) {
        if($element->nodeType == 3) {
            $limit -= strlen($element->nodeValue);
            if($limit < 0) {
                $element->nodeValue = substr($element->nodeValue, 0, strlen($element->nodeValue) + $limit);
            }
        }
        else {
            for($i = 0; $i < $element->childNodes->length; $i++) {
                if($limit > 0) {
                    $limit = cut_html_recursive($element->childNodes->item($i), $limit);
                }
                else {
                    $element->removeChild($element->childNodes->item($i));
                    $i--;
                }
            }
        }
    }
    return $limit;
}

/**
 * 截取字符串
 * @param $_string
 * @param $_num
 * @param $tail
 * @return string
 */
function cut_str($_string,$_num,$tail=''){
    if(mb_strlen($_string,'utf-8')>$_num){
        $_string=mb_substr($_string,0,$_num,'utf-8').$tail;
    }
    return $_string;
}

/**
 * 使用cURL发送POST请求
 * @param string $url 请求地址
 * @param array $post POST数据数组
 * @param array $options HTTP选项数组
 * @param string $error 用于返回错误信息
 * @param int $errno 用于返回错误码
 * @param string $httpCode 用于返回响应的HTTP状态码
 * @return mixed 成功返回请求返回结果，失败返回flase
 */
function curl_post($url, $post=array(), $options=array(), &$error=false, &$errno=false, &$httpCode=false) {
    $defaults = array(
        CURLOPT_POST            => 1,
        CURLOPT_HEADER          => 0,
        CURLOPT_URL             => $url,
        CURLOPT_FRESH_CONNECT   => 1,
        CURLOPT_RETURNTRANSFER  => 1,
        CURLOPT_FORBID_REUSE    => 1,
        CURLOPT_CONNECTTIMEOUT  => 30,
        CURLOPT_TIMEOUT         => 60,
        CURLOPT_POSTFIELDS      => $post,
    );
    $ch = curl_init();
    $result = '';
    if($ch) {
        foreach($options as $k=>$v) {
            $defaults[$k] = $v;
        }
        curl_setopt_array($ch, $defaults);
        $result = curl_exec($ch);
        if($result === false) {
            if($error !== false) {
                $error = curl_error($ch);
            }
            if($errno !== false) {
                $errno = curl_errno($ch);
            }
        }
        if($httpCode !== false) {
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        }
        curl_close($ch);
    }
    return $result;
}

/**
 * 使用cURL发送GET请求
 * @param string $url 请求地址
 * @param array $post GET数据数组
 * @param array $options HTTP选项数组
 * @param string $error 用于返回错误信息
 * @param int $errno 用于返回错误码
 * @param string $httpCode 用于返回响应的HTTP状态码
 * @return mixed 成功返回请求返回结果，失败返回flase
 */
function curl_get($url, $get=array(), $options=array(), &$error=false, &$errno=false, &$httpCode=false) {
    $defaults = array(
        CURLOPT_URL             => $url. (strpos($url, '?') === FALSE ? '?' : '&'). http_build_query($get),
        CURLOPT_HEADER          => 0,
        CURLOPT_RETURNTRANSFER  => TRUE,
        CURLOPT_CONNECTTIMEOUT  => 5,
        CURLOPT_TIMEOUT         => 10,
    );
    $ch = curl_init();
    $result = '';
    if($ch) {
        foreach($options as $k=>$v) {
            $defaults[$k] = $v;
        }
        curl_setopt_array($ch, $defaults);
        
        $result = curl_exec($ch);
        if($result === false) {
            if($error !== false) {
                $error = curl_error($ch);
            }
            if($errno !== false) {
                $errno = curl_errno($ch);
            }
        }
        if($httpCode !== false) {
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        }
        curl_close($ch);
    }
    return $result;
}