<?php

class inst extends super_inst{
    public function __construct(){
        parent::__construct();
		$this->table='jpword';
    }
	public function condition(){
		$sql="";
		
		return $sql;
	}
	public function mp3(){
		$this->mymkdir("E:/wwwroot/myfetcher/callback/jpword/mp3/");
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
	public function doit2($info){

		echo $info['japanese'];
		echo "<br />";
		$matches=array();
		//http://dict.hjenglish.com/jp/jc/%E5%8F%A4%E3%81%84
		$url="http://dict.hjenglish.com/jp/jc/".rawurlencode($info['japanese']);
		$c=$this->request(0,$url,$this->cookie_jar,'http://www.godic.net/');
		
		phpQuery::newDocumentHTML($c);
		
		//spell
		// $c2=pq("div.mt10:eq(0) > .trs_jp:eq(1)")->html();
		// if($c2){
			// $c2=str_replace(array('【','】'),'',$c2);
			// $aaa=addslashes(trim($c2));
			// $query="update `{$this->table}` set `spell`='{$aaa}' where `id`='{$info['id']}'";
			// mysql_query($query);
		// }
		//chinese
		$c2=pq("span#comment_0")->html();
		if($c2){
			//
			$c2=explode('<br>',$c2);
			
			$aaa='';
			$bbb='';
			
			foreach($c2 as $kkkkk=>$vvvvv){
				$vvvvv=strip_tags($vvvvv);
				$vvvvv=str_replace('　 ','',$vvvvv);
				$vvvvv=trim($vvvvv);
				if(mb_substr($vvvvv,0,1,'UTF-8')=='（' or $kkkkk==0){
					$aaa.=$vvvvv."\n";
					
				}else{
					
					$bbb.=$vvvvv."||||";
				}
			}
			

			$aaa=addslashes(trim($aaa));

			$bbb=addslashes(trim($bbb));
			$bbb=trim($bbb,'||||');
			
			$ccc=explode('||||',$bbb);
			$ddd=$this->rand($ccc);
			
			//echo $aaa;
			//echo "<hr />";
			//echo $ddd;
			$query="update `{$this->table}` set `chinese`='{$aaa}',`sentence`='{$ddd}' where `id`='{$info['id']}'";
			mysql_query($query);
		}
		//audio
		// $c2=pq(".jpSound:eq(0)")->html();
		
		// if($c2){
			// $c3=preg_match_all('/GetTTSVoice\("(.*?)"\)/ims',$c2,$matches);
			// if($c3){
				// $bbb=trim($matches[1][0]);
				// $this->download_mp3($bbb,$info['id'],$info['japanese']);
			// }
		// }
		
	
		$this->msg("单词ID: ".$info['id']." 完成！{$info['japanese']}");
		
	}
	private function mytrim($aaa){
		$aaa=str_replace("\t",' ',$aaa);
		$aaa=preg_replace("/\n/i"," ",$aaa);
		$aaa=preg_replace("/\r/i"," ",$aaa);
		$aaa=preg_replace('/ {2,}/i',' ',$aaa);
		return $aaa;
	}
	public function doit($info){

		echo $info['japanese'];
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



