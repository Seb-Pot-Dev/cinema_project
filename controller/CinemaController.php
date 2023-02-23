<?php

namespace Controller;
use Model\Connect;

class CinemaController {

// Lister les films
public function listMovies() {
    // on se connecte
    $pdo = Connect::connectToDb();
    // on effectue la requette de notre choix
    $request = $pdo->query("
    SELECT movie_name, release_date
    FROM movie
    ");
    //on relie par un require la vue qui nous intéresse (située dans le dossier "view")
    require "view/listMovies.php";
}

// Lister les acteurs
public function listActors() {

    $pdo = Connect::connectToDb();
    $request = $pdo->query("
    SELECT firstname, lastname, sexe, birthdate
    FROM actor 
    ");

    require "view/listActors.php";
}

// Lister les reals
public function listDirectors() {

    $pdo = Connect::connectToDb();
    $request = $pdo->query("
    SELECT firstname, lastname, sexe, birthdate
    FROM directors
    ");

    require "view/listDirectors.php";
}

// Lister les genres
public function listGenres() {

    $pdo = Connect::connectToDb();
    $request = $pdo->query("
    SELECT genre_name 
    FROM genre 
    ");

    require "view/listGenre.php";
}

// Lister les roles
public function listRoles() {
    $pdo = Connect::connectToDb();
    $request = $pdo->query("
    SELECT role_name
    FROM role 
    ");

    require "view/listRoles.php"
}

// Lister les info d'un film particulier
public function InfoFromMovie($movie_name) {
    $pdo = Connect::connectToDb();
    $movie_name="$movie_name";
    $request = $pdo->query("
    SELECT movie_name, release_year, DATE_FORMAT(movie_length, '%H\:%i') AS movie_length, firstname, lastname
    FROM movie 
    WHERE movie_name = '$movie_name'
    INNER JOIN director ON movie.director_id = director.id_director
    ");

    require "view/listMovie.php";

}

}