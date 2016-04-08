<?php
class super_inst{
	public $db;
	public $list_url_table;
	public $arc_url_table;
	public $table;
	public $counter_table;
	public $cookie_jar;
	public $project_id=0;
	public $number=50;
	protected $project;
	
    public function __construct(){
		global $db;
		$this->db=$db;
		
		
		$this->number=50;
		
    }
	public function converting($str,$from='GB2312',$to='UTF-8'){
		return iconv($from, "{$to}//IGNORE", $str);
	}
	public function p($c2){
		var_dump(htmlspecialchars($c2));
	}
	public function myhost($url){
		$arr=parse_url($url);
		$str=$arr['scheme'].'://'.$arr['host'];
		return $str;
	}
	public function init(){
		$info=$this->project=$this->project();
		$this->list_url_table="{$info['dir']}_list_url";
		$this->arc_url_table="{$info['dir']}_arc_url";
		$this->counter_table="{$info['dir']}_current_item";
		$this->cookie_jar=dirname(__FILE__)."/callback/{$info['dir']}/cookie.tmp";
	}
	function project(){
		return $this->db->select("select * from project where id='{$this->project_id}'");
	}
	
	
	function put_into_file($str){
		$file='./data/sql.sql';
		$maxsize=1024*1024*10;
		if(!file_exists($file)){
			touch($file);
		}
		if(filesize($file)>$maxsize){
			$r=rename($file,'./data/'.date("Y_m_d_H_i_s").'.sql');
			file_put_contents($file,$str);
		}else{
			file_put_contents($file,$str,FILE_APPEND);
		}
		return true;
	}
	
	function request($is_post,$url,$cookie_jar,$referer,$post_fields=array()){
		$ch = curl_init();
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
		curl_setopt($ch,CURLOPT_POSTFIELDS,$post_fields);
		$code = curl_exec($ch);
		curl_close($ch);
		return $code;
	}
	
	
	//下载音频
	function download_mp3($txt,$id,$word){
		$cookie_jar = 'E:/wwwroot/de/cookie3.tmp';
		//http://api.frdic.com/api/v2/speech/speakweb?langid=de&txt=QYNaWNo
		$url="http://api.frdic.com/api/v2/speech/speakweb?langid=de&txt={$txt}";
		$src=md5($word);
		$f=substr($src,0,1);
		$l=substr($src,1,1);

		$m=$url;

		$c=request(0,$m,$cookie_jar,'http://www.godic.net/');
		if($c){
			$filename="./mp3/{$f}/{$l}/{$src}.mp3";
			file_put_contents($filename,$c);
			
					
			if(file_exists($filename)){
				$finfo    = finfo_open(FILEINFO_MIME);
				$mimetype = finfo_file($finfo, $filename);
				finfo_close($finfo);
				
				//extension=php_fileinfo.dll 
				if($mimetype=='audio/mpeg; charset=binary'){
					$string="update `deword` set `src`='{$src}' where `id`='{$id}'";
					mysql_query($string);
				}else{
					rename($filename,$filename.'.bak');	
				}
				
			}
			
		}
		
		
	}
	
