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

                <?php for ($i = 0; $i < 10; $i++) { ?>
                <div class="cell">
                    <a href="/film/__URL__">
                        <div class="card">
                            <div class="card-image">
                                <figure class="image is-16by9">
                                    <img src="https://bulma.io/assets/images/placeholders/1280x960.png" alt="Placeholder image" />
                                </figure>
                            </div>
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-content">
                                        <p class="title is-5">Movie title</p>
                                        <p class="subtitle is-7">1900</p>
                                    </div>
                                </div>

                                <div class="content description">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec.
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

<?=View::render('base/footer')?>
