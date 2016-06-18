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
							<?php $seats = modelGetAvailableSeats($s["screeningid"]); ?>

							<?php if($seats > 0): ?>
								<p><?= $s["screeningtime"] . " - " . $seats . " place(s) restante(s)" ?></p>

								<form method="post" action="/book/action/<?= $s["screeningid"] ?>">
									<select name="rate">
										<?php foreach($rates as $r): ?>
											<option value="<?= $r["rateid"] ?>"><?= $r["ratename"] . " - " . $r["rateprice"] . "€" ?></option>
										<?php endforeach; ?>
									</select>

									<input type="number" name="amount" placeholder="Quantité">
									<input type="submit" name="submit" value="Réserver">
								</form>
								<br>
							<?php endif; ?>
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
