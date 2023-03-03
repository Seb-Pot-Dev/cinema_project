<?php
ob_start();
?>
<form action="index.php?action=addActor" method="post">
    <label>Prénom du réalisateur :</label>
    <input type="text" name="first_name" id="first_name">
    <label>Nom du réalisateur :</label>
    <input type="text" name="last_name" id="last_name">
    <label>Sexe du réalisateur :</label>
    <input type="text" name="last_name" id="last_name">
    <label>Date de naissance du réalisateur :</label>
    <input type="date" name="last_name" id="last_name">

    <input type="submit" name="submit" value="Ajouter le réalisateur">
</form>
<?php
$title = "Ajouter un realisateur";
$secondary_title = "Ajouter un realisateur a la base de données";
$content = ob_get_clean();
require "view/admin.php"
?>