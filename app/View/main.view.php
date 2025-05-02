<?=View::render('base/header', ['title' => 'Lorem ipsum dolor'])?>

<section class="hero is-halfheight ">
    <video poster="video/poster.png" muted loop autoplay playsinline>
        <!-- <source src="video/background.mp4" type="video/mp4"> -->
    </video>

    <div class="hero-body">
        <div>
            <p class="title"><?= $quote[0] ?></p>
            <p class="subtitle"><?= $quote[1] ?></p>
        </div>
    </div>
</section>

<section class="section movies">
    <div class="container">
        <div class="fixed-grid has-1-cols-mobile has-2-cols-tablet has-3-cols-desktop has-4-cols-widescreen">
            <div class="grid is-column-gap-2 is-row-gap-2">

                <?php if (count($movies) === 0) { ?>
                    <div class="cell">
                        <h4 class="title is-4">Jelenleg nincsenek megjeleníthető filmek!</h4>
                    </div>
                <?php } ?>

                <?php foreach ($movies as $movie) { ?>
                <div class="cell">
                    <a href="/film/<?=$movie['url']?>">
                        <div class="card">
                            <div class="card-image" style="background:url('/img/uploads/<?=$movie['poster']?>')"></div>
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-content">
                                        <p class="title is-6"><?=$movie['title']?></p>
                                        <p class="subtitle is-7"><?=$movie['release_date']?></p>
                                    </div>
                                </div>

                                <div class="content description">
                                    <?=Helper::truncateText($movie['description'], 230)?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php } ?>

            </div>
        </div>

    </div>
</section>

<script src="js/main.js"></script>

<?=View::render('base/footer')?>
