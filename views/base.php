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
				<a class="main-menu-nav-item" href="#">Le cinéma</a>
				<a class="main-menu-nav-item" href="#">Films à l'affiche</a>
				<a class="main-menu-nav-item" href="#">Film au hasard</a>
			</nav>

			<form class="main-menu-form" method="post">
				<div class="main-menu-form-inputs">
					<h2 class="main-menu-form-title">Connexion</h2>
					<input class="main-menu-form-input" type="text" name="username" placeholder="Nom d'utilisateur">
					<input class="main-menu-form-input" type="password" name="password" placeholder="Mot de passe">
				</div>

				<input class="main-menu-form-submit" type="submit" name="submit" value="Valider">
			</form>
		</div>

		<div class="main-content">
			<?php include $view; ?>
		</div>

	</body>
</html>
