<div class="content login">
	<h1>Inscription</h1>

	<form method="post" action="<?= ROUTER_PREFIX ?>/register">
		<table>
			<tr>
				<td>Adresse e-mail</td>
				<td><input type="email" name="mail"></td>
			</tr>

			<tr>
				<td>Mot de passe</td>
				<td><input type="password" name="password"></td>
			</tr>

			<tr>
				<td>Confirmation du mot de passe</td>
				<td><input type="password" name="password2"></td>
			</tr>

			<tr>
				<td>Age</td>
				<td><input type="number" name="age"></td>
			</tr>
		</table>

		<input type="submit" value="Valider">
	</form>
</div>
