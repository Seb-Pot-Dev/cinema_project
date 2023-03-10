<?php
/* On commence et on termine la vue par "ob_start()" et "ob_get_clean()"
On va donc "aspirer" tout ce qui se trouve entre ces 2 fonctions (temporisation de sortie) pour stocker le contenu dans une variable $contenu
*/
ob_start();
?>
<p class="row-count-list"> Il y a <?= $request->rowCount() ?> films</p>

<div class="movie-card-list">
	<?php
	foreach ($request->fetchAll() as $movie) { ?>
		<a href="index.php?action=detailsMovie&id=<?= $movie["id_movie"] ?>">
				<div class="movie-card">
					<div class="movie-card-infos">
					<span><?= $movie["movie_name"] ?></span>
					<span class="release-date"><?= $movie["release_year"] ?></span>
					<span><?= ucfirst($movie["genre_name"]) ?></span>
						
						<?php 
						//convertir les minutes en format HH:ii
						$minutes = $movie["movie_length"];
						$movie_length = date('H:i', mktime(0,$minutes)); 
						?>

					<span ><?= $movie_length ?></span>
				</div>
				<img class="img-film" src="<?= $movie["url_img"]?>" alt="affiche du film <?=$movie["movie_name"]?>">
			</div>
		</a>
	<?php } ?>
</div>
<?php

$title = "Liste des films";
$secondary_title = "Liste des films";
$content = ob_get_clean();

// Le require de fin permet d'injecter le contenu dans le template "squelette"  > template.php
// Du coup dans notre "template.php" on aura des variables qui vont accueillir les éléments provenant des vues 
// Donc DANS CHAQUE VUE, il faudra toujours donner une valeur à $title, $content et $secondary_title

require "view/template.php"; ?>