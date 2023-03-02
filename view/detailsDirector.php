<?php
/* On commence et on termine la vue par "ob_start()" et "ob_get_clean()"
On va donc "aspirer" tout ce qui se trouve entre ces 2 fonctions (temporisation de sortie) pour stocker le contenu dans une variable $contenu
*/
ob_start(); 
?>
			<!-- boucle foreach afin d'afficher les films d'un genre -->
<a href="index.php?action=listDirectors" class="button"><i class="fa-solid fa-arrow-left"></i>Retour</a>
	<div class="movie-card-list">
		<?php 
			if($request->rowCount()>0){
				foreach($request->fetchAll() as $director){ ?>
					<div class="movie-card-detail-simple-list">
				<span> - <?= $director["movie_name"]." ". $director["release_year"]." ".$director["movie_length"] ?> </span>
				</div>
			<?php }}
			else{ ?>
				<span class="error">Ce réalisateur n'as pas encore réalisé de film (AH).</span>
			<?php
			} ?>
</div>


<?php

$title = 'Tout les films réalisés par « '.ucfirst($director["firstname"])." ".ucfirst($director["lastname"])." »";
$secondary_title = 'Tout les films réalisés par « '.ucfirst($director["firstname"])." ".ucfirst($director["lastname"])." »";


$content = ob_get_clean();

// Le require de fin permet d'injecter le contenu dans le template "squelette"  > template.php
// Du coup dans notre "template.php" on aura des variables qui vont accueillir les éléments provenant des vues 
// Donc DANS CHAQUE VUE, il faudra toujours donner une valeur à $title, $content et $secondary_title

require "view/template.php";
