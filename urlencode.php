<?php
include('./init.php');

if($_POST){
	$str=trim(stripslashes($_POST['str']));
	$type=$_POST['type'];
	$func=($type==1)?'rawurlencode':'rawurldecode';
	if($str){
		echo $func($str);
		exit;
	}
}else{
	$url='https://www.baidu.com/';
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<style>
input{
	line-height:40px;
	height:40px;	
}
</style>
</head>
<body>

<form action="" target="ccc" method="post">
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="row">字符</th>
    <td><input type="text" name="str" id="" value="" size="100"></td>
  </tr>
  <tr>
    <th scope="row">方式</th>
    <td><label><input type="radio" name="type" id="" value="1" checked>encode </label><label><input type="radio" name="type" id="" value="2">decode </label></td>
  </tr>
  <tr>
    <th scope="row">&nbsp;</th>
    <td><input type="submit" name="submit" value="提交"></td>
  </tr>
</table>

</form>

<br>
<br>
<br>
<br>

<iframe name="ccc" width="100%" height="500px">

</iframe>
</body>
</html>