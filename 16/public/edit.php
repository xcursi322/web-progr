<?php
session_start();
require_once "../core/config.php";
require_once "../core/connection.php";
require_once "../core/Model.php";
require_once "../models/Material.php";

if (!isset($_SESSION['user_id'])) {
    die("Доступ заборонено");
}

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Не вказано ID матеріалу");
}

// Знаходимо матеріал
$material = Material::find($pdo, $id);
if (!$material) {
    die("Матеріал не знайдено");
}

// Обробка форми
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => $_POST['name'],
        'category' => $_POST['category'],
        'quantity' => $_POST['quantity'],
        'price' => $_POST['price'],
    ];
    $material->update($data);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Редагування матеріалу</title>
</head>
<body>

<h2>Редагування матеріалу</h2>

<form method="post">
    <label>Назва:</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($material->columns->name) ?>" placeholder="Введіть назву матеріалу" required><br><br>

    <label>Категорія:</label><br>
    <input type="text" name="category" value="<?= htmlspecialchars($material->columns->category) ?>" placeholder="Введіть категорію" required><br><br>

    <label>Кількість:</label><br>
    <input type="number" name="quantity" value="<?= htmlspecialchars($material->columns->quantity) ?>" placeholder="Введіть кількість" required><br><br>

    <label>Ціна:</label><br>
    <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($material->columns->price) ?>" placeholder="Введіть ціну" required><br><br>

    <button type="submit">Зберегти</button>
    <button type="button" onclick="window.location.href='index.php'">Назад</button>
</form>

</body>
</html>
