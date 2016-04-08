<?php
include('./init.php');
$file=ROOT.'mysql.error.txt';
$type=$_POST['type'];
$ts=date("Y-m-d H:i:s");
$arr=array();
$arr[]=$ts;
if($type=='get'){
	if(file_exists($file)){
		$arr[]=file_get_contents($file);
	}else{
		$arr[]='文件不存在！';
	}
}

if($type=='set'){
	$arr[]=file_put_contents($file,'');
}


echo json_encode($arr);