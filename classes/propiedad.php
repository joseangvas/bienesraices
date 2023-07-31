<?php

namespace App;

class Propiedad extends ActiveRecord {

  protected static $tabla = 'propiedades';
  protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

  public $id;
  public $titulo;
  public $precio;
  public $imagen;
  public $descripcion;
  public $habitaciones;
  public $wc;
  public $estacionamiento;
  public $creado;
  public $vendedorId;

  //* Función Constructora que Lee los Datos de los Campos
  public function __construct($args = []) {
  
    $this->id = $args['id'] ?? null;
    $this->titulo = $args['titulo'] ?? '';
    $this->precio = $args['precio'] ?? '';
    $this->imagen = $args['imagen'] ?? '';
    $this->descripcion = $args['descripcion'] ?? '';
    $this->habitaciones = $args['habitaciones'] ?? '';
    $this->wc = $args['wc'] ?? '';
    $this->estacionamiento = $args['estacionamiento'] ?? '';
    $this->creado = $args['creado'] ?? date('Y/m/d');
    $this->vendedorId = $args['vendedorId'] ?? '';
  }

  //* Validar entrada de Datos
  public function validar() {
    if(!$this->titulo) {
      self::$errores[] = "Debes Ingresar un Título";
    }
    
    if(!$this->precio) {
      self::$errores[] = "Debes Ingresar un Precio";
    }

    if( strlen($this->descripcion) < 50 ) {
      self::$errores[] = "Debes Ingresar Descripcion y Debe tener más de 50 Caracteres";
    }

    if(!$this->habitaciones) {
      self::$errores[] = "Debes Ingresar Número de Habitaciones";
    }

    if(!$this->wc) {
      self::$errores[] = "Debes Ingresar Número de Baños";
    }

    if(!$this->estacionamiento) {
      self::$errores[] = "Debes Ingresar Número de Estacionamientos";
    }

    if(!$this->vendedorId) {
      self::$errores[] = "Debes Seleccionar un Vendedor";
    }

    if(!$this->imagen) {
      self::$errores[] = "La Imagen es Obligatoria";
    }

    return self::$errores;
  }
}