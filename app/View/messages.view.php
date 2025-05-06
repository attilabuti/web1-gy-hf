<?= View::render('base/header', ['title' => 'Üzenetek']) ?>

<section class="section">
    <div class="container">
        <div class="columns is-multiline">

            <?php if (count($messages) === 0) { ?>
                <div class="column is-three-quarters is-offset-1 has-text-centered mt-5">
                    <h4 class="title is-4">Jelenleg nincsenek megjeleníthető üzenetek!</h4>
                </div>
            <?php } ?>


            <div class="column is-three-quarters is-offset-1">
                <table class="table">
                    <tbody>
                    <?php
                    $first = true;
                    foreach ($messages as $msg) {
                        if ($first === false) { echo '<tr><td colspan="3"></td></tr>'; } else { $first = false; }
                    ?>

                        <tr>
                            <th class="is-info has-text-weight-medium"><?= $msg['subject'] ?></th>
                            <td class="is-info has-text-weight-medium"><?= $msg['name'] ?></td>
                            <td class="is-info has-text-weight-medium"><?= $msg['created_at'] ?></td>
                        </tr>
                        <tr>
                            <td colspan="3"><?= $msg['message'] ?></td>
                        </tr>

                    <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</section>

<?= View::render('base/footer') ?>