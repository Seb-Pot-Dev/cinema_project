<?php
ob_start();
?>
<form action="index.php?action=addMovie" method="post">

    <label for="movie_name">Nom du film :</label>
    <input type="text" name="movie_name" id="movie_name">

    <label for="release_year">Année de sortie :</label>
    <input type="number" name="release_year" id="release_year">

    <label for="movie_length">Durée du film (en minutes) :</label>
    <input type="number" name="movie_length" id="movie_length">

    <label for="synopsis">Synopsis :</label>
    <input type="text" name="synopsis" id="synopsis">

    <label for="url_img">URL de l'image (affiche) :</label>
    <input type="text" name="url_img" id="url_img">

    <label for="note">Note du film sur 5 :</label>
    <input type="number" min="0" max="5" name="note" id="note">

    <?php

// formulaire "select" pour avoir un menu déroulant 
// le label est associé au select car for = id

// Pour le genre du film

    //définition de la variable en utilisant fetchAll sur la request
$AllGenres=$requestGenre->fetchAll();?>    

    <label for="genre_id">Genre du film : </label>           
        <select name ="genre_id" id="genre_id">
            <?php foreach($AllGenres as $genre){
                echo "<option value='".$genre['id_genre']."'>".$genre['genre_name']."</option>";
            }; ?>
        </select>           

    <?php

// Pour le réalisateur du film
    //définition de la variable en utilisant fetchAll sur la request

$AllDirector=$requestDirector->fetchAll();?>  

    <label for="director_id">Réalisateur du film</label>
        <select name="director_id" id="director_id">
            <?php foreach($AllDirector as $director){
                echo "<option value='".$director['id_director']."'>".$director['director_fullname']."</option>";
        
            }; ?>
        </select>    
<!--Bouton submit du form -->       
    <input type="submit" name="submit" value="Ajouter le movie">
</form>

        
        
        
        <?php
$title = "Ajouter un film";
$secondary_title = "Ajouter un film a la base de données";
$content = ob_get_clean();
require "view/admin.php";
?>