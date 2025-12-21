<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Category.php';

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::allForUser($_SESSION['user_id']);
        $title = 'Категорії';
        $template = 'categories_index.php';
        include "views/layout.php";
    }

    public function show($id)
    {
        $category = Category::findForUser($id, $_SESSION['user_id']);
        if (!$category) { header('Location: /categories'); exit; }

        $title = 'Категорія';
        $template = 'categories_show.php';
        include "views/layout.php";
    }

    public function create()
    {
        $title = 'Додати категорію';
        $template = 'categories_create.php';
        include "views/layout.php";
    }

    public function store()
    {
        Category::insert([
            'title' => $_POST['title'],
            'user_id' => $_SESSION['user_id']
        ]);
        header('Location: /categories');
        exit;
    }

    public function edit($id)
    {
        $category = Category::findForUser($id, $_SESSION['user_id']);
        if (!$category) { header('Location: /categories'); exit; }

        $title = 'Редагувати категорію';
        $template = 'categories_edit.php';
        include "views/layout.php";
    }

    public function update($id)
    {
        $category = Category::findForUser($id, $_SESSION['user_id']);
        if (!$category) { header('Location: /categories'); exit; }

        $category->update(['title' => $_POST['title']]);
        header('Location: /categories');
        exit;
    }

    public function delete($id)
    {
        $category = Category::findForUser($id, $_SESSION['user_id']);
        if ($category) $category->delete();
        header('Location: /categories');
        exit;
    }
}
