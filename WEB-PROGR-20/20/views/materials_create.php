<h1>Додати матеріал</h1>

<form method="post" action="/materials/store">

    <div>
        Назва:<br>
        <input type="text" name="name" required>
    </div>

    <div>
        Категорія:<br>
        <select name="category_id" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category->columns->id ?>">
                    <?= htmlspecialchars($category->columns->title) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        Постачальник:<br>
        <select name="supplier_id" required>
            <?php foreach ($suppliers as $supplier): ?>
                <option value="<?= $supplier->columns->id ?>">
                    <?= htmlspecialchars($supplier->columns->name) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        Ціна:<br>
        <input type="text" name="price" required>
    </div>

    <div>
        Одиниця:<br>
        <input type="text" name="unit" required>
    </div>

    <div>
        <button type="submit">Зберегти</button>
    </div>

</form>

<a href="/materials">← Назад</a>
