<?=View::render('base/header', ['title' => 'Regisztráció'])?>

<section class="section movies">
    <div class="container">
        <div class="columns is-multiline">

            <?php
            $errorMessage = Flash::get('error');
            if ($errorMessage !== null) {
            ?>
            <div class="column is-half is-offset-one-quarter">
                <article class="message is-danger">
                    <div class="message-body"><?=$errorMessage?></div>
                </article>
            </div>
            <?php } ?>

            <div class="column is-half is-offset-one-quarter">
                <form action="/regisztracio" method="POST" id="registration" class="box">
                    <div class="field">
                        <label class="label">Felhasználónév</label>
                        <div class="control has-icons-left">
                            <input class="input" type="text" id="username" name="username">
                            <span class="icon is-small is-left"><i class="fas fa-user"></i></span>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">E-mail cím</label>
                        <div class="control has-icons-left">
                            <input class="input is-normal" type="input" id="email" name="email">
                            <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Jelszó</label>
                        <div class="control has-icons-left">
                            <input class="input is-normal" type="password" id="password" name="password">
                            <span class="icon is-small is-left"><i class="fas fa-key"></i></span>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Jelszó ismét</label>
                        <div class="control has-icons-left">
                            <input class="input is-normal" type="password" id="password_re" name="password_re">
                            <span class="icon is-small is-left"><i class="fas fa-key"></i></span>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Családnév</label>
                        <div class="control has-icons-left">
                            <input class="input is-normal" type="text" id="last_name" name="last_name">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Utónév</label>
                        <div class="control has-icons-left">
                            <input class="input is-normal" type="text" id="first_name" name="first_name">
                        </div>
                    </div>

                    <div class="field is-grouped">
                        <div class="control is-centered">
                            <input type="submit" value="Regisztráció" class="button is-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="js/lib/validate.js"></script>
<script src="js/registration.js"></script>

<?=View::render('base/footer')?>
