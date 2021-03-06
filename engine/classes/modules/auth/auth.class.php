<?php
if(!defined('FOXXEY')) {
	die("Hacking attempt!");
} else {
	define('auth', true);
}
	if(isset($_REQUEST['userAction'])) {
		if(@$_REQUEST['key'] === $config['secureKey']) {
			$authWrapper = new authWrapper($_REQUEST, $this->db, $this->logger);
		} else {
			functions::jsonAnswer('Wrong secure key!', true);
		}
	}

	class authWrapper extends init {
		
		protected $db;
		protected $logger;
		private $dbShape = "CREATE TABLE IF NOT EXISTS `users` (
		  `user_id` int(8) NOT NULL,
		  `login` varchar(16) NOT NULL,
		  `password` varchar(128) NOT NULL,
		  `email` varchar(64) NOT NULL,
		  `user_group` int(4) NOT NULL,
		  `realname` varchar(32) NOT NULL,
		  `hash` varchar(64) NOT NULL,
		  `reg_date` varchar(32) NOT NULL,
		  `last_date` varchar(32) NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
		
		private $plMount = 'classes';
		
		function __construct($request, $db, $logger){
			$this->db = $db;
			$this->logger = $logger;
			$this->db->run($this->dbShape);
			require(dirname(__FILE__).'/classes/utilsLoader.class.php');
			$utilsLoader = new utilsLoader;
			if(@$request["userAction"] !== '') {
				switch(@$request["userAction"]){
					
					case 'auth':
						require (dirname(__FILE__).'/classes/auth.class.php');
						$auth = new auth($_POST, $this->db, $this->logger);
					break;
							
					case 'reg':
						require (dirname(__FILE__).'/classes/reg.class.php');
						$req = new reg($_REQUEST, $this->db, $this->logger);
					break;
					
					case 'subscribe':
						require (dirname(__FILE__).'/classes/subscribe.class.php');
						$subscribe = new subscribe($_REQUEST, $this->db, $this->logger);
						$subscribe->subscribe();
					break;
							
					default:
					break;
					
				}
			}
		}
		
	}