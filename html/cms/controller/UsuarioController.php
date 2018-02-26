<?php

namespace App\Controller; // 🠴 App sería el nombre del proyecto y Controller la carpeta que lo tiene

use App\Model\Usuario;
use App\Helper\ViewHelper;
use App\Helper\DbHelper; // 🠴 Conexion a la base de datos


class UsuarioController
{

    // 🡇 Funcion para la conexion con la BBDD, habra que copiar en los contructores
    var $db;
    var $view;

    function __construct()
    {
        // 🡇 Inicilizo la conexion
        $dhhelper = new DbHelper();
        $this->db = $dhhelper->db;

        // 🡇 Instancio el ViewHelper
        $viewHelper = new ViewHelper();
        $this->view = $viewHelper;
    }

    function acceso() // 🠴 Funcion paramostar la venta de acceso al panel
    {
        $datos = new \StdClass();

        // 🡇 Copruebo si esta loggeado
        if (isset($_SESSION['usuario']) && $_SESSION['usuario']) { // 🠴 Si lo esta le doy acceso al panel de admin
            $datos->usuario = $_SESSION['usuario'];
            $vista = "panel";
        } else {
            $vista = "acceso"; // 🠴 Sino lo redirijo a la pagina de acceso
        }


        // 🡇 Inicilizo el mensaje de bienvenida de la caja de login
        $datos->mensaje = "Bienvenido al panel de administración.";

        // 🡇 Compruebo si ha rellenado el formulario de acceso
        if (isset($_POST['acceder'])) {

            // 🡇 aplico el saneador de inputs para evitar inyecciones de código
            $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
            $contrasena = filter_input(INPUT_POST, 'contrasena', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if ($usuario && $contrasena) { // 🠴 Si se le han pasado los datos de usuario y contraseña

                // 🡇 Compruebo que existe el usuario
                if ($this->compruebaUsuario($usuario, $contrasena)) { // 🠴 Si existe le mando al panel y establezco la variable en sesion del nombre de usuario
                    $vista = "panel";
                    $datos->usuario = $_SESSION['usuario'];
                } else {  // 🠴 No podra acceder y se le mostrara un error en la parte superior de los inputs indicandole que la pass o el user son erroneos
                    $datos->mensaje = "<span class='rojo'> Usuario y/o clave incorrectos <br> Vuelve a intentarlo</span>";
                }
            }
        }

        $this->view->vista($vista, $datos); // 🠴 Le paso los datos a la vista

    }

    function compruebaUsuario($usuario, $contrasena) // 🠴 Funcion para comprobar el usuario y contraseña
    {
        // 🡇 Realizo la consulta para saber si el usuario es correcto y esta activo
        $resultado = $this->db->query("SELECT * FROM usuarios where usuario='" . $usuario . "' AND activo=1");

        // 🡇 Asigno la consulta a variable
        $data = $resultado->fetch(\PDO::FETCH_OBJ);

        // 🡇 Comprobador de contraseñas encriptadas con  la funcion crypt
        if ($data && hash_equals($data->clave, crypt($contrasena, $data->clave))) {

            // 🡇 Añado el nombre de usuario y los permisos a la session
            $_SESSION['usuario'] = $data->usuario;
            $_SESSION['nombre_completo'] = $data->nombre_completo;
            $_SESSION['usuarios'] = $data->usuarios;
            $_SESSION['noticias'] = $data->noticias;

            // 🡇 Añado a la base de datos el timestamp del acceso del usuario
            $momento = time();
            $fecha = date($momento);
            $this->db->exec("UPDATE usuarios SET fecha_acceso=" . $fecha . " where usuario='" . $usuario . "'");
            return 1;  // 🠴 Retorno un 1 como conexion realizada
        } else {
            return 0;  // 🠴 Retorno un 0 como contraseña erronea

        }

    }

    function index() // 🠴 Funcion para el index del panel
    {
        // 🡇 Compruebo permisos con la funcion homónima
        $this->permisos();

        // 🡇 Realizo la consulta para saber si el usuario es correcto y esta activo
        $resultado = $this->db->query('SELECT * FROM usuarios');

        // 🡇 Asigno la consulta a variable
        while ($data = $resultado->fetch(\PDO::FETCH_OBJ)) {
            $usuarios [] = new Usuario($data);
        }

        $this->view->vista("usuarios", $usuarios);// 🠴 Le paso los datos a la vista
    }

    function salir()// 🠴 Funcion para salir del panel
    {
        // 🡇 Borro las variable de session que he ido almacenando
        $_SESSION['usuario'] = "";
        $_SESSION['nombre_completo'] = "";
        $_SESSION['usuarios'] = "";
        $_SESSION['noticias'] = "";

        // 🡇 Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel");
        $this->acceso();

    }

    function crear() // 🠴 Funcion para crear nuevos usuarios
    {
        // 🡇 Compruebo permisos con la funcion homónima
        $this->permisos();


        $nombre = "usuario" . rand(1000, 99999); // 🠴 Creo la variable nombre seguido de un rumero aleatorio para la creacion

        // 🡇 Inserto el nombre en la base de datos usando la variable $nombre
        $registros = $this->db->exec('INSERT INTO usuarios (usuario) VALUES("' . $nombre . '")');


        // 🡇 Inicializo los mensajes de error/exito
        if ($registros) {  // 🠴 Si la creacion es correcta establezo un mensaje de exito
            $mensaje[] = ['tipo' => 'success',
                'texto' => "El usuario <strong> $nombre </strong> se ha añadido correctamente"
            ];
        } else { // 🠴 Si la creacion es correcta establezo un mensaje de error
            $mensaje[] = ['tipo' => 'danger',
                'texto' => "Ha ocurrido un error al añadir el usuario"
            ];
        }

        // 🡇 La variable contiene el mensaje que le paso de if con los datos del mensaje y el tipo de banner que se necesita
        $_SESSION['mensajes'] = $mensaje;

        // 🡇 Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/usuarios");
        $this->usuarios();
    }

    function activar($id) // 🠴 Funcion para activar usuarios
    {
        // 🡇 Compruebo permisos con la funcion homónima
        $this->permisos();

        if ($id) { // 🠴 Si la funcion recibe un id

            // 🡇 Actualizo el valor en la BBDD
            $registros = $this->db->exec("UPDATE usuarios SET activo=1 WHERE id=" . $id . "");

            // 🡇 Inicializo los mensajes de error/exito
            if ($registros) { // 🠴 Si la activacion es correcta establezo un mensaje de exito
                $mensaje[] = ['tipo' => 'success',
                    'texto' => "El usuario se ha activado correctamente"
                ];
            } else { // 🠴 Si la activacion es incorrecta establezo un mensaje de error
                $mensaje[] = ['tipo' => 'danger',
                    'texto' => "Ha ocurrido un error al activar el usuario"
                ];
            }
        } else {  // 🠴 Si el id recibido no es correcto establezo un mensaje de error
            $mensaje[] = ['tipo' => 'danger',
                'texto' => "Ha ocurrido un error al activar el usuario"
            ];
        }

        // 🡇 La variable contiene el mensaje que le paso de if con los datos del mensaje y el tipo de banner que se necesita
        $_SESSION['mensajes'] = $mensaje;

        // 🡇 Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/usuarios");

    }

    function desactivar($id)// 🠴 Funcion para desactivar usuarios
    {
        // 🡇 Compruebo permisos con la funcion homónima
        $this->permisos();


        if ($id) { // 🠴 Si la funcion recibe un id

            // 🡇 Actualizo el valor en la BBDD
            $registros = $this->db->exec("UPDATE usuarios SET activo=0 WHERE id=" . $id . "");


            // 🡇 Inicializo los mensajes de error/exito
            if ($registros) { // 🠴 Si la desactivacion es correcta establezo un mensaje de exito
                $mensaje[] = ['tipo' => 'success',
                    'texto' => "El usuario se ha desactivado correctamente"
                ];
            } else {  // 🠴 Si la activacion es incorrecta establezo un mensaje de error
                $mensaje[] = ['tipo' => 'danger',
                    'texto' => "Ha ocurrido un error al desactivar el usuario"
                ];
            }
        } else { // 🠴 Si el id recibido no es correcto establezo un mensaje de error
            $mensaje[] = ['tipo' => 'danger',
                'texto' => "Ha ocurrido un error al desactivar el usuario"
            ];
        }

        // 🡇 La variable contiene el mensaje que le paso de if con los datos del mensaje y el tipo de banner que se necesita
        $_SESSION['mensajes'] = $mensaje;

        // 🡇 Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/usuarios");

    }

    function borrar($id) // 🠴 Funcion para borrar usuarios
    {
        // 🡇 Compruebo permisos con la funcion homónima
        $this->permisos();

        if ($id) { // 🠴 Si la funcion recibe un id

            // 🡇 Borro el valor en la BBDD
            $registros = $this->db->exec("DELETE FROM usuarios WHERE id=" . $id . "");

            // 🡇 Inicializo los mensajes de error/exito
            if ($registros) { // 🠴 Si el borrado es correcto establezo un mensaje de exito
                $mensaje[] = ['tipo' => 'success',
                    'texto' => "El usuario se ha borrado correctamente"
                ];
            } else { // 🠴 Si el borrado no se puede realizar establezo un mensaje de error
                $mensaje[] = ['tipo' => 'danger',
                    'texto' => "Ha ocurrido un error al borrar el usuario"
                ];
            }
        } else { // 🠴 Si el id recibido no es correcto establezo un mensaje de error
            $mensaje[] = ['tipo' => 'danger',
                'texto' => "Ha ocurrido un error al borrar el usuario"
            ];
        }

        // 🡇 La variable contiene el mensaje que le paso de if con los datos del mensaje y el tipo de banner que se necesita
        $_SESSION['mensajes'] = $mensaje;

        // 🡇 Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/usuarios");

    }

    function editar($id) // 🠴 Funcion para editar usuarios
    {
        if ($id) { // 🠴 Si la funcion recibe un id

            // 🡇 Compruebo permisos con la funcion homónima
            $this->permisos();

            // 🡇 Si se ha pulsado el boton de guardar y en el post recibe la palabla guardar del boton
            if (isset($_POST['guardar']) && $_POST['guardar'] == "Guardar") {

                // 🡇 Recojo los valores de los inputs de editar
                $usuario = filter_input(0, 'usuario', FILTER_SANITIZE_SPECIAL_CHARS);
                $nombre_completo = filter_input(0, 'nombre', FILTER_SANITIZE_STRING);
                $clave = crypt(filter_input(0, 'clave', FILTER_SANITIZE_STRING));
                $usuarios = (filter_input(0, 'usuarios', FILTER_SANITIZE_STRING) == 'on') ? 1 : 0;
                $noticias = (filter_input(0, 'noticias', FILTER_SANITIZE_STRING) == 'on') ? 1 : 0;

                // 🡇 Guardo en la base de datos mediante transaction
                $this->db->beginTransaction();
                $this->db->exec("UPDATE usuarios SET usuario='" . $usuario . "' WHERE id=" . $id . "");
                if (isset($_POST['cambiarClave'])) {
                    $this->db->exec("UPDATE usuarios SET clave='" . $clave . "' WHERE id=" . $id . "");
                }
                $this->db->exec("UPDATE usuarios SET usuarios='" . $usuarios . "' WHERE id=" . $id . "");
                $this->db->exec("UPDATE usuarios SET noticias='" . $noticias . "' WHERE id=" . $id . "");
                $this->db->exec("UPDATE usuarios SET nombre_completo='" . $nombre_completo . "' WHERE id=" . $id . "");
                $this->db->commit();

                //Mensaje y redireccion
                $mensaje[] = ['tipo' => 'success',
                    'texto' => "El usuario <b>$usuario</b> se ha guardado correctamente"
                ];

                // 🡇 La variable contiene el mensaje que le paso de if con los datos del mensaje y el tipo de banner que se necesita
                $_SESSION['mensajes'] = $mensaje;

                // 🡇 Le redirijo al panel
                header("Location: " . $_SESSION['home'] . "panel/usuarios");

            } else {
                $resultado = $this->db->query("SELECT * FROM usuarios WHERE id=" . $id . " LIMIT 1");

                //Mensaje
                if ($resultado) {
                    $usuario = $resultado->fetch(\PDO::FETCH_OBJ);
                    //Le paso los datos a la vista
                    $this->view->vista('editar', $usuario);

                } else {  // 🠴 Si el id recibido no es correcto establezo un mensaje de error
                    $_SESSION['mensajes'] = $mensaje;
                    //Le redirijo al panel
                    header("Location: " . $_SESSION['home'] . "panel/usuarios");
                }
            }
        } else {

            // 🡇 La variable contiene el mensaje que le paso de if con los datos del mensaje y el tipo de banner que se necesita
            $_SESSION['mensajes'] = $mensaje;

            // 🡇 Le redirijo al panel
            header("Location: " . $_SESSION['home'] . "panel/usuarios");
        }

    }

    function permisos() // 🠴 Funcion para comprobar los permisos del usuario
    {
        // 🡇 Si no esta setteado la casilla de usuarios o es distinta de 1
        if (!isset($_SESSION['usuarios']) || $_SESSION['usuarios'] != 1) {

            // 🡇 Se establece el mensaje de usuario no autorizado
            $mensaje[] = ['tipo' => 'warning',
                'texto' => "Usuario no autorizado"
            ];

            // 🡇 La variable contiene el mensaje que le paso de if con los datos del mensaje y el tipo de banner que se necesita
            $_SESSION['mensajes'] = $mensaje;

            // 🡇 Le redirijo al panel
            header("Location: " . $_SESSION['home'] . "panel");
        }
    }
}