<?php
ob_start();
?>
<form action="index.php?action=addRole" method="post">
    <label>Nom du rôle :</label>
    <input type="text" name="role_name" id="role_name">
    <input type="submit" name="submit" value="Ajouter le rôle">
</form>

<?php
$title = "Ajouter un rôle";
$secondary_title = "Ajouter un rôle a la base de données";
$content = ob_get_clean();
require "view/admin.php"
?>