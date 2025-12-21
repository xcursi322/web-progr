<h1>Реєстрація</h1>

<form method="post" action="/register">
    <div>
        Логін:<br>
        <input type="text" name="username" required>
    </div>

    <div>
        Пароль:<br>
        <input type="password" name="password" required>
    </div>

    <div>
        Повторіть пароль:<br>
        <input type="password" name="password_confirm" required>
    </div>

    <button type="submit">Зареєструватися</button>
</form>

<p>
    <a href="/login">← Вхід</a>
</p>
