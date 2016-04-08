<?php
include('./init.php');
include('project.class.php');
$project=new project($_GET['id']);

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<script src="jquery.js"></script>
<script>
$(document).ready(function(e) {
    
});
</script>
</head>
<body>

<div><h2>简单模式</h2></div>

<form action="import_action.php" target="ccc" method="get">
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="row">project id</th>
    <td><input type="text" name="project_id" id="" value="<?php echo $_GET['id'];?>" readonly></td>
  </tr>
  <tr>
    <th scope="row">数据id:</th>
    <td><input type="text" name="test_id" id="" value="1"><input type="hidden" name="type" value="test"></td>
  </tr>
  <tr>
    <th scope="row"><input type="submit" name="submit" value="测试"></th>
    <td>&nbsp;</td>
  </tr>
</table>

</form>
<h3 style="align:center;"><a href="import_action.php?project_id=<?php echo $_GET['id'];?>&type=begin" target="ccc">开始采集文章[<?php echo $project->count_c();?>]</a> || <a target="ccc" href="zero.php?id=<?php echo $_GET['id'];?>" onClick="return confirm('确定要清零么？');">计数清零[<?php echo $project->current_c();?>]</a></h3>
<h3 style="align:center;"><a href="import_action.php?project_id=<?php echo $_GET['id'];?>&type=mp3" target="ccc">创建mp3目录</a></h3>
<br>
<br>
<br>
<br>
<div><a href="javascript:void(0)" onClick="location.reload();">刷新</a></div>

<iframe name="ccc" width="100%" height="500px">

</iframe>
<script>
$(window).bind('beforeunload',function(){
	return '您输入的内容尚未保存，确定离开此页面吗？';
});
</script>
</body>
</html>