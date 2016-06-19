<h2 class="sub-header">Gestion des salles</h2>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Capacité</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($rooms as $r): ?>
				<tr>
					<td><?= $r["roomid"] ?></td>
					<td><?= $r["roomcap"] ?></td>
					<td>
						<a class="btn btn-danger" href="<?= ROUTER_PREFIX ?>/admin/screenings/room/delete/<?= $r["roomid"] ?>">Supprimer</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<h2 class="sub-header">Ajouter une salle</h2>
<form method="post" action="<?= ROUTER_PREFIX ?>/admin/screenings/room/add">
	<div class="form-group">
		<label for="id">Numéro (ID)</label>
		<input type="number" class="form-control" id="id" name="id" placeholder="Numero">
	</div>

	<div class="form-group">
		<label for="cap">Capacité</label>
		<input type="number" class="form-control" id="cap" name="cap" placeholder="Nombre de places">
	</div>

	<button type="submit" class="btn btn-success">Valider</button>
</form>

<h2 class="sub-header">Gestion des projections</h2>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Salle</th>
				<th>Film</th>
				<th>Date</th>
				<th>Heure</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($scr as $s): ?>
				<tr>
					<td><?= $s["screeningroom"] ?></td>
					<td><?= $s["filmtitle"] ?></td>
					<td><?= $s["screeningdate"] ?></td>
					<td><?= $s["screeningtime"] ?></td>
					<td>
						<a class="btn btn-danger" href="<?= ROUTER_PREFIX ?>/admin/screenings/delete/<?= $s["screeningid"] ?>">Supprimer</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<h2 class="sub-header">Ajouter une projection</h2>
<form method="post" action="<?= ROUTER_PREFIX ?>/admin/screenings/add">
	<div class="form-group">
		<label for="room">Salle</label>
		<select class="form-control" name="room" id="room">
			<?php foreach($rooms as $r): ?>
				<option value="<?= $r["roomid"] ?>">Salle n°<?= $r["roomid"] ?></option>
			<?php endforeach; ?>
		</select>
	</div>

	<div class="form-group">
		<label for="film">Film</label>
		<select class="form-control" name="film" id="film">
			<?php foreach($films as $f): ?>
			<option value="<?= $f["filmid"] ?>"><?= $f["filmtitle"] ?></option>
			<?php endforeach; ?>
		</select>
	</div>

	<div class="form-group">
		<label for="date">Date</label>
		<input type="text" class="form-control" id="date" name="date" placeholder="Date (AAAA-MM-JJ)">
	</div>

	<div class="form-group">
		<label for="time">Heure</label>
		<input type="text" class="form-control" id="time" name="time" placeholder="Heure (hh:mm)">
	</div>

	<button type="submit" class="btn btn-success">Valider</button>
</form>
