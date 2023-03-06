<?php
ob_start();
?>
<form action="index.php?action=addDirector" method="post">
    <label>Prénom du réalisateur :</label>
    <input type="text" name="firstname" id="firstname">
    <label>Nom du réalisateur :</label>
    <input type="text" name="lastname" id="lastname">
    <label>Sexe du réalisateur :</label>
    <input type="text" name="sexe" id="sexe">
    <label>Date de naissance du réalisateur :</label>
    <input type="date" name="birthdate" id="birthdate">

    <input type="submit" name="submit" value="Ajouter le réalisateur">
</form>
<?php
$title = "Ajouter un realisateur";
$secondary_title = "Ajouter un realisateur a la base de données";
$content = ob_get_clean();
require "view/admin.php"
?>