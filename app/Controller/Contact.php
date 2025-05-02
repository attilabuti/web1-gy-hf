<?php

class Contact_Controller extends Controller {

    public function main_action() : void {
        $this->response->markup(
            View::render('contact')
        )->send();
    }

    public function main_post_action() : void {
        $postData = $_POST;

        $postData['subject'] = Helper::sanitize(Helper::trimWWhitespace(Arr::get($postData, 'subject', '')));
        $postData['message'] = Helper::sanitize(Helper::trimWWhitespace(Arr::get($postData, 'message', '')));

        $result = Valid::check($postData, [[
            'name'  => 'subject',
            'rules' => [
                'required' => 'A tárgy megadása kötelező.',
                'max:120'  => 'A tárgy maximum $$ karakter hosszú lehet.',
            ],
        ], [
            'name'  => 'message',
            'rules' => [
                'required' => 'Az üzenet megadása kötelező.',
                'max:5000' => 'Az üzenet maximum $$ karakter hosszú lehet.',
            ],
        ]]);

        if ($result !== null) {
            Flash::set($result, 'error');
            $this->response->redirect('/kapcsolat');
        }

        $userId = $this->auth->getUserId();
        if ($userId === null) {
            $userId = 0;
        }

        $messages = new Messages_Model();
        $messages->add(
            $userId,
            Arr::get($postData, 'subject'),
            Arr::get($postData, 'message'),
        );

        Flash::set('Az üzenet mentésre került!', 'message');
        $this->response->redirect('/kapcsolat');
    }

}
