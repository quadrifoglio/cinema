<div class="content client">
	<h1>Espace client - <?= $firstName . " " . $lastName ?></h1>

	<h2>Mes réservation</h2>

	<?php if(count($bks) > 0): ?>
		<table class="client-screenings">
			<tr>
				<td>Titre</td>
				<td>Date</td>
				<td>Heure</td>
				<td>Salle</td>
				<td>Tarif</td>
				<td>Actions</td>
			</tr>

			<?php foreach($bks as $b): ?>
				<tr>
					<td><?= $b["filmtitle"] ?></td>
					<td><?= formatDate($b["screeningdate"]) ?></td>
					<td><?= $b["screeningtime"] ?></td>
					<td><?= $b["screeningroom"] ?></td>
					<td><?= $b["ratename"] . " - " . $b["rateprice"] . "€" ?></td>
					<td><a href="<?= ROUTER_PREFIX ?>/book/cancel/<?= $b["bookingid"] ?>">Annuler</a></td>
				</tr>
			<?php endforeach; ?>
		</table>
	<?php else: ?>
		<p>Vous n'avez aucune réservation</p>
	<?php endif; ?>
</div>
