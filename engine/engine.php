<?php
if(!defined('FOXXEY')) {
	die ('{"message": "Not in FOXXEY thread"}');
} else {
	if(isset($_REQUEST['userAction'])){
		if(@$_REQUEST['key'] === $config['secureKey']) {
			$engine = new engine($_REQUEST, $this->db, $this->logger);
		} else {
			functions::jsonAnswer('Wrong secure key!', true);
		}
	}
}

	class engine extends init {
		
		function __construct($request = null, $db, $logger){
			$action = $request['userAction'];
			if(@!$_SESSION['isLogged']) {
				if(functions::FoxesStrlen($action) > 0) {
					switch(functions::filterString($action)){

						case 'auth':
						case 'reg':
							require (ENGINE_DIR.'classes/user/authWrapper.class.php');
							$authWrapper = new authWrapper($request, $db, $logger);
						break;
						
						default:
							functions::jsonAnswer('Unknown request!', true);
						break;
						
					}
					
				} else {
					functions::jsonAnswer('No request!', true);
				}
			}
		}
		
	}