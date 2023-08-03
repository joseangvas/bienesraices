<?php

namespace App;

class ActiveRecord {

  //* BASES DE DATOS
  //* Definir los Campos de la DB a Usar
  protected static $db;
  protected static $columnasDB = [];
  protected static $tabla = '';

  //* Crear Array de Validación de Errores
  protected static $errores = [];

  //* DEFINIR LA CONEXION A LA BASE DE DATOS
  public static function setDB($database) {
    self::$db = $database;
  }

  //* GUARDAR DATOS EN LA BASE DE DATOS (Registros CRUD)
  //* Comprobar el Tipo de Guardado en la Base de Datos
  public function guardar() {
    if(!is_null($this->id)) {
      // Actualizar el Registro
      $this->actualizar();
    } else {
      // Insertar el Registro
      $this->crear();
    }
  }

  //* INSERTAR PROPIEDAD EN LA BASE DE DATOS
  public function crear() {
    //* Sanitizar los Datos
    $atributos = $this->sanitizarAtributos();

    //* Insertar en la Base de Datos
    $query = " INSERT INTO " . static::$tabla . " ( ";
    $query .= join(', ', array_keys($atributos));
    $query .= " ) VALUES ('";
    $query .= join("', '", array_values($atributos));
    $query .= "') ";

    $resultado = self::$db->query($query);

    //* Mensaje de Exito al Guardar
    if($resultado) {
      //* Redireccionar al Usuario
      header('Location: /admin/?resultado=1');
    };

  }

  //* ACTUALIZAR REGISTRO EN LA BASE DE DATOS
  public function actualizar() {
    //* Sanitizar los Datos
    $atributos = $this->sanitizarAtributos();

    //* Llenar Array con las Claves y Valores de la BD
    $valores = [];
    foreach($atributos as $key => $value) {
      $valores[] = "{$key}='{$value}'";
    }

    //* Actualizar Datos en la DB
    $query = "UPDATE " . static::$tabla . " SET ";
    $query .= join(', ', $valores);
    $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
    $query .= " LIMIT 1";

    $resultado = self::$db->query($query);

    //* Mensaje de Exito al Guardar
    if($resultado) {
      //* Redireccionar al Usuario
      header('Location: /admin/index.php?resultado=2');
    };
  }

  //* Eliminar un Registro de la Tabla
  public function eliminar() {
    // Eliminar Registro
    $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
    $resultado = self::$db->query($query);

    if($resultado) {
      $this->borrarImagen();
      header('Location: /admin?resultado=3');
    }
  }



  //* Identificar y Unir los Atributos de la BD
  public function atributos() {
    $atributos = [];
    foreach(static::$columnasDB as $columna) {
      if($columna === 'id') continue;
      $atributos[$columna] = $this->$columna;
    }

    return $atributos;
  }

  //* Subida de Archivo de Imagen
  public function setImagen($imagen) {
    // Eliminar la Imagen Previa
    if(!is_null($this->id)) {
      $this->borrarImagen();
    }

    // Asignar al Atributo de Imagen el Nombre de la Imagen
    if($imagen) {
      $this->imagen = $imagen;
    }
  }

  //* Eliminar el Archivo de Imagen
  public function borrarImagen() {
    // Comprobar si Existe el Archivo
    $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);

    // Borrar el Archivo
    if($existeArchivo) {
      unlink(CARPETA_IMAGENES . $this->imagen);
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
    return static::$errores;
  }

  //* Validar entrada de Datos
  public function validar() {
    static::$errores = [];
    return static::$errores;
  }

  //* Listar Todos los Registros
  public static function all() {
    $query = "SELECT * FROM " . static::$tabla;

    $resultado = self::consultarSQL($query);

    return $resultado;
  }

  //* Obtener Determinado Número de Registros
  public static function get($cantidad) {
    $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;

    $resultado = self::consultarSQL($query);

    return $resultado;
  }  

  //* Buscar un Registro por su ID
  public static function find($id) {
    $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id";
    $resultado = self::consultarSQL($query);

    return array_shift($resultado);
  }

  //* Consultar la Base de Datos
  public static function consultarSQL($query) {
    $resultado = self::$db->query($query);

    //* Iterar los Resultados
    $array = [];
    while($registro = $resultado->fetch_assoc()) {
      $array[] = static::crearObjeto($registro);
    }

    //* Liberar la Memoria
    $resultado->free();

    //* Retornar los Resultados
    return $array;
  }

  //* Convertir los Datos en Objetos
  protected static function crearObjeto($registro) {
    $objeto = new static;

    foreach($registro as $key => $value) {
      if(property_exists( $objeto, $key )) {
        $objeto->$key = $value;
      }
    }

    return $objeto;
  }

  //* Sincroniza el Objeto en Memoria con los Cambios Realizados por el Usuario
  public function sincronizar( $args = [] ) {
    foreach($args as $key => $value) {
      if(property_exists($this, $key) && !is_null($value)) {
        $this->$key = $value;
      }
    }
  }
}