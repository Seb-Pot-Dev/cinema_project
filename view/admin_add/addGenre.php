<?php
ob_start();
?>
<form action="index.php?action=addGenre" method="post">
    <label>Nom du genre :</label>
    <input type="textarea" name="genre_name" id="genre_name">
    <input type="submit" name="submit" value="Ajouter le genre">
</form>

<?php
$title = "Ajouter un genre";
$secondary_title = "Ajouter un genre a la base de données";
$content = ob_get_clean();
require "view/admin.php"
?>