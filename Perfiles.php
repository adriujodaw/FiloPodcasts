<?php
class Perfiles{
    public $bd;
function bdA($bbdd, $usuario, $clave){
    $dsn = "mysql:dbname=". $bbdd .";host=db";

    try {
        $this->bd = new PDO($dsn, $usuario, $clave);
     
        $this->bd = null;
    } catch (PDOException $e) {
      
    }
}

public function getPerfil($query, $parametros = []){
    try {
       $dcon =  $this->bd->prepare($query);
       $dcon->fetch();
       return $dcon ;
    } catch (PDOException $e) {
        throw new Exception($e->getMessage());
    }
 }

 public function getPerfiles($query, $parametros = []){
    try {
        $dcon =  $this->bd->prepare($query);
        $dcon->fetch();
        return $dcon ;
     } catch (PDOException $e) {
         throw new Exception($e->getMessage());
     }
 }

 public function nuevoPerfil($query, $parametros = []) {
    try {
        $dcon =  $this->bd->prepare($query);
        $dcon->execute($parametros);
        return TRUE ;
     } catch (PDOException $e) {
         throw new Exception($e->getMessage());
     }
}

function editarPerfil($query, $parametros = []) {
$this->nuevoPerfil($query,$parametros) ;

}

function eliminarPerfil($query, $parametros = []) {
$this->nuevoPerfil($query,$parametros) ;
  
}}

$bdatos = new Perfiles();
                                                                //en este array va el perfil que quieras obtener
$getPerfil =$bdatos->$getPerfil("SELECT * FROM perfiles WHERE  = ?", [""]);
$getPerfiles = $bdatos->$getUsuarios("SELECT * FROM perfiles");//no necesita nada, simplemente seleciona todos los perfiles
//$nuevoPerfil =$bdatos->$nuevoPerfil("INSERT INTO perfiles(usuario, rol, descripcionCorta, descipcionLarga) VALUE(?,?,?,?)", ["DATO", "DATO", "DATO", "DATO"]);
//$actualizarPerfil = $bdatos->$actualizarPerfil("UPDATE perfiles SET  rol = ? descripcionCorta = ? descipcionLarga = ? WHERE" , ["DATO", "DATO", "DATO"]); 
//$eliminarPerfil=$bdatos->$eliminarPerfil("SELECT FROM perfiles WHERE perfil = ?", ["DATO"]);  //Insertar los datos de manera respectiva: rol, descipcionCorta, etc
//^^Descomentar para añadir actualizar o eliminar



?>