<?php

namespace App\Controller; //App sería el nombre del proyecto y Controller la carpeta que lo tiene

use App\Model\Usuario;
use App\Helper\ViewHelper;
use App\Helper\DbHelper; //Conexion a la base de datos


class NoticiaController
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


    function index()
    {
        //Inicio el objeto usuarios
        // $usuarios = new \stdClass();

        $resultado = $this->db->query('SELECT * FROM noticias');


        while ($data = $resultado->fetch(\PDO::FETCH_OBJ)) {
            $noticias [] = new Noticia($data);
        }
        // Le paso los datos
        $this->view->vista("noticias", $noticias);
    }


//// HE MODIFICADO HASTA AQUI >>>>>>>>>
    function crear()
    {

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
            if (isset($_POST['guardar']) && $_POST['guardar'] == "Guardar") {

                //Recojo los valores de los inputs de editar
                $usuario = filter_input(0, 'usuario', FILTER_SANITIZE_SPECIAL_CHARS);
                $usuarios = (filter_input(0, 'usuarios', FILTER_SANITIZE_STRING) == 'on') ? 1 : 0;
                $noticias = (filter_input(0, 'noticias', FILTER_SANITIZE_STRING) == 'on') ? 1 : 0;

                //Guardo en la base de datos
                $this->db->beginTransaction();
                $this->db->exec("UPDATE usuarios SET usuario='".$usuario."' WHERE id=" . $id . "");
                $this->db->exec("UPDATE usuarios SET usuarios='".$usuarios."' WHERE id=" . $id . "");
                $this->db->exec("UPDATE usuarios SET noticias='".$noticias."' WHERE id=" . $id . "");
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
}