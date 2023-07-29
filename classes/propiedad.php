<?php

namespace App;

class Propiedad {
  //* BASES DE DATOS
  protected static $db;

  //* Definir los Campos de la DB a Usar
  protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];

  //* Validación de Datos
  protected static $errores = [];

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

  //* DEFINIR LA CONEXION A LA BASE DE DATOS
  public static function setDB($database) {
    self::$db = $database;
  }

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

  //* GUARDAR DATOS EN LA BASE DE DATOS
  public function guardar() {
    //* Sanitizar los Datos
    $atributos = $this->sanitizarAtributos();

    //* Insertar en la Base de Datos
    $query = " INSERT INTO propiedades ( ";
    $query .= join(', ', array_keys($atributos));
    $query .= " ) VALUES ('";
    $query .= join("', '", array_values($atributos));
    $query .= "') ";

    $resultado = self::$db->query($query);

    return $resultado;
  }

  //* Identificar y Unir los Atributos de la BD
  public function atributos() {
    $atributos = [];
    foreach(self::$columnasDB as $columna) {
      if($columna === 'id') continue;
      $atributos[$columna] = $this->$columna;
    }

    return $atributos;
  }

  //* Subida de Archivo de Imagen
  public function setImagen($imagen) {
    // Asignar al Atributo de Imagen el Nombre de la Imagen
    if($imagen) {
      $this->imagen = $imagen;
    }
  }

  //* Sanitizar los Datos Ingresados por el Usuario
  public function sanitizarAtributos() {
    $atributos = $this->atributos();
    $sanitizado = [];

    foreach($atributos as $key=>$value) {
      $sanitizado[$key] = self::$db->escape_string($value);
    }

    return $sanitizado;
  }

  //* Validación de Errores
  public static function getErrores() {
    return self::$errores;
  }

  public function validar() {
      //* Validar entrada de Datos
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

   //* Listar Todas las Propiedades
   public static function all() {
    $query = "SELECT * FROM propiedades";

    $resultado = self::consultarSQL($query);

    return $resultado;
   }

   public static function consultarSQL($query) {
    //* Consultar la Base de Datos
    $resultado = self::$db->query($query);

    //* Iterar los Resultados
    $array = [];
    while($registro = $resultado->fetch_assoc()) {
      $array[] = self::crearObjeto($registro);
    }

    //* Liberar la Memoria
    $resultado->free();

    //* Retornar los Resultados
    return $array;
   }

   //* Convertir los Datos en Objetos
   protected static function crearObjeto($registro) {
    $objeto = new self;

    foreach($registro as $key => $value) {
      if(property_exists( $objeto, $key )) {
        $objeto->$key = $value;
      }
    }

    return $objeto;
   }
}