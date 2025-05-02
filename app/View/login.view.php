<?=View::render('base/header', ['title' => 'Bejelentkezés'])?>

<section class="section">
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

            <?php
            $message = Flash::get('message');
            if ($message !== null) {
            ?>
            <div class="column is-half is-offset-one-quarter">
                <article class="message is-success">
                    <div class="message-body"><?=$message?></div>
                </article>
            </div>
            <?php } ?>

            <div class="column is-half is-offset-one-quarter">
                <form action="/bejelentkezes" method="POST" id="login" class="box">
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

                    <div class="field is-grouped">
                        <div class="control is-centered">
                            <input type="submit" value="Bejelentkezés" class="button is-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="js/lib/validate.js"></script>
<script src="js/login.js"></script>

<?=View::render('base/footer')?>
