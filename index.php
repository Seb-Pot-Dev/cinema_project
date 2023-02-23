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
    }
}

// APRES  LA PAUSE MIDI FAIRE LA PAGE INDEX POUR QUE LES CASE TYPE DETAILS MO
// DETAILS MOVIE RENVOIE AU ID CORRESPONDANT
