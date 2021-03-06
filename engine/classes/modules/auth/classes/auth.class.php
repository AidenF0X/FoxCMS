<?php
if(!defined('auth')) {
	die ('{"message": "Not in auth thread"}');
}
	class auth extends authWrapper {
		
		private $authData = array();
		
		function __construct($input, $db, $logger){
			global $config;
			$this->authData = functions::collectData($input, true);
			$inputPassword = $this->authData['password'];
			$userPassword = functions::getUserData($this->authData['login'], 'password', $db);
			if(authorize::passVerify($inputPassword, $userPassword)) {
				$this->authUpdates($this->authData['login'], $db);

				$loadUserInfo = new loadUserInfo($this->authData['login'], $db);
				$userData = $loadUserInfo->userInfoArray();

				$sessionManager = new sessionManager($userData);
				$logger->WriteLine($this->authData['login']." successfuly authorised");
				functions::jsonAnswer("Успешная авторизация!", false);
			} else {
				$logger->WriteLine($this->authData['login']." failed authorisation with password ".$this->authData['password']);
				$antiBrute = new antiBrute(REMOTE_IP, $db, false);
				functions::jsonAnswer("Неверный логин или пароль!");
			}
		}
		
		private function authUpdates($login, $db){
			$query = "UPDATE `users` SET hash='".authorize::generateLoginHash()."', last_date='".CURRENT_TIME."' WHERE login = '".$login."'";
			$db->query($query);
		}
	}