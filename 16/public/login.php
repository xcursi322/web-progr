<?php
session_start();
require_once "../core/connection.php";
require_once "../models/User.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = $_POST["login"];
    $password = $_POST["password"];

    $user = User::getByLogin($pdo, $login);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user"] = $user["username"];
        $_SESSION["user_id"] = $user["id"];
        header("Location: index.php");
        exit;
    }

    $error = "Невірний логін або пароль";
}
?>

<form method="post">
    <input name="login"><br>
    <input name="password" type="password"><br>
    <button>Вхід</button>
</form>

<a href="register.php">Реєстрація</a>
