<?=View::render('base/header', ['title' => 'Feltöltés'])?>

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
                <form action="/feltoltes" method="POST" id="upload" enctype="multipart/form-data" class="box">
                    <div class="field">
                        <label class="label">Cím</label>
                        <div class="control">
                            <input class="input" type="text" id="title" name="title">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Megjelenés éve</label>
                        <div class="control">
                            <input class="input is-normal" type="number" id="release_date" name="release_date">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Leírás</label>
                        <div class="control">
                            <textarea class="textarea" id="description" name="description"></textarea>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Filmplakát</label>

                        <div id="poster-file" class="file has-name is-fullwidth">
                            <label class="file-label">
                                <input class="file-input" type="file" name="poster" id="poster" />
                                <span class="file-cta">
                                    <span class="file-icon">
                                        <i class="fas fa-upload"></i>
                                    </span>
                                    <span class="file-label">Fájl kiválasztása</span>
                                </span>
                                <span class="file-name"></span>
                            </label>
                        </div>
                    </div>

                    <div class="field is-grouped">
                        <div class="control is-centered">
                            <input type="submit" value="Mentés" class="button is-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="js/lib/validate.js"></script>
<script src="js/upload.js"></script>

<?=View::render('base/footer')?>
