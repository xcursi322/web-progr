<?php
require_once __DIR__ . '/../core/Model.php';

class User extends Model
{
    protected static $table = "users";

    public static function getByLogin($pdo, $login)
    {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$login]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
