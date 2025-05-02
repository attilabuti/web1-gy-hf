<?php

class Main_Controller extends Controller {

    protected array $quotes = [
        ['You\'re gonna need a bigger boat.', 'Jaws (1975)'],
        ['May the Force be with you.', 'Star Wars (1977)'],
        ['There\'s no place like home.', 'The Wizard of Oz (1939)'],
        ['Talk to me, Goose.', 'Top Gun (1986)'],
        ['Why so serious?', 'The Dark Knight (2008)'],
        ['Adventure is out there.', 'Up (2009)'],
        ['Life finds a way.', 'Jurassic Park (1993)'],
        ['To infinity and beyond!', 'Toy Story (1995)'],
        ['I\'ll be back', 'The Terminator (1984)'],
    ];

    public function main_action() : void {
        $moviesModel = new Movies_Model();
        $movies = $moviesModel->getMovies();

        $this->response->markup(
            View::render('main', [
                'quote'  => $this->quotes[rand(0, count($this->quotes)-1)],
                'movies' => $movies
            ])
        )->send();
    }

}
