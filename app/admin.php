<?php

require_once "system/session.php";
require_once "models/admin.php";

$adminDash = function($request) {
	if(!Session::admin()) redirect("/");

	$vars = [
		"page" => "dashboard",
		"numRooms" => modelAdminCountRooms(),
		"numFilms" => modelAdminCountFilms(),
		"numScrs" => modelAdminCountScreenings(),
		"numClients" => modelAdminCountClients()
	];

	render("views/admin/dashboard.php", $vars, "views/admin/base.php");
};

$adminFilms = function($request) {
	if(!Session::admin()) redirect("/");

	$vars = [
		"page" => "films",
		"films" => modelAdminListFilms(),
		"roles" => modelAdminListRoles(),
		"persons" => modelAdminListPersons(),
	];

	if(isset($_GET["editFilmId"]) && intval($_GET["editFilmId"]) != 0) {
		$id = htmlentities($_GET["editFilmId"]);
		$film = modelGetFilm($id);

		$vars["editFilmId"] = $id;
		$vars["editFilmTitle"] = $film["filmtitle"];
		$vars["editFilmRelease"] = $film["filmrelease"];
		$vars["editFilmDesc"] = $film["filmdesc"];
		$vars["editFilmTrailer"] = $film["filmtrailer"];
		$vars["editFilmStaff"] = modelGetFilmStaff($id);
	}

	render("views/admin/films.php", $vars, "views/admin/base.php");
};

$adminFilmPost = function($request) {
	if(!Session::admin()) redirect("/");
	$id = $request->getVar("id");

	$title = $_POST["title"];
	$release = $_POST["release"];
	$desc = $_POST["desc"];
	$trailer = $_POST["trailer"];
	if(strlen($title) == 0 || strlen($release) == 0 || strlen($desc) == 0 || strlen($trailer) == 0) {
		render("views/admin/error.php", ["message" => "Formulaire invalide"], "views/admin/base.php");
		exit();
	}
	
	if($id) {
		$ok = modelAdminEditFilm($id, $title, $release, $desc, $trailer);
		if(!$ok) {
			render("views/admin/error.php", ["message" => "Erreur d'insertion en base de données"], "views/admin/base.php");
			exit();
		}
	}
	else {
		modelAdminAddFilm($title, $release, $desc, $trailer);
		$id = modelAdminLastFilmID();
	}

	if(isset($_FILES["thumb"])) {
		$thumb = $_FILES["thumb"];
		$path = realpath(__dir__ . "/../webroot/img");
		$ext = pathinfo($thumb["name"], PATHINFO_EXTENSION);

		if($ext == "jpg" && $thumb["size"] < 512000) {
			move_uploaded_file($thumb["tmp_name"], $path . "/" . $id . ".jpg");
		}
	}

	if(isset($_FILES["poster"])) {
		$poster = $_FILES["poster"];
		$path = realpath(__dir__ . "/../webroot/img");
		$ext = pathinfo($poster["name"], PATHINFO_EXTENSION);

		if($ext == "jpg" && $poster["size"] < 512000) {
			move_uploaded_file($poster["tmp_name"], $path . "/" . $id . ".poster.jpg");
		}
	}

	$vars = [
		"page" => "films",
		"films" => modelAdminListFilms()
	];

	redirect("/admin/films");
};

$adminFilmDel = function($request) {
	if(!Session::admin()) redirect("/");
	$id = $request->getVar("id");

	if(!modelAdminDelFilm($id)) {
		render("views/admin/error.php", ["message" => "Erreur lors de la suppression"], "views/admin/base.php");
		exit();
	}

	redirect("/admin/films");
};

$adminFilmPersonAdd = function($request) {
	if(!Session::admin()) redirect("/");
	$id = $request->getVar("id");

	$fname = $_POST["fname"];
	$lname = $_POST["lname"];

	if(strlen($fname) == 0 || strlen($lname) == 0) {
		render("views/admin/error.php", ["message" => "Formulaire invalide"], "views/admin/base.php");
		exit();
	}

	if(!modelAdminAddPerson($fname, $lname)) {
		render("views/admin/error.php", ["message" => "Erreur d'insertion en base de données"], "views/admin/base.php");
		exit();
	}
	
	redirect("/admin/films");
};

$adminFilmStaffAdd = function($request) {
	if(!Session::admin()) redirect("/");
	$id = $request->getVar("id");

	$role = $_POST["role"];
	$person = $_POST["person"];

	if($role == 0 || $person == 0) {
		render("views/admin/error.php", ["message" => "Formulaire invalide"], "views/admin/base.php");
		exit();
	}

	if(!modelAdminAddStaffMember($id, $role, $person)) {
		render("views/admin/error.php", ["message" => "Erreur d'insertion en base de données"], "views/admin/base.php");
		exit();
	}
	
	redirect("/admin/films?editFilmId=" . $id);
};

