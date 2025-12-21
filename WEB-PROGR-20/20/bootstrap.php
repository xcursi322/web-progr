<?php



require_once 'core/config.php';
require_once 'core/connection.php';
require_once 'core/Model.php';
require_once 'core/Controller.php';
require_once 'core/Router.php';

require_once 'models/User.php';
require_once 'models/Category.php';
require_once 'models/Material.php';
require_once 'models/Supplier.php';

require_once 'controllers/HomeController.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/CategoryController.php';
require_once 'controllers/MaterialController.php';
require_once 'controllers/SupplierController.php';

Model::$pdo = $pdo;
