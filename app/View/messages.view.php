<?=View::render('base/header', ['title' => 'Üzenetek'])?>

<section class="section">
    <div class="container">
        <div class="columns is-multiline">

        <?php if (count($messages) === 0) { ?>
            <div class="column is-three-quarters is-offset-1 has-text-centered mt-5">
                <h4 class="title is-4">Jelenleg nincsenek megjeleníthető üzenetek!</h4>
            </div>
        <?php } ?>

        <?php foreach ($messages as $msg) { ?>
        <div class="column is-three-quarters is-offset-1">
            <article class="message is-dark">
                <div class="message-header">
                    <p>
                        <?=$msg['subject']?><br>
                        <small><?=$msg['name']?> / <?=$msg['created_at']?></small>
                    </p>
                </div>
                <div class="message-body"><?=$msg['message']?></div>
            </article>
        </div>
        <?php } ?>

        </div>
    </div>
</section>

<?=View::render('base/footer')?>
