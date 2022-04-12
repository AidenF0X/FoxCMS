<?php
	define('ROOT_DIR', 	$_SERVER['DOCUMENT_ROOT']);
	define('ENGINE_DIR',ROOT_DIR.'/engine/');
	define('CURRENT_TIME',time());
	define('CURRENT_DATE',date("d.m.Y"));
	define('REMOTE_IP',   getenv('REMOTE_ADDR'));
	
	$config = array(
	
		/* DATABASE */
		'dbHost' =>  'localhost',
		'dbUser' =>  'root',
		'dbPass' => 'P$Ak$O2sJZSu$aAKOBqkokf@Vs5%YCj',
		'dbName' => 'fox_radio',
		
		'siteTpl' => 'bootstrap',
		'timezone'=> 'Europe/Moscow',
		'webserviceName'=> 'FoxEngine',
		'secureKey' => 'ghYyufghVH',
		
		'radioStream' => "https://radio.macros-core.com:8443/live",
		
		/* AUTHORISATION */
		'bantime'			=> CURRENT_TIME + (120),
		'maxLoginAttempts'	=> 1,
		
	/*WebSite Appeareance*/
	
		/*Title*/
		'title' => 'FoxEngine',
		'status' => 'Alpha',
		
		/* LINKS */
		'links' => array(
		array('TressModal', '#tess', '<i class="bi bi-bug"></i>'),
		array('Wesp', 'wesp.ru', '<i class="bi bi-emoji-wink"></i>')
		),
		'additionalString' => 'onclick="$(this).notify(\'Work In Progress!\', \'info\'); return false" class="nav-link scrollto"',
		
		/* UserSettings */
		'userDatainDb'   => array("user_id", "email", "login", "password", "user_group", "realname", "hash", "reg_date", "last_date"),
		'userDataToShow' => array('login', 'realname', 'user_group', 'email'),
		'filterSymbols'  => array ("\x22", "\x60", "\t", '\n', '\r', "\n", "\r", '\\', ",", "/", "¬", "#", ";", ":", "~", "[", "]", "{", "}", ")", "(", "*", "^", "%", "$", "<", ">", "?", "!", '"', "'", " ", "&", '"' )
	
	);
	
	class initConfig {
		
		//Plugins to include
		//{Name} => (type, path, exclude, enabled)
		protected $toIncludeArray = array(
			"BaseJS" 			=>	array('.js',  ENGINE_DIR.'plugins/', 				'', 	true),
			"FoxEngineJS" 		=>	array('.js',  ENGINE_DIR.'plugins/FoxEngine/js/', 	'', 	true),
			"FoxEngineCSS" 		=>	array('.css', ENGINE_DIR.'plugins/FoxEngine/css/', 	'', 	true),
			"PopperJS" 			=>	array('.js',  ENGINE_DIR.'plugins/Popper/', 		'.map', true),
			"BootstrapJS" 		=>	array('.js',  ENGINE_DIR.'plugins/Bootstrap/js/', 	'.map', true),
			"BootstrapCSS" 		=>	array('.css', ENGINE_DIR.'plugins/Bootstrap/css/', 	'.map', true),
			"Bootstrap-icons" 	=>	array('.css', ENGINE_DIR.'plugins/Bootstrap-icons/','', 	true),
			"GlightboxCSS" 		=>	array('.css', ENGINE_DIR.'plugins/Glightbox/css/', 	'', 	true),
			"GlightboxJS" 		=>	array('.js',  ENGINE_DIR.'plugins/Glightbox/js/', 	'', 	true),
			"FoxModalCSS" 		=>	array('.css', ENGINE_DIR.'plugins/FoxModal/css/', 	'', 	true),
			"FoxModalJS" 		=>	array('.js',  ENGINE_DIR.'plugins/FoxModal/js/', 	'', 	true),
			"SwipwerCSS" 		=>	array('.css', ENGINE_DIR.'plugins/Swiper/', 		'', 	true),
			"SwiperJS" 			=>	array('.js',  ENGINE_DIR.'plugins/Swiper/', 		'.map', true),
			"PaceCSS" 			=>	array('.css', ENGINE_DIR.'plugins/Pace/', 			'', 	true),
			"PaceJS" 			=>	array('.js',  ENGINE_DIR.'plugins/Pace/', 			'', true),
			"aosJS" 			=>	array('.js',  ENGINE_DIR.'plugins/aos/', 			'', 	true),
			"aosCSS" 			=>	array('.css',  ENGINE_DIR.'plugins/aos/', 			'', 	true));
		
		//Modals to unlogged
		protected $modalsUnlogged = array(
			"login" => array("Авторизация", "Что бы на сайт войти логин и пароль нам нужно ввести", "%file:=auth"),
			"reg" 	=> array("Регистрация", "Регистрируйтесь пожалуйста", "%file:=reg")
		);
		
		protected $modalsLogged = array(
			"cp" => array("Личный кабинет", "Посмотрим, что мы тут можем поменять...", "%file:=cp")
		);
		
	}