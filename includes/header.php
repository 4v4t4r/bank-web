<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php echo $title; ?></title>

	<!--[if lt IE 9]>
	<script src="//oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
	<script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
</head>
<body>
<div class="container">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>

			<div class="brand-centered">
				<a class="navbar-brand" href="https://lockdown.ubnetdef.org/">Federal Bank</a>
			</div>

			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-left">
					<?php foreach ( $navLeft AS $n ): if ( isset($n['show']) && $n['show']($curuser) == false ) continue; ?>
					<li class="<?php echo ($n['name'] == $curnav) ? 'active' : ''; ?>">
						<a href="<?php echo $n['url']; ?>">
							<?php echo $n['name']; ?>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<?php foreach ( $navRight AS $n ): if ( isset($n['show']) && $n['show']($curuser) == false ) continue; ?>
					<li class="<?php echo ($n['name'] == $curnav) ? 'active' : ''; ?>">
						<a href="<?php echo $n['url']; ?>">
							<?php echo $n['name']; ?>
						</a>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</nav>
</div>