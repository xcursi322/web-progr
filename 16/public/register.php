<?php
require_once "../core/connection.php";
require_once "../models/User.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($username && $email && $password) {
        $existing = User::getByLogin($pdo, $username);
        if ($existing) {
            $error = "Такий логін вже існує";
        } else {
            User::create($pdo, $username, $email, $password);
            header("Location: login.php");
            exit;
        }
    } else {
        $error = "Заповніть усі поля";
    }
}
?>

<h2>Реєстрація</h2>

<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

<form method="post">
    <input type="text" name="username" placeholder="Введіть логін" required><br><br>
    <input type="email" name="email" placeholder="Введіть email" required><br><br>
    <input type="password" name="password" placeholder="Введіть пароль" required><br><br>
    <button type="submit">Зареєструватись</button>
    <a href="login.php"><button type="button">До входу</button></a>
</form>
