<?php
/* (Ya lo hizo Guillermo)
function crearConexionBBDD($bbdd, $usuario, $clave){
    $dsn = 'mysql:dbname=$bbdd;host=db';

    try {
        $bd = new PDO($dsn, $usuario, $clave);
        echo "Conexión a la base de datos con éxito.<br>";
        $bd = null;
    } catch (PDOException $e) {
        echo 'Falló la conexión: '.$e->getMessage();
    }
}

function cerrarConexionBBDD (){
    $bd = null;
}*/

function crearToken (){
    $token = bin2hex(openssl_random_pseudo_bytes(16));
    return $token;
}

function comprobarToken ($tokenSesion, $tokenCreado){
    if ($tokenSesion == $tokenCreado){
        $coinciden = true;
    } else {
        $coinciden = false;
    }

    return $coinciden;
}

function conectarBBDD(){
    $dns = 'mysql:dbname=$bbdd;host=db';
    $usuario = "alumnado";
    $clave= "alumnado";
    try {
        
        $bd = new PDO($dns, $usuario, $clave);
        echo "Conexión a la base de datos con éxito.<br>"; 
        
    } catch (PDOException $e) {
        echo 'Falló la conexión: '.$e->getMessage();
    }
}
/*
function nuevoUsuario($id, $clave, $rol) {

    $sql = "INSERT INTO usuarios VALUES ($id, $clave, $rol);";
    $resultado = $bd->query($sql);

}

function eliminarUsuario($id) {

    $sql = "DELETE FROM usuarios WHERE id='$id'"
    $resultado = $bd->query($sql);

}

function editarUsuario($antiguoID, $id, $clave, $rol) {

    $sql = "UPDATE usuarios SET ($id, $contraseña, $rol)  WHERE id='$antiguoID'";
    $resultado = $bd->query($sql);

}

function crearTablas(){
    crearConexion();
    $crearTabla = "CREATE TABLE usuarios (usuario VARCHAR(35) NOT NULL, clave VARCHAR(15) NOT NULL, rol VARCHAR(20), PRIMARY KEY (usuario))";
    $bd -> query($crearTabla);

    try {
        $bd -> query($crearTabla);        
    } catch (PDOException $e) {
        echo 'Falló la creación de la tabla: '.$e->getMessage();
    }

}*/