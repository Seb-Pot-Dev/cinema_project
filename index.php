<!DOCTYPE html>
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
            <ul>
                <li><a href="http://localhost:81/sebastien_pothee/cinema_project/index.php"><i class="fa-solid fa-house"></i></a></li>
                <li><a href="http://localhost:81/sebastien_pothee/cinema_project/index.php?action=listMovies">Films</a></li>
                <li><a href="http://localhost:81/sebastien_pothee/cinema_project/index.php?action=listGenres">Genres</a></li>
                <li><a href="http://localhost:81/sebastien_pothee/cinema_project/index.php?action=listRoles">Roles</a></li>
                <li><a href="http://localhost:81/sebastien_pothee/cinema_project/index.php?action=listDirectors">Réalisateurs</a></li>
                <li><a href="http://localhost:81/sebastien_pothee/cinema_project/index.php?action=listCastings">Castings</a></li>            </ul>
        </nav>
    </header>

<?php

use Controller\CinemaController;

spl_autoload_register(function($class_name){
    include $class_name . '.php';
});

$ctrlCinema= new CinemaController();

if(isset($_GET["action"])){
    switch($_GET["action"]){
        case "listMovies" : $ctrlCinema->listMovies(); break;
        case "listActors" : $ctrlCinema->listActors(); break;
        case "listGenres" : $ctrlCinema->listGenres(); break;
        case "listRoles" : $ctrlCinema->listRoles(); break;
        case "listDirectors" : $ctrlCinema->listDirectors(); break;
        case "detailsMovie" : $ctrlCinema->detailsMovie($id_movie); break;
        case "listCastings" : $ctrlCinema->listCastings(); break;
    }
}

// APRES  LA PAUSE MIDI FAIRE LA PAGE INDEX POUR QUE LES CASE TYPE DETAILS MO
// DETAILS MOVIE RENVOIE AU ID CORRESPONDANT
?>
</body>
</html>