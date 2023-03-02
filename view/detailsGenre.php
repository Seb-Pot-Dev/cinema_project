<?php
/* On commence et on termine la vue par "ob_start()" et "ob_get_clean()"
On va donc "aspirer" tout ce qui se trouve entre ces 2 fonctions (temporisation de sortie) pour stocker le contenu dans une variable $contenu
*/
ob_start(); 
?>
			<!-- boucle foreach afin d'afficher les films d'un genre -->
<a href="index.php?action=listGenres" class="button"><i class="fa-solid fa-arrow-left"></i>Retour</a>
	<div class="movie-card-list">
		<?php 
			if($request->rowCount()>0){
				foreach($request->fetchAll() as $genre){ ?>
					<div class="movie-card-detail-simple-list">
				<span> - <a href="index.php?action=detailsMovie&id=<?=$genre['id_movie']?>"><?= $genre["movie_name"]." ". $genre["release_year"]."</a> ".$genre["movie_length"] ?> </span>
				</div>
			<?php }}
			else{ ?>
				<span class="error">Ce film ne possède pas d'acteurs.</span>
			<?php
			} ?>
</div>


<?php

$title = 'Tout les films du genre « '.ucfirst($genre["genre_name"])." »";
$secondary_title = 'Tout les films du genre «'.ucfirst($genre["genre_name"])."»";
$content = ob_get_clean();

// Le require de fin permet d'injecter le contenu dans le template "squelette"  > template.php
// Du coup dans notre "template.php" on aura des variables qui vont accueillir les éléments provenant des vues 
// Donc DANS CHAQUE VUE, il faudra toujours donner une valeur à $title, $content et $secondary_title

require "view/template.php";
