<?php

require_once "system/utils.php";
require_once "models/film.php";

const ROLE_DIRECTOR = 1;
const ROLE_ACTOR = 2;

$filmId = function($request) {
	$id =  $request->getVar("id");

	$film = modelGetFilm($id);
	if(!$film) {
		render("views/error.php", ["message" => "Film introuvable"]);
	}

	$staff = modelGetFilmStaff($id);
	$directors = modelGetFilmRole($id, ROLE_DIRECTOR, false, true);
	$topActors = modelGetFilmRole($id, ROLE_ACTOR, "LIMIT 5", true);

	$data = [
		"ftitle" => $film["filmtitle"],
		"fdesc" => $film["filmdesc"],
		"fdirs" => $directors,
		"ftopa" => $topActors,
		"fteam" => $staff,
		"frelease" => $film["filmrelease"]
	];

	render("views/film.php", $data);
};
