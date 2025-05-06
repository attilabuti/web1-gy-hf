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

        <?php $menu = require(ROOT . '/config/menu.php'); ?>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a href="<?=$menu['fooldal']['path']?>" class="navbar-item"><?=$menu['fooldal']['name']?></a>
                <?php if (App::get('auth')->isLoggedIn()) { ?>
                <a href="<?=$menu['feltoltes']['path']?>" class="navbar-item"><?=$menu['feltoltes']['name']?></a>
                <a href="<?=$menu['uzenetek']['path']?>" class="navbar-item"><?=$menu['uzenetek']['name']?></a>
                <?php }?>
                <a href="<?=$menu['kapcsolat']['path']?>" class="navbar-item"><?=$menu['kapcsolat']['name']?></a>
            </div>

            <div class="navbar-end">

                <?php if (App::get('auth')->isLoggedIn()) { ?>
                    <div class="navbar-item">
                        <?=App::get('auth')->getData('name')?> (<?=App::get('auth')->getData('username')?>)
                    </div>
                    <a href="<?=$menu['kijelentkezes']['path']?>" class="navbar-item"><?=$menu['kijelentkezes']['name']?></a>
                <?php } else { ?>
                <div class="navbar-item">
                    <div class="buttons">
                        <a href="<?=$menu['regisztracio']['path']?>" class="button is-primary">
                            <strong><?=$menu['regisztracio']['name']?></strong>
                        </a>

                        <a href="<?=$menu['bejelentkezes']['path']?>" class="button is-light">
                            <?=$menu['bejelentkezes']['name']?>
                        </a>
                    </div>
                </div>
                <?php } ?>

            </div>
        </div>
    </nav>
