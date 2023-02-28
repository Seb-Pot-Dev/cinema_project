<?php
/* On commence et on termine la vue par "ob_start()" et "ob_get_clean()"
On va donc "aspirer" tout ce qui se trouve entre ces 2 fonctions (temporisation de sortie) pour stocker le contenu dans une variable $contenu
*/
ob_start();
?>
<p><?= $title?></p>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Genre</th>
            <th>Date de parution</th>
            <th>Synopsis</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($request->fetchAll() as $movie) { ?>
            <tr>
                <td><?= $movie["name"] ?></td>
                <td><? $movie["genre_id"] ?></td>
                <td><? $movie["release_date"] ?></td>
                <td><? $movie["synopsis"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php

$title = "Détails du film";
$secondary_title = "Détails du film";
$content = ob_get_clean();

// Le require de fin permet d'injecter le contenu dans le template "squelette"  > template.php
// Du coup dans notre "template.php" on aura des variables qui vont accueillir les éléments provenant des vues 
// Donc DANS CHAQUE VUE, il faudra toujours donner une valeur à $title, $content et $secondary_title

require "view/template.php";
