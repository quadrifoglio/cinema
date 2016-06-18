<div class="content login">
	<h1>Connexion</h1>

	<form method="post" action="<?= ROUTER_PREFIX ?>/login">
		<table>
			<tr>
				<td>Adresse e-mail</td>
				<td><input type="email" name="mail"></td>
			</tr>

			<tr>
				<td>Mot de passe</td>
				<td><input type="password" name="password"></td>
			</tr>
		</table>

		<input type="submit" value="Valider">
	</form>
</div>
