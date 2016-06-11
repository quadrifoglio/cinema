<?php

require_once "system/utils.php";
require_once "models/film.php";

const ROLE_DIRECTOR = 1;
const ROLE_ACTOR = 2;

$film = function($request) {
	$id =  $request->getVar("id");

	$film = modelGetFilm($id);
	if(!$film) {
		render("views/error.php", ["message" => "Film introuvable"]);
	}

	$staff = modelGetFilmStaff($id);
	$directors = modelGetFilmRole($id, ROLE_DIRECTOR, false, true);
	$topActors = modelGetFilmRole($id, ROLE_ACTOR, "LIMIT 5", true);
	$scr = modelGetScreenings($film["filmid"]);

	$data = [
		"id" => $film["filmid"],
		"title" => $film["filmtitle"],
		"desc" => $film["filmdesc"],
		"dirs" => $directors,
		"topa" => $topActors,
		"team" => $staff,
		"release" => $film["filmrelease"],
		"scr" => $scr
	];

	render("views/film.php", $data);
};
