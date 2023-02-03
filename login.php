<?php
include "funciones.php";
session_start();

//si no guarde el token en sesion lo creo, y si no guardo en la variable token el que anteriormente guarde en sesión
if(!isset($_SESSION["token"])){
    //creo el token
    $token = crearToken();
    //lo guardo en sesión
    $_SESSION["token"] = $token;
    //lo guardo en una cookie
    setcookie("token", $token, time()+3600*24);
}   else{
    //
    $token = $_SESSION["token"];
}


    //este trozo de código lo ejecuta cuando vengo de un post, lo que significa que ya envié el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        //si el token es el mismo que el de la cookie
        if ($token == $_COOKIE["token"]){


            //recojo el nombre de usuario y la clave introducidos
            $usuarioLogin = trim(strip_tags($_POST["usuario"]));
            $claveLogin = trim(strip_tags($_POST["clave"]));



            //si todavia no estoy logueado
            if (!isset($_SERVER["login"])){

                $claveCorrecta = false;
                $usuarioCorrecto = false;            


                //dns de la conexiona la bbdd
                $dsn = 'mysql:host=db;dbname=proyectoPodcasts';
                //usuario de la conexiona la bbdd
                $usuario = 'alumnado';
                //clave de la conexiona la bbdd
                $clave = 'alumnado';

                try {
                    //establezco la conexion   
                    $bd = new PDO($dsn, $usuario, $clave);


                    //introduzco la consulta en una variable
                    $sql = "SELECT clave, usuario FROM usuarios WHERE usuario = '$usuarioLogin'; ";

                    //hago la consulta y guardo el resultado un la variable usuarios
                    $usuarios = $bd->query($sql);
                    //echo "<pre>".$claveBBDD."</pre>";
                    //echo strval($claveBBDD);
                    //compruebo que coincida la clave de ese usuario
                    /*if($clave == $claveBBDD){
                        $_SESSION["login"] = $usuarioLogin;
                        header("Location: principal.php");
                        $datosCorrectos = true;
                    }*/
                    
                    //compruebo por cada usuario si el nombre de usuario y la clave del post coincide con alguno de los de la vase de datos 
                    foreach ($usuarios as $elemento) {
                        
                        if ($claveLogin == $elemento['clave']) {
                            $_SESSION["login"] = $usuarioLogin;
                            
                            header("Location: principal.php");
                            $claveCorrecta = true;

                        }

                        if($elemento['clave'] != ""){
                            $usuarioCorrecto = true;
                        }

                    
                }

                    //cierro la conexión con la bbdd
                    $bd = null;

                } catch (PDOException $e) {
                        echo 'Falló la conexión: '.$e->getMessage();
                }

                
?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Unidad 5 Actividad 2</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link
      href="https://getbootstrap.com/docs/5.2/assets/css/docs.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/login.css" />
  </head>
  <body>
    <form action="<?=$_SERVER["PHP_SELF"]?>" method="post">
      <div style="margin: 3em" class="flexContainer">
        <div class="card" style="width: 18rem">
          <img src="imagenes/filosofia.jpg" class="card-img-top" alt="..." />
          <div class="card-body">
            <!--Usuario y contraseña-->

            <?php if($usuarioCorrecto){?>
            <div class="input-group mb-3">
              <span class="input-group-text">@</span>
              <div class="form-floating">
                <input
                  name="usuario"
                  type="text"
                  name="usuario"
                  class="form-control"
                  id="floatingInputGroup1"
                  placeholder="Username"
                  value="<?=$_POST["usuario"]?>"
                />
                <label for="floatingInputGroup1">Usuario</label>
              </div>
            </div>
            <?php } else {?>
            <div class="input-group has-validation">
              <span class="input-group-text">@</span>
              <div class="form-floating is-invalid">
                <input
                  name="usuario"
                  type="text"
                  class="form-control is-invalid"
                  id="floatingInputGroup2"
                  placeholder="Username"
                  required
                />
                <label for="floatingInputGroup2">Usuario</label>
              </div>
              <div class="invalid-feedback">Usuario incorrecto</div>
            </div>
            <?php } 
            
            if($claveCorrecta){?>

            <div class="input-group mb-3">
              <span class="input-group-text"
                ><img
                  src="imagenes/contraseña2.png"
                  height="24em"
                  alt="contraseña"
              /></span>
              <div class="form-floating">
                <input
                  name="clave"
                  type="password"
                  class="form-control"
                  id="floatingInputGroup1"
                  placeholder="Username"
                />
                <label for="floatingInputGroup1">Contraseña</label>
              </div>
            </div>
            <?php } else {?>
                <div class="input-group has-validation">
              <span class="input-group-text"
                ><img
                  src="imagenes/contraseña2.png"
                  height="24em"
                  alt="contraseña"
              /></span>
              <div class="form-floating is-invalid">
                <input
                  name="clave"
                  type="password"
                  class="form-control is-invalid"
                  id="floatingInputGroup2"
                  placeholder="Username"
                  required
                />
                <label for="floatingInputGroup2">Contraseña</label>
              </div>
              <div class="invalid-feedback">Contraseña incorrecta</div>
            </div>
            <?php } ?>
            <!--Fin usuario y contraseña-->
            <input type="submit" class="btn btn-info"/>
          </div>
        </div>
      </div>
      </form>
  </body>
</html><?php
                

            }   

            //si al entrar ya estoy logueado
            else  {
                header("Location: menu050204.php");
            }
        }   else {
            echo '<script language="javascript">alert("Ha habido un fallo de seguridad. El token correspondido no es el mismo que el asignado.");</script>';
        }
    }  
    //si entro la primera vez
    else {
        ?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Unidad 5 Actividad 2</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link
      href="https://getbootstrap.com/docs/5.2/assets/css/docs.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/login.css" />
  </head>
  <body>
    <form action="<?=$_SERVER["PHP_SELF"]?>" method="post">
      <div style="margin: 3em" class="flexContainer">
        <div class="card" style="width: 18rem">
          <img src="imagenes/filosofia.jpg" class="card-img-top" alt="..." />
          <div class="card-body">
            <!--Usuario y contraseña-->
            <div class="input-group mb-3">
              <span class="input-group-text">@</span>
              <div class="form-floating">
                <input
                  type="text"
                  name="usuario"
                  class="form-control"
                  id="floatingInputGroup1"
                  placeholder="Username"
                />
                <label for="floatingInputGroup1">Usuario</label>
              </div>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text"
                ><img
                  src="imagenes/contraseña2.png"
                  height="24em"
                  alt="contraseña"
              /></span>
              <div class="form-floating">
                <input
                  name="clave"
                  type="password"
                  class="form-control"
                  id="floatingInputGroup1"
                  placeholder="Username"
                />
                <label for="floatingInputGroup1">Contraseña</label>
              </div>
            </div>
            <!--Fin usuario y contraseña-->
            <input type="submit" class="btn btn-info"/>
          </div>
        </div>
      </div>
      </form>
  </body>
</html><?php
    }

?>
