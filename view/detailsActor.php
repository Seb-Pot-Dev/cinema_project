<?php
/* On commence et on termine la vue par "ob_start()" et "ob_get_clean()"
On va donc "aspirer" tout ce qui se trouve entre ces 2 fonctions (temporisation de sortie) pour stocker le contenu dans une variable $contenu
*/
ob_start(); 
?>
			<!-- boucle foreach afin d'afficher les films d'un genre -->
<a href="index.php?action=listActors" class="button"><i class="fa-solid fa-arrow-left"></i>Retour</a>
	<div class="movie-card-list">
		
		<div class="movie-card-detail-simple-list">
		<?php 
			if(isset($request_actor_infos)){
				$actor_infos = $request_actor_infos->fetch();
			} ?>
			<span><?=$actor_infos["firstname"]." ".$actor_infos["lastname"]." est né le ".$actor_infos["birthdate"]?></span>
			<span>Il a jouer dans les films suivants : <br><br></span>

			<?php 
			if($request_actor_list_movies->rowCount()>0){
				foreach($request_actor_list_movies->fetchAll() as $actor_movie){ ?>
				<span> - <?= $actor_movie["movie_name"]." (". $actor_movie["release_year"].") 
				dans le role de ".$actor_movie["role_name"]?> </span>
				</div>
			<?php }}
			else{ ?>
				<span class="error">Cet acteur n'a jouer dans aucuns films.</span>
			<?php
			} ?>
</div>


<?php

$title = 'Tout les films dans lequel « '.ucfirst($actor_movie["firstname"])." ".ucfirst($actor_movie["lastname"])." »";
$secondary_title = 'Tout les films dans lequel « '.ucfirst($actor_movie["firstname"])." ".ucfirst($actor_movie["lastname"])." »";

$content = ob_get_clean();

// Le require de fin permet d'injecter le contenu dans le template "squelette"  > template.php
// Du coup dans notre "template.php" on aura des variables qui vont accueillir les éléments provenant des vues 
// Donc DANS CHAQUE VUE, il faudra toujours donner une valeur à $title, $content et $secondary_title

require "view/template.php";
