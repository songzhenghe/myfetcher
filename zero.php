<?php
include('./init.php');

$id=$_GET['id'];
if($id){
	$data=$db->select("select * from project where id='{$id}'");
	$db->query("update `{$data['dir']}_current_item` set n=0 where id=1");
	
	echo 1;
}
?>
