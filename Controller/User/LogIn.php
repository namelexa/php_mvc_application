<?php

declare(strict_types=1);

namespace Test\Check24\Controller\User;

use Test\Check24\Controller\AbstractController;
use Test\Check24\Repository\UserRepository;

class LogIn extends AbstractController
{
    public function __construct(
        private UserRepository $userRepository
    ) {
    }

    public function execute(): void
    {
        if (!$this->checkRequest(self::POST)) {
            header("Location: ../../view/home_page.html");
            exit;
        }

        $email = htmlspecialchars($_POST["email"]);
        $password = htmlspecialchars($_POST["password"]);

        try {
            $user = $this->login($email, $password);
            show($_SESSION);
        } catch (\PDOException $e) {
            throw new \PDOException('PDOException: ' . $e->getMessage());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    private function login($email, $password)
    {
        if (empty($email) || empty($password)) {
            $_SESSION["error"] = "Combination of password and email are wrong.";
            header("Location: ../");
            exit;
        }
        $this->saveUser($email, $password);
        $this->startSession();

        $user = $this->userRepository->getUser($email);

        if ($this->authenticate($email, $password)) {
            $_SESSION['email'] = $email;
            $_SESSION['logged_in'] = true;
            return true;
        } else {
            return false;
        }
    }

    private function authenticate($email, $password): bool
    {
        return $email === "admin" && $password === "password123";
    }

    private function logout() {
        $this->startSession();

        unset($_SESSION['email'], $_SESSION['logged_in']);

        session_destroy();
    }

    public function isLoggedIn() {
        $this->startSession();

        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }

    public function saveUser($email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $this->userRepository->addUser($email, $hashedPassword);
    }

    private function startSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}