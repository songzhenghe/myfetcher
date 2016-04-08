<?php
include('./init.php');
if($_POST){
	$query="insert into `project` (`title`,`dir`,`file`,`class`,`callback`) values ('{$title}','{$dir}','{$file}','{$class}','{$callback}')";
	$r=$db->query($query);
	if($r){
		if($dir and !file_exists(ROOT.'callback/'.$dir.'/')){
			mkdir(ROOT.'callback/'.$dir.'/');
			$sql=<<<st
CREATE TABLE IF NOT EXISTS `{$dir}_current_item` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `n` int(10) unsigned NOT NULL,
  primary key(`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8
st;
			$db->query($sql);
			$sql="INSERT INTO `{$dir}_current_item` (`id`, `n`) VALUES (1, 0),(2, 0),(3, 0)";
			$db->query($sql);
			
			$sql=<<<st
CREATE TABLE `{$dir}_list_url` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `url` varchar(300) NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `url` (`url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8
st;
			$db->query($sql);
			
			$sql=<<<st
CREATE TABLE `{$dir}_arc_url` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `url` varchar(300) NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `url` (`url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8
st;
			$db->query($sql);		
			
		}
	/*
CREATE TABLE IF NOT EXISTS `current_item` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `n` int(10) unsigned NOT NULL,
  primary key(`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `current_item` (`id`, `n`) VALUES
(1, 0);
	*/		
	}
	autoalert($r);
	js("window.parent.frames['left'].location.reload();");
	back();
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>
<body>
<form action="" method="post">
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <th scope="row">名称</th>
    <td><input type="text" name="title" id=""></td>
  </tr>
  <tr>
    <th scope="row">dir name</th>
    <td><input type="text" name="dir" id=""></td>
  </tr>
  <tr>
    <th scope="row">file</th>
    <td><input type="text" name="file" id="" value="index.php" readonly></td>
  </tr>
  <tr>
    <th scope="row">class</th>
    <td><input type="text" name="class" id="" value="inst" readonly></td>
  </tr>
  <tr>
    <th scope="row">callback</th>
    <td><input type="text" name="callback" id="" value="begin" readonly></td>
  </tr>
  <tr>
    <th scope="row"><input type="submit" name="sumbit" value="提交"></th>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>