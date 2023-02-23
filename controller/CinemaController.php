<?php

namespace Controller;

use Model\Connect;

class CinemaController
{

    // Lister les films
    public function listMovies()
    {
        // on se connecte
        $pdo = Connect::connectToDb();
        // on effectue la requette de notre choix

        $request = $pdo->query("
        SELECT movie_name, release_year, genre_name
        FROM movie
        INNER JOIN genre ON genre.id_genre = movie.genre_id
    ");
        //on relie par un require la vue qui nous intéresse (située dans le dossier "view")
        require "view/listMovies.php";
    }

    // Lister les acteurs
    public function listActors()
    {

        $pdo = Connect::connectToDb();
        $request = $pdo->query("
    SELECT firstname, lastname, sexe, birthdate
    FROM actor 
    ");

        require "view/listActors.php";
    }

    // Lister les reals
    public function listDirectors()
    {
        $pdo = Connect::connectToDb();
        $request = $pdo->query("
    SELECT firstname, lastname, sexe, birthdate
    FROM director
    ");

        require "view/listDirectors.php";
    }

    // Lister les genres
    public function listGenres()
    {

        $pdo = Connect::connectToDb();
        $request = $pdo->query("
    SELECT genre_name 
    FROM genre 
    ");

        require "view/listGenres.php";
    }

    // Lister les roles
    public function listRoles()
    {
        $pdo = Connect::connectToDb();
        $request = $pdo->query("
    SELECT role_name
    FROM role 
    ");

        require "view/listRoles.php";
    }
    
    public function listCastings()
    {
        $pdo = Connect::connectToDb();
        $request = $pdo->query("

        SELECT firstname, lastname, role_name, movie_name
        FROM movie
        INNER JOIN casting ON casting.movie_id = movie.id_movie
        INNER JOIN role ON casting.role_id = role.id_role
        INNER JOIN actor ON casting.actor_id = actor.id_actor
    ");

        require "view/listCastings.php";

    }

    // Lister les info d'un film particulier
    public function detailsMovie($id_movie)
    {
        $pdo = Connect::connectToDb();
        $movie_name = "$id_movie";
        $request = $pdo->query("
    SELECT movie_name, release_year, DATE_FORMAT(movie_length, '%H\:%i') AS movie_length, firstname, lastname
    FROM movie 
    WHERE id_movie = '$id_movie'
    INNER JOIN director ON movie.director_id = director.id_director
    ");

        require "view/listMovies.php";
    }

    public function detailsActor($id_actor)
    {
        $pdo = Connect::connectToDb();
        $movie_name = "$id_actor";
        $request = $pdo->query("
    SELECT firstname, lastname, sexe, birthdate
    FROM
    WHERE id_actor = '$id_actor'
    ");

        require "view/detailsActor.php";
    }

}
