<h1>Редагувати матеріал</h1>

<form method="post" action="/materials/<?= $material->columns->id ?>/update">

    <div>
        Назва:<br>
        <input type="text" name="name" value="<?= htmlspecialchars($material->columns->name ?? '') ?>" required>
    </div>

    <div>
        Категорія:<br>
        <select name="category_id" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category->columns->id ?>" 
                    <?= ($material->columns->category_id ?? '') == $category->columns->id ? 'selected' : '' ?>>
                    <?= htmlspecialchars($category->columns->title) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        Постачальник:<br>
        <select name="supplier_id" required>
            <?php foreach ($suppliers as $supplier): ?>
                <option value="<?= $supplier->columns->id ?>" 
                    <?= ($material->columns->supplier_id ?? '') == $supplier->columns->id ? 'selected' : '' ?>>
                    <?= htmlspecialchars($supplier->columns->name) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        Ціна:<br>
        <input type="text" name="price" value="<?= htmlspecialchars($material->columns->price ?? '') ?>" required>
    </div>

    <div>
        Одиниця:<br>
        <input type="text" name="unit" value="<?= htmlspecialchars($material->columns->unit ?? '') ?>" required>
    </div>

    <div>
        <button type="submit">Зберегти</button>
    </div>

</form>

<a href="/materials">← Назад</a>
