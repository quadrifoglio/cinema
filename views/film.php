<div class="film-details cb">
	<h1><?= $ftitle ?></h1>

	<div class="film-details-left left">
		<div class="film-details-vid">
			<iframe width="853" height="480" src="https://www.youtube.com/embed/YE7VzlLtp-4" frameborder="0" allowfullscreen></iframe>
		</div>

		<div class="film-details-desc">
			<h2>Description</h2>
			<p><?= $fdesc ?></p>
		</div>

		<div class="film-details-info">
			<h2>Informations</h2>
			<p>
				Réalisateur: <?= $fdirs ?><br>
				Date de sortie: <?= $frelease ?><br>
				Avec: <?= $ftopa ?>
			</p>
		</div>

		<div class="film-details-cast">
			<h2>Equipe</h2>

			<table>
				<?php foreach($fteam as $p): ?>
					<tr>
						<td><?= $p["personfirstname"] . " " . $p["personlastname"] ?></td>
						<td><?= $p["rolename"] ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>
	</div>

	<div class="film-details-right right">
		<img class="film-details-poster" src="http://lorempicsum.com/up/300/441/1" alt="poster">

		<div class="film-details-times">
			<h2>Scéances</h2>

			<?php foreach($fscr as $s): ?>
				<a class="white-button film-details-time"><?= $s["screeningdate"] . " " . $s["screeningtime"] ?></a>
			<?php endforeach; ?>
		</div>
	</div>
</div>
