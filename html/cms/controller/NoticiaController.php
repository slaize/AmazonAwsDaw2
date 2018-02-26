<?php

namespace App\Controller;// 🠴 App sería el nombre del proyecto y Controller la carpeta que lo tiene

use App\Model\Noticia;
use App\Helper\ViewHelper;
use App\Helper\DbHelper; // 🠴 Conexion a la base de datos
$public = '/cms/public/';

class NoticiaController
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
    } // Completa

    function index() // 🠴 Funcion para el index de las noticias
    {
        // 🡇 Compruebo permisos con la funcion homónima
        $this->permisos();

        // 🡇 Inicio el array noticias para que no de fallo en el front-end si no hubiera ninguna
        $noticias = [];

        // 🡇 Realizo la consulta para saber si el usuario es correcto y esta activo
        $resultado = $this->db->query('SELECT * FROM noticias order by fecha_alta DESC');

        // 🡇 Asigno la consulta a variable
        while ($data = $resultado->fetch(\PDO::FETCH_OBJ)) {
            $noticias [] = new Noticia($data);
        }

        $this->view->vista("noticias", $noticias);// 🠴 Le paso los datos a la vista
    }

    function crear() // 🠴 Funcion para crear nuevas noticias
    {

        $nombre = "noticia" . rand(0, 999999);   // 🠴 Variable para el nombre inicial de la noticia
        $nombre_completo = $_SESSION['nombre_completo'];  // 🠴 Variable para recuperar el autor de las noticias

        // 🡇 Inserto la noticia en la base de datos usando la variable $nombre
        $registros = $this->db->exec('INSERT INTO noticias (titulo,autor) VALUES("' . $nombre . '", "' . $nombre_completo . '")');


        // 🡇 Inicializo los mensajes de error/exito
        if ($registros) {
            $mensaje[] = ['tipo' => 'success',
                'texto' => "La noticia <strong> $nombre </strong> se ha añadido correctamente"
            ];
        } else {
            $mensaje[] = ['tipo' => 'danger',
                'texto' => "Ha ocurrido un error al añadir la noticia"
            ];
        }

        // 🡇 La variable contiene el mensaje que le paso de if con los datos del mensaje y el tipo de banner que se necesita
        $_SESSION['mensajes'] = $mensaje;

        // 🡇 Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/noticias");
        $this->noticias();
    }

    function activar($id) // 🠴 Funcion para activar noticias
    {
        if ($id) { // 🠴 Si la funcion recibe un id

            // 🡇 Actualizo el valor en la BBDD
            $registros = $this->db->exec("UPDATE noticias SET activa=1 WHERE id=" . $id . "");
            $fecha_pub = date("Y-m-d H:i:s");  // 🠴 Establezco una fecha de publicacion


            // 🡇 Inicializo los mensajes de error/exito
            if ($registros) {

                // 🡇 Si hay exito actualizo el valor de la fecha en la BBDD con la fecha de la variable anterior
                $this->db->exec("UPDATE noticias SET fecha_publicacion='" . $fecha_pub . "' WHERE id=" . $id . "");
                $mensaje[] = ['tipo' => 'success',
                    'texto' => "La noticia se ha activado correctamente"
                ];
            } else {
                $mensaje[] = ['tipo' => 'danger',
                    'texto' => "Ha ocurrido un error al activar la noticia"
                ];
            }
        } else {
            $mensaje[] = ['tipo' => 'danger',
                'texto' => "Ha ocurrido un error al activar la noticia"
            ];
        }

        // 🡇 La variable contiene el mensaje que le paso de if con los datos del mensaje y el tipo de banner que se necesita
        $_SESSION['mensajes'] = $mensaje;

        // 🡇 Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/noticias");

    }

    function desactivar($id) // 🠴 Funcion para desactivar noticias
    {
        if ($id) {  // 🠴 Si la funcion recibe un id

            // 🡇 Actualizo el valor en la BBDD
            $registros = $this->db->exec("UPDATE noticias SET activa=0 WHERE id=" . $id . "");

            // 🡇 Inicializo los mensajes de error/exito
            if ($registros) {
                // 🡇 Si hay exito actualizo el valor de la fecha en la BBDD a null
                $this->db->exec("UPDATE noticias SET fecha_publicacion=null WHERE id=" . $id . "");
                $mensaje[] = ['tipo' => 'success',
                    'texto' => "La noticia se ha desactivado correctamente"
                ];
            } else {
                $mensaje[] = ['tipo' => 'danger',
                    'texto' => "Ha ocurrido un error al desactivar la noticia"
                ];
            }
        } else {
            $mensaje[] = ['tipo' => 'danger',
                'texto' => "Ha ocurrido un error al desactivar la noticia"
            ];
        }

        // 🡇 La variable contiene el mensaje que le paso de if con los datos del mensaje y el tipo de banner que se necesita
        $_SESSION['mensajes'] = $mensaje;

        // 🡇 Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/noticias");

    }

    function homeactivar($id) // 🠴 Funcion para activar noticias de la homepage
    {
        if ($id) { // 🠴 Si la funcion recibe un id

            // 🡇 Inicializo los mensajes de error/exito
            $registros = $this->db->exec("UPDATE noticias SET home=1 WHERE id=" . $id . "");

            // 🡇 Inicializo los mensajes de error/exito
            if ($registros) {
                $mensaje[] = ['tipo' => 'success',
                    'texto' => "La noticia se ha añadido a la home correctamente"
                ];
            } else {
                $mensaje[] = ['tipo' => 'danger',
                    'texto' => "Ha ocurrido un error al añadir  la noticia a la home"
                ];
            }
        } else {
            $mensaje[] = ['tipo' => 'danger',
                'texto' => "Ha ocurrido un error al añadir  la noticia a la home"
            ];
        }

        // 🡇 La variable contiene el mensaje que le paso de if con los datos del mensaje y el tipo de banner que se necesita
        $_SESSION['mensajes'] = $mensaje;

        // 🡇 Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/noticias");

    }

    function homedesactivar($id) // 🠴 Funcion para desactivar noticias de la homepage
    {
        if ($id) {// 🠴 Si la funcion recibe un id

            // 🡇 Actualizo el valor en la BBDD
            $registros = $this->db->exec("UPDATE noticias SET home=0 WHERE id=" . $id . "");

            // 🡇 Inicializo los mensajes de error/exito
            if ($registros) {
                $mensaje[] = ['tipo' => 'success',
                    'texto' => "La noticia se ha quitado correctamente de la home"
                ];
            } else {
                $mensaje[] = ['tipo' => 'danger',
                    'texto' => "Ha ocurrido un error al quitar  la noticia de la home"
                ];
            }
        } else {
            $mensaje[] = ['tipo' => 'danger',
                'texto' => "Ha ocurrido un error al quitar  la noticia de la home"
            ];
        }

        // 🡇 La variable contiene el mensaje que le paso de if con los datos del mensaje y el tipo de banner que se necesita
        $_SESSION['mensajes'] = $mensaje;

        // 🡇 Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/noticias");

    }

    function borrar($id) // 🠴 Funcion para borrar noticias
    {

        if ($id) { // 🠴 Si la funcion recibe un id

            // 🡇 Borro el valor en la BBDD
            $registros = $this->db->exec("DELETE FROM noticias WHERE id=" . $id . "");

            // 🡇 Inicializo los mensajes de error/exito
            if ($registros) {
                $mensaje[] = ['tipo' => 'success',
                    'texto' => "La noticia se ha borrado correctamente"
                ];
            } else {
                $mensaje[] = ['tipo' => 'danger',
                    'texto' => "Ha ocurrido un error al borrar la noticia"
                ];
            }
        } else {
            $mensaje[] = ['tipo' => 'danger',
                'texto' => "Ha ocurrido un error al borrar la noticia"
            ];
        }

        // 🡇 La variable contiene el mensaje que le paso de if con los datos del mensaje y el tipo de banner que se necesita
        $_SESSION['mensajes'] = $mensaje;

        // 🡇 Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/noticias");

    }

    function editarN($id) // 🠴 Funcion para editar noticias
    {
        if ($id) { // 🠴 Si la funcion recibe un id

            // 🡇 Si se ha pulsado el boton de guardar y en el post recibe la palabla guardar del boton
            if (isset($_POST['guardar']) && $_POST['guardar'] == "Guardar") {

                // 🡇 Recojo los valores de los inputs de editar
                $titulo = filter_input(0, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
                $entradilla = filter_input(0, 'entradilla');
                $texto = filter_input(0, 'texto');
                $autor = filter_input(0, 'autor', FILTER_SANITIZE_SPECIAL_CHARS);
                $fecha_mod = date("Y-m-d H:i:s");

                $hoy = time(); // 🠴 variable time para añadir al slug y hacerlo unico

                // 🡇 Reglas para formar el slug de la noticia
                $reglas = ['á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ü' => 'u', 'ñ' => 'n', ' ' => '-',
                    'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'u', 'Ü' => 'U', 'Ñ' => 'N', '\'' => '´'];
                $slug = strtolower(strtr($titulo, $reglas)) . $hoy;  // 🠴 Creo el slug


                // 🡇 Guardo en la base de datos
                $this->db->beginTransaction();
                $this->db->exec("UPDATE noticias SET titulo='" . $titulo . "' WHERE id=" . $id . "");
                $this->db->exec("UPDATE noticias SET slug='" . $slug . "' WHERE id=" . $id . "");
                $this->db->exec("UPDATE noticias SET entradilla='" . $entradilla . "' WHERE id=" . $id . "");
                $this->db->exec("UPDATE noticias SET texto='" . $texto . "' WHERE id=" . $id . "");
                $this->db->exec("UPDATE noticias SET autor='" . $autor . "' WHERE id=" . $id . "");
                $this->db->exec("UPDATE noticias SET fecha_mod='" . $fecha_mod . "' WHERE id=" . $id . "");
                $this->db->commit();

                // 🡇 Inicializo los mensajes de error/exito
                $mensaje[] = ['tipo' => 'success',
                    'texto' => "La noticia se ha guardado correctamente"
                ];

                // 🡇 La variable contiene el mensaje que le paso de if con los datos del mensaje y el tipo de banner que se necesita
                $_SESSION['mensajes'] = $mensaje;

                // 🡇 Le redirijo al panel
                header("Location: " . $_SESSION['home'] . "panel/noticias");

            } else {
                $resultado = $this->db->query("SELECT * FROM noticias WHERE id=" . $id . " LIMIT 1");

                // 🡇 Inicializo los mensajes de error/exito
                if ($resultado) {
                    $noticia = $resultado->fetch(\PDO::FETCH_OBJ);
                    //Le paso los datos a la vista
                    $this->view->vista('editarN', $noticia);

                } else {
                    $_SESSION['mensajes'] = $mensaje;

                    // 🡇 Le redirijo al panel
                    header("Location: " . $_SESSION['home'] . "panel/noticias");
                }
            }
        } else {

            $_SESSION['mensajes'] = $mensaje;

            // 🡇 Le redirijo al panel
            header("Location: " . $_SESSION['home'] . "panel/noticias");
        }

    }

    function upload($id) // 🠴 Funcion para subir imagenes a la s noticias
    {
        if ($id) { // 🡇 Si recibe la id
            if (isset($_POST['subir'])) {  // 🡇 Si esta setteado el boton subir

                $archivo_recibido = $_FILES['archivo'];
                $directorio_subida = '../public/img/uploads/';
                $nombre_fichero_unico = time();
                $archivo_subido = $directorio_subida . basename($nombre_fichero_unico . ".jpeg");

                // 🡇 Declaramos la variable que contiene el tipo de extension del archivo a subir
                $tipo = mime_content_type($archivo_recibido['tmp_name']);


                // 🡇 Declaramos las variables para el control de tamaño de los ficheros
                $maxsize = $_POST['size'];
                $tamanoFichero = filesize($archivo_recibido['tmp_name']);

                // 🡇 Comparamos el tipo del fichero con el que nos interesa
                if ($tipo == "image/jpeg" || $tipo == "image/png" && $maxsize > $tamanoFichero) {

                    // 🡇 Inicia la subida del fichero
                    if (is_uploaded_file($archivo_recibido['tmp_name']) AND move_uploaded_file($archivo_recibido['tmp_name'], $archivo_subido)) {

                        // 🡇 Iniciamos la transaction con la url que tendra el archivo subido
                        $this->db->beginTransaction();
                        $this->db->exec("UPDATE noticias SET url='" . $archivo_subido . "' WHERE id=" . $id . "");
                        $this->db->commit();

                        $mensaje[] = ['tipo' => 'success',
                            'texto' => "La imagen se ha subido  correctamente"
                        ];

                        // 🡇 La variable contiene el mensaje que le paso de if con los datos del mensaje y el tipo de banner que se necesita
                        $_SESSION['mensajes'] = $mensaje;

                        // 🡇 Le redirijo al panel
                        header("Location: " . $_SESSION['home'] . "panel/noticias");

                    } else {  // 🠴 Si la subida falla
                        $mensaje[] = ['tipo' => 'danger',
                            'texto' => "Ha ocurrido un error al subir la imagen."
                        ];

                        // 🡇 La variable contiene el mensaje que le paso de if con los datos del mensaje y el tipo de banner que se necesita
                        $_SESSION['mensajes'] = $mensaje;

                        // 🡇 Le redirijo al panel
                        header("Location: " . $_SESSION['home'] . "panel/noticias");
                    }
                } else {
                    $mensaje[] = ['tipo' => 'danger',
                        'texto' => "Formato de imagen erróneo, formatos admitidos .jpeg y .png"
                    ];

                    $_SESSION['mensajes'] = $mensaje;
                    //Le redirijo al panel
                    header("Location: " . $_SESSION['home'] . "panel/noticias");
                }
            } else {
                // 🡇 Le redirijo a la pantalla de upload
                $this->view->vista("upload", "");
            }
        }
    }

    function permisos()
    {
        if (!isset($_SESSION['noticias']) || $_SESSION['noticias'] != 1) {
            $mensaje[] = ['tipo' => 'warning',
                'texto' => "Usuario no autorizado"
            ];
            $_SESSION['mensajes'] = $mensaje;
            //Le redirijo al panel
            header("Location: " . $_SESSION['home'] . "panel");
        }
    }
}
