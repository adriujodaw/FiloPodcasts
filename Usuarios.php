<?php
include "funciones.php";
class Usuarios {
    /**
     * @author Guillermo Iglesias
     * @var string
     */
    private string $usuario; // PRIMARY KEY
    /**
     * @var string
     */
    private string $clave;
    /**
     * @var string
     */
    private string $nombre;
    /**
     * @var string
     */
    private string $correo;
    /**
     * @var string
     */
    private string $descripcionLarga;

    // -- Nombre de bbdd y host --
    /**
     * @var string
     */
    private string $dsn = 'mysql:dbname=proyectoPodcasts;host=db';
    // Usuario
    /**
     * @var string
     */
    private string $dbUsuario = "alumnado";
    // Contraseña
    /**
     * @var string
     */
    private string $dbClave = "alumnado";

    public function getUsuario() : string {
        return $this->usuario;
    }

    public function setUsuario(string $usuario) : void {
        $this->usuario = $usuario;
    }

    public function getClave() : string {
        return $this->clave;
    }

    public function setClave(string $clave) : void {
        $this->usuario = $clave;
    }

    public function getNombre() : string {
        return $this->nombre;
    }

    public function setNombre(string $nombre) : void {
        $this->usuario = $nombre;
    }

    public function getCorreo() : string {
        return $this->correo;
    }

    public function setCorreo(string $correo) : void {
        $this->usuario = $correo;
    }

    public function getDescripcionLarga() : string {
        return $this->descripcionLarga;
    }

    public function setDescripcionLarga(string $descripcionLarga) : void {
        $this->usuario = $descripcionLarga;
    }

    /**
     * @author Guillermo Iglesias
     * El método conectar() conecta con la base de datos proyectoPodcast mediante
     * un objeto de tipo PDO
     * @throws Lanza una excepción de tipo PDOException en caso de que ocurra
     * algún error
     * @version 1.2
     */
    public function conectar() {
        
    }

    /**
     * Función que devuelve una consulta con los datos del usuario
     * @version 1.2
     */
    public function leer() {

        $dns = 'mysql:dbname=$bbdd;host=db';
        $usuario = "alumnado";
        $clave= "alumnado";
        try {
            
            $bd = new PDO($dns, $usuario, $clave);
            echo "Conexión a la base de datos con éxito.<br>"; 
            
        } catch (PDOException $e) {
            echo 'Falló la conexión: '.$e->getMessage();
        }

        $sql = 'SELECT * FROM usuarios';
        /**
         * @return devuelve la consulta realizada
         */
        return $resultado = $bd->query($sql);
    }

    /**
     * Función que inserta datos en la tabla usuarios, le pasamos
     * por parámetro los nuevos valores
     * @version 1.2
     */
    public function insertar() {

        $dns = 'mysql:dbname=$bbdd;host=db';
        $usuario = "alumnado";
        $clave= "alumnado";
        try {
            
            $bd = new PDO($dns, $usuario, $clave);
            echo "Conexión a la base de datos con éxito.<br>"; 
            
        } catch (PDOException $e) {
            echo 'Falló la conexión: '.$e->getMessage();
        }

        $sql = "INSERT INTO usuarios (usuario, clave, nombre, correo, descripcionLarga) 
        VALUES ($this->usuario, $this->clave, $this->nombre, $this->correo, $this->descripcionLarga)";
        /**
         * @return devuelve la consulta realizada
         */
        return $resultado = $bd->query($sql);
    }

    /**
     * Función que borra registro de la tabla, le pasamos por parámetro
     * el usuario y borrar la fila de la tabla
     * @version 1.2
     */
    public function borrar(string $usuario) {

        $dns = 'mysql:dbname=$bbdd;host=db';
        $usuario = "alumnado";
        $clave= "alumnado";
        try {
            
            $bd = new PDO($dns, $usuario, $clave);
            echo "Conexión a la base de datos con éxito.<br>"; 
            
        } catch (PDOException $e) {
            echo 'Falló la conexión: '.$e->getMessage();
        }

        $sql = "DELETE FROM usuarios WHERE usuario = '$this->usuario'";
        /**
         * @return devuelve la consulta realizada
         */
        return $resultado = $bd->query($sql);
    }

    /**
     * Funcion actualizar, le pasamos el usuarios, el campo y 
     * el contenido para actualizar esa tabla
     * @version 1.2
     */
    public function actualizar() {
        $dns = 'mysql:dbname=$bbdd;host=db';
        $usuario = "alumnado";
        $clave= "alumnado";
        try {
            
            $bd = new PDO($dns, $usuario, $clave);
            echo "Conexión a la base de datos con éxito.<br>"; 
            
        } catch (PDOException $e) {
            echo 'Falló la conexión: '.$e->getMessage();
        }

        $sql = "UPDATE `usuarios` SET usuario = $this->usuario, clave = $this->clave, nombre = $this->nombre, correo = $this->correo, descripcionLarga = $this->descripcionLarga  WHERE usuario = '$this->usuario'";
        /**
         * @return devuelve la consulta realizada
         */
        return $resultado = $bd->query($sql);
    }
}
// Prueba conexion de base de datos
$baseDatos = new Usuarios();
$baseDatos->conectar();
?>