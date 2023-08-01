<?php

namespace App;

class Vendedor extends ActiveRecord {

  protected static $tabla = 'vendedores';
  protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

  public $id;
  public $nombre;
  public $apellido;
  public $telefono;

  //* Función Constructora que Lee los Datos de los Campos
  public function __construct($args = []) {
  
    $this->id = $args['id'] ?? null;
    $this->nombre = $args['nombre'] ?? '';
    $this->apellido = $args['apellido'] ?? '';
    $this->telefono = $args['telefono'] ?? '';
  }

  //* Validar entrada de Datos
  public function validar() {
    if(!$this->nombre) {
      self::$errores[] = "Debes Ingresar un Nombre";
    }

    if(!$this->apellido) {
      self::$errores[] = "Debes Ingresar un Apellido";
    }

    if(!$this->telefono) {
      self::$errores[] = "Debes Ingresar un Teléfono";
    }

    // if(!preg_match("/[0-9]{4}-[0-9]{8}$/", $this->telefono)) {
    //   self::$errores[] = "El Teléfono No es Válido";
    // }

    return vendedor::$errores;
  }
  
}