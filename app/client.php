<?php

$clientPanel = function($request) {
	$ss = Session::get();
	if(!$ss) {
		render("views/error.php", ["message" => "Vous devez vous identifier avant de consulter vos informations"]);
		exit();
	} 

	$bks = modelClientBookings($ss["clientid"]);

	$data = [
		"firstName" => $ss["clientfirstname"],
		"lastName" => $ss["clientlastname"],
		"bks" => $bks
	];

	render("views/clientPanel.php", $data);
};
