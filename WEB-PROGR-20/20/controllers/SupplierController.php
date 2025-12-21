<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Supplier.php';

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::allForUser($_SESSION['user_id']);
        $title = 'Постачальники';
        $template = 'suppliers_index.php';
        include "views/layout.php";
    }

    public function show($id)
    {
        $supplier = Supplier::findForUser($id, $_SESSION['user_id']);
        if (!$supplier) { header('Location: /suppliers'); exit; }

        $title = 'Постачальник';
        $template = 'suppliers_show.php';
        include "views/layout.php";
    }

    public function create()
    {
        $title = 'Додати постачальника';
        $template = 'suppliers_create.php';
        include "views/layout.php";
    }

    public function store()
    {
        Supplier::insert([
            'name' => $_POST['name'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'user_id' => $_SESSION['user_id']
        ]);
        header('Location: /suppliers');
        exit;
    }

    public function edit($id)
    {
        $supplier = Supplier::findForUser($id, $_SESSION['user_id']);
        if (!$supplier) { header('Location: /suppliers'); exit; }

        $title = 'Редагувати постачальника';
        $template = 'suppliers_edit.php';
        include "views/layout.php";
    }

    public function update($id)
    {
        $supplier = Supplier::findForUser($id, $_SESSION['user_id']);
        if (!$supplier) { header('Location: /suppliers'); exit; }

        $supplier->update([
            'name' => $_POST['name'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email']
        ]);
        header('Location: /suppliers');
        exit;
    }

    public function delete($id)
    {
        $supplier = Supplier::findForUser($id, $_SESSION['user_id']);
        if ($supplier) $supplier->delete();
        header('Location: /suppliers');
        exit;
    }
}
