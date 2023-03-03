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
            <h2 class="logo">Pop <span class="corn">corn</h2>
            <ul>
                <li><a href="index.php?action=listMovies">Films</a></li>
                <li><a href="index.php?action=listGenres">Genre</a></li>
                <li><a href="index.php?action=listActors">Acteurs</a></li>
                <li><a href="index.php?action=listRoles">Rôles</a></li>
                <li><a href="index.php?action=listDirectors">Réalisateurs</a></li>
                <li><a href="index.php?action=listCastings">Castings</a></li>
            </ul>
            <div class="account-access">
                <a class="subscribe">S'inscrire</a>
                <a class="subscribe" href="index.php?action=admin">Admin</a>
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