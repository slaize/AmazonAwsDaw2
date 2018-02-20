<?php

namespace App\Controller; //App sería el nombre del proyecto y Controller la carpeta que lo tiene

use App\Model\Noticia;
use App\Helper\ViewHelper;
use App\Helper\DbHelper; //Conexion a la base de datos
$public = '/cms/public/';

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
    } // Completa


    function index()
    {
        $this->permisos();
        //Inicio el objeto usuarios
        $noticias = [];

        $resultado = $this->db->query('SELECT * FROM noticias');


        while ($data = $resultado->fetch(\PDO::FETCH_OBJ)) {
            $noticias [] = new Noticia($data);
        }
        // Le paso los datos
        $this->view->vista("noticias", $noticias);
    } // Completa

    function crear()
    {
        //Insert
        $nombre = "noticia" . rand(0, 999999);
        $slug = "slug" . rand(0, 999999);
        $nombre_completo = $_SESSION['nombre_completo'];

        $registros = $this->db->exec('INSERT INTO noticias (titulo,autor) VALUES("' . $nombre . '", "' . $nombre_completo . '")');


        //Mensajes
        if ($registros) {
            $mensaje[] = ['tipo' => 'success',
                'texto' => "La noticia <strong> $nombre </strong> se ha añadido correctamente"
            ];
        } else {
            $mensaje[] = ['tipo' => 'danger',
                'texto' => "Ha ocurrido un error al añadir la noticia"
            ];
        }

        $_SESSION['mensajes'] = $mensaje;

        //Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/noticias");
        $this->noticias();
    } // Completa

    function activar($id)
    {
        if ($id) {
            //Update
            $registros = $this->db->exec("UPDATE noticias SET activa=1 WHERE id=" . $id . "");
            $fecha_pub = date("Y-m-d H:i:s");
            //Mensajes
            if ($registros) {

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
        $_SESSION['mensajes'] = $mensaje;
        //Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/noticias");

    } // Completa

    function desactivar($id)
    {
        if ($id) {
            //Update
            $registros = $this->db->exec("UPDATE noticias SET activa=0 WHERE id=" . $id . "");
            //Mensajes
            if ($registros) {
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
        $_SESSION['mensajes'] = $mensaje;
        //Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/noticias");

    } // Completa

    function homeactivar($id)
    {
        if ($id) {
            //Update
            $registros = $this->db->exec("UPDATE noticias SET home=1 WHERE id=" . $id . "");
            //Mensajes
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
        $_SESSION['mensajes'] = $mensaje;
        //Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/noticias");

    } // Completa

    function homedesactivar($id)
    {
        if ($id) {
            //Update
            $registros = $this->db->exec("UPDATE noticias SET home=0 WHERE id=" . $id . "");
            //Mensajes
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
        $_SESSION['mensajes'] = $mensaje;
        //Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/noticias");

    } // Completa

    function borrar($id)
    {
        if ($id) {
            //Update
            $registros = $this->db->exec("DELETE FROM noticias WHERE id=" . $id . "");
            //Mensajes
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
        $_SESSION['mensajes'] = $mensaje;
        //Le redirijo al panel
        header("Location: " . $_SESSION['home'] . "panel/noticias");

    }  // Completa

    function editarN($id)
    {
        if ($id) {

            if (isset($_POST['guardar']) && $_POST['guardar'] == "Guardar") {

                //Recojo los valores de los inputs de editar
                $titulo = filter_input(0, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);

                $reglas = ['á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ü' => 'u', 'ñ' => 'n', ' ' => '-'];
                $hoy = date("YmdHis");
                $slug = strtolower(strtr($titulo, $reglas)) . $hoy;

                $entradilla = filter_input(0, 'entradilla');
                $texto = filter_input(0, 'texto');
                $autor = filter_input(0, 'autor', FILTER_SANITIZE_SPECIAL_CHARS);
                $fecha_mod = date("Y-m-d H:i:s");

                //Guardo en la base de datos
                $this->db->beginTransaction();
                $this->db->exec("UPDATE noticias SET titulo='" . $titulo . "' WHERE id=" . $id . "");
                $this->db->exec("UPDATE noticias SET slug='" . $slug . "' WHERE id=" . $id . "");
                $this->db->exec("UPDATE noticias SET entradilla='" . $entradilla . "' WHERE id=" . $id . "");
                $this->db->exec("UPDATE noticias SET texto='" . $texto . "' WHERE id=" . $id . "");
                $this->db->exec("UPDATE noticias SET autor='" . $autor . "' WHERE id=" . $id . "");
                $this->db->exec("UPDATE noticias SET fecha_mod='" . $fecha_mod . "' WHERE id=" . $id . "");
                $this->db->commit();

                //Mensaje y redireccion
                $mensaje[] = ['tipo' => 'success',
                    'texto' => "La noticia se ha guardado correctamente"
                ];
                $_SESSION['mensajes'] = $mensaje;
                //Le redirijo al panel
                header("Location: " . $_SESSION['home'] . "panel/noticias");

            } else {
                $resultado = $this->db->query("SELECT * FROM noticias WHERE id=" . $id . " LIMIT 1");

                //Mensaje
                if ($resultado) {
                    $noticia = $resultado->fetch(\PDO::FETCH_OBJ);
                    //Le paso los datos a la vista
                    $this->view->vista('editarN', $noticia);

                } else {
                    $_SESSION['mensajes'] = $mensaje;
                    //Le redirijo al panel
                    header("Location: " . $_SESSION['home'] . "panel/noticias");
                }
            }
        } else {
            $_SESSION['mensajes'] = $mensaje;
            //Le redirijo al panel
            header("Location: " . $_SESSION['home'] . "panel/noticias");
        }

    }

    function upload($id)
    {
        if ($id) {
            if (isset($_POST['subir'])) {

                $archivo_recibido = $_FILES['archivo'];
                $directorio_subida = '../public/img/uploads/';
                $nombre_fichero_unico = date("Ymd-Hms");
                $archivo_subido = $directorio_subida . basename($nombre_fichero_unico . ".jpeg");

                // Declaramos la variable que contiene el tipo de extension del archivo a subir
                $tipo = mime_content_type($archivo_recibido['tmp_name']);


                //Declaramos las variables para el control de tamaño de los ficheros
                $maxsize = $_POST['size'];
                $tamanoFichero = filesize($archivo_recibido['tmp_name']);
                //Comparamos el tipo del fichero con el que nos interesa
                if ($tipo == "image/jpeg" || $tipo == "image/png" && $maxsize > $tamanoFichero) {

                    if (is_uploaded_file($archivo_recibido['tmp_name']) AND move_uploaded_file($archivo_recibido['tmp_name'], $archivo_subido)) {

                        $this->db->beginTransaction();
                        $this->db->exec("UPDATE noticias SET url='" . $archivo_subido . "' WHERE id=" . $id . "");
                        $this->db->commit();
                        //Mensaje y redireccion
                        $mensaje[] = ['tipo' => 'success',
                            'texto' => "La imagen se ha subido  correctamente"
                        ];
                        $_SESSION['mensajes'] = $mensaje;
                        //Le redirijo al panel
                        header("Location: " . $_SESSION['home'] . "panel/noticias");

                    } else {
                        $mensaje[] = ['tipo' => 'danger',
                            'texto' => "Ha ocurrido un error al subir la imagen."
                        ];

                        $_SESSION['mensajes'] = $mensaje;
                        //Le redirijo al panel
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
                $this->view->vista("upload", "");
            }
        }
    }

    function permisos(){
        if(!isset($_SESSION['noticias']) || $_SESSION['noticias'] != 1){
            $mensaje[] = ['tipo' => 'warning',
                'texto' => "Usuario no autorizado"
            ];
            $_SESSION['mensajes'] = $mensaje;
            //Le redirijo al panel
            header("Location: " . $_SESSION['home'] . "panel");
        }
    }
}
