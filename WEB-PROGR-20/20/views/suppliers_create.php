<h1>Додати постачальника</h1>

<form method="post" action="/suppliers/store">
    <div>
        Назва: <input type="text" name="name" required>
    </div>
    <div>
        Телефон: <input type="text" name="phone" required>
    </div>
    <div>
        Email: <input type="email" name="email" required>
    </div>
    <button type="submit">Зберегти</button>
</form>

<a href="/suppliers">← Назад до списку</a>
