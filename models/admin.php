<?php

/*
 * Enregister une salle
 * @param $cap Capacité
 */
function modelAdminAddRoom($cap) {
	$db = Database::get();
	return $db->request("INSERT INTO room (RoomCap) VALUES (?)", [$cap]);
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
