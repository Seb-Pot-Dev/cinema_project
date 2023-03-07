<?php

namespace Controller;

use DateTime;
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
        SELECT id_movie, movie_name, release_year, genre_name, movie_length, url_img
        FROM movie
        INNER JOIN genre ON genre.id_genre = movie.genre_id
		ORDER BY release_year DESC
    ");
		//on relie par un require la vue qui nous intéresse (située dans le dossier "view")
		require "view/listMovies.php";
	}

	// Lister les acteurs
	public function listActors()
	{

		$pdo = Connect::connectToDb();
		$request = $pdo->query("
    SELECT firstname, lastname, sexe, DATE_FORMAT(birthdate, '%d-%m-%Y') AS birthdate, id_actor
    FROM actor 
    ");

		require "view/listActors.php";
	}

	// Lister les reals
	public function listDirectors()
	{
		$pdo = Connect::connectToDb();
		$request = $pdo->query("
    SELECT firstname, lastname, sexe, birthdate, id_director
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
		
			SELECT firstname, lastname, role_name, movie_name, id_movie, id_role, id_actor
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


	// Lister les infos d'un acteur particulier
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
			SELECT a.id_actor, a.firstname, a.lastname, m.movie_name, m.release_year, m.movie_length, r.role_name, m.id_movie
			FROM actor a
			INNER JOIN casting c ON c.actor_id = a.id_actor
			INNER JOIN movie m ON m.id_movie = c.movie_id
			INNER JOIN role r ON r.id_role = c.role_id
			WHERE a.id_actor = :id_actor

		");

		$request_actor_list_movies->execute(["id_actor" => $id_actor]);


		require "view/detailsActor.php";
	}

	public function detailsGenre($id_genre)
	{

		$pdo = Connect::connectToDb();
		$genre_name = "$id_genre";
		$request = $pdo->prepare("
			SELECT m.movie_name, m.release_year, DATE_FORMAT(m.movie_length, '%H:%i') AS movie_length, m.genre_id, genre_name, m.id_movie
			FROM movie m 
			INNER JOIN genre g ON g.id_genre = m.genre_id
			WHERE g.id_genre = :id_genre
			ORDER BY release_year DESC
		");
		$request->execute(["id_genre" => $id_genre]);

		require "view/detailsGenre.php";
	}

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
	
	public function admin()
	{
		require "view/admin.php";
	}

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


		if(isset($_POST["submit"])){

			$movie_name = $_POST["movie_name"];
			$release_year = $_POST["release_year"];
			$movie_length = $_POST["movie_length"];
			$synopsis = $_POST["synopsis"];
			$url_img = $_POST["url_img"] ?? "public\img\kisspng-popcorn-caramel-corn-free-content-cinema-clip-art-how-to-draw-popcorn-5a848b58bd54c0.6191740315186358647755.png";
			if (empty($url_img)) {
				$url_img = "public\img\kisspng-popcorn-caramel-corn-free-content-cinema-clip-art-how-to-draw-popcorn-5a848b58bd54c0.6191740315186358647755.png";
			}
			$note = $_POST["note"];
			$genre_id = $_POST["genre_id"];
			$director_id=$_POST["director_id"];


			if($movie_name && $release_year && $movie_length && $synopsis && $url_img && $note && $genre_id && $director_id){
				$pdo = Connect::connectToDb();
	
				$stmt = $pdo->prepare("
				INSERT INTO movie (movie_name, release_year, movie_length, synopsis, url_img, note, genre_id, director_id)
				VALUES (:movie_name, :release_year, :movie_length, :synopsis, :url_img, :note, :genre_id, :director_id)	
				");
	
				$stmt->execute(["movie_name"=>$movie_name, "release_year"=>$release_year, "movie_length"=>$movie_length, "synopsis"=>$synopsis, "url_img"=>$url_img, "note"=>$note, "genre_id"=>$genre_id, "director_id"=>$director_id
				]);
	
				header('Location: index.php?action=listMovies');
				die();
			}
		}
		require "view/admin_add/addMovie.php";

		
	}

	public function addGenre()
	{
		if(isset($_POST["submit"])){
			//FILTER
			$_POST["genre_name"]=filter_input(INPUT_POST, "genre_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			
			//ASSOCIATION A VARIABLE
			$genre_name = $_POST["genre_name"];

			//VERIFICATION SI DEFINI
			if($genre_name){
				$pdo = Connect::connectToDb();
				
				
				$stmt =$pdo->prepare("
				INSERT INTO genre (genre_name)
				VALUES (:genre_name)
				");
				
				$stmt->execute(["genre_name"=>$genre_name]);

				header('Location: index.php?action=listGenres');
				die();
			}
		}
		
		require "view/admin_add/addGenre.php";
	}


	public function addActor()
	{

		if(isset($_POST["submit"])){
			//FILTER
			$_POST["birthdate"]= filter_input(INPUT_POST, "birthdate", FILTER_SANITIZE_SPECIAL_CHARS);
			$_POST["firstname"]= filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_SPECIAL_CHARS);
			$_POST["lastname"]= filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_SPECIAL_CHARS);
			$_POST["sexe"]= filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_SPECIAL_CHARS);

			//ASSOCIATION A VARIABLE
			$birthdate=$_POST["birthdate"];
			$firstname=$_POST["firstname"];
			$lastname=$_POST["lastname"];
			$sexe=$_POST["sexe"];

			if($firstname && $lastname && $sexe && $birthdate){

				$pdo = Connect::connectToDb();

				$stmt = $pdo->prepare("
				INSERT INTO actor (firstname, lastname, sexe, birthdate)
				VALUES (:firstname, :lastname, :sexe, :birthdate)
				");

				$stmt->execute(["firstname"=>$firstname, "lastname"=>$lastname, "sexe"=>$sexe, "birthdate"=>$birthdate]);
				
				header('location:index.php?action=listActors');
				die();
				}

			}

		require "view/admin_add/addActor.php";
	}

	
	public function addRole()
	{
		if(isset($_POST["submit"])){

			$role_name=filter_input(INPUT_POST, "role_name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			
			$role_name = $_POST["role_name"];
			
			if($role_name){
				
				$pdo = Connect::connectToDb();
				
				$stmt =$pdo->prepare("
				INSERT INTO role (role_name)
				VALUES (:role_name)
				");
				
				$stmt->execute(["role_name"=>$role_name]);

				header('Location: index.php?action=listRoles');
				die();
			}
		}
		

		require "view/admin_add/addRole.php";
	}
	
	public function addDirector()
	{

		if(isset($_POST["submit"])){
			//FILTER
			$_POST["birthdate"]= filter_input(INPUT_POST, "birthdate", FILTER_SANITIZE_SPECIAL_CHARS);
			$_POST["firstname"]= filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_SPECIAL_CHARS);
			$_POST["lastname"]= filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_SPECIAL_CHARS);
			$_POST["sexe"]= filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_SPECIAL_CHARS);
			
			//ASSOCIATION A VARIABLE
			$birthdate=$_POST["birthdate"];
			$firstname=$_POST["firstname"];
			$lastname=$_POST["lastname"];
			$sexe=$_POST["sexe"];

			if($firstname && $lastname && $sexe && $birthdate){

				$pdo = Connect::connectToDb();

				$stmt = $pdo->prepare("
				INSERT INTO director (firstname, lastname, sexe, birthdate)
				VALUES (:firstname, :lastname, :sexe, :birthdate)
				");

				$stmt->execute(["firstname"=>$firstname, "lastname"=>$lastname, "sexe"=>$sexe, "birthdate"=>$birthdate]);
				
				header('location:index.php?action=listDirectors');
				die();
				}

			}

		require "view/admin_add/addDirector.php";
	}

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

		if(isset($_POST['submit'])){
			$actor_id = $_POST["actor_id"];
			$role_id = $_POST["role_id"];
			$movie_id = $_POST["movie_id"];

				if($actor_id && $role_id && $movie_id){
					$pdo = Connect::connectToDb();
					$pdo->query("
					INSERT INTO casting (actor_id, role_id, movie_id)
					VALUES ($actor_id, $role_id, $movie_id)
					");
					header('Location: index.php?action=listCastings');
					die();
				};
		}


		require "view/admin_add/addCasting.php";
	}
}
