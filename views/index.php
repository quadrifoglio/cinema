<?php foreach($films as $i => $f) : ?>
<section class="film <?= $i % 2 == 0 ? "film-1" : "film-2" ?>">
	<aside class="film-poster left">
	<img src="<?= WEBROOT . "/img/films/" . $f["id"] . ".png" ?>" alt="poster">
	</aside>

	<div class="film-info">
		<header class="film-info-header">
		<h1 class="film-info-header-title"><?= $f["title"] ?></h1>
		</header>

		<div class="film-info-left left">
			<div class="film-info-text">
				<h2>Description</h2>
				<p>
					<?= $f["desc"] ?>
				</p>
			</div>

			<div class="film-info-misc cb">
				<h2>Autres informations</h2>
				<p>
					Réalisateur: <?= $f["dirs"] ?><br>
					Date de sortie: <?= $f["release"] ?><br>
					Avec: <?= $f["topa"] ?>
				</p>

				<a class="white-button" href="/film/<?= $f["id"] ?>">Plus de détails</a>
			</div>
		</div>

		<div class="film-info-times right">
			<h2 class="film-info-title">Horaires</h2>

			<?php foreach($f["scr"] as $s): ?>
				<a class="white-button film-info-time"><?= $s["screeningdate"] . " " . $s["screeningtime"] ?></a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<?php endforeach; ?>
