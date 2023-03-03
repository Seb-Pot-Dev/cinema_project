<?php
ob_start();
?>
<form action="index.php?action=addActor" method="post">
    <label>Prénom de l'acteur :</label>
    <input type="text" name="first_name" id="first_name">
    <label>Nom de l'acteur :</label>
    <input type="text" name="last_name" id="last_name">
    <label>Sexe de l'acteur :</label>
    <input type="text" name="last_name" id="last_name">
    <label>Date de naissance de l'acteur :</label>
    <input type="date" name="last_name" id="last_name">

    <input type="submit" name="submit" value="Ajouter l'acteur'">
</form>

<?php
$title = "Ajouter un acteur";
$secondary_title = "Ajouter un acteur a la base de données";
$content = ob_get_clean();
require "view/admin.php"
?>