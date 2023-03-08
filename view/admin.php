<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a45e9c27c8.js" crossorigin="anonymous"></script>
    <title><?php if (isset($title)) { ?> <?= $title ?> <?php } ?></title>
</head>

<body>
    <main>
        <nav>
            <h2 class="logo"> <a href="index.php?action=listMovies"> Pop <span class="corn">corn</a></h2>
            <ul>
                <li><a href="index.php?action=addMovie">Ajouter un film</a></li>
                <li><a href="index.php?action=addGenre">Ajouter un genre</a></li>
                <li><a href="index.php?action=addActor">Ajouter un acteur</a></li>
                <li><a href="index.php?action=addRole">Ajouter un rôle</a></li>
                <li><a href="index.php?action=addDirector">Ajouter un réaliseur</a></li>
                <li><a href="index.php?action=addCasting">Ajouter un casting</a></li>
            </ul>
            <div class="account-access">
                <a class="subscribe">S'inscrire</a>
                <a class="subscribe" href="index.php?action=listMovies">Vue normale</a>
            </div>
        </nav>
        <div>
            <!-- <h1>Bienvenu sur Popcorn !</h1> -->
            <?php if (isset($secondary_title)) { ?>
                <h2 class="list-title"><?= $secondary_title ?></h2>
            <?php } ?>
            <?php if (isset($content)) { ?>
                <?= $content ?>
            <?php } ?>
        </div>
        <!-- </div> -->
    </main>
</body>

</html>