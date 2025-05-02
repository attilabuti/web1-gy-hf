<?=View::render('base/header', ['title' => 'Kapcsolat'])?>

<div id="map"></div>

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
                <form action="/kapcsolat" method="POST" id="contact" class="box">
                    <div class="field">
                        <label class="label">Tárgy</label>
                        <div class="control">
                            <input class="input" type="text" id="subject" name="subject">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Üzenet</label>
                        <div class="control">
                            <textarea class="textarea" id="message" name="message"></textarea>
                        </div>
                    </div>

                    <div class="field is-grouped">
                        <div class="control is-centered">
                            <input type="submit" value="Üzenet küldése" class="button is-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script src="js/lib/validate.js"></script>
<script src="js/contact.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgyKzYrDARkM_JK9uSIbs_cb933eyDZao&map_ids=e636c79d34d4886d&callback=initMap&v=weekly" async defer></script>

<?=View::render('base/footer')?>
