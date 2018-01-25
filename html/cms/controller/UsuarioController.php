<?php
namespace App\Controller; //App sería el nombre del proyecto y Controller la carpeta que lo tiene

use App\Model\Usuario;
use App\Helper\ViewHelper;
use App\Helper\DbHelper; //Conexion a la base de datos



class UsuarioController{

    //Funcion para la conexion con la BBDD, habra que copiar en los contructores
    var $db;
    function __construct(){
        //Inicilizo la conexion
        $dhhelper = new DbHelper();
        $this->db = $dhhelper->db;
    }

    function index(){
        //Realizo la consulta
        $resultado = $this->db->query('SELECT * FROM usuarios where id=1');

        //Asigno la consulta a variable
        $data = $resultado->fetch(\PDO::FETCH_OBJ);

        //Paso esa vatiable al constructor de usuario
        $usuario = new Usuario($data);


        //Instancio el ViewHelper
        $view = new ViewHelper();

        $view->vista("index",$usuario);
    }


}