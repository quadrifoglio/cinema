<?php

require_once "system/database.php";
require_once "system/utils.php";

/*
 * Vérifie le mot de passe d'un utilisateur en se basant sur mon email
 * Retourne l'ID du client en cas de succès, false sinon
 * @param $mail Mail de l'utilisateur
 */

function modelCheckClientPass($mail, $pass) {
	$db = Database::get();
	$res = $db->request("SELECT ClientID, ClientPass FROM client WHERE ClientMail = ? LIMIT 1", [$mail]);
	if(!$res) {
		return false;
	}

	if(sha1($pass) == $res[0]["clientpass"]) {
		return $res[0]["clientid"];
	}
	else {
		return false;
	}
}
