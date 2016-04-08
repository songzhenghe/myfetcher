<?php
include('./init.php');

if($_POST){
	$url=trim(stripslashes($_POST['url']));
	$preg=trim(stripslashes($_POST['preg']));
	if($url){
		$content=file_get_contents($url);
		if(!$content){
			exit('内容获取失败！');	
		}
		$c2=preg_match_all($preg,$content,$matches);
		if($c2){
			foreach($matches as $k=>$v){
				echo $k;
				foreach($v as $kk=>$vv){
					echo "&nbsp;&nbsp;".$k;
					echo "&nbsp;&nbsp;";
					echo htmlspecialchars($vv,ENT_QUOTES);
					echo "<hr />";	
				}
			}
			exit;
		}else{
			exit('匹配失败！');	
		}	
	}
}else{
	$url='https://www.baidu.com/';
	$preg='/<title>(.*?)<\/title>/ims';	
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
    <td>/&lt;span class=&quot;Phonitic&quot;&gt;\[(.*?)\]&lt;\/span&gt;/ims</td>
  </tr>
  <tr>
    <th scope="row">preg</th>
    <td><input type="text" name="preg" id="" value="<?php echo $preg;?>" size="100"></td>
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