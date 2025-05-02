<?=View::render('base/header', ['title' => $movie['title']])?>

<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column has-text-centered">
                <h1 class="title is-2 mb-0 pb-0"><?=$movie['title']?></h1>
                <h2 class="title is-5 mt-0 pt-0"><?=$movie['release_date']?></h2>
            </div>
        </div>

        <div class="columns mt-5">
            <div class="column is-3 is-offset-1 has-text-centered">
                <img src="img/uploads/<?=$movie['poster']?>" alt="<?=$movie['title']?>">
            </div>
            <div class="column is-7">
                <div class="columns is-multiline">
                    <div class="column is-12">
                        <h3 class="title is-6 mb-2">Összefoglaló</h3>

                        <p class="has-text-justified"><?=$movie['description']?></p>
                    </div>
                    <div class="column is-12">
                        <h3 class="title is-6 mb-2">Előzetes</h3>

                        <figure class="image is-16by9">
                            <iframe width="560" height="315"
                                class="has-ratio"
                                src="https://www.youtube.com/embed/<?=$movie['trailer']?>"
                                title="<?=$movie['title']?> - Előzetes" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture;"
                                allowfullscreen>
                            </iframe>
                        </figure>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?=View::render('base/footer')?>
