<div class="content screenings">
	<section class="film-details">
		<h1>Réservez votre place pour <?= $title ?></h1>

		<p class="film-details-desc"><?= $desc ?></p>

		<table class="film-details-screenings">
			<?php if($dates): foreach($dates as $date => $scr): ?>
				<tr>
					<td><?= formatDate($date) ?></td>
					<td>
						<?php foreach($scr as $s): ?>
							<a href="/book/action/<?= $s["screeningid"] ?>"><?= $s["screeningtime"] ?></a>
						<?php endforeach; ?>
					</td>
				</tr>
			<?php endforeach; endif; ?>
		</table>

	</section>

	<aside class="film-poster">
		<img src="<?= WEBROOT ?>/img/<?= $id ?>.poster.jpg" alt="poster">
	</aside>
</div>
