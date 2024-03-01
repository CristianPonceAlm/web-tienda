<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tienda virtual- Admin - Modificar Productos</title>
        <!--Insertamos nuestro css -->
        <link rel="stylesheet" type="text/css" href="../css/estilo.css">
        <!--Vinculamos boostrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        <!--Aquí metemos la función para la confirmación de la cancelación --> 
        <script language="JavaScript">
            function confirmarborrado(){
                var respuesta= confirm("¡Cuidado! ¿Seguro que quieres BORRAR ese disco?");
                if(respuesta== true){
                    return true;
                }else{
                    return false;
                }   
            }   
        </script>
    </head>
    <body>
        <?php
                //Iniciamos la sesión
                session_start();
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
                //Recogemos el nombre del usuario logeado
                $nombreusuario=$_SESSION['nameclient'];
                //Listamos todos los datos de los discos
                $consultadiscos= $conexion-> query("SELECT * FROM discos");

        ?>
        
        <div id="logo">
            <img src="../img/logo.png">  
            <!--En este trozo recogemos el nombre de usuario que esta logeado actualmente -->
            <p> Bienvenido <?= $nombreusuario ?> </p>
        </div>
        
        <!-- Menú con boostrap -->
        <nav class="navbar  navbar-expand-lg navbar-dark bg-primary">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main_nav">
              <ul class="navbar-nav mx-auto">
                  <li class="nav-item active"> <a class="nav-link" href="editproduct.php">Modificar Productos </a> </li>
                  <li class="nav-item"><a class="nav-link" href="addproduct.php"> Añadir producto </a></li>
                  <li class="nav-item"><a class="nav-link" href="editaruser.php"> Modificar usuario </a></li>
                  <li class="nav-item"><a class="nav-link" href="../normal/logout.php"> Cerrar sesión </a></li>
              </ul>
         </div> <!-- navbar-collapse.// -->
       </nav>
       
        <br><br>
                    
            <!--Creamos una tabla para ir mostrando los resultados en ella para modificar cada producto-->
            <div id="masventas" >
                <table border="5" style="text-align: center;">
                    <tr>
                        <td><b>ID</b></td>
                        <td><b>Nombre</b></td>
                        <td><b>Precio</b></td>
                        <td><b>Stock</b></td>
                        <td><b>Numero de ventas</b></td>
                        <td> </td>
                        <td> </td>
                    </tr>
                <?php    
                         while($disco=$consultadiscos->fetch_object()){
                         ?>
                         <tr>
                         <form method="post" action="modificarproducto.php">
                             <td><?=$disco->id ?> </td>
                             <td><?=$disco->nombre ?> </td> 
                             <td><?=$disco->precio ?> </td>
                             <td><?=$disco->stock ?> </td>
                             <td><?=$disco->numeroventas ?> </td>
                            <!--Mantenemos los datos en hidden para luego procesar que disco es el que modifica -->
                                <input type="hidden" name="idcd" value="<?= $disco->id ?>" >
                                <input type="hidden" name="nombrecd" value="<?= $disco->nombre ?>" >
                                <input type="hidden" name="preciocd" value="<?= $disco->precio ?>" >
                                <input type="hidden" name="stockcd" value="<?= $disco->stock ?>" >
                                <input type="hidden" name="ventascd" value="<?= $disco->numeroventas ?>" >
                            <td> <input type="submit" value="Editar"> </td>  
                         </form>
                         <form method="post" action="eliminardisco.php">
                             <!--Mantenemos el id para moverlo al eliminardiscos.php -->
                                <input type="hidden" name="idcd" value="<?= $disco->id ?>" >
                             <td> <input type="submit" value="Eliminar" onclick="return confirmarborrado()"> </td>  
                         </form>    
                         </tr>
                         <?php
                         }
                         ?>
                </table>
            </div>
            
        </div>   
        <br><br>
    <footer id="piedepagina">
        <nav class="navbar  navbar-expand-lg navbar-dark bg-primary">
             <ul class="navbar-nav mx-auto">
            <p> <b> Autor: Cristian Omar Ponce Almeida </b> </p>
             </ul>
        </nav>      
    </footer>
    </body>
</html>