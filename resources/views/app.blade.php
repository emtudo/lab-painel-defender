<!DOCTYPE html>
<html lang="pt_BR" ng-app="app">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Result Systems - Sistema de Teste</title>
	<link rel="stylesheet" href="/assets/css/all.css" rel="stylesheet">
	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<script>
	_token='{{ csrf_token() }}';
	_janela='<?=session_id();?>';
</script>
<div class="container">
	<div class="loading text-center col-sm-12">
	     <h1>Carregando por favor aguarde...</h1>
		<button class="btn btn-lg btn-warning"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>Carregando por favor aguarde...</button><br><br>
		<h2><a href="{{ route('home') }}">Ir para HOME</a></h2>
	</div>

</div>

	<nav class="navbar navbar-default hidden startHidden">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">ResultSystems</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav" ng-controller="geralController">
					<li><a href="{{ route('home') }}">Home</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">MENU<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li class="dropdown-submenu">Opção X - Teste
					        </li>
						</ul>
					</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Configurações
									<span class="glyphicon glyphicon-adjust" aria-hidden="true"></span><span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li class="dropdown-submenu">
						            <a tabindex="0" data-toggle="dropdown">Permissões</a>
						            <ul class="dropdown-menu">
										<li><a href="{!! route('admin.permission.group.create') !!}">Novo grupo de permissões</a></li>
										<li><a href="{!! route('admin.permission.resetall') !!}">Reconfigurar todos</a></li>
						            </ul>
						        </li>
							</ul>
						</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="/auth/login">Login</a></li>
						<li><a href="/auth/register">Criar conta</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">

							@if (isset($_SESSION['Usuario']['Tipo_Usuario']) && $_SESSION['Usuario']['Tipo_Usuario'] == 'adm')
								ROOT
							@else
							{{ ucfirst(current(str_word_count(Auth::user()->name, 2, 'áàãâäÁÀÃÂÄéèẽêëÉÈẼÊËíìĩîïÍÌĨÎÏóòõôöÓÒÕÔÖúùũûüÚÙŨÛÜýỳỹŷÿÝỲỸŶŸçÇ') ))  }}
							@endif
							<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="/auth/logout">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

<?php
/*
	<script src="http://ghiden.github.io/angucomplete-alt/js/libs/angucomplete-alt.js"></script>
*/
?>
@yield('content')
	<!-- Scripts -->
	<script src="/assets/js/all.js"></script>
</body>
</html>
