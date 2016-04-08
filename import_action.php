<?php
include('./init.php');

$project_id=intval($_GET['project_id']);
$info=$db->select("select * from project where id='{$project_id}'");
include_once(ROOT.'callback/'.$info['dir'].'/'.$info['file']);


$class=$info['class'];
$func=$info['callback'];

$myInstance=new $class;
$myInstance->project_id=$project_id;
$myInstance->init();




$type=$_GET['type'];

//////////////////////////////////////////////
if($type=='create_list_url'){
	$myInstance->create_list_url();
	echo 'ok';
}
if($type=='op_list_url'){
	$kind=$_GET['kind'];
	$myInstance->op_list_url($kind);
	echo 'ok';
}
////////////////////////////////////////////////
if($type=='create_arc_url'){
	$myInstance->create_arc_url();
	//echo 'ok';
}

if($type=='op_arc_url'){
	$kind=$_GET['kind'];
	$myInstance->op_arc_url($kind);
	echo 'ok';
}
if($type=='create_arc_url_demo'){
	$test_id=intval($_GET['test_id']);
	$myInstance->create_arc_url_demo($test_id);
}
///////////////////////////////////////////////////
if($type=='fetch_arc_info'){
	$myInstance->fetch_arc_info();
}

if($type=='op_arc_info'){
	$kind=$_GET['kind'];
	$myInstance->op_arc_info($kind);
	echo 'ok';
}
if($type=='fetch_arc_info_demo'){
	$test_id=intval($_GET['test_id']);
	$myInstance->fetch_arc_info_demo($test_id);
}
/////////////////////////////////////////////////////
if($type=='test'){
	$test_id=intval($_GET['test_id']);
	$myInstance->test($test_id);
}


if($type=='begin'){
	$myInstance->begin();
}

if($type=='mp3'){
	$myInstance->mp3();
}
