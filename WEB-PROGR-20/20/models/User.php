<?php
require_once __DIR__ . '/../core/Model.php';

class User extends Model
{
    public static string $table = 'users';

    public static function findByUsername(string $username): ?self
    {
        $stmt = self::$pdo->prepare("SELECT * FROM " . static::$table . " WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new self($row) : null;
    }

    public function materials(): array
    {
        require_once __DIR__ . '/Material.php';
        $stmt = self::$pdo->prepare("SELECT * FROM materials WHERE user_id = :id");
        $stmt->execute(['id' => $this->columns->id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => new Material($row), $rows);
    }
}
