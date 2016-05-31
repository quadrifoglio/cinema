<?php

require_once "system/session.php";
require_once "models/client.php";

$login = function($request) {
	$mail = htmlentities($_POST["mail"]);
	$pass = htmlentities($_POST["password"]);

	if($clientId = modelCheckClientPass($mail, $pass)) {
		Session::start($clientId);
		redirect("/");
	}
	else {
		render("views/error.php", ["message" => "Identifiants incorrects"]);
	}
};

$logout = function($request) {
	if($client = Session::get()) {
		Session::remove($client["clientid"]);
		redirect("/");
	}
};
