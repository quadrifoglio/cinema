<?php require_once "system/session.php"; ?>

<!DOCTYPE html>
<html>
	<head>
		<title>Cinema</title>

		<meta charset="utf-8">

		<link rel="stylesheet" type="text/css" href="<?= WEBROOT ?>/css/base.css">
		<link rel="stylesheet" type="text/css" href="<?= WEBROOT ?>/css/layout.css">
		<link rel="stylesheet" type="text/css" href="<?= WEBROOT ?>/css/modules.css">
	</head>

	<body>
		<div class="main-menu left">
			<div class="logo">
				<img src="http://lorempicsum.com/futurama/250/75/1" alt="logo">
			</div>

			<nav class="main-menu-nav">
				<a class="main-menu-nav-item" href="/">Le cinema</a>
				<a class="main-menu-nav-item" href="/">Films à l'affiche</a>

				<?php if(Session::get()): ?>
					<a class="main-menu-nav-item" href="/client">Espace client</a>
					<a class="main-menu-nav-item" href="/logout">Déconnexion</a>
				<?php else: ?>
					<a class="main-menu-nav-item" href="/register">Inscription</a>
				<?php endif; ?>
			</nav>

			<?php if(!Session::get()): ?>
				<form class="main-menu-form" method="post" action="/login">
					<div class="main-menu-form-inputs">
						<h2 class="main-menu-form-title">Connexion</h2>
						<input class="main-menu-form-input" type="email" name="mail" placeholder="Adresse mail">
						<input class="main-menu-form-input" type="password" name="password" placeholder="Mot de passe">
					</div>

					<input class="main-menu-form-submit" type="submit" name="submit" value="Valider">
				</form>
			<?php endif; ?>
		</div>

		<div class="main-content">
			<?php include $view; ?>
		</div>
	</body>
</html>
