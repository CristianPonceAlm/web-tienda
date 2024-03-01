<?php
// Empezaremos estableciendo una conexion con el servidor de bases de datos usando PDO
    $conexion = new PDO("mysql:host=localhost", "root", "");    
//Iniciamos la conexion con la base de datos banco
    $conexion= new PDO("mysql:host=localhost;dbname=db_tienda;charset=utf8","root","");
//Recogemos los valores
    $newemail=$_POST['cambiaremail'];
    $newnombre=$_POST['cambiarnombre'];
    $newapellido=$_POST['cambiarapellido'];
    $newcontrasena=$_POST['cambiarcontrasena'];
    $newdireccion=$_POST['cambiardireccion'];
    $newtipo=$_POST['cambiartipo'];
//Hacemos la query para modificar los datos
    $actualizar= "UPDATE `clientes` SET email='$newemail', nombrecliente='$newnombre' , apellidocliente='$newapellido', contrasena='$newcontrasena', direccion='$newdireccion', tipo='$newtipo' where email='$newemail'";
//Ejecutamos la consulta
    try{
        $conexion->exec($actualizar);
        echo "Se han actualizado los datos";
    }catch(Exception $kk){
        echo "No se han actualizado los datos";
    }
   
?>

<!--Regresar al index -->
<form action="editaruser.php">
    Registro actualizado correctamente pulse continuar para regresar <input type="submit" value="Continuar" >
</form>