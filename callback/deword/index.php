<?php

class inst extends super_inst{
    public function __construct(){
        parent::__construct();
		$this->table='deword';
		$this->number=1;
    }
	public function condition(){
		$sql="";
		
		return $sql;
	}
	public function mp3(){
		$this->mymkdir("E:/wwwroot/myfetcher/callback/deword/mp3/");
	}
	public function rand($data,$num=2){
		$str='';
		if(count($data)<=$num) return implode('||||',$data);
		
		$key=array_rand($data,$num);
		foreach((array) $key as $k=>$v){
			$str.=$data[$v]."||||";
		}
		return trim($str,'||||');
	}
	private function mytrim($aaa){
		$aaa=str_replace("\t",' ',$aaa);
		$aaa=preg_replace("/\n/i"," ",$aaa);
		$aaa=preg_replace("/\r/i"," ",$aaa);
		$aaa=preg_replace('/ {2,}/i',' ',$aaa);
		return $aaa;
	}
	public function doit($info){
		echo $info['word'];
		echo "<br />";
	
		$matches=array();
		//http://www.godic.net/dicts/de/nach
		$url="http://www.godic.net/dicts/de/".rawurlencode($info['word']);
		$c=$this->request(0,$url,$this->cookie_jar,'http://www.godic.net/');
		
		//<input type="hidden" id="page-status" value="QYNTG9jaCtBRUEtMTkzMDA3K0FFQS0tOTk5OStBRUEtMjAwMStBRUEtbG9jaA--AV-" lang="de" word="Loch">
		$c2=preg_match_all('/<input type="hidden" id="page-status" value="(.*?)" lang="de" word=".*?">/ims',$c,$matches);
		if($c2){
			$key=$matches[1][0];
			
			echo "find key<br />";
			if($key){
				$c8=$this->request(1,'http://www.godic.net/Dicts/de/tab-detail/-12',$this->cookie_jar,'http://www.godic.net/',array('status'=>$key));
				
				phpQuery::newDocumentHTML($c8);
		

					//chinese
					$c2=pq("div.lj_item:lt(1)")->html();
				
				//例句
				
				if($c2){
					echo "find sentence<br />";
					$c2=strip_tags($c2);
					$c2=$this->mytrim($c2);
					$c2=str_replace('评价该例句：好评差评指正','||||',$c2);
					$c2=trim($c2,'|||| ');
					
					
					
					$query="update `deword` set `sentence`='{$c2}' where `id`='{$info['id']}'";
					

					$this->db->query($query);
					
					echo mysql_affected_rows();
					
				}
			
			}
			
			
		}else{
			echo 'NO!';
		}
		
		
				echo "<br />";
		$this->msg("单词ID: ".$info['id']." 完成！{$info['word']}");
	}
	public function doit2($info){

		echo $info['word'];
		echo "<br />";
		$matches=array();
		//http://dict.hjenglish.com/app/jp/sent/%E3%81%95%E3%82%8F%E3%82%84%E3%81%8B/
		$url="http://dict.hjenglish.com/app/jp/sent/".rawurlencode($info['japanese']);
		$c=$this->request(0,$url,$this->cookie_jar,'http://dict.hjenglish.com/');
		
		phpQuery::newDocumentHTML($c);
		

		//chinese
		$c2=pq("ul.search_result li:lt(1)")->html();
		
		if($c2){
			//
			//$this->p($c2);
			$c2=strip_tags($c2);
			$c2=preg_replace('/getSentenceSound\(.*?\);/ims','',$c2);
			
			$c2=$this->mytrim($c2);
			$c2=str_replace('收藏 反馈','||||',$c2);
			$c2=trim($c2,'|||| ');
			$arr=explode('||||',$c2);
			
			$str='';
			foreach($arr as $k=>$v){
				$v=trim($v);
				if($k==0){
					$add='||||';
				}else{
					$add='';
				}
				$str.=str_replace(array('1. ','2. '),'',$v).$add;
			}
			
			$query="update `{$this->table}` set `sentence`='{$str}' where `id`='{$info['id']}'";
			mysql_query($query);
		}

		
		echo "<br />";
		$this->msg("单词ID: ".$info['id']." 完成！{$info['japanese']}");
		
	}
	
		//下载音频
	function download_mp3($txt,$id,$word){
		$cookie_jar = 'E:/wwwroot/cookie.tmp';
		//http://d1.g.hjfile.cn/voice/jpsound/J17690.mp3
		$url=$txt;
		$src=md5($word);
		$f=substr($src,0,1);
		$l=substr($src,1,1);

		$m=$url;
		//$c=$this->request(0,$m,$cookie_jar,'http://dict.hjenglish.com/');
		$c=file_get_contents($txt);
		if($c){
			$filename="E:/wwwroot/myfetcher/callback/jpword/mp3/{$f}/{$l}/{$src}.mp3";
			//mkdir(dirname($filename),0777,true);
			
			file_put_contents($filename,$c);
			
					
			if(file_exists($filename)){
				$finfo    = finfo_open(FILEINFO_MIME);
				$mimetype = finfo_file($finfo, $filename);
				finfo_close($finfo);
				
				//extension=php_fileinfo.dll 
				if($mimetype=='audio/mpeg; charset=binary'){
					$string="update `{$this->table}` set `audio`='{$src}' where `id`='{$id}'";
					mysql_query($string);
				}else{
					rename($filename,$filename.'.bak');	
				}
				
			}
			
		}
		
		
	}

//	
}



