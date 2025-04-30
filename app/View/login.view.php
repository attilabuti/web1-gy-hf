<?=View::render('base/header', ['title' => 'Bejelentkezés'])?>

<?php
$message = Flash::get('message');
if ($message !== null) {
    echo '<h3 style="color:green;">'.$message.'</h3>';
}

$errorMessage = Flash::get('error');
if ($errorMessage !== null) {
    echo '<h3 style="color:red;">'.$errorMessage.'</h3>';
}
?>

<form action="/bejelentkezes" method="POST">
    <label for="email">E-mail cím:</label><br>
    <input type="email" id="email" name="email"><br><br>

    <label for="password">Jelszó:</label><br>
    <input type="password" id="password" name="password"><br><br>

    <button type="submit">Bejelentkezés</button>
</form>

<?=View::render('base/footer')?>



