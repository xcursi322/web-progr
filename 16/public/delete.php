<?php
session_start();
require_once "../core/connection.php";
require_once "../models/Material.php";

if (!isset($_SESSION["user_id"])) die("Доступ заборонено");

$m = Material::find($pdo, $_GET["id"]);
if ($m) $m->delete();

header("Location: index.php");
exit;
