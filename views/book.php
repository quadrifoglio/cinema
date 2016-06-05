<div class="film-book cb">
	<h1>Réservez votre place pour <?= $title ?></h1>

	<form method="post" action="/book">
		<select name="screening">
			<?php foreach($scr as $s): ?>
				<option value="<?= $s["screeningid"] ?>"><?= $s["screeningdate"] . " " . $s["screeningtime"] ?></option>
			<?php endforeach; ?>
		</select>

		<input type="submit" value="Valider">
	</form>
</div>
