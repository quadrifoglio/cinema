<?php

require_once "system/session.php";
require_once "models/client.php";

$register = function($request) {
	if(!Session::get()) {
		render("views/register.php", []);
	}
	else {
		redirect("/client");
	}
};

$login = function($request) {
	if(!Session::get()) {
		render("views/login.php", []);
	}
	else {
		redirect("/client");
	}
};

$loginPost = function($request) {
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

$registerPost = function($request) {
	$mail = htmlentities($_POST["mail"]);
	$fname = htmlentities($_POST["fname"]);
	$lname = htmlentities($_POST["lname"]);
	$pass = htmlentities($_POST["password"]);
	$pass2 = htmlentities($_POST["password2"]);
	$age = htmlentities($_POST["age"]);

	if($pass !== $pass2) {
		render("views/error.php", ["message" => "Les mots de passe ne correspondent pas"]);
		exit();
	}

	if(modelRegisterClient($mail, sha1($pass), $fname, $lname, $age)) {
		redirect("/login");
	}
	else {
		render("views/error.php", ["message" => "Erreur lors de l'inscription"]);
	}
};

$logout = function($request) {
	if($client = Session::get()) {
		Session::remove($client["clientid"]);
		redirect("/");
	}
};
