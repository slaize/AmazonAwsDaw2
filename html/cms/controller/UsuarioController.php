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

    function __construct()
    {
        //Inicilizo la conexion
        $dhhelper = new DbHelper();
        $this->db = $dhhelper->db;

        //Instancio el ViewHelper
        $viewHelper = new ViewHelper();
        $this->view = $viewHelper;
    }

    function acceso()
    {
        $datos = new \StdClass();
        //Copruebo si esta loggeado
        if (isset($_SESSION['usuario']) && $_SESSION['usuario']) {
            $datos->usuario = $_SESSION['usuario'];
            $vista = "panel";
        } else {
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
        $resultado = $this->db->query("SELECT * FROM usuarios where usuario='" . $usuario . "' AND activo=1");
        //Asigno la consulta a variable
        $data = $resultado->fetch(\PDO::FETCH_OBJ);

        // Comprobador de contraseñas encriptadas con crypt
        if ($data && hash_equals($data->clave, crypt($contrasena, $data->clave))) {
            //Añado el nombre de usuario y los permisos a la session
            $_SESSION['usuario'] = $data->usuario;
            $_SESSION['nombre_completo'] = $data->nombre_completo;
            $_SESSION['usuarios'] = $data->usuarios;
            $_SESSION['noticias'] = $data->noticias;
            $momento = time();
            $fecha = date($momento);
            $this->db->exec("UPDATE usuarios SET fecha_acceso=" . $fecha . " where usuario='" . $usuario . "'");
            return 1;
        } else {
            // return
            return 0;

        }

    }

    function index()
    {
        // Compruebo permisos
        $this->permisos();

        $resultado = $this->db->query('SELECT * FROM usuarios');


        while ($data = $resultado->fetch(\PDO::FETCH_OBJ)) {
            $usuarios [] = new Usuario($data);
        }
        // Le paso los datos
        $this->view->vista("usuarios", $usuarios);
    }


    function salir()
    {
        //Borro el nombre de usuario a la session
        $_SESSION['usuario'] = "";
        $_SESSION['nombre_completo'] = "";
        $_SESSION['usuarios'] = "";
        $_SESSION['noticias'] = "";

        //Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel");
        $this->acceso();

    }

    function crear()
    {
        $this->permisos();
        //Create user
        //Insert
        $nombre = "usuario" . rand(1000, 99999);
        $registros = $this->db->exec('INSERT INTO usuarios (usuario) VALUES("' . $nombre . '")');

        //Mensajes
        if ($registros) {
            $mensaje[] = ['tipo' => 'success',
                'texto' => "El usuario <strong> $nombre </strong> se ha añadido correctamente"
            ];
        } else {
            $mensaje[] = ['tipo' => 'danger',
                'texto' => "Ha ocurrido un error al añadir el usuario"
            ];
        }

        $_SESSION['mensajes'] = $mensaje;

        //Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/usuarios");
        $this->usuarios();
    }

    function activar($id)
    {
        $this->permisos();
        if ($id) {
            //Update
            $registros = $this->db->exec("UPDATE usuarios SET activo=1 WHERE id=" . $id . "");
            //Mensajes
            if ($registros) {
                $mensaje[] = ['tipo' => 'success',
                    'texto' => "El usuario se ha activado correctamente"
                ];
            } else {
                $mensaje[] = ['tipo' => 'danger',
                    'texto' => "Ha ocurrido un error al activar el usuario"
                ];
            }
        } else {
            $mensaje[] = ['tipo' => 'danger',
                'texto' => "Ha ocurrido un error al activar el usuario"
            ];
        }
        $_SESSION['mensajes'] = $mensaje;
        //Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/usuarios");

    }

    function desactivar($id)
    {
        $this->permisos();
        if ($id) {
            //Update
            $registros = $this->db->exec("UPDATE usuarios SET activo=0 WHERE id=" . $id . "");
            //Mensajes
            if ($registros) {
                $mensaje[] = ['tipo' => 'success',
                    'texto' => "El usuario se ha desactivado correctamente"
                ];
            } else {
                $mensaje[] = ['tipo' => 'danger',
                    'texto' => "Ha ocurrido un error al desactivar el usuario"
                ];
            }
        } else {
            $mensaje[] = ['tipo' => 'danger',
                'texto' => "Ha ocurrido un error al desactivar el usuario"
            ];
        }
        $_SESSION['mensajes'] = $mensaje;
        //Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/usuarios");

    }

    function borrar($id)
    {
        $this->permisos();
        if ($id) {
            //Update
            $registros = $this->db->exec("DELETE FROM usuarios WHERE id=" . $id . "");
            //Mensajes
            if ($registros) {
                $mensaje[] = ['tipo' => 'success',
                    'texto' => "El usuario se ha borrado correctamente"
                ];
            } else {
                $mensaje[] = ['tipo' => 'danger',
                    'texto' => "Ha ocurrido un error al borrar el usuario"
                ];
            }
        } else {
            $mensaje[] = ['tipo' => 'danger',
                'texto' => "Ha ocurrido un error al borrar el usuario"
            ];
        }
        $_SESSION['mensajes'] = $mensaje;
        //Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/usuarios");

    }

    function editar($id){
        if ($id) {
            $this->permisos();
            if (isset($_POST['guardar']) && $_POST['guardar'] == "Guardar") {

                //Recojo los valores de los inputs de editar
                $usuario = filter_input(0, 'usuario', FILTER_SANITIZE_SPECIAL_CHARS);
                $nombre_completo = filter_input(0, 'nombre', FILTER_SANITIZE_STRING);
                $clave = crypt(filter_input(0, 'clave', FILTER_SANITIZE_STRING));
                $usuarios = (filter_input(0, 'usuarios', FILTER_SANITIZE_STRING) == 'on') ? 1 : 0;
                $noticias = (filter_input(0, 'noticias', FILTER_SANITIZE_STRING) == 'on') ? 1 : 0;

                //Guardo en la base de datos
                $this->db->beginTransaction();
                $this->db->exec("UPDATE usuarios SET usuario='".$usuario."' WHERE id=" . $id . "");
                $this->db->exec("UPDATE usuarios SET clave='".$clave."' WHERE id=" . $id . "");
                $this->db->exec("UPDATE usuarios SET usuarios='".$usuarios."' WHERE id=" . $id . "");
                $this->db->exec("UPDATE usuarios SET noticias='".$noticias."' WHERE id=" . $id . "");
                $this->db->exec("UPDATE usuarios SET nombre_completo='".$nombre_completo."' WHERE id=" . $id . "");
                $this->db->commit();

                //Mensaje y redireccion
                $mensaje[] = ['tipo' => 'success',
                    'texto' => "El usuario <b>$usuario</b> se ha guardado correctamente"
                ];
                $_SESSION['mensajes'] = $mensaje;
                //Le redirijo al panel
                header("Location: " . $_SESSION['home'] . "panel/usuarios");

            } else {
                $resultado = $this->db->query("SELECT * FROM usuarios WHERE id=" . $id . " LIMIT 1");

                //Mensaje
                if ($resultado) {
                    $usuario = $resultado->fetch(\PDO::FETCH_OBJ);
                    //Le paso los datos a la vista
                    $this->view->vista('editar', $usuario);

                } else {
                    $_SESSION['mensajes'] = $mensaje;
                    //Le redirijo al panel
                    header("Location: " . $_SESSION['home'] . "panel/usuarios");
                }
            }
        } else {
            $_SESSION['mensajes'] = $mensaje;
            //Le redirijo al panel
            header("Location: " . $_SESSION['home'] . "panel/usuarios");
        }

    }

    function permisos(){
        if(!isset($_SESSION['usuarios']) || $_SESSION['usuarios'] != 1){
            $mensaje[] = ['tipo' => 'warning',
                'texto' => "Usuario no autorizado"
            ];
            $_SESSION['mensajes'] = $mensaje;
            //Le redirijo al panel
            header("Location: " . $_SESSION['home'] . "panel");
        }
    }
}