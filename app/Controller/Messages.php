<?php

class Messages_Controller extends Controller {

    public function _before() : void {
        if (!$this->auth->isLoggedIn()) {
            $this->response->redirect('/');
        }
    }

    public function main_action() : void {
        $usersModel = new Users_Model();
        $messagesModel = new Messages_Model();

        $messages = $messagesModel->getMessages();
        foreach ($messages as &$msg) {
            if ($msg['user_id'] == 0) {
                $msg['name'] = 'Vendég';
            } else {
                $tmpName = $usersModel->getUserFullName($msg['user_id']);
                if ($tmpName === null) {
                    $msg['name'] = 'Vendég';
                } else {
                    $msg['name'] = $tmpName;
                }
            }
        }

        $this->response->markup(
            View::render('messages', [
                'messages' => $messages,
            ])
        )->send();
    }

}