$adminFilmStaffDel = function($request) {
	if(!Session::admin()) redirect("/");
	$id = $request->getVar("id");

	$person = $_POST["person"];

	if($person == 0) {
		render("views/admin/error.php", ["message" => "Formulaire invalide"], "views/admin/base.php");
		exit();
	}

	if(!modelAdminDelStaffMember($id, $person)) {
		render("views/admin/error.php", ["message" => "Erreur d'insertion en base de données"], "views/admin/base.php");
		exit();
	}
	
	redirect("/admin/films?editFilmId=" . $id);
};

$adminScreenings = function($request) {
	if(!Session::admin()) redirect("/");

	$vars = [
		"page" => "screenings",
		"rooms" => modelAdminListRooms(),
		"scr" => modelAdminListScreenings(),
		"films" => modelAdminListFilms()
	];

	render("views/admin/screenings.php", $vars, "views/admin/base.php");
};

$adminScreeningsRoomAdd = function($request) {
	if(!Session::admin()) redirect("/");

	$id = intval($_POST["id"]);
	$cap = intval($_POST["cap"]);

	if($id == 0 || $cap == 0) {
		render("views/admin/error.php", ["message" => "Formulaire invalide"], "views/admin/base.php");
		exit();
	}

	if(!modelAdminAddRoom($id, $cap)) {
		render("views/admin/error.php", ["message" => "Erreur d'insertion en base de données"], "views/admin/base.php");
		exit();
	}

	redirect("/admin/screenings");
};

$adminScreeningsRoomDel = function($request) {
	if(!Session::admin()) redirect("/");
	$id = intval($request->getVar("id"));

	if($id == 0) {
		render("views/admin/error.php", ["message" => "Formulaire invalide"], "views/admin/base.php");
		exit();
	}

	if(!modelAdminDelRoom($id)) {
		render("views/admin/error.php", ["message" => "Erreur d'insertion en base de données"], "views/admin/base.php");
		exit();
	}

	redirect("/admin/screenings");
};

$adminScreeningsAdd = function($request) {
	if(!Session::admin()) redirect("/");

	$room = intval($_POST["room"]);
	$film = intval($_POST["film"]);
	$date = $_POST["date"];
	$time = $_POST["time"];

	if($room == 0 || $film == 0 || strlen($date) == 0 || strlen($time) == 0) {
		render("views/admin/error.php", ["message" => "Formulaire invalide"], "views/admin/base.php");
		exit();
	}

	if(!modelAdminAddScreening($room, $film, $date, $time)) {
		render("views/admin/error.php", ["message" => "Erreur d'insertion en base de données"], "views/admin/base.php");
		exit();
	}

	redirect("/admin/screenings");
};

$adminScreeningsDel = function($request) {
	if(!Session::admin()) redirect("/");
	$id = intval($request->getVar("id"));

	if($id == 0) {
		render("views/admin/error.php", ["message" => "Formulaire invalide"], "views/admin/base.php");
		exit();
	}

	if(!modelAdminDelScreening($id)) {
		render("views/admin/error.php", ["message" => "Erreur d'insertion en base de données"], "views/admin/base.php");
		exit();
	}

	redirect("/admin/screenings");
};

$adminRates = function($request) {
	if(!Session::admin()) redirect("/");

	$vars = [
		"page" => "rates",
		"rates" => modelAdminListRates()
	];

	render("views/admin/rates.php", $vars, "views/admin/base.php");
};

$adminRatePost = function($request) {
	if(!Session::admin()) redirect("/");

	$name = $_POST["name"];
	$price = floatval($_POST["price"]);

	if(strlen($name) == 0 || $price == 0) {
		render("views/admin/error.php", ["message" => "Formulaire invalide"], "views/admin/base.php");
		exit();
	}

	if(!modelAdminAddRate($name, $price)) {
		render("views/admin/error.php", ["message" => "Erreur d'insertion en base de données"], "views/admin/base.php");
		exit();
	}

	redirect("/admin/rates");
};

$adminRateDel = function($request) {
	if(!Session::admin()) redirect("/");
	$id = intval($request->getVar("id"));

	if($id == 0) {
		render("views/admin/error.php", ["message" => "Formulaire invalide"], "views/admin/base.php");
		exit();
	}

	if(!modelAdminDelRate($id)) {
		render("views/admin/error.php", ["message" => "Erreur d'insertion en base de données"], "views/admin/base.php");
		exit();
	}

	redirect("/admin/rates");
};
