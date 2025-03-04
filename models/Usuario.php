<?php

namespace Model;

class Usuario extends ActiveRecord {
    //db
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    //constructor
    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? 0;
        $this->confirmado = $args['confirmado'] ?? 0;
        $this->token = $args['token'] ?? '';
    }

    //validar creacion de cuenta
    public function validarNuevaCuenta() {
        if (!$this->nombre) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        if (!$this->apellido) {
            self::$alertas['error'][] = 'El apellido es Obligatorio';
        }
        if (!$this->telefono) {
            self::$alertas['error'][] = 'El Telefono es Obligatorio';
        }
        if (!preg_match('/^[0-9]{8}$/', $this->telefono)) {
            self::$alertas['error'][] = 'El telefono no es valido';
        }
        if (!$this->email) {
            self::$alertas['error'][] = 'El Email es Obligatorio';
        }
        if (!$this->password) {
            self::$alertas['error'][] = 'El password es Obligatorio';
        }
        if (strlen($this->password) < 8) {
            self::$alertas['error'][] = 'El password debe tener al menos 8 caracteres';
        }

        return self::$alertas;
    }

    //validar login
    public function validarLogin() {
        if(!$this->email) {
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }
        return self::$alertas;
    }

    //verificar si el usuario existe
    public function userExist() {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);

        if ($resultado->num_rows) {
            self::$alertas['error'][] = 'El usuario ya se encuentra registrado';
        }

        return $resultado;
    }

    //hashear el password
    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    //generar token
    public function createToken() {
        $this->token = uniqid();
    }

    //comprobar el password y si esta confirmado
    public function checkPasswordAndVerified($password) {
        $resultado = password_verify($password, $this->password);
        if(!$resultado || !$this->confirmado) {
            self::$alertas['error'][] = 'Contraseña incorrecta o tu cuenta no se encuentra confirmada';
        } else {
            return true;
        }
    }
}
