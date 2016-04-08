<?php
include('./init.php');


function request($is_post,$url,$cookie_jar,$referer,$post_fields=array()){
	$ch = curl_init();
	if(!$is_post){
		$arr=array();
		foreach($post_fields as $a=>$b){
			$arr[]=$a.'='.$b;	
		}
		if(strpos($url,'?')>0){
			$q='&';
		}else{
			$q='?';
		}
		$url=$url.$q.implode('&',$arr);	
	}
	$options = array(CURLOPT_URL => $url,
		  CURLOPT_HEADER => 0,
		  CURLOPT_NOBODY => 0,
		  CURLOPT_PORT => 80,
		  CURLOPT_POST => $is_post,
		  CURLOPT_RETURNTRANSFER => 1,
		  CURLOPT_FOLLOWLOCATION => 1,
		  CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; rv:22.0) Gecko/20100101 Firefox/22.0',
		  CURLOPT_COOKIEJAR => $cookie_jar,
		  CURLOPT_COOKIEFILE => $cookie_jar,
		  CURLOPT_REFERER => $referer,
		  
	);
	curl_setopt_array($ch, $options);
	if($is_post){
		curl_setopt($ch,CURLOPT_POSTFIELDS,$post_fields);
	}
	$code = curl_exec($ch);
	curl_close($ch);
	return $code;
}

if($_POST){
	$url=trim(stripslashes($_POST['url']));
	$is_post=$_POST['kind']=='get'?0:1;
	$referer=trim(stripslashes($_POST['referer']));
	$kkk=$_POST['kkk'];
	$vvv=$_POST['vvv'];
	$post_fields=array();
	foreach($kkk as $a=>$b){
		$b=trim($b);
		if(!$b) continue;
		
		$post_fields[stripslashes($b)]=rawurlencode(stripslashes($vvv[$a]));
	}
	if($url){
		$content=request($is_post,$url,'./gp.cookie.tmp',$referer,$post_fields);
		echo htmlspecialchars($content);
		exit;
	}
}else{
	$url='';
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<style>
input{
	line-height:30px;
	height:30px;	
}
</style>
</head>
<body>

<form action="" target="ccc" method="post">
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="row">url</th>
    <td><input type="text" name="url" id="" value="" size="100"></td>
  </tr>
  <tr>
    <th scope="row">来源</th>
    <td><input type="text" name="referer" id="" value="" size="100"></td>
  </tr>
  <tr>
    <th scope="row">类型</th>
    <td><label><input type="radio" name="kind" id="" value="get"> get</label>&nbsp;<label><input type="radio" name="kind" id="" value="post" checked> post</label></td>
  </tr>
  <?php
  $ele=range(1,10);
  foreach($ele as $k=>$v){
  ?>
  <tr>
    <th scope="row">参数</th>
    <td><input type="text" name="kkk[]" id="" value="" size="20"> = <input type="text" name="vvv[]" id="" value="" size="40"></td>
  </tr>
  <?php
  }
  ?>
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
<iframe name="ccc" width="100%" height="300px">

</iframe>

</body>
</html>