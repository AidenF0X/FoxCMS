<?php

define('FOXXEY', true);
require ('data/config.php');
session_start();

	class init {
		
		protected $debug;
		protected $logger;
		protected static $profileBlock = '';
		protected $db;
		
		private $toIncludeArray = array(
			"JS" =>
				array(
				'.js',
				ENGINE_DIR.'/classes/js/',
				true), 
			"CSS" =>
				array(
				'.css',
				ENGINE_DIR.'/skins/css/',
				true));
		
		function __construct($debug = false) {
			global $config;
			
			$this->debug = $debug;
			self::libFilesInclude(ENGINE_DIR.'/lib', $this->debug);
			$this->logger = new Logger('lastlog');
			$this->db = new db($config['dbUser'], $config['dbPass'], $config['dbName'], $config['dbHost']);
			
			require (ENGINE_DIR.'engine.php');
			require (ENGINE_DIR.'/lib/smarty/Smarty.class.php');
			require (ENGINE_DIR.'/classes/user/userInit.class.php');

				$userInit = new userInit();
				$smartyInit = new smartyInit();
		}

		protected function getFilesInc($filetype){
			$allFilesArray = $this->systemLibsInc();
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

		private function systemLibsInc(){
			$filesArray = array();
			foreach ($this->toIncludeArray as $key => $value){
				if($value[2] === true) {
					$filesArray[] = filesInDir::filesInDirArray($value[1], $value[0]);
				}
			}
				
			return $filesArray;
		}

		public static function libFilesInclude($libDir, $debug) {
			global $config;
			$visualCounter = 1;
			$openDir = opendir($libDir);
			if($debug){echo "libraries to include: <br />";}
			while($file = readdir($openDir)){
				if(!is_dir($libDir.'/'.$file)) {
					if($file == '.' || $file == '..'){
						continue;
					} else {
						if($debug){ echo $visualCounter.') '.$file."<br />";$visualCounter++;}
						require_once ($libDir.'/'.$file);
					}
				}
			}
			if($debug){
				echo "<br />";
			}
		}
	}

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
	}