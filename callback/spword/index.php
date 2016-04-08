<?php

class inst extends super_inst{
    public function __construct(){
        parent::__construct();
		$this->table='spword_base';
		$this->number=1;
    }
	public function condition(){
		$sql="";
		
		return $sql;
	}
	public function mp3(){
		$this->mymkdir("E:/wwwroot/myfetcher/callback/spword/mp3/");
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
		
		$url="http://www.esdict.cn/dicts/es/".rawurlencode($info['word']);
		$c=$this->request(0,$url,$this->cookie_jar,'http://www.esdict.cn/');
		
		phpQuery::newDocumentHTML($c);
		//音标
		// $c2=pq("span.Phonitic:eq(0)")->html();
		
		
		// if($c2){
			// $c2=ltrim($c2,'[');
			// $c2=rtrim($c2,']');
			// $c2=addslashes($c2);
			// $query="update `{$this->table}` set `spell`='{$c2}' where `id`='{$info['id']}'";
			// $this->db->query($query);
		// }

		
		//解释
		// $c2=pq("div#ExpFC")->html();
		
		// if($c2){
			// $c2=strip_tags($c2);
			// $c2=addslashes($c2);
		
			// $query="update `{$this->table}` set `chinese`='{$c2}' where `id`='{$info['id']}'";
			// $this->db->query($query);
		// }
		
		
		// $aaa=addslashes(strtoupper(mb_substr($info['word'],0,1,'UTF-8')));
		// $query="update `{$this->table}` set `aleph`='{$aaa}' where `id`='{$info['id']}'";
		// $this->db->query($query);
		
		
		
		//音频
		//http://api.frdic.com/api/v2/speech/speakweb?langid=de&txt=QYNaWNo
		//<a href="#" title="真人发音" class="voice-js voice-button" data-rel="langid=de&txt=QYNaWNo"></a>
		
		// $c2=pq("a.voice-js[title=\"真人发音\"]:eq(0)")->attr("data-rel");
		
		// if($c2){

			// //langid=es&txt=QYNcXVpw6lu
			// $c99=preg_match_all('/langid=es&txt=(.*)/ims',$c2,$matches);
			
			// $aaa=addslashes(trim($matches[1][0]));
			
			// //$query="update `{$this->table}` set `a`='{$aaa}' where `id`='{$info['id']}'";
			// //mysql_query($query);
			
			// if($aaa){
				// $this->download_mp3($aaa,$info['id'],$info['word']);
			// }
			
			
		// }

		//<input type="hidden" id="page-status" value="QYNYWJvbmRlcitBRUEtNjM5K0FFQS0tOTk5OStBRUEtMStBRUEtYWJvbmRlcg--AV-" lang="fr" word="abonder">
		$c2=preg_match_all('/<input type="hidden" id="page-status" value="(.*?)" lang="es" word=".*?">/ims',$c,$matches);
		if($c2){
			$key=$matches[1][0];
			
			

			// if($key){
				// //http://www.esdict.cn/Dicts/es/tab-detail/-12
				// $c8=$this->request(1,'http://www.esdict.cn/Dicts/es/tab-detail/-12',$this->cookie_jar,'http://www.esdict.cn/',array('status'=>$key));

					// phpQuery::newDocumentHTML($c8);
		

					// //chinese
					// $c2=pq("div.lj_item:lt(1)")->html();

				// //例句
				
				// if($c2){
					// $c2=strip_tags($c2);
					// $c2=$this->mytrim($c2);
					// $c2=str_replace('评价该例句：好评差评指正','||||',$c2);
					// $c2=trim($c2,'|||| ');
					// $c2=addslashes($c2);


					// $query="update `{$this->table}` set `sentence`='{$c2}' where `id`='{$info['id']}'";
					

					// $this->db->query($query);
					
				// }
			
			// }
			
			
		if($key){
		
			//http://www.esdict.cn/Dicts/es/tab-detail/-12
				$c8=$this->request(1,'http://www.esdict.cn/Dicts/es/tab-detail/-12',$this->cookie_jar,'http://www.esdict.cn/',array('status'=>$key));

					phpQuery::newDocumentHTML($c8);
			
			$c2=pq("#DictLijuChild")->html();
			
			//例句
			
			if($c2){
				$tttt=$c2;
				// $this->p($c2);
				$arr=explode("<br><br>",$tttt);
				
			
				$aaa=addslashes(trim(strip_tags($arr[0])));
				
				$bbb=addslashes(trim(strip_tags($arr[1])));
				
			
				$ccc=$aaa.'||||'.$bbb;
					


				$query="update `spword_base` set `sentence`='{$ccc}' where `id`='{$info['id']}'";
				

				$this->db->query($query);
				echo $this->db->affected_rows();
			}
		
		}
			
			
			
		 }
		
		

		
		
		echo "<br />";
		$this->msg("单词ID: ".$info['id']." 完成！{$info['word']}");		
	}
	
		//下载音频
	function download_mp3($txt,$id,$word){
		$cookie_jar = 'E:/wwwroot/cookie.tmp';
		//http://api.frdic.com/api/v2/speech/speakweb?langid=es&txt=QYNcXVpw6lu

		$src=md5($word);
		$f=substr($src,0,1);
		$l=substr($src,1,1);

		$m="http://api.frdic.com/api/v2/speech/speakweb?langid=es&txt=".$txt;
		//$c=$this->request(0,$m,$cookie_jar,'http://www.esdict.cn/');
		$c=file_get_contents("http://api.frdic.com/api/v2/speech/speakweb?langid=es&txt=".$txt);
		if($c){
			$filename="E:/wwwroot/myfetcher/callback/spword/mp3/{$f}/{$l}/{$src}.mp3";
			//mkdir(dirname($filename),0777,true);
			
			file_put_contents($filename,$c);
			
					
			if(file_exists($filename)){
				$finfo    = finfo_open(FILEINFO_MIME);
				$mimetype = finfo_file($finfo, $filename);
				finfo_close($finfo);
				
				//extension=php_fileinfo.dll 
				if($mimetype=='audio/mpeg; charset=binary'){
					$string="update `{$this->table}` set `audio`='{$src}' where `id`='{$id}'";
					$this->db->query($string);
				}else{
					rename($filename,$filename.'.bak');	
				}
				
			}
			
		}
		
		
	}

//	
}



