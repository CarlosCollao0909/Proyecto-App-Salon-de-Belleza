<?php 

namespace Controllers;

use MVC\Router;

class LoginController {
    public static function login(Router $router) {
        $router->render('auth/login', [
            
        ]);
    }
    public static function logout() {
        echo "Logout";
    }
    public static function forgotPassword() {
        echo "Forgot Password";
    }
    public static function resetPassword() {
        echo "Reset Password";
    }
    public static function createAccount() {
        echo "Create Account";
    }
}