<?php

namespace App\Controller; //App sería el nombre del proyecto y Controller la carpeta que lo tiene

use App\Model\Usuario;
use App\Helper\ViewHelper;
use App\Helper\DbHelper; //Conexion a la base de datos


class UsuarioController
{

    //Funcion para la conexion con la BBDD, habra que copiar en los contructores
    var $db;
    var $view;

    function __construct(){
        //Inicilizo la conexion
        $dhhelper = new DbHelper();
        $this->db = $dhhelper->db;

        //Instancio el ViewHelper
        $viewHelper = new ViewHelper();
        $this->view = $viewHelper;
    }

    function acceso(){
        $datos = new \StdClass();
        //Copruebo si esta loggeado
        if(isset($_SESSION['usuario']) && $_SESSION['usuario']){
            $datos->usuario = $_SESSION['usuario'];
            $vista = "panel";
        }else{
            $vista = "acceso";
        }


        //Inicializo mensaje

        $datos->mensaje = "Bienvenido al panel de administración.";
        //Compruebo si ha rellenado el formulario
        if (isset($_POST['acceder'])) {
            $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
            $contrasena = filter_input(INPUT_POST, 'contrasena', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($usuario && $contrasena) {
                //Compruebo que existe el usuario
                if ($this->compruebaUsuario($usuario, $contrasena)) {
                    //Entro al panel
                    $vista = "panel";
                    $datos->usuario = $_SESSION['usuario'];
                } else {
                    $datos->mensaje = "<span class='rojo'> Usuario y/o clave incorrectos <br> Vuelve a intentarlo</span>";
                }
            }
        }
        // Le paso los datos a la vista
        $this->view->vista($vista, $datos);
    }

    function compruebaUsuario($usuario, $contrasena){
        //Realizo la consulta con OBJ
        $resultado = $this->db->query("SELECT * FROM usuarios where usuario='" . $usuario . "'");
        //Asigno la consulta a variable
        $data = $resultado->fetch(\PDO::FETCH_OBJ);

        // Comprobador de contraseñas encriptadas con crypt
        if ($data && hash_equals($data->clave, crypt($contrasena, $data->clave))) {
            //Añado el nombre de usuario a la session
            $_SESSION['usuario'] = $data->usuario;
            return 1;
        } else {
            // return
            return 0;

        }

    }

    function index(){
        //Inicio el objeto usuarios
      // $usuarios = new \stdClass();

        $resultado = $this->db->query('SELECT * FROM usuarios');


        while ($data =  $resultado->fetch(\PDO::FETCH_OBJ)){
            $usuarios [] = new Usuario($data);
        }
        // Le paso los datos
        $this->view->vista("usuarios", $usuarios);
    }


    function salir(){
        //Borro el nombre de usuario a la session
        $_SESSION['usuario'] ="";

        //Le redirijo al panel
        header("Location: " . $_SESSION['home']."panel");
        $this->acceso();
    }
}