<?php
if(!defined('FOXXEY')) {
	die("Hacking attempt!");
} else {
	define('profile', true);
}
	$profile = new profile($this->db, $this->logger);


		class profile extends init {
			
			protected $db;
			protected $logger;
			
			function __construct($db, $logger){
				if(@$_SESSION['isLogged']) {
				$this->db = $db;
				$this->logger = $logger;
					require ('userActions.class.php');
					$userActions = new userActions($this->db, $this->logger, $_REQUEST);
					require(dirname(__FILE__).'/classes/shortProfile.class.php');
				}
			}
			
		}