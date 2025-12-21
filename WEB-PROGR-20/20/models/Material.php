<?php
require_once __DIR__ . '/../core/Model.php';
require_once __DIR__ . '/Category.php';
require_once __DIR__ . '/Supplier.php';

class Material extends Model
{
    public static string $table = "materials";

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, "supplier_id");
    }

    public static function allForUser($user_id): array
    {
        $stmt = self::$pdo->prepare("SELECT * FROM " . static::$table . " WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => new static($row), $rows);
    }

    public static function findForUser($id, $user_id): ?static
    {
        $stmt = self::$pdo->prepare("SELECT * FROM " . static::$table . " WHERE id = :id AND user_id = :user_id");
        $stmt->execute(['id' => $id, 'user_id' => $user_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new static($row) : null;
    }
}
