<?php

require 'Core/Model.php';

class User extends Model
{
    public static function getUserByEmail($email)
    {
        $pq = self::connection()->prepare('SELECT * FROM users WHERE email =? LIMIT 1');
        $pq->bind_param('s', $email);
        $pq->execute();
        return $pq->get_result()->fetch_assoc();
    }


    public static function find($id)
    {
        $pq = self::connection()->prepare('SELECT * FROM users WHERE email =? LIMIT 1');
        $pq->bind_param('s', $id);
        $pq->execute();
        return $pq->get_result()->fetch_assoc();
    }

    public static function createNewUser($name, $email, $pass)
    {
        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
        $qp = self::connection()->prepare('INSERT INTO `users`(`name`, `email`, `password`) VALUES (?, ?, ?)');
        $qp->bind_param('sss', $name, $email, $hashedPass);
        return $qp->execute();
    }
}
