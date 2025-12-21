<?php

require_once 'bootstrap.php';

$router = new Router($pdo);


$router->addRoute('GET', '/', [HomeController::class, 'index']);

$router->addRoute('GET', '/register', [AuthController::class, 'showRegisterForm']);
$router->addRoute('POST', '/register', [AuthController::class, 'register']);
$router->addRoute('GET', '/login', [AuthController::class, 'showLoginForm']);
$router->addRoute('POST', '/login', [AuthController::class, 'login']);
$router->addRoute('GET', '/logout', [AuthController::class, 'logout']);


$router->addRoute('GET', '/categories', [CategoryController::class, 'index']); 
$router->addRoute('GET', '/categories/create', [CategoryController::class, 'create']); // 
$router->addRoute('POST', '/categories/store', [CategoryController::class, 'store']); // 
$router->addRoute('GET', '/categories/{id}/show', [CategoryController::class, 'show']); // 
$router->addRoute('GET', '/categories/{id}/edit', [CategoryController::class, 'edit']); // 
$router->addRoute('POST', '/categories/{id}/update', [CategoryController::class, 'update']); 
$router->addRoute('GET', '/categories/{id}/delete', [CategoryController::class, 'delete']); //


$router->addRoute('GET', '/materials', [MaterialController::class, 'index']);
$router->addRoute('GET', '/materials/create', [MaterialController::class, 'create']);
$router->addRoute('POST', '/materials/store', [MaterialController::class, 'store']);
$router->addRoute('GET', '/materials/{id}/show', [MaterialController::class, 'show']);
$router->addRoute('GET', '/materials/{id}/edit', [MaterialController::class, 'edit']);
$router->addRoute('POST', '/materials/{id}/update', [MaterialController::class, 'update']);
$router->addRoute('GET', '/materials/{id}/delete', [MaterialController::class, 'delete']);


$router->addRoute('GET', '/suppliers', [SupplierController::class, 'index']);
$router->addRoute('GET', '/suppliers/create', [SupplierController::class, 'create']);
$router->addRoute('POST', '/suppliers/store', [SupplierController::class, 'store']);
$router->addRoute('GET', '/suppliers/{id}/show', [SupplierController::class, 'show']);
$router->addRoute('GET', '/suppliers/{id}/edit', [SupplierController::class, 'edit']);
$router->addRoute('POST', '/suppliers/{id}/update', [SupplierController::class, 'update']);
$router->addRoute('GET', '/suppliers/{id}/delete', [SupplierController::class, 'delete']);


$router->handleRequest();
