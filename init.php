<?php
set_time_limit(0);
error_reporting(E_ALL);
header('content-type:text/html;charset=utf-8');
date_default_timezone_set('Asia/Shanghai');
define('ROOT',str_replace('\\','/',realpath(dirname(__FILE__))).'/');
define('GPC',get_magic_quotes_gpc());
define('UPLOAD_DIR',ROOT.'upload/');
define('CALLBACK_DIR',ROOT.'callback/');
session_start();
include ROOT.'db.class.php';
include ROOT.'super_inst.class.php';
$db=new db;
include(ROOT.'phpQuery.php');
if(!GPC){
	if($_GET){
		$_GET=addslashes_array($_GET);
	}
	if($_POST){
		$_POST=addslashes_array($_POST);
	}
	if($_COOKIE){
		$_COOKIE=addslashes_array($_COOKIE);
	}
}
@extract($_GET);
@extract($_POST);
function _post($url,$mydata){
    $post_fields='';
    foreach($mydata as $k=>$v){
        $post_fields.="{$k}={$v}&";
    }
    $post_fields=rtrim($post_fields,'&');
    $ch=curl_init($url);
    curl_setopt($ch,CURLOPT_HEADER,0);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_POST,1);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$post_fields);
    $contents=curl_exec($ch);
    curl_close($ch);
    return $contents;
}
function addslashes_array($string) { 
	if(is_array($string)){ 
		foreach($string as $key => $val){ 
			$string[$key] = addslashes_array($val); 
		} 
	}else{ 
		$string = addslashes(trim($string)); 
	}
	return $string; 
}
function stripslashes_array($string) {
	if (is_array($string)) {
		foreach ($string as $k => $v) {
			$string[$k] = stripslashes_array($v);
		}
	} else if (is_string($string)) {
		$string = stripslashes($string);
	}
	return $string;
}
function s_i_p($path_array){
	array_unshift($path_array,get_include_path());
	set_include_path(implode(PATH_SEPARATOR,$path_array));
}
function alert($msg){
	echo "<script>alert('{$msg}');</script>";
}
function back(){
    echo "<script>window.history.back();</script>";
    exit;
}
function js($code){
	echo '<script>';
	echo $code;
	echo '</script>';
}
function jump($url){
    echo "<script>location.href='{$url}';</script>";
    exit;
}
function autoalert($f,$extra=''){
	if($f){
		alert("操作成功！\\n{$extra}");
	}else{
		alert("操作失败！\\n{$extra}");
	}
}
function p(){
	$args=func_get_args();  //获取多个参数
	if(count($args)<1){
		return;
	}	
	echo '<div style="width:100%;text-align:left"><pre>';
	//多个参数循环输出
	foreach($args as $arg){
		if(is_array($arg)){  
			print_r($arg);
			echo '<br>';
		}else if(is_string($arg)){
			echo $arg.'<br>';
		}else{
			var_dump($arg);
			echo '<br>';
		}
	}
	echo '</pre></div>';	
}
function myswitch($kvalue,$array){
	return  $array[$kvalue];
}
//二维数组转一维
function multi2single($array){
	$new_array=array();
	$keys=array_keys($array[0]);
	$size=count($keys);
	$n=count($array);
	for($i=0;$i<$n;$i++){
		for($j=0;$j<$size;$j++){
			$key_name=$keys[$j];
			$new_array[$key_name][]=$array[$i][$key_name];
		}
	}
	return $new_array;
}
//二维转一维 单元素
function multi2single_min($array,$key_name){
	$new_array=array();
	if(!is_array($array)) return array();
	if(!is_array($array[0])) return array();
	$n=count($array);
	for($i=0;$i<$n;$i++){
		$new_array[]=$array[$i][$key_name];
	}
	return $new_array;
}
//echo form_radio('tag',array(1=>'显示',0=>'隐藏',2=>'很好'),1);
function form_radio($name,$array,$checked='-1',$id_prefix='x_'){
	$string='';
   foreach($array as $key=>$value){
		if($checked==$key){
			$c="checked='checked'";
		}else{
			$c='';
		}
		$string.=<<<st
\n\r<label><input type="radio" name="{$name}" value="{$key}" {$c} id='{$id_prefix}{$key}' />{$value}</label>
st;
   }
   return $string."\r\n";
}
//echo form_checkbox('mycheckbox',array(0=>'音乐',1=>'体育',2=>'政治'),array(1,2));
function form_checkbox($name,$array,$checked=array(),$id_prefix='y_'){
	$string='';
	foreach($array as $key=>$value){
		if(in_array($key,$checked)){
			$c="checked='checked'";
		}else{
			$c='';
		}
		$string.=<<<st
\n\r<label><input type="checkbox" name="{$name}" value="{$key}" {$c} id='{$id_prefix}{$key}' />{$value}</label>
st;
   }
   return $string."\r\n";
}
//echo form_select(array(0=>'第0个',1=>'第一个',2=>'第二个'),2);
function form_select($array,$selected='-1'){
	$string='';
	foreach($array as $key=>$value){
		if($selected==$key){
			$s="selected='selected'";
		}else{
			$s='';
		}
		$string.=<<<st
\n\r<option value='{$key}' {$s} >{$value}</option>
st;
	}
	return $string."\r\n";
}