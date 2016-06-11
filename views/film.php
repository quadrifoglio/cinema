<div class="content film">
	<section class="film-details">
		<h1><?= $title ?></h1>

		<iframe id="video" width="853" height="480" src="https://www.youtube.com/embed/YE7VzlLtp-4" frameborder="0" allowfullscreen></iframe>

		<p class="film-details-desc"><?= $desc ?></p>
		<div class="film-details-info">
			<table>
				<tr>
					<td>Réalisateur(s)</td>
					<td><?= $dirs ?></td>
				</tr>
				<tr>
					<td>Date de sortie</td>
					<td><?= $release ?></td>
				</tr>
				<tr>
					<td>Avec</td>
					<td><?= $topa ?></td>
				</tr>
			</table>
		</div>

		<table class="film-details-staff">
			<?php if($team): foreach($team as $p): ?>
				<tr>
					<td><?= $p["personfirstname"] . " " . $p["personlastname"] ?></td>
					<td><?= $p["rolename"] ?></td>
				</tr>
			<?php endforeach; endif; ?>
		</table>
	</section>

	<aside class="film-poster">
		<img src="<?= WEBROOT ?>/img/<?= $id ?>.poster.jpg" alt="poster">

		<!--<a class="button" href="#">Jeudredi 94 Mavril à 8h00</a>
		<a class="button" href="#">Jeudredi 94 Mavril à 8h00</a>
		<a class="button" href="#">Jeudredi 94 Mavril à 8h00</a>
		<a class="button" href="#">Jeudredi 94 Mavril à 8h00</a>-->
	</aside>
</div>
