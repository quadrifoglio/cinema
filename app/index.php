<?php

require_once "system/session.php";

$index = function($request) {
	$data = [];
	$films = modelGetRecentFilms();

	foreach($films as $film) {
		$directors = modelGetFilmRole($film["filmid"], ROLE_DIRECTOR, false, true);
		$topActors = modelGetFilmRole($film["filmid"], ROLE_ACTOR, "LIMIT 5", true);
		$scr = modelGetScreenings($film["filmid"]);

		$data["films"][] = [
			"id" => $film["filmid"],
			"title" => $film["filmtitle"],
			"desc" => $film["filmdesc"],
			"dirs" => $directors,
			"topa" => $topActors,
			"release" => $film["filmrelease"],
			"scr" => $scr
		];
	}

	render("views/index.php", $data);
};
