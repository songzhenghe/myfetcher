<?php
class db{
	private $link=null;
	
	public function __construct(){
		$this->connect();
	}
	public function __destruct(){
		$this->close();
	}
	protected function connect(){
		$this->link=mysql_connect('localhost','root','root');
		if($this->link){
			$r=mysql_select_db('myfetcher',$this->link);
			if($r){
				$this->query("set names utf8");
			}else{
				exit('数据库选择错误！');
			}
		}else{
			exit('数据库连接错误！');
		}
	}
	public function query($query){
		$r=mysql_query($query,$this->link);
		if(!$r){
			file_put_contents(ROOT.'mysql.error.txt',$this->err()."\r\n",FILE_APPEND);
		}else{
			return $r;	
		}
	}
	public function err(){
		return mysql_error($this->link);
	}
	//MYSQL_ASSOC, MYSQL_NUM, or MYSQL_BOTH
	public function fetch_array($result,$type){
		switch($type){
			case 'ASSOC':
				return mysql_fetch_array($result,MYSQL_ASSOC);
			break;
			case 'NUM':
				return mysql_fetch_array($result,MYSQL_NUM);
			break;
			case 'BOTH':
				return mysql_fetch_array($result,MYSQL_BOTH);
			break;
			default:
				return mysql_fetch_array($result,MYSQL_ASSOC);
			break;
		}
	}
	public function fetch_array_all($result,$type){
		$data=array();
		while($d=$this->fetch_array($result,$type)){
			$data[]=$d;
		}
		return $data;
	}
	public function free_result($result) {
		if(is_resource($result)){
			return mysql_free_result($result);
		}else{
			return true;
		}
	}
	public function insert_id() {
		return mysql_insert_id($this->link);
	}
	public function affected_rows(){
		return mysql_affected_rows($this->link);
	}
	public function close(){
		return mysql_close($this->link);
	}
    public function get_column($query){
        $d=array();
        $result=$this->query($query);
		if($result){
			while($r=$this->fetch_array($result,'NUM')){
                $d[]=$r[0];
            }
			$this->free_result($result);
		}
        return $d;
    }
	public function get_field($query){
		$result=$this->query($query);
		if($result){
			$info=$this->fetch_array($result,'NUM');
			$this->free_result($result);
			if(!empty($info)){
				return $info[0];
			}else{
				return '';
			}
		}else{
			return '';
		}
	}
	public function select($query,$type='ASSOC'){
		$result=$this->query($query);
		if($result){
			$r=$this->fetch_array($result,$type);
			$this->free_result($result);
			return $r;
		}else{
			return false;
		}
	}
	public function mselect($query,$type='ASSOC'){
		$result=$this->query($query);
		if($result){
			$r=$this->fetch_array_all($result,$type);
			$this->free_result($result);
			return $r;
		}else{
			return false;
		}
	}
//
}