

<?php

use Controller\CinemaController;

spl_autoload_register(function ($class_name) {
	include $class_name . '.php';
});

$ctrlCinema = new CinemaController();

if (isset($_GET["id"])) {
	($id = filter_var($_GET["id"], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE));
}

if (isset($_GET["action"])) {
	switch ($_GET["action"]) {
		case "listMovies":
			$ctrlCinema->listMovies();
			break;
		case "listActors":
			$ctrlCinema->listActors();
			break;
		case "listGenres":
			$ctrlCinema->listGenres();
			break;
		case "listRoles":
			$ctrlCinema->listRoles();
			break;
		case "listDirectors":
			$ctrlCinema->listDirectors();
			break;
		case "detailsMovie":
			$ctrlCinema->detailsMovie($id);
			break;
		case "listCastings":
			$ctrlCinema->listCastings();
			break;
		case "detailsGenre":
			$ctrlCinema->detailsGenre($id);
			break;
		case "detailsActor":
			$ctrlCinema->detailsActor($id);
			break;
		case "detailsDirector":
			$ctrlCinema->detailsDirector($id);
			break;
		case "admin":
			$ctrlCinema->admin();
			break;
		case "addMovie":
			$ctrlCinema->addMovie();
			break;
		case "addGenre":
			$ctrlCinema->addGenre();
			break;	
		case "addActor":
			$ctrlCinema->addActor();
			break;
		case "addRole":
			$ctrlCinema->addRole();
			break;
		case "addDirector":
			$ctrlCinema->addDirector();
			break;
		case "addCasting":
			$ctrlCinema->addCasting();
			break;
	}
} else {
	$ctrlCinema->listMovies();
}



?>
