<?php

declare(strict_types=1);

namespace Test\Check24\Controller\User;

use Test\Check24\Controller\AbstractController;
use Test\Check24\Repository\UserRepository;

class LogIn extends AbstractController
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    public function execute(): void
    {
        if (!$this->checkRequest(self::POST)) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
            //TODO add handling wrong request method
            exit;
        }

        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        try {
            if (!$this->login($email, $_POST["password"])) {
                header("Location: " . $_SERVER['HTTP_REFERER']);
            }

            header("Location: " . $_SERVER['HTTP_REFERER']);
            // TODO handle message for login
        } catch (\PDOException $e) {
            throw new \PDOException('PDOException: ' . $e->getMessage());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    private function login($email, $password): bool
    {
        if (empty($email) || empty($password)) {
            $_SESSION["login_error"] = "Combination of password and email are wrong.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            $this->session = $_SESSION;
            exit;
        }
//        $this->saveUser($email, $password);

        $user = $this->userRepository->getUser($email);

        if ($this->authenticate($email, $password, $user)) {
            $_SESSION['email'] = $user->getEmail();
            $_SESSION['user_id'] = (int)$user->getId();
            $_SESSION['logged_in'] = true;
            unset($_SESSION['login_error']);
            $this->session = $_SESSION;

            return true;
        }

        return false;
    }

    private function authenticate($email, $password, $user): bool
    {
        return $email === $user->getEmail() && password_verify($password, $user->getPasswordHash());
    }

    public function saveUser($email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->userRepository->addUser($email, $hashedPassword);
    }
}
