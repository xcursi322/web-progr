<?php

class Controller
{
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        Model::$pdo = $pdo;
        session_start();
    }

    protected function requireLogin()
    {
        if (empty($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }
    }

    protected function currentUserId(): ?int
    {
        return $_SESSION['user_id'] ?? null;
    }
}
