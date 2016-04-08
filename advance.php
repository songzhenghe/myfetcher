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

<div><h2>高级模式</h2></div>

<h3 style="align:center;">2<a href="import_action.php?project_id=<?php echo $_GET['id'];?>&type=create_list_url" target="ccc">创建列表地址</a> || <a onClick="return confirm('确定要清空列表么?');" href="import_action.php?project_id=<?php echo $_GET['id'];?>&type=op_list_url&kind=truncate" target="ccc">清空列表[<?php echo $project->count_a();?>]</a> || <a onClick="return confirm('确定要重置么?');" href="import_action.php?project_id=<?php echo $_GET['id'];?>&type=op_list_url&kind=reset" target="ccc">重置[<?php echo $project->current_a();?>]</a></h3>
 
<h3 style="align:center;">3<a href="import_action.php?project_id=<?php echo $_GET['id'];?>&type=create_arc_url" target="ccc">采集文章地址</a> || <a onClick="return confirm('确定要清空列表么?');" href="import_action.php?project_id=<?php echo $_GET['id'];?>&type=op_arc_url&kind=truncate" target="ccc">清空列表[<?php echo $project->count_b();?>]</a> || <a onClick="return confirm('确定要重置么?');" href="import_action.php?project_id=<?php echo $_GET['id'];?>&type=op_arc_url&kind=reset" target="ccc">重置[<?php echo $project->current_b();?>]</a> || <a href="javascript:void(0);" target="ccc" onClick="window.frames['ccc'].location.href='import_action.php?project_id=<?php echo $_GET['id'];?>&type=create_arc_url_demo&test_id='+document.getElementById('t1').value;">测试</a> <input type="text" name="" id="t1" value="1" size="10"></h3>

<h3 style="align:center;">1<a href="import_action.php?project_id=<?php echo $_GET['id'];?>&type=fetch_arc_info" target="ccc">采集文章</a> || <a onClick="return confirm('确定要清空内容么?');" href="import_action.php?project_id=<?php echo $_GET['id'];?>&type=op_arc_info&kind=truncate" target="ccc">清空内容[<?php echo $project->count_c();?>]</a>|| <!--<a onClick="return confirm('确定要重置么?');" href="import_action.php?project_id=<?php echo $_GET['id'];?>&type=op_arc_info&kind=reset" target="ccc">重置[<?php echo $project->current_c();?>]</a>--> || <a href="javascript:void(0);" target="ccc" onClick="window.frames['ccc'].location.href='import_action.php?project_id=<?php echo $_GET['id'];?>&type=fetch_arc_info_demo&test_id='+document.getElementById('t11').value;">测试</a> <input type="text" name="" id="t11" value="1" size="10"></h3>

<div><a href="javascript:void(0)" onClick="location.reload();">刷新</a></div>
<br>
<br>
<br>
<br>

<iframe name="ccc" width="100%" height="500px">

</iframe>
<script>
$(window).bind('beforeunload',function(){
	return '您输入的内容尚未保存，确定离开此页面吗？';
});
</script>
</body>
</html>