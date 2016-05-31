<?php

require_once "system/session.php";

$index = function($request) {
	$data = [];
	$films = modelGetRecentFilms();

	foreach($films as $film) {
		$directors = modelGetFilmRole($id, ROLE_DIRECTOR, false, true);
		$topActors = modelGetFilmRole($id, ROLE_ACTOR, "LIMIT 5", true);

		$data[] = [
			"title" => $film["filmtitle"],
			"desc" => $film["filmdesc"],
			"dirs" => $directors,
			"topa" => $topActors,
			"release" => $film["filmrelease"]
		];
	}

	render("views/index.php", $data);
};
