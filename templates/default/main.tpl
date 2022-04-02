<html>

<head>	
	<meta charset="utf-8">
	<meta name="HandheldFriendly" content="true">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width, height=device-height"> 
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="default">
	<meta property="og:image" content="{$tplDir}/img/logo.png">
	<link rel="stylesheet" type="text/css" href="{$tplDir}/css/styles.css">
	{$systemJS}
	{$systemCSS}
</head>
	<body id="content">
		{$builtInJS}
		<div class="animated BounceInRight menu-top">
			{include file='logo.tpl'}
			{include file='nav.tpl'}
		</div>

		<main ID="mainCont" class="animated BounceInUp">
		
		</main>

	</body>

</html>