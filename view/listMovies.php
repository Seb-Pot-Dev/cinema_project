
<?php
    /* On commence et on termine la vue par "ob_start()" et "ob_get_clean()"
On va donc "aspirer" tout ce qui se trouve entre ces 2 fonctions (temporisation de sortie) pour stocker le contenu dans une variable $contenu
*/
    ob_start();
    ?>
    <p> Il y a <?= $request->rowCount() ?> films</p>

            <div class="movie-card-list">
            <?php
            foreach ($request->fetchAll() as $movie) { ?>
                    <div class="movie-card">
                        <span><?= $movie["movie_name"] ?></span>
                        <span><?= $movie["genre_name"] ?></span>
                        <span><?= $movie["release_year"] ?></span>
                    </div>
                    <?php } ?>
                </div>
<?php

$title = "Liste des films";
$secondary_title = "Liste des films";
$content = ob_get_clean();

// Le require de fin permet d'injecter le contenu dans le template "squelette"  > template.php
// Du coup dans notre "template.php" on aura des variables qui vont accueillir les éléments provenant des vues 
// Donc DANS CHAQUE VUE, il faudra toujours donner une valeur à $title, $content et $secondary_title

require "view/template.php"; ?>