<?php

require_once "system/database.php";
require_once "system/utils.php";

/*
 * Obtenir les informations de base concernant un film depuis la base de données/
 */
function modelGetFilm($id) {
	$db = Database::get();

	$res = $db->request("SELECT * FROM film WHERE FilmID = ? LIMIT 1", [$id]);
	if(!$res) {
		return false;
	}

	return $res[0];
}

/*
 * Obtenir le staff entier d'un film
 */
function modelGetFilmStaff($filmId, $more = false) {
	$db = Database::get();

	$sql = "SELECT RoleName, PersonFirstName, PersonLastName " .
		   "FROM staff INNER JOIN role ON RoleIdRef=RoleId ".
		   "INNER JOIN person ON PersonId=PersonIdRef ".
		   "WHERE FilmIdRef = ?";

	if($more) {
		$sql .= " $more";
	}

	$res = $db->request($sql, [$filmId]);
	if(!$res) {
		return false;
	}

	return $res;
}

/*
 * Récupérer les personnes qui occupent un certain role dans l'équipe d'un film
 */
function modelGetFilmRole($filmId, $roleId, $more = false, $stringify = false) {
	$db = Database::get();

	$sql = "SELECT PersonFirstName, PersonLastName " .
		   "FROM staff INNER JOIN role ON RoleIdRef=RoleId ".
		   "INNER JOIN person ON PersonId=PersonIdRef ".
		   "WHERE FilmIdRef = ? AND RoleIdRef = ?";

	if($more) {
		$sql .= " $more";
	}

	$res = $db->request($sql, [$filmId, $roleId]);
	if(!$res) {
		return false;
	}

	return $res;
}
