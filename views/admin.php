<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Cinema - Administration</title>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="<?= WEBROOT ?>/css/admin.css">
	</head>

	<body>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Menu</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Cinema - Administration</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
					<li><a href="#">Link</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="#">Separated link</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="#">One more separated link</a></li>
						</ul>
					</li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">Link</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">Action</a></li>
							<li><a href="#">Another action</a></li>
							<li><a href="#">Something else here</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="#">Separated link</a></li>
						</ul>
					</li>
				</ul>
				</div>
			</div>
		</nav>

		<div class="row">
			<div class="rooms col-md-10 col-md-offset-1">
				<h1>Gestion des salles</h1>

				<table class="table">
					<thead>
						<tr>
							<td>Numéro</td>
							<td>Capacité</td>
							<td>Actions</td>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td>1</td>
							<td>50</td>
							<td><a class="btn btn-danger" href="/admin/delroom">Supprimer</a></td>
						</tr>
					</tbody>
				</table>

				<form class="form" method="post" action="/admin/addrom">
					<input type="number" name="capacity" placeholder="Capacité"><br>
					<input class="btn btn-success" type="submit" value="Ajouter une salle">
				</form>
			</div>
		</div>

		<div class="row">
			<div class="persons col-md-10 col-md-offset-1">
				<h1>Gestion des personnalitées</h1>

				<table class="table">
					<thead>
						<tr>
							<td>Prénom</td>
							<td>Nom</td>
							<td>Actions</td>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td>Emma</td>
							<td>Stone</td>
							<td><a class="btn btn-danger" href="/admin/delperson">Supprimer</a></td>
						</tr>
					</tbody>
				</table>

				<form class="form" method="post" action="/admin/addperson">
					<input type="text" name="firstname" placeholder="Prénom"><br>
					<input type="text" name="lastname" placeholder="Nom"><br>
					<input class="btn btn-success" type="submit" value="Ajouter une personnalitée">
				</form>
			</div>
		</div>

		<div class="row">
			<div class="persons col-md-10 col-md-offset-1">
				<h1>Gestion des films</h1>

				<table class="table">
					<thead>
						<tr>
							<td>ID</td>
							<td>Titre</td>
							<td>Date de sortie</td>
							<td>Description</td>
							<td>URL de la bande annonce</td>
							<td>Actions</td>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td>ID</td>
							<td>Titre</td>
							<td>Date de sortie</td>
							<td>Description</td>
							<td>URL de la bande annonce</td>
							<td><a class="btn btn-danger" href="/admin/delperson">Supprimer</a></td>
						</tr>
					</tbody>
				</table>

				<form class="form" method="post" action="/admin/addfilm">
					<input type="text" name="title" placeholder="Titre"><br>
					<input type="text" name="release" placeholder="Date de sortie"><br>
					<textarea name="desc" placeholder="Description"></textarea><br>
					<input type="text" name="trailer" placeholder="URL de la bande annonce"><br>
					<input class="btn btn-success" type="submit" value="Ajouter un film">
				</form>
			</div>
		</div>

		<div class="row">
			<div class="persons col-md-10 col-md-offset-1">
				<h1>Gestion des équipes</h1>

				<form method="get" action="/admin">
					<p>Film à gérer</p>
					<select name="idfilmstaff">
						<option value="1">Cloud Atlas</option>
					</select>

					<input class="btn btn-success" type="submit" value="Editer">
				</form>

				<table class="table">
					<thead>
						<tr>
							<td>Prénom</td>
							<td>Nom</td>
							<td>Role</td>
							<td>Actions</td>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td>Prénom</td>
							<td>Nom</td>
							<td>Role</td>
							<td><a class="btn btn-danger" href="/admin/delperson">Supprimer</a></td>
						</tr>
					</tbody>
				</table>

				<form class="form" method="post" action="/admin/addrole">
					<select name="person">
						<option value="1">Emma Stone</option>
					</select>
					<br>
					<select name="role">
						<option value="1">Director</option>
						<option value="2">Actor</option>
					</select>
					<br>

					<input class="btn btn-success" type="submit" value="Ajouter un film">
				</form>
			</div>
		</div>

		<div class="row">
			<div class="persons col-md-10 col-md-offset-1">
				<h1>Gestion des projections</h1>

				<table class="table">
					<thead>
						<tr>
							<td>ID</td>
							<td>Film</td>
							<td>Date/heure</td>
							<td>Salle</td>
							<td>Actions</td>
						</tr>
					</thead>

					<tbody>
						<tr>
							<td>ID</td>
							<td>Film</td>
							<td>Date/heure</td>
							<td>Salle</td>
							<td><a class="btn btn-danger" href="/admin/delperson">Supprimer</a></td>
						</tr>
					</tbody>
				</table>

				<form class="form" method="post" action="/admin/addrole">
					<select name="film">
						<option value="1">Cloud Atlas</option>
					</select>
					<br>
					<input type="text" name="datetime"><br>
					<select name="room">
						<option value="1">Salle 1</option>
					</select>
					<br>

					<input class="btn btn-success" type="submit" value="Ajouter un film">
				</form>
			</div>
		</div>

		<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	</body>
</html>
