<?php
class project{
	public $project_id=0;
	public $data=array();
	
	public function __construct($id){
		global $db;
		$this->db=$db;
		$this->project_id=$id;
		$this->data=$this->db->select("select * from project where id='{$id}'");
		
		$this->table_a=$this->data['dir'].'_list_url';
		$this->table_b=$this->data['dir'].'_arc_url';
		$this->table_c=$this->data['dir'];
		$this->table_counter=$this->data['dir'].'_current_item';
		
	}
	public function count_a(){
		return $this->db->get_field("select count(*) from `{$this->table_a}`");
	}
	public function count_b(){
		return $this->db->get_field("select count(*) from `{$this->table_b}`");
	}
	public function count_c(){
		return $this->db->get_field("select count(*) from `{$this->table_c}`");
	}
	public function current_a(){
		return $this->db->get_field("select `n` from `{$this->table_counter}` where `id`='2'");
	}
	public function current_b(){
		return $this->db->get_field("select `n` from `{$this->table_counter}` where `id`='3'");
	}
	public function current_c(){
		return $this->db->get_field("select `n` from `{$this->table_counter}` where `id`='1'");
	}
	
	
}