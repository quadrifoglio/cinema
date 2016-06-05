<?php

require_once "system/session.php";
require_once "models/film.php";
require_once "models/client.php";

$book = function($request) {
	$id =  $request->getVar("id");
	$ss = Session::get();

	if(!$ss) {
		render("views/error.php", ["message" => "Veuillez vous identifier avant de commander une place"]);
		exit();
	}

	$film = modelGetFilm($id);
	if(!$film) {
		render("views/error.php", ["message" => "Film introuvable"]);
		exit();
	}

	$scr = modelGetScreenings($film["filmid"]);

	$data = [
		"id" => $film["filmid"],
		"title" => $film["filmtitle"],
		"release" => $film["filmrelease"],
		"scr" => $scr
	];

	render("views/book.php", $data);
};

$bookAction = function($request) {
	$scrId = isset($_POST["screening"]) ? htmlentities($_POST["screening"]) : false;

	if(!$scrId) {
		render("views/error.php", ["message" => "Veuillez renseigner tous les champs"]);
		exit();
	}

	$ss = Session::get();

	if(!$ss) {
		render("views/error.php", ["message" => "Veuillez vous identifier avant de commander une place"]);
		exit();
	}

	if(!modelBookScreening($ss["clientid"], $scrId)) {
		render("views/error.php", ["message" => "Erreur lors de la commande de la place"]);
		exit();
	}

	redirect("/client");
};

$bookCancel = function($request) {
	$id =  $request->getVar("id");
	$ss = Session::get();

	if(!$ss) {
		render("views/error.php", ["message" => "Veuillez vous identifier avant de commander une place"]);
		exit();
	}

	if(!modelCancelBooking($id, $ss["clientid"])) {
		render("views/error.php", ["message" => "Erreur lors de la suppression de la reservation"]);
		exit();
	}

	redirect("/client");
};
