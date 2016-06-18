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
 * Retourne la liste des tarifs disponibles
 */
function modelGetRates() {
	$db = Database::get();
	return $db->request("SELECT * FROM rate", []);
}

/*
 * Retourne le nombre de place dispobibles pour une projection
 * @param $screeningId ID de la scéance
 */
function modelGetAvailableSeats($screeningId) {
	$db = Database::get();

	$res = $db->request("SELECT RoomCap FROM screening INNER JOIN room ON ScreeningRoom = RoomID WHERE ScreeningID = ? LIMIT 1", [$screeningId]);
	if(!$res) {
		return false;
	}

	$cap = $res[0][0];

	$res = $db->request("SELECT COUNT(*) FROM booking WHERE ScreeningRef = ?", [$screeningId]);
	if(!$res) {
		return false;
	}

	return $cap - $res[0][0];
}

/*
 * Réserve une place pour le client spécifié
 * @param $clientId ID du client
 * @param $screeningId ID de la scéance
 * @param $rateId ID du tarif à appliquer
 * @param $amount Nombre de places à commander
 */
function modelBookScreening($clientId, $screeningId, $rateId, $amount) {
	$db = Database::get();

	for($i = 0; $i < $amount; $i++) {
		$res = $db->request("INSERT INTO booking (RateRef, ClientRef, ScreeningRef) VALUES (?, ?, ?)", [$rateId, $clientId, $screeningId]);
		if(!$res) {
			return false;
		}
	}

	return true;
}

/*
 * Retourne les réservations du client spécifié
 * @param $clientId ID du client concerné
 */
function modelClientBookings($clientId) {
	$db = Database::get();
	$sql = "SELECT BookingID, FilmTitle, RateName, RatePrice, ScreeningRoom, ScreeningDate, ScreeningTime FROM booking " .
		   "INNER JOIN screening ON ScreeningRef = ScreeningID " .
		   "INNER JOIN film ON ScreeningFilm = FilmID " .
		   "INNER JOIN rate ON RateRef = RateID " .
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
