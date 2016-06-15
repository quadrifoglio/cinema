<?php

require_once "system/database.php";
require_once "system/utils.php";

/*
 * Film aléatoire
 */
function modelGetRandomFilm() {
	$db = Database::get();

	$res = $db->request("SELECT filmid FROM film OFFSET floor(random()*(select count(*) from film)) LIMIT 1", []);
	if(!$res) {
		return false;
	}

	return $res[0][0];
}

/*
 * Obtenir la liste des films récents
 */
function modelGetRecentFilms() {
	$db = Database::get();

	$res = $db->request("SELECT * FROM film ORDER BY filmrelease DESC", []);
	if(!$res) {
		return false;
	}

	return $res;
}

/*
 * Obtenir les informations de base concernant un film depuis la base de données/
 * @param $id ID du film
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
 * Obtenir les projections d'un film
 * @param $filmId ID du film
 */
function modelGetScreenings($filmId) {
	$db = Database::get();
	$sql = "SELECT * FROM screening WHERE ScreeningFilm = ?";

	$res = $db->request($sql, [$filmId]);
	if(!$res) {
		return false;
	}

	foreach($res as $i => $r) {
		$res[$i]["screeningtime"] = substr($r["screeningtime"], 0, -3); // Suppression de précision horaire inutile: (ex: 13:00:00 -> 13:00)
	}

	return $res;
}

/*
 * Obtenir le staff entier d'un film
 * @param $filmId ID du film
 * @param $more Ajouts à la fin de la requête SQL
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
 * @param $filmId ID du film
 * @param $roleId ID du role
 * @param $more Ajouts à la requête sql
 * @param $stringify Retourne le résultat sous forme de chaine de caractères
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

	if($stringify) {
		$str = "";

		foreach($res as $r) {
			$str .= $r["personfirstname"] . " " . $r["personlastname"] . ", ";
		}

		$res = substr($str, 0, -2);
	}

	return $res;
}
