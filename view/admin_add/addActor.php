<?php
ob_start();
?>
<form action="index.php?action=addActor" method="post">

    <label for="first_name">Prénom de l'acteur :</label>
    <input type="textarea" name="firstname" id="first_name">

    <label for="last_name">Nom de l'acteur :</label>
    <input type="textarea" name="lastname" id="last_name">

    <label for="sexe">Sexe de l'acteur :</label>
    <input type="textarea" name="sexe" id="sexe">

    <label for="birthdate">Date de naissance de l'acteur :</label>
    <input type="date" name="birthdate" id="birthdate">

    <input type="submit" name="submit" value="Ajouter l'acteur'">
</form>

<?php
$title = "Ajouter un acteur";
$secondary_title = "Ajouter un acteur a la base de données";
$content = ob_get_clean();
require "view/admin.php"
?>