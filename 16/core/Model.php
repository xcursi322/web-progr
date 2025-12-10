<?php

class Model
{
    protected static $pdo = null;
    protected static $table = null;
    public object $columns;

    public function __construct(PDO $pdo, $table, $data = [])
    {
        static::$pdo = $pdo;
        static::$table = $table;
        $this->columns = (object) $data;
    }

    protected static function init(PDO $pdo, $table = null)
{
    if (!static::$pdo) static::$pdo = $pdo;
    if ($table) static::$table = $table;

    if (!static::$table) {
        throw new Exception("Table name is not defined for Model.");
    }
}


    public static function all(PDO $pdo, $table = null, $where = "", $params = [])
    {
        static::init($pdo, $table);

        $sql = "SELECT * FROM `" . static::$table . "` $where";
        $stmt = static::$pdo->prepare($sql);
        $stmt->execute($params);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $items = [];
        foreach ($rows as $row) {
            $items[] = new static($pdo, static::$table, $row);
        }

        return $items;
    }

    public static function find(PDO $pdo, $id, $table = null)
    {
        static::init($pdo, $table);

        $sql = "SELECT * FROM `" . static::$table . "` WHERE id = ?";
        $stmt = static::$pdo->prepare($sql);
        $stmt->execute([$id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) return null;

        return new static($pdo, static::$table, $row);
    }

    public static function insert(PDO $pdo, $data, $table = null)
    {
        static::init($pdo, $table);

        $cols = implode(', ', array_keys($data));
        $vals = rtrim(str_repeat('?,', count($data)), ',');

        $sql = "INSERT INTO `" . static::$table . "` ($cols) VALUES ($vals)";
        $stmt = static::$pdo->prepare($sql);

        return $stmt->execute(array_values($data));
    }

    public function update($data)
    {
        $set = [];
        foreach ($data as $k => $v) {
            $set[] = "$k = ?";
        }
        $setStr = implode(', ', $set);

        $sql = "UPDATE `" . static::$table . "` SET $setStr WHERE id = ?";
        $stmt = static::$pdo->prepare($sql);

        $values = array_values($data);
        $values[] = $this->columns->id;

        return $stmt->execute($values);
    }

    public function delete()
    {
        $sql = "DELETE FROM `" . static::$table . "` WHERE id = ?";
        $stmt = static::$pdo->prepare($sql);

        return $stmt->execute([$this->columns->id]);
    }
    

}
