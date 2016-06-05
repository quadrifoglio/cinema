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

/*
 * Réserve une place pour le client spécifié
 * @param $clientId ID du client
 * @param $screeningId ID de la scéance
 */
function modelBookScreening($clientId, $screeningId) {
	$db = Database::get();
	return $db->request("INSERT INTO booking (ClientRef, ScreeningRef) VALUES (?, ?)", [$clientId, $screeningId]);
}

/*
 * Retourne les réservations du client spécifié
 * @param $clientId ID du client concerné
 */
function modelClientBookings($clientId) {
	$db = Database::get();
	$sql = "SELECT BookingID, FilmTitle, ScreeningRoom, ScreeningDate, ScreeningTime FROM booking " .
		   "INNER JOIN screening ON ScreeningRef = ScreeningID " .
		   "INNER JOIN film ON ScreeningFilm = FilmID " .
		   "WHERE ClientRef = ?";

	return $db->request($sql, [$clientId]);
}

/*
 * Annuler une réservation
 * @param $bookingId ID de la réservation
 * @param $clientId ID du client (sécurité)
 */
function modelCancelBooking($bookingId, $clientId) {
	$db = Database::get();
	return $db->request("DELETE FROM booking WHERE BookingID = ? AND ClientRef = ?", [$bookingId, $clientId]);
}
