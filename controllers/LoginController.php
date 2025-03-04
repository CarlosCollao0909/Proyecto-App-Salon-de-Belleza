<?php 

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {
    public static function login(Router $router) {
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();

            if(empty($alertas)) {
                //comprobar que el usuario exista
                $usuario = Usuario::where('email', $auth->email);

                if($usuario) {
                    //verificar si el usuario esta confirmado
                    if($usuario->checkPasswordAndVerified($auth->password)) {
                        //autenticar el usuario
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . ' ' . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        if($usuario->admin === '1') {
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                        } else {
                            header('Location: /appointment');
                        }
                    }
                } else {
                    Usuario::setAlerta('error', 'Usuario no encontrado');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/login', [
            'alertas' => $alertas
        ]);
    }
    public static function logout() {
        echo "Logout";
    }
    public static function forgotPassword(Router $router) {
        $router->render('auth/forgotPassword', [
            
        ]);
    }
    public static function resetPassword() {
        echo "Reset Password";
    }
    public static function createAccount(Router $router) {

        $usuario = new Usuario;
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            //Revisar que alertas este vacio
            if(empty($alertas)) {
                //Revisar que el usuario no este registrado
                $resultado = $usuario->userExist();

                if($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                }else {
                    //hashear el password
                    $usuario->hashPassword();

                    //Generar token
                    $usuario->createToken();

                    //enviar el email con el token
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                    $email->sendConfirmation();

                    //Crear el usuario
                    $resultado = $usuario->create();
                    if($resultado) {
                        header('Location: /message');
                    }

                    debug($usuario);
                }
            }
        }

        $router->render('auth/createAccount', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function message(Router $router) {
        $router->render('auth/message');
    }

    public static function confirmAccount(Router $router) {
        $alertas = [];
        $token = s($_GET['token']);
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            Usuario::setAlerta('error', 'Token no valido');
        } else {
            //modificar a usuario confirmado
            $usuario->token = "";
            $usuario->confirmado = 1;
            $usuario->update();
            Usuario::setAlerta('exito', 'Cuenta Confirmada Correctamente');
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/confirmAccount', [
            'alertas' => $alertas
        ]);
    }
}