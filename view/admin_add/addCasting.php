<?php
ob_start();
?>












<?php
$title = "Ajouter un casting";
$secondary_title = "Ajouter un casting a la base de données";
$content = ob_get_clean();
require "view/admin.php"
?>