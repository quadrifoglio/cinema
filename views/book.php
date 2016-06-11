<div class="content screenings">
	<section class="film-details">
		<h1>Réservez votre place pour <?= $title ?></h1>

		<p class="film-details-desc"><?= $desc ?></p>

		<!--<table class="film-details-screenings">
			<tr>
				<td>Jeudredi 62 Mavril</td>
				<td>
					<a href="#">9h00</a>
					<a href="#">9h00</a>
					<a href="#">9h00</a>
					<a href="#">9h00</a>
				</td>
			</tr>
		</table>-->

		<form method="post" action="/book">
			<select name="screening">
				<?php foreach($scr as $s): ?>
					<option value="<?= $s["screeningid"] ?>"><?= $s["screeningdate"] . " " . $s["screeningtime"] ?></option>
				<?php endforeach; ?>
			</select>

			<input type="submit" value="Valider">
		</form>
	</section>

	<aside class="film-poster">
		<img src="<?= WEBROOT ?>/img/<?= $id ?>.poster.jpg" alt="poster">
	</aside>
</div>
