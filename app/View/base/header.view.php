<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M0VI3Z - <?= $title ?></title>
    <base href="<?=Helper::getBaseURL()?>" />
    <link rel="stylesheet" href="css/fontawesome.all.min.css">
    <link rel="stylesheet" href="css/bulma.min.css">
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item navbar-logo" href="/">M0VI3Z</a>

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
                <?php if (App::get('auth')->isLoggedIn()) { ?>
                <a href="/feltoltes" class="navbar-item">Feltöltés</a>
                <a href="/uzenetek" class="navbar-item">Üzenetek</a>
                <?php }?>
                <a href="/kapcsolat" class="navbar-item">Kapcsolat</a>
            </div>

            <div class="navbar-end">

                <?php if (App::get('auth')->isLoggedIn()) { ?>
                    <div class="navbar-item">
                        <?=App::get('auth')->getData('name')?> (<?=App::get('auth')->getData('username')?>)
                    </div>
                    <a href="/kijelentkezes" class="navbar-item">Kijelentkezés</a>
                <?php } else { ?>
                <div class="navbar-item">
                    <div class="buttons">
                        <a href="/regisztracio" class="button is-primary">
                            <strong>Regisztráciió</strong>
                        </a>

                        <a href="/bejelentkezes" class="button is-light">
                            Bejelentkezés
                        </a>
                    </div>
                </div>
                <?php } ?>

            </div>
        </div>
    </nav>
