<?php

require_once "system/utils.php";
require_once "system/session.php";
require_once "models/film.php";
require_once "models/client.php";

const RateNormal = 1;
const RateStudent = 2;

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

	$scr = modelGetScreeningsByDate($film["filmid"]);

	$data = [
		"id" => $film["filmid"],
		"title" => $film["filmtitle"],
		"desc" => $film["filmdesc"],
		"release" => $film["filmrelease"],
		"dates" => $scr,
		"rates" => modelGetRates()
	];

	render("views/book.php", $data);
};

$bookAction = function($request) {
	$id =  $request->getVar("id");
	if(!$id) {
		redirect("/");
		exit();
	}

	$ss = Session::get();

	if(!$ss) {
		render("views/error.php", ["message" => "Veuillez vous identifier avant de commander une place"]);
		exit();
	}

	$rate = htmlentities($_POST["rate"]);
	$amount = htmlentities($_POST["amount"]);

	if($rate == RateStudent && $ss["clientage"] > 21) {
		render("views/error.php", ["message" => "Vous devez avoir moins de 21 ans pour réserver un tarif étudiant"]);
		exit();
	}

	$n = modelGetAvailableSeats($id);
	if($n < $amount) {
		render("views/error.php", ["message" => "Nombre de places disponibles insuffisant"]);
		exit();
	}

	if(!modelBookScreening($ss["clientid"], $id, $rate, $amount)) {
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
