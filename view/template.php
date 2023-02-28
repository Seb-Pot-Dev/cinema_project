<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?= $title ?></title>
</head>

<body>
    <header>

        <nav>

            <a href="http://localhost/sebastien_pothee/cinema_project/index.php">
                <img src="public/img/kisspng-popcorn-caramel-corn-free-content-cinema-clip-art-how-to-draw-popcorn-5a848b58bd54c0.6191740315186358647755.png" alt="logo de votre entreprise">
            </a>

            <ul>
                <li><a href="index.php?action=listMovies">Films</a></li>
                <li><a href="index.php?action=listGenres">Genres</a></li>
                <li><a href="index.php?action=listRoles">Roles</a></li>
                <li><a href="index.php?action=listDirectors">Réalisateurs</a></li>
                <li><a href="index.php?action=listCastings">Castings</a></li>
            </ul>
        </nav>
        <div>
            <main>
                <div>
                    <h1>Bienvenu sur Popcorn !</h1>
                    <h2><?= $secondary_title ?></h2>
                    <?= $content ?>
                </div>
            </main>
        </div>


</body>

</html>