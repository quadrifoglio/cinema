<?php

require_once "system/session.php";

$admin = function($request) {
	$ss = Session::get();
	render("views/admin.php", [], false);
};
