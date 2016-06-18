<?php require_once "system/session.php"; ?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Cinema</title>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">

		<link rel="stylesheet" type="text/css" href="<?= WEBROOT ?>/css/base.css">
		<link rel="stylesheet" type="text/css" href="<?= WEBROOT ?>/css/page.css">
	</head>

	<body>
		<nav class="nav">
			<div class="nav-top"></div>

			<a class="nav-logo" href="/">
				<img class="nav-logo-img" src="<?= WEBROOT ?>/img/logo.png" alt="logo">
			</a>

			<div class="nav-links">
				<a href="<?= ROUTER_PREFIX ?>/">A l'affiche</a>
				<a href="<?= ROUTER_PREFIX ?>/random">Film au hasard</a>
				<a href="<?= ROUTER_PREFIX ?>/about">A Propos</a>
			</div>
		</nav>

		<?php include $view; ?>

		<footer class="footer">
			<p class="footer-left">Copyleft &copy William Peal - 2016</p>

			<div class="footer-right">
				<?php if(Session::get()): ?>
					<a href="<?= ROUTER_PREFIX ?>/client">Espace client</a>
					<a href="<?= ROUTER_PREFIX ?>/logout">Déconnexion</a>
				<?php else: ?>
					<a href="<?= ROUTER_PREFIX ?>/register">Inscription</a>
					<a href="<?= ROUTER_PREFIX ?>/login">Connexion</a>
				<?php endif; ?>
			</div>
		</footer>
	</body>
</html>
