<?php

declare(strict_types=1);

namespace Test\Check24\Controller\User;

use Test\Check24\Controller\AbstractController;

class LogOut extends AbstractController
{
    public function execute()
    {
        if (!$this->checkRequest(self::POST)) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
            //TODO add handling wrong request method
            exit;
        }

        $this->logout();
        header("Location: " . $_SERVER['HTTP_REFERER']);
        // TODO handle message for logout
    }

    private function logout()
    {
        $session = $this->getSession();

        unset($session['email'], $session['logged_in'], $session['login_error']);
        $this->session = $session;

        session_destroy();
    }
}
