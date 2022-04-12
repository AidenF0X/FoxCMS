<?php
if(!defined('auth')) {
	die ('{"message": "Not in auth thread"}');
}
	class sessionManager extends authWrapper {
		
		function __construct($userData) {
			global $config;
			for($i = 0; $i < count($userData); $i++) {
				if($userData[$i]) {
					$_SESSION[$config['userDatainDb'][$i]] = $userData[$i];
				} else {
					$_SESSION[$config['userDatainDb'][$i]] = randTexts::getRandText('noName');
				}
			}
			$_SESSION['isLogged'] = true;
		}
		
	}