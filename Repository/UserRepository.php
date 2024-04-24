<?php

declare(strict_types=1);

namespace Test\Check24\Repository;

class UserRepository extends Repository
{
    protected string $table = 'users';
    public function getUser(string $email)
    {
        return $this->get(['email' => $email],\PDO::FETCH_CLASS);
    }

    public function addUser($email, $hashedPassword) {
        $query = "INSERT INTO users (email, passwordHash) VALUES (:username, :password)";
        $params = ['email' => $email, 'password' => $hashedPassword];
        return $this->save($query, $params);
    }
}
