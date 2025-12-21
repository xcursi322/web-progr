<?php
abstract class Model
{
    public static PDO $pdo;
    protected static string $table;

    public object $columns;

    public function __construct(array $data = [])
    {
        $this->columns = (object) $data;
    }

    

    public static function all(): array
    {
        $stmt = self::$pdo->query("SELECT * FROM " . static::$table);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => new static($row), $rows);
    }

    public static function allByUser(int $user_id): array
    {
        $stmt = self::$pdo->prepare("SELECT * FROM " . static::$table . " WHERE user_id = :uid");
        $stmt->execute(['uid' => $user_id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => new static($row), $rows);
    }

    public static function find(int $id): ?static
    {
        $stmt = self::$pdo->prepare(
            "SELECT * FROM " . static::$table . " WHERE id = :id"
        );
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new static($row) : null;
    }

    public static function insert(array $data): bool
    {
        $fields = array_keys($data);
        $sql = "INSERT INTO " . static::$table .
            " (" . implode(',', $fields) . ") VALUES (:" . implode(',:', $fields) . ")";
        $stmt = self::$pdo->prepare($sql);
        return $stmt->execute($data);
    }

    public function update(array $data): bool
    {
        $set = [];
        foreach ($data as $key => $value) {
            $set[] = "$key = :$key";
        }

        $sql = "UPDATE " . static::$table . " SET " . implode(', ', $set) . " WHERE id = :id";
        $data['id'] = $this->columns->id;
        $stmt = self::$pdo->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete(): bool
    {
        $stmt = self::$pdo->prepare(
            "DELETE FROM " . static::$table . " WHERE id = :id"
        );
        return $stmt->execute(['id' => $this->columns->id]);
    }


    public function belongsTo(string $class, string $fk): ?Model
    {
        $id = $this->columns->$fk ?? null;
        if (!$id) return null;
        return $class::find((int)$id);
    }

    public function hasMany(string $class, string $fk): array
    {
        $stmt = self::$pdo->prepare(
            "SELECT * FROM " . $class::$table . " WHERE $fk = :id"
        );
        $stmt->execute(['id' => $this->columns->id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => new $class($row), $rows);
    }
    public static function whereUser(int $userId): array
    {
    $stmt = self::$pdo->prepare(
        "SELECT * FROM " . static::$table . " WHERE user_id = :uid"
    );
    $stmt->execute(['uid' => $userId]);

    return array_map(
        fn($row) => new static($row),
        $stmt->fetchAll(PDO::FETCH_ASSOC)
    );
    }

}
