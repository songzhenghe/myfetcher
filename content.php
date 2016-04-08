<?php
include('./init.php');

if($_POST){
	$url=trim(stripslashes($_POST['url']));
	if($url){
		$content=file_get_contents($url);
		echo htmlspecialchars($content);
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
    <th scope="row">url</th>
    <td><input type="text" name="url" id="" value="<?php echo $url;?>" size="100"></td>
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


</body>
</html>