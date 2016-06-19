<h2 class="sub-header">Gestion des films</h2>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Titre</th>
				<th>Date de sortie</th>
				<th>Description</th>
				<th>Bande annonce</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($films as $f): ?>
				<tr>
					<td><?= $f["filmid"] ?></td>
					<td><?= $f["filmtitle"] ?></td>
					<td><?= $f["filmrelease"] ?></td>
					<td><?= $f["filmdesc"] ?></td>
					<td><?= $f["filmtrailer"] ?></td>
					<td>
						<a class="btn btn-warning" href="<?= ROUTER_PREFIX ?>/admin/films?editFilmId=<?= $f["filmid"] ?>">Modifiter</a>
						<a class="btn btn-danger" href="<?= ROUTER_PREFIX ?>/admin/delfilm/<?= $f["filmid"] ?>">Supprimer</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<h2 class="sub-header"><?= isset($editFilmId) ? "Modifier un film" : "Ajouter un film" ?></h2>
<form method="post" action="<?= ROUTER_PREFIX ?>/admin/films<?= isset($editFilmId) ? "/".$editFilmId : "/" ?>">
	<div class="form-group">
		<label for="title">Titre</label>
		<input type="text" class="form-control" id="title" name="title" placeholder="Titre du film" value="<?= isset($editFilmTitle) ? $editFilmTitle : "" ?>">
	</div>

	<div class="form-group">
		<label for="title">Date de sortie</label>
		<input type="text" class="form-control" id="title" name="release" placeholder="Date de sortie du film" value="<?= isset($editFilmRelease) ? $editFilmRelease : "" ?>">
	</div>

	<div class="form-group">
		<label for="desc">Description</label>
		<textarea class="form-control" id="desc" name="desc" placeholder="Description du film"><?= isset($editFilmDesc) ? $editFilmDesc : "" ?></textarea>
	</div>

	<div class="form-group">
		<label for="trailer">Bande annonce</label>
		<input type="text" class="form-control" id="trailer" name="trailer" placeholder="URL de la bande annonce" value="<?= isset($editFilmTrailer) ? $editFilmTrailer : "" ?>">
	</div>

	<button type="submit" class="btn btn-success">Valider</button>
</form>

<?php if(isset($editFilmId)): ?>
	<h2 class="sub-header">Equipe du film</h2>
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Role</th>
					<th>Prenom</th>
					<th>Nom</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($editFilmStaff as $s): ?>
					<tr>
						<td><?= $s["rolename"] ?></td>
						<td><?= $s["personfirstname"] ?></td>
						<td><?= $s["personlastname"] ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

	<h2 class="sub-header">Ajouter un membre d'équipe</h2>
	<form method="post" action="<?= ROUTER_PREFIX ?>/admin/films/staff/add/<?= $editFilmId ?>">
		<div class="form-group">
			<label for="role">Role</label>
			<select class="form-control" name="role" id="role">
				<?php foreach($roles as $r): ?>
					<option value="<?= $r["roleid"] ?>"><?= $r["rolename"] ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<div class="form-group">
			<label for="person">Personnalitée</label>
			<select class="form-control" name="person" id="person">
				<?php foreach($persons as $p): ?>
					<option value="<?= $p["personid"] ?>"><?= $p["personfirstname"] . " " . $p["personlastname"] ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<button type="submit" class="btn btn-success">Valider</button>
	</form>

	<h2 class="sub-header">Supprimer un membre d'équipe</h2>
	<form method="post" action="<?= ROUTER_PREFIX ?>/admin/films/staff/delete/<?= $editFilmId ?>">
		<div class="form-group">
			<label for="title">Personnalitée</label>
			<select class="form-control" name="person" id="person">
				<?php foreach($editFilmStaff as $p): ?>
					<option value="<?= $p["personid"] ?>"><?= $p["personfirstname"] . " " . $p["personlastname"] ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<button type="submit" class="btn btn-success">Valider</button>
	</form>
<?php endif; ?>
