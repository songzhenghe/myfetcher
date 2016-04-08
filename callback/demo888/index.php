<?php

class inst extends super_inst{
    public function __construct(){
        parent::__construct();
		$this->table='demo888';
    }
	public function condition(){
		$sql="";
		
		return $sql;
	}
	//采分页
	public function my_create_list_url(){
		$urls=array();
		
		$pattern='http://www.helloweba.com/index-%s.html';
		
		$urls[]='http://www.helloweba.com/index.html';
		$range=range(2,26);
		foreach($range as $k=>$v){
			$urls[]=sprintf($pattern,$v);
		}
		
		return $urls;
	}
	//采文章列表
	public function my_create_arc_url($v){
		$urls=array();

		$c=$this->request(0,$v['url'],$this->cookie_jar,$this->myhost($v['url']));
		//$c=$this->converting($c);
		phpQuery::newDocumentHTML($c);
		
		
		$object=pq(".blog_li h2 a");
		
		foreach($object as $obj){
			$href=pq($obj)->attr('href');
			$urls[]='http://www.helloweba.com'.$href;
		}
		
		return $urls;
	}

	//采文章内容
	public function my_fetch_arc_info($v){
		$c=$this->request(0,$v['url'],$this->cookie_jar,$this->myhost($v['url']));

		phpQuery::newDocumentHTML($c);
		
		
		$title=pq(".blog_title h2:eq(0)")->html();
		$title=addslashes(trim($title));
		
		$content=pq("div.content:eq(0)")->html();
		$content=addslashes($content);
		
		$query="insert into `{$this->table}` (`title`,`content`) values ('{$title}','{$content}')";
		$this->db->query($query);
		
		echo $title;
		echo "<br />";

	}
	// public function doit($info){
		
		// echo $info['word'];
		// echo "<br />";
		// $url="http://www.godic.net/dicts/de/".urlencode($info['word']);
		// $c=request(0,$url,$this->cookie_jar,'http://www.godic.net/');
		
		
	
		// $this->msg("单词ID: ".$info['id']." 完成！{$info['word']}");
		
	// }
	

//	
}



