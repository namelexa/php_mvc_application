<?php

declare(strict_types=1);

namespace Test\Check24\Repository;

use Test\Check24\Model\User;

class UserRepository extends Repository
{
    protected string $table = 'users';

    public function getUser(string $email): User
    {
        return $this->get(User::class, ['id' => 1, 'email' => $email], \PDO::FETCH_OBJ);
    }

    public function addUser($email, $hashedPassword)
    {
        $query = "INSERT INTO users (email, passwordHash) VALUES (:email, :passwordHash)";
        $params = ['email' => $email, 'passwordHash' => $hashedPassword];
        return $this->save($query, $params);
    }
}
