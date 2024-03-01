<?php
// Iniciar conexión con la base de datos
    $conexion= new mysqli("localhost","root","");  
//Comprobamos que esté bien hecha la conexión
    if($conexion->connect_errno>0){
        echo "No se ha podido establecer conexión con el servidor de bases de datos <br>";
    }else{
        echo "Se ha establecido una conexión con el servidor de bases de datos <br>";
//Ahora seleccionaremos una tabla para trabajar con ella
        $conexion->select_db("db_tienda");
        $conexion->set_charset("utf8");
    }
//Recogemos el id que es lo unico que necesitamos
    $discoid=$_POST['idcd']; 
//Hacemos la query para borrar
    $borrar= "DELETE FROM `discos` WHERE id='$discoid'";
//Ejecutamos la consulta
if(mysqli_query($conexion, $borrar)){
    echo "Registro eliminado con éxito.";
} else{
    echo "ERROR: No se pudo eliminar registro $borrar. " . mysqli_error($link);
}

$conexion->close();  
?>

<!--Regresar al index -->
<form action="editproduct.php">
    Registro borrado correctamente pulse continuar para regresar al listado de discos <input type="submit" value="Continuar" >
</form>