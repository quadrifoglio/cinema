<h2 class="sub-header">Gestion des tarifs</h2>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Nom</th>
				<th>Prix</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($rates as $r): ?>
				<tr>
					<td><?= $r["ratename"] ?></td>
					<td><?= $r["rateprice"] ?></td>
					<td>
						<a class="btn btn-danger" href="<?= ROUTER_PREFIX ?>/admin/rates/delete/<?= $r["rateid"] ?>">Supprimer</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<h2 class="sub-header">Ajouter un tarif</h2>
<form method="post" action="<?= ROUTER_PREFIX ?>/admin/rates">
	<div class="form-group">
		<label for="name">Nom</label>
		<input type="text" class="form-control" id="name" name="name" placeholder="Nom">
	</div>

	<div class="form-group">
		<label for="price">Prix</label>
		<input type="number" class="form-control" id="price" name="price" placeholder="Prix">
	</div>

	<button type="submit" class="btn btn-success">Valider</button>
</form>
