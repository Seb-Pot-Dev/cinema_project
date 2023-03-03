<?php
ob_start();
?>
<form action="index.php?action=addMovie" method="post">
    <label>Nom du film :</label>
    <input type="text" name="movie_name" id="movie_name">
    <label>Année de sortie :</label>
    <input type="number" name="release_year" id="release_year">
    <label>Durée du film :</label>
    <input type="number" name="movie_length" id="movie_length">
    <label>Synopsis :</label>
    <input type="text" name="synopsis" id="synopsis">
    <label>URL de l'image (affiche) :</label>
    <input type="text" name="url_img" id="url_img">
    <label>Note du film sur 5 :</label>
    <input type="number" min="0" max="5" name="note" id="note">
    <input type="submit" name="submit" value="Ajouter le movie">
</form>

<?php
$title = "Ajouter un film";
$secondary_title = "Ajouter un film a la base de données";
$content = ob_get_clean();
require "view/admin.php"
?>