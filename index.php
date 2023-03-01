<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a45e9c27c8.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <header>
      
        <nav>
            
            <a href="http://localhost/sebastien_pothee/cinema_project/index.php">
                <img src="public/img/kisspng-popcorn-caramel-corn-free-content-cinema-clip-art-how-to-draw-popcorn-5a848b58bd54c0.6191740315186358647755.png" alt="logo de votre entreprise">
            </a>
                
            <ul>
                <li><a href="index.php?action=listMovies">Films</a></li>
                <li><a href="index.php?action=listGenres">Genres</a></li>
                <li><a href="index.php?action=listRoles">Roles</a></li>
                <li><a href="index.php?action=listDirectors">Réalisateurs</a></li>
                <li><a href="index.php?action=listCastings">Castings</a></li>
            </ul>
        </nav>
    </header> -->

<?php

use Controller\CinemaController;

spl_autoload_register(function ($class_name) {
	include $class_name . '.php';
});

$ctrlCinema = new CinemaController();

if (isset($_GET["id"])) {
	$id = $_GET["id"];
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
		
	}
} else {
	$ctrlCinema->listMovies();
}


// APRES  LA PAUSE MIDI FAIRE LA PAGE INDEX POUR QUE LES CASE TYPE DETAILS MO
// DETAILS MOVIE RENVOIE AU ID CORRESPONDANT
?>
<!-- </body>

</html> -->