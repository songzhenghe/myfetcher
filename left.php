<?php
include('./init.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<style>
*{margin:0;padding:0}
</style>
<script src="jquery.js"></script>
</head>
<body>
<h3>项目列表</h3>
<ul>
<?php
$data=$db->mselect("select * from project order by id asc");
foreach($data as $k=>$v){
?>
<li style="border:1px solid #ccc;padding:3px;margin-top:3px;margin-bottom:3px;list-style:none;text-align:center;">
<?php echo $v['id'];?> <?php echo $v['title'];?> [<?php echo $v['dir'];?>]
<br>
<a target="main" href="import.php?id=<?php echo $v['id'];?>">简单</a> || <a target="main" href="advance.php?id=<?php echo $v['id'];?>">高级</a>
</li>
<?php
}
?>
<li><a href="javascript:void(0)" onClick="location.reload();">刷新</a></li>
</ul>
<?php echo time();?>
<br />
<br />
<h3><a target="main" href='add_project.php'>增加项目</a></h3>
<h3><a target="main" href='content.php'>内容获取</a></h3>
<h3><a target="main" href='gp.php'>get/post</a></h3>
<h3><a target="main" href='preg.php'>正则测试</a></h3>
<h3><a target="main" href='urlencode.php'>rawurlencode</a></h3>
<h3><a target="_blank" href='phpquery手册 _ PHPer晨星.htm'>pq手册</a></h3>
<br>
<br>
<h3>mysql错误：<a href="javascript:void(0);" id="set_error">清空</a></h3>
<div style="border:1px solid #09F" id="ts"></div>
<div style="border:1px solid #09F" id="mysql_error"></div>
<script>
$(document).ready(function(e) {
	function get_error(){
		$.post('./get_mysql_error.php',{type:'get'},function(data){
			$('#ts').html(data[0]);
			$('#mysql_error').html(data[1]);
		},'json');	
	}
	get_error();
	setInterval(function(){
		get_error();
	},10000);
	function set_error(){
		$.post('./get_mysql_error.php',{type:'set'},function(data){
			$('#ts').html(data[0]);
			$('#mysql_error').html(data[1]);
		},'json');	
	}
	$("#set_error").click(function(){
		set_error();	
	});
});
</script>
</body>
</html>