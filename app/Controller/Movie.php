<?php

class Movie_Controller extends Controller {

    public function main_action($url = null) : void {
        $movieModel = new Movies_Model();

        $movie = $movieModel->getMovie(Helper::sanitize($url));
        if ($movie === null) {
            $error = new Error_Controller();
            $error->error404_action();
            exit;
        }

        $this->response->markup(
            View::render('movie', [
                'movie' => $movie
            ])
        )->send();
    }

    public function upload_action() : void {
        if (!$this->auth->isLoggedIn()) {
            $this->response->redirect('/');
        }

        $this->response->markup(
            View::render('upload')
        )->send();
    }

    public function upload_post_action() : void {
        if (!$this->auth->isLoggedIn()) {
            $this->response->redirect('/');
        }

        $postData = $_POST;
        $fileData = $_FILES;

        $postData['title']        = Helper::sanitize(Helper::trimWWhitespace(Arr::get($postData, 'title', '')));
        $postData['release_date'] = Helper::sanitize(Helper::trimWWhitespace(Arr::get($postData, 'release_date', '')));
        $postData['description']  = Helper::sanitize(Helper::trimWWhitespace(Arr::get($postData, 'description', '')));

        $result = Valid::check($postData, [[
            'name'  => 'title',
            'rules' => [
                'required' => 'A filmcím megadása kötelező.',
                'max:120'  => 'A film címe maximum $$ karakter hosszú lehet.',
            ],
        ], [
            'name'  => 'release_date',
            'rules' => [
                'required'    => 'A megjelenés éve kitöltése kötelező.',
                'intmin:1800' => 'A megjelenés éve nem lehet kevesebb mint $$.',
                'intmax:2030' => 'A megjelenés éve nem lehet több mint $$.',
            ],
        ], [
            'name'  => 'description',
            'rules' => [
                'required' => 'A lírás megadása kötelező.',
                'max:5000' => 'A leírás maximum $$ karakter hosszú lehet.',
            ],
        ], [
            'name'  => 'trailer',
            'rules' => [
                'required' => 'Az előzőteshez tartozó URL megadása kötelező.',
                'max:150'  => 'Az előzőteshez tartozó URL maximum $$ karakter hosszú lehet.',
            ],
        ]]);

        if ($result !== null) {
            Flash::set($result, 'error');
            $this->response->redirect('/feltoltes');
        }

        if (
            !isset($fileData) ||
            !is_array($fileData) ||
            !isset($fileData['poster']) ||
            !isset($fileData['poster']['tmp_name']) ||
            !is_uploaded_file($fileData['poster']['tmp_name'])
        ) {
            Flash::set('Fájl feltöltése kötelező.', 'error');
            $this->response->redirect('/feltoltes');
        }

        if (!File::isImage($fileData['poster'])) {
            Flash::set('A fájl csak kép lehet (jpg, png, webp).', 'error');
            $this->response->redirect('/feltoltes');
        }

        $posterName = str_replace('.', '', uniqid('', true)) . '.' . strtolower(pathinfo($fileData['poster']['name'], PATHINFO_EXTENSION));
        $poster = File::save($fileData['poster'], 'public/img/uploads/', $posterName);

        if ($poster === false) {
            Flash::set('A fájl feltöltése során hiba lépett fel.', 'error');
            $this->response->redirect('/feltoltes');
        }

        $movies = new Movies_Model();

        $url = Helper::slugify(Arr::get($postData, 'title'));
        if ($movies->movieUrlExists($url)) {
            $url = Helper::createUniqueSlug($url);
        }

        $trailer = $this->getYoutubeEmbedCode($postData['trailer']);
        if ($trailer === null) {
            Flash::set('Az előzeteshez megadott URL nem YouTube link.', 'error');
            $this->response->redirect('/feltoltes');
        }

        $movies->add(
            $url,
            Arr::get($postData, 'title'),
            Arr::get($postData, 'release_date'),
            Arr::get($postData, 'description'),
            $trailer,
            $posterName,
        );

        Flash::set('Sikeres feltöltés!', 'message');
        $this->response->redirect('/feltoltes');
    }

    public function login_action() : void {
        if ($this->auth->isLoggedIn()) {
            $this->response->redirect('/');
        }

        $this->response->markup(
            View::render('login')
        )->send();


        echo '<pre>';
        print_r($_POST);
        echo '<br>';
        print_r($_FILES);
    }

    private function getYoutubeEmbedCode(string $url): ?string {
        $pattern = '%(?:youtube\.com/(?:watch\?v=|embed/|v/|shorts/)|youtu\.be/)([A-Za-z0-9_-]{11})%';

        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }

        return null;
    }
}
