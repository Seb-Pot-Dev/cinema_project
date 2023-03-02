<?php
/* On commence et on termine la vue par "ob_start()" et "ob_get_clean()"
On va donc "aspirer" tout ce qui se trouve entre ces 2 fonctions (temporisation de sortie) pour stocker le contenu dans une variable $contenu
*/
ob_start(); 
?>
			<!-- boucle foreach afin d'afficher les films d'un réalisateur -->
			<a href="index.php?action=listDirectors" class="button"><i class="fa-solid fa-arrow-left"></i>Retour</a>
	<div class="movie-card-list">
		
		<div class="movie-card-detail">
		<?php 
			if(isset($request)){
				$director_infos = $request->fetch();
			} ?>
			<span><?=$director_infos["firstname"]." ".$director_infos["lastname"]." est né le ".$director_infos["birthdate"]?><br></span>
			<span>Il a réaliser les films suivants : <br><br></span>

			<?php 
			if($request_director_list_movies->rowCount()>0){
				foreach($request_director_list_movies->fetchAll() as $director_movie){ ?>
				<span> - <a href="index.php?action=detailsMovie&id=<?=$director_movie['id_movie']?>"><?= $director_movie["movie_name"]." (". $director_movie["release_year"].")</a> 
				 "?><br> </span>
			<?php }}
			else{ ?>
				<span class="error">Cet acteur n'a jouer dans aucuns films.</span>
				<?php
			} ?>
			</div>
			</div>


<?php

$title = 'Tout les films réalisés par « '.ucfirst($director_infos["firstname"])." ".ucfirst($director_infos["lastname"])." »";
$secondary_title = 'Tout les films réalisés par « '.ucfirst($director_infos["firstname"])." ".ucfirst($director_infos["lastname"])." »";


$content = ob_get_clean();

// Le require de fin permet d'injecter le contenu dans le template "squelette"  > template.php
// Du coup dans notre "template.php" on aura des variables qui vont accueillir les éléments provenant des vues 
// Donc DANS CHAQUE VUE, il faudra toujours donner une valeur à $title, $content et $secondary_title

require "view/template.php";
