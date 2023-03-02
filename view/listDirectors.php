<?php
/* On commence et on termine la vue par "ob_start()" et "ob_get_clean()"
On va donc "aspirer" tout ce qui se trouve entre ces 2 fonctions (temporisation de sortie) pour stocker le contenu dans une variable $contenu
*/
ob_start();
?>
<p class="row-count-list"> Il y a <?= $request->rowCount() ?> réalisateurs</p>

<table>
    
    <div class="movie-card-list">
        <?php
        foreach ($request->fetchAll() as $director) { ?>
            <div class="movie-card-person">
                <a href="index.php?action=detailsDirector&id=<?= $director["id_director"] ?>">
                    <span><?= $director["firstname"]." ".$director["lastname"] ?></span>
                    <span><?= $director["birthdate"] ?></span>
                    <span><?= $director["sexe"] ?></span>
                </a>
            </div>
        <?php //Mettre les dates en jour/mois/année /!\
    } ?>
        </div>

<?php

$title = "Liste des réalisateurs";
$secondary_title = "Liste des réalisateurs";
$content = ob_get_clean();

// Le require de fin permet d'injecter le contenu dans le template "squelette"  > template.php
// Du coup dans notre "template.php" on aura des variables qui vont accueillir les éléments provenant des vues 
// Donc DANS CHAQUE VUE, il faudra toujours donner une valeur à $title, $content et $secondary_title

require "view/template.php";
