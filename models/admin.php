<?php

require_once "system/database.php";

/*
 * Compter les salles
 */
function modelAdminCountRooms() {
	$db = Database::get();
	return $db->request("SELECT COUNT(*) FROM room", [])[0][0];
}

/*
 * Compter les films
 */
function modelAdminCountFilms() {
	$db = Database::get();
	return $db->request("SELECT COUNT(*) FROM film", [])[0][0];
}

/*
 * Compter les projections
 */
function modelAdminCountScreenings() {
	$db = Database::get();
	return $db->request("SELECT COUNT(*) FROM screening", [])[0][0];
}

/*
 * Compter les clients
 */
function modelAdminCountClients() {
	$db = Database::get();
	return $db->request("SELECT COUNT(*) FROM client", [])[0][0];
}

/*
 * Lister les films
 */
function modelAdminListFilms() {
	$db = Database::get();
	return $db->request("SELECT * FROM film ORDER BY FilmRelease DESC", []);
}

/*
 * ID de film disponible
 */
function modelAdminFreeFilmID() {
	$db = Database::get();
	return $db->request("SELECT FilmID FROM film ORDER BY FilmID DESC LIMIT 1", [])[0]["filmid"] + 1;
}

/*
 * Enregister une salle
 * @param $id ID (numero) de la salle
 * @param $cap Capacité
 */
function modelAdminAddRoom($id, $cap) {
	$db = Database::get();
	return $db->request("INSERT INTO room VALUES (?, ?)", [$id, $cap]);
}

/*
 * Supprimer une salle
 * @param $id ID de la salle
 */
function modelAdminDelRoom($id) {
	$db = Database::get();
	return $db->request("DELETE FROM room WHERE RoomID = ?", [$id]);
}

/*
 * Lister les tarifs
 */
function modelAdminListRates() {
	$db = Database::get();
	return $db->request("SELECT * FROM rate ORDER BY RateID", []);
}

/*
 * Enregister un tarif
 * @param $name Nom
 * @param $price Prix
 */
function modelAdminAddRate($name, $price) {
	$db = Database::get();
	return $db->request("INSERT INTO rate (RateName, RatePrice) VALUES (?, ?)", [$name, $price]);
}

/*
 * Supprimer un tarif
 * @param $id ID du tarif
 */
function modelAdminDelRate($id) {
	$db = Database::get();
	return $db->request("DELETE FROM rate WHERE RateID = ?", [$id]);
}

/*
 * Enregister une personnalitée
 * @param $fname Prénom
 * @param $lname Nom
 */
function modelAdminAddPerson($fname, $lname) {
	$db = Database::get();
	return $db->request("INSERT INTO person (PersonFirstName, PersonLastName) VALUES (?, ?)", [$fname, $lname]);
}

/*
 * Enregister un film
 * @param $title Titre
 * @param $release Date de sortie
 * @param $desc Résumé
 * @param $trailer URL Youtube de la bance annonce
 */
function modelAdminAddFilm($title, $release, $desc, $trailer) {
	$db = Database::get();
	return $db->request("INSERT INTO film (FilmTitle, FilmRelease, FilmDesc, FilmTrailer) VALUES (?, ?, ?, ?)", [$title, $release, $desc, $trailer]);
}

/*
 * Editer un film
 * @param $id ID du film
 * @param $title Titre
 * @param $release Date de sortie
 * @param $desc Résumé
 * @param $trailer URL Youtube de la bance annonce
 */
function modelAdminEditFilm($id, $title, $release, $desc, $trailer) {
	$db = Database::get();
	return $db->request("UPDATE film SET FilmTitle = ?, FilmRelease = ?, FilmDesc = ?, FilmTrailer = ? WHERE FilmId = ?", [$title, $release, $desc, $trailer, $id]);
}

/*
 * Supprimer un film
 * @param $id ID du film
 */
function modelAdminDelFilm($id) {
	$db = Database::get();
	return $db->request("DELETE FROM film WHERE FilmID = ?", [$id]);
}

/*
 * Lister les rôles
 */
function modelAdminListRoles() {
	$db = Database::get();
	return $db->request("SELECT * FROM role", []);
}

/*
 * Lister les personnalitées
 */
function modelAdminListPersons() {
	$db = Database::get();
	return $db->request("SELECT * FROM person", []);
}

/*
 * Enregister un membre du staff d'un film
 * @param $filmId ID du film
 * @param $roleId ID du role
 * @param $personId ID de la personnalitée
 */
function modelAdminAddStaffMember($filmId, $roleId, $personId) {
	$db = Database::get();
	return $db->request("INSERT INTO staff (FilmIDRef, RoleIDRef, PersonIDRef) VALUES (?, ?, ?)", [$filmId, $roleId, $personId]);
}

/*
 * Supprimer un membre du staff d'un film
 * @param $filmId ID du film
 * @param $personId ID de la personnalitée
 */
function modelAdminDelStaffMember($filmId, $personId) {
	$db = Database::get();
	return $db->request("DELETE FROM staff WHERE FilmIDRef = ? AND PersonIDRef = ?", [$filmId, $personId]);
}

/*
 * Lister les salles
 */
function modelAdminListRooms() {
	$db = Database::get();
	return $db->request("SELECT * FROM room ORDER BY RoomID", []);
}

/*
 * Lister les projection
 */
function modelAdminListScreenings() {
	$db = Database::get();
	$sql = "SELECT ScreeningID, FilmTitle, ScreeningDate, ScreeningTime, ScreeningRoom FROM screening " .
		   "INNER JOIN film ON ScreeningFilm = FilmID " .
		   "ORDER BY ScreeningDate DESC";

	return $db->request($sql, []);
}

/*
 * Enregister une projection
 * @param $roomId ID de la salle
 * @param $filmId ID du film
 * @param $date Date
 * @param $time Heure
 */
function modelAdminAddScreening($roomId, $filmId, $date, $time) {
	$db = Database::get();
	return $db->request("INSERT INTO screening (ScreeningRoom, ScreeningFilm, ScreeningDate, ScreeningTime) VALUES (?, ?, ?, ?)", [$roomId, $filmId, $date, $time]);
}

/*
 * Supprimer une projection
 * @param $id ID de la projection
 */
function modelAdminDelScreening($id) {
	$db = Database::get();
	return $db->request("DELETE FROM screening WHERE ScreeningID = ?", [$id]);
}
