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
		<header class="header">
			<img class="header-logo" src="<?= WEBROOT ?>/img/logo.png" alt="logo">

			<div class="header-info-btns">
				<?php if(!Session::get()): ?>
					<a class="button" href="/register">Inscription</a>
					&nbsp&nbsp&nbsp
					<a class="button" href="/login">Connexion</a>
				<?php else: ?>
					<a class="button" href="/client">Espace client</a>
				<?php endif; ?>
			</div>
		</header>

		<section class="brand">
			<?php foreach($films as $i => $f) : ?>
				<div class="brand-film">
				<img src="<?= WEBROOT ?>/img/<?= $f["id"] ?>.png" alt="1">

					<div class="brand-film-info brand-film-info-dark">
						<div class="brand-film-info-content">
							<h2><?= $f["title"] ?></h2>
							<p><?= $f["desc"] ?></p>

							<div class="brand-film-info-btns">
								<a class="button" href="/film/<?= $f["id"] ?>">Plus d'informations</a>
								<a class="button" href="/book/<?= $f["id"] ?>">Réserver une place</a>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</section>

		<footer class="footer">
			<p class="footer-left">Copyleft &copy William Peal - 2016</p>

			<div class="footer-right">
				<?php if(Session::get()): ?>
					<a href="/client">Espace client</a>
					<a href="/logout">Déconnexion</a>
				<?php else: ?>
					<a href="/reigster">Inscription</a>
					<a href="/login">Connexion</a>
				<?php endif; ?>
			</div>
		</footer>
	</body>
</html>
