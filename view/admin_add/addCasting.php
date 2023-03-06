<?php
ob_start();
?>
<label for="">Choisir un film</label>
    <select name="movie_id" id="movie_id">
        <?php 
    </select>

<label for="">Choisir un role</label>



<label for="">Choisir un acteur</label>


// FINIR ICI








<?php
$title = "Ajouter un casting";
$secondary_title = "Ajouter un casting a la base de données";
$content = ob_get_clean();
require "view/admin.php"
?>