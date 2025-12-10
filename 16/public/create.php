<?php
session_start();
require_once "../core/connection.php";
require_once "../models/Material.php";

$userId = $_SESSION["user_id"] ?? null;
if (!$userId) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $category = $_POST["category"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    if ($name && $category && $price && $quantity) {
        Material::insert($pdo, [
            "user_id" => $userId,
            "name" => $name,
            "category" => $category,
            "price" => $price,
            "quantity" => $quantity
        ], "materials");

        header("Location: index.php");
        exit;
    } else {
        $error = "Заповніть всі поля";
    }
}
?>

<h2>Додати матеріал</h2>

<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="post">
    <input type="text" name="name" placeholder="Введіть назву матеріалу" required><br><br>
    <input type="text" name="category" placeholder="Введіть категорію" required><br><br>
    <input type="number" name="price" placeholder="Введіть ціну" step="0.01" required><br><br>
    <input type="number" name="quantity" placeholder="Введіть кількість" step="1" required><br><br>
    <button type="submit">Додати</button>
    <a href="index.php"><button type="button">Назад</button></a>
</form>
