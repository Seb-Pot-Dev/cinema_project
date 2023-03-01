<?php
/* On commence et on termine la vue par "ob_start()" et "ob_get_clean()"
On va donc "aspirer" tout ce qui se trouve entre ces 2 fonctions (temporisation de sortie) pour stocker le contenu dans une variable $contenu
*/
ob_start();
$movie = $request_film->fetch();
?>
<a href="index.php?action=listMovies" class="button">Retour</a>
<div class="movie-card-list">
		<div class="movie-card-detail">
			<span><?= $movie["movie_name"] ?></span>
			<span>Un film de <?= $movie["dir_firstname"]." ".$movie["dir_lastname"] ?></span>
			<span>Genre : <?= ucfirst($movie["genre_name"]) ?></span>
			<span>Année de parution : <?= $movie["release_year"] ?></span>
			<span>Durée du film : <?= $movie["movie_length"] ?></span>
			<span>Note : <?php $times = $movie["note"];
			echo str_repeat("<i class='fa-solid fa-star'></i>", $times);
			echo str_repeat("<i class='fa-regular fa-star'></i>", 5-$times); ?> 
			</span>

			<?php 
			// condition pour vérifier si le film possède des acteurs :
			if($request_casting->rowCount()>0){ ?>
			<span>Il y a <?php echo $request_casting->rowCount() ?> acteurs dans ce film : </span>
			
			<!-- boucle foreach afin d'afficher les acteurs du film -->
			<?php foreach($request_casting->fetchAll() as $casting){ ?>
				<span> - <?= $casting["firstname"]." ". $casting["lastname"]." dans le role de ".$casting["role_name"] ?></span>
			<?php } }
			// si le film ne possède pas d'acteurs alors :
			else{ ?>
			<span class="error">Ce film ne possède pas d'acteurs.</span>
			<?php };?>


		</div>
</div>


<?php

$title = "Détails du film";
$secondary_title = "Détails du film";
$content = ob_get_clean();

// Le require de fin permet d'injecter le contenu dans le template "squelette"  > template.php
// Du coup dans notre "template.php" on aura des variables qui vont accueillir les éléments provenant des vues 
// Donc DANS CHAQUE VUE, il faudra toujours donner une valeur à $title, $content et $secondary_title

require "view/template.php";
