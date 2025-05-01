<?=View::render('base/header', ['title' => '404'])?>

<section class="section error-page">
    <div class="container has-text-centered mt-5">
        <h1 class="title">404 – Az oldal nem található</h1>
        <h2 class="subtitle mt-2 pb-5">
            Úgy tűnik, rossz helyre tévedtél. Nézz vissza a főoldalra, vagy próbáld újra később!
        </h2>

        <figure class="image mt-5 pt-5">
            <img src="img/404.png" />
        </figure>
    </div>
</section>

<?=View::render('base/footer')?>
