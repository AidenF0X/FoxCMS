<?php
if(!defined('auth')) {
	die ('{"message": "Not in auth thread"}');
}
	class reg extends authWrapper{
		
		private $regData;
		private $passminCount = 5;
		private $baseUserGroup = 4;
		protected $logger, $db;
		
		function __construct($input, $db, $logger){
			$this->logger = $logger;
			$this->db = $db;
			$this->regData = functions::collectData($input, true);
			$this->checkPass();
			if(!functions::checkExistingData($this->db, 'login', $this->regData['login']) === false){
				exit('{"message": "Данный логин уже зарегистрирован!", "type": "warn"}');
			}
			if(!functions::checkExistingData($this->db, 'email', $this->regData['email']) === false){
				exit('{"message": "Данная почта уже была зарегистрирована!", "type": "warn"}');
			}
			$this->regiter();
		}
		
		private function checkPass() {
			if(functions::FoxesStrlen($this->regData['password']) >= $this->passminCount) {
				if(!preg_match("/[А-Яа-я]/", $this->regData['password'])) {
					switch($this->regData['password']){
						case $this->regData['password2']:
						break;
						
						default:
							functions::jsonAnswer("Пароли не совпадают", true);
						break;
					}
				} else {
					functions::jsonAnswer("pass.badSyms", true);
				}
			} else {
				functions::jsonAnswer("pass.tooShort".functions::FoxesStrlen($this->regData['password']), true);
			}
		}
		
		private function regiter(){
			global $config;
			functions::checkSA($this->regData);
			$this->logger->WriteLine("Trying to register user '".$this->regData['login']."'");
			$password = password_hash($this->regData['password'], PASSWORD_DEFAULT);
			$query = "INSERT INTO `users`(`login`, `password`, `email`, `user_group`, `realname`, `hash`, `reg_date`, `last_date`) 
			VALUES ('".$this->regData['login']."', '".$password."', '".$this->regData['email']."', '".$this->baseUserGroup."', '".randTexts::getRandText('noName')."', '".authorize::generateLoginHash()."', '".CURRENT_TIME."', '".CURRENT_TIME."')";
			$userReg = $this->db->run($query);
			if($userReg) {
				$loadUserInfo = new loadUserInfo($this->regData['login'], $this->db);
				$userData = $loadUserInfo->userInfoArray();
				$this->logger->WriteLine("User has completed registration '".$this->regData['login']."'");
				$sessionManager = new sessionManager($userData);
				functions::jsonAnswer("Registration complete!", false); 
			} else {
				
			}
		}
		
	}
	
