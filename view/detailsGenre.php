<?php
/* On commence et on termine la vue par "ob_start()" et "ob_get_clean()"
On va donc "aspirer" tout ce qui se trouve entre ces 2 fonctions (temporisation de sortie) pour stocker le contenu dans une variable $contenu
*/
ob_start(); 
?>

<a href="index.php?action=listGenres" class="button"><i class="fa-solid fa-arrow-left"></i>Retour</a>
	<div class="movie-card-list">

		<div class="movie-card-detail">
		<?php 
			if(isset($request_genre_infos)){ 
				$genre_infos=$request_genre_infos->fetch();
			}?>
				<span>Ce genre possède les films suivants : <br><br></span>
		<?php
			if($request_genre_list_movies->rowCount()>0){
				foreach($request_genre_list_movies->fetchAll() as $genre_list_movies){ ?>
				<span> - <a href="index.php?action=detailsMovie&id=<?=$genre_list_movies['id_movie']?>"><?= $genre_list_movies["movie_name"]." ". $genre_list_movies["release_year"]."</a> ".$genre_list_movies["movie_length"]?></span>
				
				<?php
}
}else{ ?>
	<span class="error">Aucun films ajoutés a ce genre pour le moment.</span>
	<?php
} ?>
<?php 
$title = 'Tout les films du genre « '.ucfirst($genre_infos["genre_name"])." »";
$secondary_title = 'Tout les films du genre «'.ucfirst($genre_infos["genre_name"])."»";
?>

</div>	
</div>
<?php				
$content = ob_get_clean();

// Le require de fin permet d'injecter le contenu dans le template "squelette"  > template.php
// Du coup dans notre "template.php" on aura des variables qui vont accueillir les éléments provenant des vues 
// Donc DANS CHAQUE VUE, il faudra toujours donner une valeur à $title, $content et $secondary_title

require "view/template.php";?>
