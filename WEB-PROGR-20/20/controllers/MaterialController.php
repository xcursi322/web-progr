<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Material.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/Supplier.php';

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::allForUser($_SESSION['user_id']);
        $title = 'Матеріали';
        $template = 'materials_index.php';
        include "views/layout.php";
    }

    public function show($id)
    {
        $material = Material::findForUser($id, $_SESSION['user_id']);
        if (!$material) { header('Location: /materials'); exit; }

        $title = 'Матеріал';
        $template = 'materials_show.php';
        include "views/layout.php";
    }

    public function create()
    {
        $categories = Category::allForUser($_SESSION['user_id']);
        $suppliers = Supplier::allForUser($_SESSION['user_id']);
        $title = 'Додати матеріал';
        $template = 'materials_create.php';
        include "views/layout.php";
    }

    public function store()
    {
        Material::insert([
            'name' => $_POST['name'],
            'category_id' => $_POST['category_id'],
            'supplier_id' => $_POST['supplier_id'],
            'price' => $_POST['price'],
            'unit' => $_POST['unit'],
            'user_id' => $_SESSION['user_id']
        ]);
        header('Location: /materials');
        exit;
    }

    public function edit($id)
    {
        $material = Material::findForUser($id, $_SESSION['user_id']);
        if (!$material) { header('Location: /materials'); exit; }

        $categories = Category::allForUser($_SESSION['user_id']);
        $suppliers = Supplier::allForUser($_SESSION['user_id']);
        $title = 'Редагувати матеріал';
        $template = 'materials_edit.php';
        include "views/layout.php";
    }

    public function update($id)
    {
        $material = Material::findForUser($id, $_SESSION['user_id']);
        if (!$material) { header('Location: /materials'); exit; }

        $material->update([
            'name' => $_POST['name'],
            'category_id' => $_POST['category_id'],
            'supplier_id' => $_POST['supplier_id'],
            'price' => $_POST['price'],
            'unit' => $_POST['unit']
        ]);
        header('Location: /materials');
        exit;
    }

    public function delete($id)
    {
        $material = Material::findForUser($id, $_SESSION['user_id']);
        if ($material) $material->delete();
        header('Location: /materials');
        exit;
    }
}
