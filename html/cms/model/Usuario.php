<?php
namespace App\Model;  //App sería el nombre del proyecto y Model la carpeta que lo tiene

class Usuario
{
    // Variables o atributos
    var $id;
    var $usuario;
    var $clave;
    var $fecha_acceso;
    var $activo;
    var $usuarios;
    var $noticias;

    //Metodo constructor nuevo
    function __construct($data){
        $this->id = $data->id;
        $this->usuario = $data->usuario;
        $this->clave = $data->clave;
        $this->fecha_acceso = $data->fecha_acceso;
        $this->activo = $data->activo;
        $this->usuarios = $data->usuarios;
        $this->noticias = $data->noticias;
    }
}