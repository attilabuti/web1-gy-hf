<?=View::render('base/header', ['title' => 'Regisztráció'])?>

<?php
$errorMessage = Flash::get('error');
if ($errorMessage !== null) {
    echo '<h3 style="color:red;">'.$errorMessage.'</h3>';
}
?>

<form action="/regisztracio" method="POST">
    <label for="email">E-mail cím:</label><br>
    <input type="email" id="email" name="email"><br><br>

    <label for="password">Jelszó:</label><br>
    <input type="password" id="password" name="password"><br><br>

    <label for="password-re">Jelszó ismét:</label><br>
    <input type="password" id="password-re" name="password-re"><br><br>

    <label for="username">Felhasználónév:</label><br>
    <input type="text" id="username" name="username"><br><br>

    <label for="last_name">Családnév:</label><br>
    <input type="text" id="last_name" name="last_name"><br><br>

    <label for="first_name">Utónév:</label><br>
    <input type="text" id="first_name" name="first_name"><br><br>

    <button type="submit">Regisztráció</button>
</form>

<?=View::render('base/footer')?>
