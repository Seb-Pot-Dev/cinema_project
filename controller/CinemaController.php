<?php

namespace Controller;

use DateTime;
use Model\Connect;

class CinemaController
{

	/*
	PARTIE
		LISTE
*/


	//***********************Lister les FILMS**************************************************************
	public function listMovies()
	{
		// on se connecte
		$pdo = Connect::connectToDb();
		// on effectue la requette de notre choix

		$request = $pdo->query("
        SELECT id_movie, movie_name, release_year, genre_name, movie_length, url_img
        FROM movie
        INNER JOIN genre ON genre.id_genre = movie.genre_id
		ORDER BY release_year DESC
    ");
		//on relie par un require la vue qui nous intéresse (située dans le dossier "view")
		require "view/listMovies.php";
	}

	//***********************Lister les ACTEURS**************************************************************
	public function listActors()
	{

		$pdo = Connect::connectToDb();
		$request = $pdo->query("
    SELECT firstname, lastname, sexe, DATE_FORMAT(birthdate, '%d-%m-%Y') AS birthdate, id_actor
    FROM actor 
    ");

		require "view/listActors.php";
	}

	//***********************Lister les REALISATEURS**************************************************************
	public function listDirectors()
	{
		$pdo = Connect::connectToDb();
		$request = $pdo->query("
    SELECT firstname, lastname, sexe, birthdate, id_director
    FROM director
    ");

		require "view/listDirectors.php";
	}

	//***********************Lister les FILMS**************************************************************
	public function listGenres()
	{

		$pdo = Connect::connectToDb();
		$request = $pdo->query("
    SELECT genre_name, id_genre
    FROM genre 
    ");

		require "view/listGenres.php";
	}

	//***********************Lister les ROLES**************************************************************
	public function listRoles()
	{
		$pdo = Connect::connectToDb();
		$request = $pdo->query("
			SELECT role_name
			FROM role  
		
			");

		require "view/listRoles.php";
	}
	//***********************Lister les CASTINGS**************************************************************
	public function listCastings()
	{
		$pdo = Connect::connectToDb();
		$request = $pdo->query("
		
			SELECT firstname, lastname, role_name, movie_name, id_movie, id_role, id_actor
			FROM movie
			INNER JOIN casting ON casting.movie_id = movie.id_movie
			INNER JOIN role ON casting.role_id = role.id_role
			INNER JOIN actor ON casting.actor_id = actor.id_actor
    ");

		require "view/listCastings.php";
	}


	/*
	PARTIE
		DETAILS 
*/


	//***********************Lister les INFOS d'un FILM particulier**************************************************************
	public function detailsMovie($id_movie)
	{
		// --------------- REQUETE POUR LES INFOS D'UN FILM ------------------ //
		$pdo = Connect::connectToDb();
		// on défini la var $movie_name comme étant = a l'id_movie que l'on passe en argument de la fonction detailsMovie
		$movie_name = "$id_movie";
		// on prépare la requete et on l'execute dans un second temps pour éviter l'injection SQL (faille de sécu)
		$request_film = $pdo->prepare("
			SELECT movie_name, release_year, movie_length, synopsis, genre_name, d.firstname AS dir_firstname, d.lastname AS dir_lastname, note, url_img, id_director
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
			SELECT firstname, lastname, role_name, a.id_actor
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


	//***********************Lister les INFOS d'un ACTEUR particulier**************************************************************
	public function detailsActor($id_actor)
	{
		// --------------- REQUETE POUR LES INFOS D'UN ACTEUR ------------------ //
		$pdo = Connect::connectToDb();

		$actor_name = "$id_actor";

		$request_actor_infos = $pdo->prepare("
			SELECT a.id_actor, a.firstname, a.lastname, a.sexe, DATE_FORMAT(a.birthdate, '%d/%m/%Y') AS birthdate
			FROM actor a 
			WHERE a.id_actor = :id_actor

		");

		$request_actor_infos->execute(["id_actor" => $id_actor]);

		// --------------- REQUETE POUR LA LISTE DES FILMS D'UN ACTEUR ---------------- //
		$pdo = Connect::connectToDb();

		$actor_name = "$id_actor";

		$request_actor_list_movies = $pdo->prepare("
			SELECT a.id_actor, m.movie_name, m.release_year, r.role_name, m.id_movie
			FROM actor a
			INNER JOIN casting c ON c.actor_id = a.id_actor
			INNER JOIN movie m ON m.id_movie = c.movie_id
			INNER JOIN role r ON r.id_role = c.role_id
			WHERE a.id_actor = :id_actor

		");

		$request_actor_list_movies->execute(["id_actor" => $id_actor]);


		require "view/detailsActor.php";
	}
	//***********************Lister les INFOS d'un GENRE particulier**************************************************************
	public function detailsGenre($id_genre)
	{

		//-------------- REQUETE pour les INFOS d'un GENRE ------------------- //
		$pdo = Connect::connectToDb();
		$genre_name = "$id_genre";
		$request_genre_infos = $pdo->prepare("
			SELECT genre_name, id_genre
			FROM genre
			WHERE id_genre = :id_genre
		");
		$request_genre_infos->execute(["id_genre" => $id_genre]);


		//---------------REQUETE pour la LISTE de films d'un GENRE
		$pdo = Connect::connectToDb();
		$genre_name = "$id_genre";
		$request_genre_list_movies = $pdo->prepare("
			SELECT m.movie_name, m.release_year, m.movie_length, m.genre_id, genre_name, m.id_movie
			FROM movie m 
			INNER JOIN genre g ON g.id_genre = m.genre_id
			WHERE g.id_genre = :id_genre
			ORDER BY release_year DESC
		");
		$request_genre_list_movies->execute(["id_genre" => $id_genre]);


		require "view/detailsGenre.php";
	}
	//***********************Lister les INFOS d'un REALISATEUR particulier**************************************************************

	public function detailsDirector($id_director)
	{
		// request pour afficher les infos du réalisateur
		$pdo = Connect::connectToDb();

		$director_name = "$id_director";

		$request_director_infos = $pdo->prepare("
			SELECT DISTINCT d.id_director, d.firstname, d.lastname, d.birthdate
			FROM director d
			WHERE d.id_director = :id_director
		");

		$request_director_infos->execute(["id_director" => $id_director]);



		// request pour afficher la liste des films du réalisateur

		$pdo = Connect::connectToDb();

		$director_name = "$id_director";

		$request_director_list_movies = $pdo->prepare("
		SELECT  m.movie_name, m.release_year, m.movie_length, id_movie
		FROM director d
		INNER JOIN movie m ON m.director_id = d.id_director
		WHERE d.id_director = :id_director

		");

		$request_director_list_movies->execute(["id_director" => $id_director]);


		require "view/detailsDirector.php";
	}



	/*
	PARTIE
	ADMINISTRATEUR
*/

	//***********************REDIRIGER VERS LA PAGE ADMIN**************************************************************

	public function admin()
	{
		require "view/admin.php";
	}
	//***********************AJOUTER un FILM en BDD**************************************************************
	public function addMovie()
	{

		$pdo = Connect::connectToDb();

		// LIST GENRE pour FORM SELECT
		$requestGenre = $pdo->query("
			SELECT genre_name, id_genre
			FROM genre 
			");

		// LIST DIRECTOR pour FORM SELECT
		$requestDirector = $pdo->query("
		SELECT CONCAT(firstname, ' ', lastname) AS director_fullname, id_director
		FROM director
		");

		// AJOUT des DONNEES en BDD
		if (isset($_POST["submit"])) {

			/*FILTRER l'input pour éviter les failles XSS
					puis l'ASSOCIER a la variable */
			$movie_name = filter_input(INPUT_POST, "movie_name", FILTER_SANITIZE_SPECIAL_CHARS);
			$release_year = filter_input(INPUT_POST, "release_year", FILTER_SANITIZE_NUMBER_INT);
			$movie_length = filter_input(INPUT_POST, "movie_length", FILTER_SANITIZE_NUMBER_INT);
			$synopsis = filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_SPECIAL_CHARS);
			$url_img = filter_input(INPUT_POST, "url_img", FILTER_SANITIZE_SPECIAL_CHARS);
			if (empty($url_img)) {
				$url_img = "public/img/kisspng-popcorn-caramel-corn-free-content-cinema-clip-art-how-to-draw-popcorn-5a848b58bd54c0.6191740315186358647755.png";
			}
			$note = filter_input(INPUT_POST, "note", FILTER_SANITIZE_NUMBER_INT);
			$genre_id = filter_input(INPUT_POST, "genre_id", FILTER_SANITIZE_NUMBER_INT);
			$director_id = filter_input(INPUT_POST, "director_id", FILTER_SANITIZE_NUMBER_INT);


			// VERIFIER que toute les variables ont une valeur
			if ($movie_name && $release_year && $movie_length && $synopsis && $url_img && $note && $genre_id && $director_id) {
				$pdo = Connect::connectToDb();

				//prepare la requete pour éviter les injections SQL puis execute
				$stmt = $pdo->prepare("
				INSERT INTO movie (movie_name, release_year, movie_length, synopsis, url_img, note, genre_id, director_id)
				VALUES (:movie_name, :release_year, :movie_length, :synopsis, :url_img, :note, :genre_id, :director_id)	
				");

				$stmt->execute([
					"movie_name" => $movie_name, "release_year" => $release_year, "movie_length" => $movie_length, "synopsis" => $synopsis, "url_img" => $url_img, "note" => $note, "genre_id" => $genre_id, "director_id" => $director_id
				]);

				header('Location: index.php?action=listMovies');
				die();
			}
		}
		require "view/admin_add/addMovie.php";
	}
	//***********************AJOUTER un GENRE en BDD**************************************************************
	public function addGenre()
	{
		if (isset($_POST["submit"])) {
			/* FILTRER pour eviter failles XSS 
				puis associer a une variable */
			$genre_name = filter_input(INPUT_POST, "genre_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

			//VERIFIER si DEFINI
			if ($genre_name) {
				$pdo = Connect::connectToDb();

				//prepare pour éviter injection SQL puis execute
				$stmt = $pdo->prepare("
				INSERT INTO genre (genre_name)
				VALUES (:genre_name)
				");

				$stmt->execute(["genre_name" => $genre_name]);

				header('Location: index.php?action=listGenres');
				die();
			}
		}

		require "view/admin_add/addGenre.php";
	}

	//***********************AJOUTER un ACTEUR en BDD**************************************************************
	public function addActor()
	{

		if (isset($_POST["submit"])) {
			/* FILTRER pour eviter failles XSS 
				puis associer a une variable */
			$birthdate = filter_input(INPUT_POST, "birthdate", FILTER_SANITIZE_SPECIAL_CHARS);
			$firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_SPECIAL_CHARS);
			$lastname =  filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_SPECIAL_CHARS);
			$sexe =  filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_SPECIAL_CHARS);


			// VERIFIER si DEFINI
			if ($firstname && $lastname && $sexe && $birthdate) {

				$pdo = Connect::connectToDb();

				//prepare pour éviter injection SQL puis execute
				$stmt = $pdo->prepare("
				INSERT INTO actor (firstname, lastname, sexe, birthdate)
				VALUES (:firstname, :lastname, :sexe, :birthdate)
				");

				$stmt->execute(["firstname" => $firstname, "lastname" => $lastname, "sexe" => $sexe, "birthdate" => $birthdate]);

				header('location:index.php?action=listActors');
				die();
			}
		}

		require "view/admin_add/addActor.php";
	}

	//***********************AJOUTER un ROLE en BDD**************************************************************
	public function addRole()
	{
		if (isset($_POST["submit"])) {

			/* FILTRER pour eviter failles XSS 
				puis associer a une variable */
			$role_name = filter_input(INPUT_POST, "role_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

			//VERIFIE si DEFINI
			if ($role_name) {

				$pdo = Connect::connectToDb();

				//prepare pour éviter injection SQL puis execute
				$stmt = $pdo->prepare("
				INSERT INTO role (role_name)
				VALUES (:role_name)
				");

				$stmt->execute(["role_name" => $role_name]);

				header('Location: index.php?action=listRoles');
				die();
			}
		}


		require "view/admin_add/addRole.php";
	}

	//***********************AJOUTER un REALISATEUR en BDD**************************************************************
	public function addDirector()
	{

		if (isset($_POST["submit"])) {

			/* FILTRER pour eviter failles XSS 
				puis associer a une variable */
			$birthdate= filter_input(INPUT_POST, "birthdate", FILTER_SANITIZE_SPECIAL_CHARS);
			$firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_SPECIAL_CHARS);
			$lastname = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_SPECIAL_CHARS);
			$sexe= filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_SPECIAL_CHARS);

			//VERIFIE si DEFINI
			if ($firstname && $lastname && $sexe && $birthdate) {

				$pdo = Connect::connectToDb();

				//prepare pour éviter injection SQL puis execute
				$stmt = $pdo->prepare("
				INSERT INTO director (firstname, lastname, sexe, birthdate)
				VALUES (:firstname, :lastname, :sexe, :birthdate)
				");

				$stmt->execute(["firstname" => $firstname, "lastname" => $lastname, "sexe" => $sexe, "birthdate" => $birthdate]);

				header('location:index.php?action=listDirectors');
				die();
			}
		}

		require "view/admin_add/addDirector.php";
	}

	//***********************AJOUTER un CASTING en BDD**************************************************************
	public function addCasting()
	{
		$pdo = Connect::connectToDb();

		//request ACTOR pour FORM SELECT 
		$requestActor = $pdo->query("
			SELECT CONCAT(firstname, ' ', lastname) AS actor_fullname, id_actor
			FROM actor
		");

		//request ROLE pour FORM SELECT
		$requestRole = $pdo->query("
			SELECT role_name, id_role
			FROM role
		");

		//request GENRE pour FORM SELECT
		$requestMovie = $pdo->query("
			SELECT movie_name, id_movie
			FROM movie
		");

		if (isset($_POST['submit'])) {

			/* FILTRER pour eviter failles XSS 
				puis associer a une variable */
			$actor_id= filter_input(INPUT_POST, "actor_id", FILTER_SANITIZE_SPECIAL_CHARS);
			$role_id = filter_input(INPUT_POST, "role_id", FILTER_SANITIZE_SPECIAL_CHARS);
			$movie_id = filter_input(INPUT_POST, "movie_id", FILTER_SANITIZE_SPECIAL_CHARS);

			//Vérifie si DEFINI 
			if ($actor_id && $role_id && $movie_id) {
				$pdo = Connect::connectToDb();

				$stmt = $pdo->prepare("
					INSERT INTO casting (actor_id, role_id, movie_id)
					VALUES (:actor_id, :role_id, :movie_id)
					");

				$stmt->execute(["actor_id" => $actor_id, "role_id" => $role_id, "movie_id" => $movie_id]);


				header('Location: index.php?action=listCastings');
				die();
			};
		}

		require "view/admin_add/addCasting.php";
	}
}
