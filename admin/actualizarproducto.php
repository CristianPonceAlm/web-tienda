<?php
// Empezaremos estableciendo una conexion con el servidor de bases de datos usando PDO
    $conexion = new PDO("mysql:host=localhost", "root", "");    
//Iniciamos la conexion con la base de datos banco
    $conexion= new PDO("mysql:host=localhost;dbname=db_tienda;charset=utf8","root","");
//Recogemos los valores
    $id_disco=$_POST['iddisco'];
    $nombre_disco=$_POST['nombredisco'];
    $precio_disco=$_POST['preciodisco'];
    $stock_disco=$_POST['stockdisco'];
    $ventas_disco=$_POST['ventasdisco'];
    
    
//Hacemos la query para modificar los datos
    $actualizar= "UPDATE `discos` SET id='$id_disco', nombre='$nombre_disco' , precio='$precio_disco', stock='$stock_disco', numeroventas='$ventas_disco' where id='$id_disco'";
//Ejecutamos la consulta
    try{
        $conexion->exec($actualizar);
        echo "Se han actualizado los datos";
    }catch(Exception $kk){
        echo "No se han actualizado los datos";
    }
   
?>

<!--Regresar al index -->
<form action="editproduct.php">
    Registro actualizado correctamente pulse continuar para regresar <input type="submit" value="Continuar" >
</form>