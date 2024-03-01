<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tienda virtual- Admin - Modificando</title>
        <!--Insertamos nuestro css -->
        <link rel="stylesheet" type="text/css" href="../css/estilo.css">
        <!--Aquí metemos la función para la confirmación de la cancelación --> 
        <script language="JavaScript">
            function confirmar(){
                var respuesta= confirm("¿Quieres cancelar la edición?");
                if(respuesta== true){
                    return true;
                }else{
                    return false;
                }   
            }   
        </script>
        <!--Vinculamos boostrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        
    </head>
    <body>
        <?php
            //Iniciamos la sesión
                session_start();
           // Empezaremos estableciendo una conexion con el servidor de bases de datos usando PDO
                $conexion = new PDO("mysql:host=localhost", "root", "");
               //Comprobamos que esté bien hecha la conexión con un try catch
                try{
                    $conexion= new PDO("mysql:host=localhost","root","");
                    echo "Se ha establecido una conexión con el servidor de bases de datos. <br>";
                }catch(PDOException $e){
                    echo "No se ha podido establecer conexión con el servidor de bases de datos. <br>";
                }
            //Conexion con la base de datos tienda mediante el usuario root sin contraseña dentro de un trycatch para asegurarnos de que no hay error
                try{
                $conexion= new PDO("mysql:host=localhost;dbname=db_tienda;charset=utf8","root","");
                }catch(PDOException $e){
                    echo "No se ha podido establecer conexion la base de datos <br>";
                    die("Error: ".$e->getMessage());
                }
            //Recogemos el id para saber que disco vamos a editar
                $emaileditando=$_POST['clienteemail'];
            //Hacemos una consulta para recoger los valores que elegimos
                $consultacliente= $conexion->query("SELECT `email`,`nombrecliente`,`apellidocliente`,`contrasena`,`direccion`,`tipo` FROM clientes where `email`='$emaileditando'");
            //Mostramos el email del cliente elegido para ver si funciona bien
                echo "El email que estas editando es el: $emaileditando";
            //Recogemos el nombre del usuario logeado
                $nombreusuario=$_SESSION['nameclient'];
        
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
        <!--Parte para modificar datos -->             
        <div id="masventas" >
            <h2> Cliente: </h2>
            <!--Creamos el formulario nuevo para la edición--> 
            <form method="POST" action="actualizarcliente.php"> <br>
                <?php
                    while($cliente=$consultacliente->fetchObject()){
                    ?>
                        <p> Email del cliente: <input type="text" name="cambiaremail" value="<?= $cliente->email ?>"> </p>
                        <p> Nombre del cliente: <input type="text" name="cambiarnombre" value="<?= $cliente->nombrecliente ?>"> </p>
                        <p> Apellidos del cliente: <input type="text" name="cambiarapellido" value="<?= $cliente->apellidocliente ?>"> </p>
                        <p> Contraseña del cliente: <input type="password" name="cambiarcontrasena" value="<?= $cliente->contrasena ?>"> </p>
                        <p> Dirección de cliente: <input type="text" name="cambiardireccion" value="<?= $cliente->direccion ?>"> </p>
                        <p> Típo de cliente: <input type="text" name="cambiartipo" value="<?= $cliente->tipo ?>"> </p>
                        <input type="submit" value="Actualizar">
            </form>
            <!--Segundo formulario para el boton cancelar, si pulsa cancelar vuelev al index.php, pero le pondrémos una confirmación por si no estamos seguros de querer cancelar -->
            <form method="post" action="editaruser.php">
                <input type="submit" value="Cancelar" onclick="return confirmar()">
            </form>
                <?php
                //Cerrar el while
                    }
                ?>
            <!-- Ahora en el siguiente fichero "actualizarcliente.php haremos los updates--> 
             <br><br>
        </div>
            
        </div>    
    <footer id="piedepagina">
        <nav class="navbar  navbar-expand-lg navbar-dark bg-primary">
             <ul class="navbar-nav mx-auto">
            <p> <b> Autor: Cristian Omar Ponce Almeida </b> </p>
             </ul>
        </nav>      
    </footer>
    </body>
</html>