	protected function _max($n=1){
		$query_tmp="select `n` from `{$this->counter_table}` where id='{$n}'";
		$max=(int) $this->db->get_field($query_tmp);
		return $max;
	}
	protected function prog($max,$table,$condition){
		$query_one="select count(*) a from `{$table}` where 1 and `id`<='{$max}' {$condition}";
		$son=(int) $this->db->get_field($query_one);
		$query_two="select count(*) a from `{$table}` where 1 {$condition}";
		$mother=(int) $this->db->get_field($query_two);
		if($mother==0) $mother=1;
		$percent=(round($son/$mother,2)*100).'%';

		return "<div style='text-align:center;color:green;'>{$son}/{$mother}[{$percent}] </div>";

	}
	protected function get_data($max){
		$condition=$this->condition();
		$query="select * from `{$this->table}` where 1 and `id`>'{$max}' {$condition}  order by `id` asc limit {$this->number}";
		$data=$this->db->mselect($query);
		return $data;
	}
	protected function find_data($id,$table){
		$query="select * from `{$table}` where id='{$id}'";
		return $this->db->select($query);
	}
	protected function update_current_item($t,$current){
		$query="update `{$this->counter_table}` set `n`='{$current}' where `id`='{$t}'";
		return $this->db->query($query);
	}
	protected function msg($msg){
		echo $msg;
		echo "<br />";
	}
	protected function jump($flag,$type,$page){
		if($flag){
			$page++;
			$ts=time();
			echo "<script>location.href='?project_id={$this->project_id}&type={$type}&page={$page}&ts={$ts}';</script>";
		}else{
			echo 'ok';
		}
	}
	public function create_list_url(){
		$urls=$this->my_create_list_url();
		foreach($urls as $url){
			$url=addslashes(trim($url));
			$this->db->query("insert into `{$this->list_url_table}` (`url`) values ('{$url}')");
		}
		return true;
	}
	public function create_list_url_demo(){
		$urls=$this->my_create_list_url();
		p($urls);
		return true;
	}
	public function load_list_url($max,$pagesize,$condition){
		$data=$this->db->mselect("select * from `{$this->list_url_table}` where 1=1 and `id`>'{$max}' '{$condition}' order by `id` asc limit {$pagesize}");
		return $data;
	}
	public function op_list_url($kind){
		switch($kind){
			case 'truncate':
				$this->db->query("truncate table `{$this->list_url_table}`");
			break;
			case 'reset':
				$this->db->query("update `{$this->counter_table}` set `n`='0' where `id`='2'");
			break;
		}
		return true;
	}
	public function create_arc_url(){
		$page=isset($_GET['page'])?$_GET['page']:1;
		$pagesize=1;
		echo "当前第{$page}页<br />";
		$max=$this->_max(2);
		$condition='';
		echo $this->prog($max,$this->list_url_table,$condition);
		$dddd=$this->load_list_url($max,$pagesize,$condition);
		$tag=0;
		foreach($dddd as $k=>$v){
			$tag=1;
			$urls=$this->my_create_arc_url($v);	
			foreach($urls as $url){
				$url=addslashes(trim($url));
				$this->db->query("insert into `{$this->arc_url_table}` (`url`) values ('{$url}')");
			}
			$this->update_current_item(2,$v['id']);
			usleep(100000);
			echo $v['url'];
			echo "<br />";
		}
		$this->jump($tag,__FUNCTION__,$page);
	}
	public function create_arc_url_demo($test_id){
		$data=$this->find_data($test_id,$this->list_url_table);
		echo $_SERVER['REQUEST_URI'];
		$urls=$this->my_create_arc_url($data);
		p($urls);
		return true;
	}
	public function load_arc_url($max,$pagesize,$condition){
		$data=$this->db->mselect("select * from `{$this->arc_url_table}` where 1=1 and `id`>'{$max}' {$condition} order by `id` asc limit {$pagesize}");
		return $data;
	}
	public function op_arc_url($kind){
		switch($kind){
			case 'truncate':
				$this->db->query("truncate table `{$this->arc_url_table}`");
			break;
			case 'reset':
				$this->db->query("update `{$this->counter_table}` set `n`='0' where `id`='3'");
			break;
		}
		return true;
	}
	public function fetch_arc_info(){
		$page=isset($_GET['page'])?$_GET['page']:1;
		$pagesize=1;
		echo "当前第{$page}页<br />";
		$max=$this->_max(3);
		$condition='';
		echo $this->prog($max,$this->arc_url_table,$condition);
		$dddd=$this->load_arc_url($max,$pagesize,$condition);
		$tag=0;
		foreach($dddd as $k=>$v){
			$tag=1;
			$this->my_fetch_arc_info($v);
			$this->update_current_item(3,$v['id']);
			usleep(100000);
			echo $v['url'];
			echo "<br />";
		}
		$this->jump($tag,__FUNCTION__,$page);
	}
	public function fetch_arc_info_demo($test_id){
		$data=$this->find_data($test_id,$this->arc_url_table);
		echo $_SERVER['REQUEST_URI'];
		$this->my_fetch_arc_info($data);
	}
	public function op_arc_info($kind){
		switch($kind){
			case 'truncate':
				$this->db->query("truncate table `{$this->table}`");
			break;
			case 'reset':
				$this->db->query("update `{$this->counter_table}` set `n`='0' where `id`='1'");
			break;
		}
		return true;
	}
	public function test($test_id){
		$data=$this->find_data($test_id,$this->table);
		echo $_SERVER['REQUEST_URI'];
		$this->doit($data);
	}
	public function begin(){
		$page=isset($_GET['page'])?$_GET['page']:1;
		$max=$this->_max(1);
		echo $_SERVER['REQUEST_URI'];
		$condition=$this->condition();
		echo $this->prog($max,$this->table,$condition);
		$data=$this->get_data($max);
		$flag=false;
		foreach($data as $k=>$info){
			$flag=true;
			$this->doit($info);
			$this->update_current_item(1,$info['id']);
			usleep(100000);
		}
		$this->jump($flag,__FUNCTION__,$page);
	}
	public function mymkdir($root,$type='mp3'){
		if($type=='mp3'){
			$a=range('a','f');
			$b=range('0','9');
			//E:/wwwroot/myfetcher/callback/jpword/mp3/
			$folder2=$folder=array_merge($a,$b);
			foreach($folder as $k=>$v){
				foreach($folder2 as $kk=>$vv){
					$path=$root.$v."/".$vv.'/';
					if(!file_exists($path)) mkdir($path,0777,true);
				}
			}
		}
		return true;
	}
	
//
}