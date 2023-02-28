
    <?php
    /* On commence et on termine la vue par "ob_start()" et "ob_get_clean()"
On va donc "aspirer" tout ce qui se trouve entre ces 2 fonctions (temporisation de sortie) pour stocker le contenu dans une variable $contenu
*/
    ob_start();
    ?>
    <p> Il y a <?= $request->rowCount() ?> genres</p>

    <table>
        <tbody>
            <?php
            foreach ($request->fetchAll() as $genre) { ?>
                <div class="vignette-film">
                    <span><?= $genre["genre_name"] ?></span>
                </div>
            <?php } ?>
        </tbody>
    </table>

<?php

$title = "Liste des genres";
$secondary_title = "Liste des genres";
$content = ob_get_clean();

// Le require de fin permet d'injecter le contenu dans le template "squelette"  > template.php
// Du coup dans notre "template.php" on aura des variables qui vont accueillir les éléments provenant des vues 
// Donc DANS CHAQUE VUE, il faudra toujours donner une valeur à $title, $content et $secondary_title

require "view/template.php"; ?>