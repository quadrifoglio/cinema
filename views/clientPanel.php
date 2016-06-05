<div class="client-panel">
	<h1>Informations - <?= $firstName . " " . $lastName ?></h1>

	<div class="client-screenings">
		<h2>Mes reservations</h2>

		<?php if(count($bks) > 0): ?>
			<table>
				<tr>
					<th>Film</th>
					<th>Date</th>
					<th>Heure</th>
					<th>Salle</th>
					<th>Action</th>
				</tr>

				<?php foreach($bks as $b): ?>
					<tr>
						<td><?= $b["filmtitle"] ?></td>
						<td><?= $b["screeningdate"] ?></td>
						<td><?= $b["screeningtime"] ?></td>
						<td><?= $b["screeningroom"] ?></td>
						<td><a href="/book/cancel/<?= $b["bookingid"] ?>">Annuler</a></td>
					</tr>
				<?php endforeach; ?>
			</table>
		<?php else: ?>
			<p>Vous n'avez aucune réservation</p>
		<?php endif; ?>
	</div>
</div>
