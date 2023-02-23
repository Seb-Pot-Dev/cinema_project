<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    

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
        case "listCasting" : $ctrlCinema->listCasting(); break;
    }
}

// APRES  LA PAUSE MIDI FAIRE LA PAGE INDEX POUR QUE LES CASE TYPE DETAILS MO
// DETAILS MOVIE RENVOIE AU ID CORRESPONDANT
?>
</body>
</html>