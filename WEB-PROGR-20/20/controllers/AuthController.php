<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/User.php';

class AuthController extends Controller
{
    
    public function showRegisterForm()
    {
        $template = 'register.php'; // <-- файл изменён
        include 'views/layout.php';
    }

    
    public function register()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $password_confirm = $_POST['password_confirm'] ?? '';

        if ($password !== $password_confirm) {
            echo "Паролі не співпадають";
            return;
        }

        $existing = User::findByUsername($username);
        if ($existing) {
            echo "Користувач з таким ім'ям вже існує";
            return;
        }

        $hashed = password_hash($password, PASSWORD_DEFAULT);

        User::insert([
            'username' => $username,
            'password' => $hashed,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        header('Location: /login');
        exit;
    }

   
    public function showLoginForm()
    {
        $template = 'login.php'; 
        include 'views/layout.php';
    }

   
    public function login()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = User::findByUsername($username);
        if (!$user || !password_verify($password, $user->columns->password)) {
            echo "Невірний логін або пароль";
            return;
        }

        session_start();
        $_SESSION['user_id'] = $user->columns->id;
        $_SESSION['username'] = $user->columns->username;

        header('Location: /materials'); 
        exit;
    }

  
    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /login');
        exit;
    }
}
