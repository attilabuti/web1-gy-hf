<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="css/bulma.min.css">
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="/">FILMEK</a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a href="/" class="navbar-item">Főoldal</a>
                <a href="/filmplakatok" class="navbar-item">Filmplakátok</a>
                <?php if (App::get('auth')->isLoggedIn()) { ?>
                <a href="/uzenetek" class="navbar-item">Üzenetek</a>
                <?php }?>
                <a href="/kapcsolat" class="navbar-item">Kapcsolat</a>
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <?php if (App::get('auth')->isLoggedIn()) { ?>
                        <?=App::get('auth')->getData('name')?> (<?=App::get('auth')->getData('username')?>)
                        <a href="/kijelentkezes" class="navbar-item">Kijelentkezés</a>
                    <?php } else { ?>
                    <div class="buttons">
                        <a href="/regisztracio" class="button is-primary">
                            <strong>Regisztráciió</strong>
                        </a>

                        <a href="/bejelentkezes" class="button is-light">
                            Bejelentkezés
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>
