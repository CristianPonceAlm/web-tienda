<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tienda virtual- Admin - Crear producto</title>
        <!--Insertamos nuestro css -->
        <link rel="stylesheet" type="text/css" href="../css/estilo.css">
        <!--Vinculamos boostrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        
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
                //echo "Se ha establecido una conexión con el servidor de bases de datos <br>";
        //Ahora seleccionaremos una tabla para trabajar con ella
            $conexion->select_db("db_tienda");
            $conexion->set_charset("utf8");
            }
        //Consulta para saber cuantos registros hay en discos
            $consultatotaldiscos= $conexion-> query("SELECT id FROM discos");
        //Almacenamos el total de la consulta
            $discostotal = $consultatotaldiscos->num_rows;
        //Mostramos los resultados
            //echo "El total de discos de la base de datos es: ".$discostotal;
        //Ahora para el siguiente disco creado le sumamos uno al contar anterior para que se autoincremente
            $siguienteid=$discostotal+1;
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
            <h2> Nuevo disco: </h2>
            <!--Creamos el formulario nuevo para la edición--> 
            <form method="POST" action="addproduct.php"> <br>
                <p> ID del disco: <?= $siguienteid ?>  </p>
                <!--Ocultamos en un input el siguiente id para enviarlo al insert -->
                <input type="hidden" name="siguienteid" value="<?= $siguienteid ?> " >
                <p>Nombre del disco: <input type="text" name="nombredisco">  </p>
                <p>Precio del disco: <input type="number" name="preciodisco" > </p>
                <p>Stock del disco: <input type="number" name="stockdisco" > </p>
                <p>Numero de ventas: <input type="number" name="ventasdisco" > </p>
                <input type="submit" value="Crear">
            </form>
            <!-- Ahora hacemos la inserccion de los datos si todo esta correcto--> 
            <?php 
                //Comprobamos que hayan datos introducidos "antes de javascript para comprobacion de errores"
                if(isset($_POST['siguienteid'])){
                //Recogemos los valores del formulario
                $idnuevo=$_POST['siguienteid'];
                $nombrenuevo=$_POST['nombredisco'];
                $precionuevo=$_POST['preciodisco'];
                $stocknuevo=$_POST['stockdisco'];
                $numeronuevo=$_POST['ventasdisco'];
                //Realizamos la inserccion de datos
                $crear="INSERT INTO `discos`(`id`, `nombre`, `precio`, `stock`, `numeroventas`) VALUES ('$idnuevo','$nombrenuevo','$precionuevo','$stocknuevo','$numeronuevo')";
                if (mysqli_query($conexion, $crear)) {
                      echo "Registro creado correctamente";
                      header("Location: indexadmin.php");
                    } else {
                      echo "Error: " . $crear . "<br>" . mysqli_error($conexion);
                    }
                //Cerramos la conexion
                mysqli_close($conexion);
                
                }
            ?>
            
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