<?php

	class smartyInit extends init {
		
		protected $smarty;
		
		function __construct() {
			global $config;
			$this->smarty = new Smarty;
			$this->smarty->debugging = false;
			$this->smarty->cache_lifetime = 120;
			$this->smarty->assign("systemJS", $this->getFilesInc('JS'));
			$this->smarty->assign("systemCSS", $this->getFilesInc('CSS'));
			$this->smarty->assign("tplDir", "/templates/".$config['siteTpl']);
			$this->smarty->assign("profile", init::$profileBlock);
			$this->smarty->assign("builtInJS", '<script>request = new request("/", {key:"'.$config['secureKey'].'"}, false);formInit(500);</script>');
			$this->smarty->template_dir 	= ROOT_DIR.'/templates/'.$config['siteTpl'];
			$this->smarty->compile_dir 	= ENGINE_DIR.'/cache/compile/';
			$this->smarty->cache_dir 		= ENGINE_DIR.'/cache/cache/';
			$this->smarty->display('main.tpl');
		
		}
		
		protected function getFilesInc($filetype){
			$allFilesArray = $this->systemLibsInc($this->toIncludeArray);
			$outString = "";
			foreach ($allFilesArray as $key){
				switch($filetype){
					case 'JS':
						if(strpos($key[0], $this->toIncludeArray['JS'][0]) !== false){
							foreach($key as $oneFile){
								$outString .= '<script src="/engine/classes/js/'.$oneFile.'"></script>'."\n";
							}
							
						}
					break;
					
					case 'CSS':
						if(strpos($key[0], $this->toIncludeArray['CSS'][0]) !== false) {
							foreach($key as $oneFile){
								$outString .= '<link rel="stylesheet" type="text/css" href="/engine/skins/css/'.$oneFile.'">'."\n";
							}	
						}
					break;
				}
			}
			return $outString;
		}

		private function systemLibsInc($array){
			$filesArray = array();
			foreach ($array as $key => $value){
				if($value[2] === true) {
					$filesArray[] = filesInDir::filesInDirArray($value[1], $value[0]);
				}
			}
				
			return $filesArray;
		}
	}