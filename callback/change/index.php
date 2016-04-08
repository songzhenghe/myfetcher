<?php

class inst extends super_inst{
    public function __construct(){
        parent::__construct();
		$this->table='change';
    }
	public function condition(){
		$sql="";
		
		return $sql;
	}
	//采分页
	public function my_create_list_url(){
		$urls=array();
		
		
		
		return $urls;
	}
	//采文章列表
	public function my_create_arc_url($v){
		$urls=array();


		
		return $urls;
	}

	//采文章内容
	public function my_fetch_arc_info($v){


	}
	public function doit($info){
		
		extract($info);
		
		$old_data=$this->db->select("select * from `word` where `id`='{$new_id}'");
		
		$old_data=array_map('addslashes',$old_data);
		extract($old_data);
		$sql='';
		$sql.="update `word` set `word`='{$word}',`spell`='{$spell}',`explain`='{$explain}',`sentence`='{$sentence}',`src`='{$src}',`interpretation`='{$interpretation}' where `id`='{$old_id}';";
		$sql.="update `word_base` set `word`='{$word}',`spell`='{$spell}',`explain`='{$explain}',`sentence`='{$sentence}',`src`='{$src}',`interpretation`='{$interpretation}' where `id`='{$old_id}';";
		
		$this->put_into_file($sql);
	
		$this->msg("单词ID: ".$info['id']." 完成！");
		
	}
	

//	
}



