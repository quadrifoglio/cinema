<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Cinema - Administration</title>
		<meta charset="utf-8">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="<?= WEBROOT ?>/css/admin.css">
	</head>

	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Menu</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?= ROUTER_PREFIX ?>/admin">Cinema - Administration</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
					<li><a href="<?= ROUTER_PREFIX ?>/">Retour au site</a></li>
					<li><a href="<?= ROUTER_PREFIX ?>/logout">Déconnexion</a></li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3 col-md-2 sidebar">
					<ul class="nav nav-sidebar">
						<li class="<?= @$page == "dashboard" ? "active" : "" ?>"><a href="<?= ROUTER_PREFIX ?>/admin">Tableau de bord</a></li>
						<li class="<?= @$page == "films" ? "active" : "" ?>"><a href="<?= ROUTER_PREFIX ?>/admin/films">Gestion des films</a></li>
						<li class="<?= @$page == "screenings" ? "active" : "" ?>"><a href="<?= ROUTER_PREFIX ?>/admin/screenings">Gestion des salles/projections</a></li>
						<li class="<?= @$page == "rates" ? "active" : "" ?>"><a href="<?= ROUTER_PREFIX ?>/admin/rates">Gestion des tarifs</a></li>
					</ul>
				</div>

				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
					<?php include $view; ?>
				</div>
			</div>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</body>
</html>
