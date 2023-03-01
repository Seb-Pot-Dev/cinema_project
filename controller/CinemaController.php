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
        SELECT id_movie, movie_name, release_year, genre_name
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
    SELECT genre_name, id_genre
    FROM genre 
    ");

		require "view/listGenres.php";
	}

	// Lister les roles
	public function listRoles()
	{
		$pdo = Connect::connectToDb();
		$request = $pdo->query(
			"SELECT role_name, actor.firstname, actor.lastname, movie.movie_name
        FROM role  
        INNER JOIN casting ON role.id_role = casting.role_id
        INNER JOIN actor ON actor.id_actor = casting.actor_id
        INNER JOIN movie ON casting.movie_id = movie.id_movie"
		);

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
		// --------------- REQUETE POUR LES INFOS D'UN FILM ------------------ //
		$pdo = Connect::connectToDb();
		// on défini la var $movie_name comme étant = a l'id_movie que l'on passe en argument de la fonction detailsMovie
		$movie_name = "$id_movie";
		// on prépare la requete et on l'execute dans un second temps pour éviter l'injection SQL (faille de sécu)
		$request_film = $pdo->prepare("
			SELECT DISTINCT movie_name, release_year, DATE_FORMAT(movie_length, '%H:%i') AS movie_length, synopsis, genre_name, d.firstname AS dir_firstname, d.lastname AS dir_lastname
			FROM movie m
			INNER JOIN director d ON m.director_id = d.id_director
			INNER JOIN genre g ON g.id_genre = m.genre_id
			WHERE  m.id_movie = :id_movie
    	");
		// la fonction native execute prend en argument un tableau associatif où "id_movie" correspond a :id_movie et $id_movie correspond 
		// a la variable passée en argument de la fn detailsMovie
		$request_film->execute(["id_movie" => $id_movie]);


		// --------------- REQUETE POUR LA LISTE DES ACTEURS DU FILM ---------------- //
		$request_casting = $pdo->prepare("
			SELECT firstname, lastname, role_name
			FROM actor a
			INNER JOIN casting c ON c.actor_id = a.id_actor
			INNER JOIN role r ON r.id_role = c.role_id
			INNER JOIN movie m ON m.id_movie = c.movie_id
			WHERE c.movie_id = :id_movie
    	");
		// la fonction native execute prend en argument un tableau associatif où "id_movie" correspond a :id_movie et $id_movie correspond 
		// a la variable passée en argument de la fn detailsMovie
		$request_casting->execute(["id_movie" => $id_movie]);



		require "view/detailsMovie.php";
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

	// public function detailsGenre($id_genre)
	// {
	// 	$pdo = Connect::connectToDb();
	// 	$genre_name = "$id_genre";
	// 	$request = $pdo->prepare("

	// 	"
	// }
