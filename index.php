<?php
//Incluimos los ficheros que nos hacen falta para trabajar con pdo
    include 'global/config.php';
    include 'global/conexion.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tienda virtual</title>
        <!--Insertamos nuestro css -->
        <link rel="stylesheet" type="text/css" href="css/estilo.css">
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
                //Listado completo de una tabla
                $consultatotaldiscos= $conexion-> query("SELECT * FROM discos");
                
        ?>
        
        <div id="logo">
            <img src="img/logo.png"/>  
            <!--En este trozo recogemos el nombre de usuario que esta logeado actualmente -->
            <p> Bienvenido visitante </p>
        </div>
        
        <!-- Menú con boostrap -->
        <nav class="navbar  navbar-expand-lg navbar-dark bg-primary">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main_nav">
              <ul class="navbar-nav mx-auto">
                  <li class="nav-item active"> <a class="nav-link" href="index.php">Discos </a> </li>
                  <li class="nav-item"><a class="nav-link" href="login.php"> Login </a></li>
              </ul>
         </div> <!-- navbar-collapse.// -->
       </nav>
       
        <br><br>
               
        <div class="row">
            <?php
                $sentencia=$pdo->prepare("SELECT * FROM discos");
                //Ejecutamos la sentencia SQL
                $sentencia->execute();
                $listaproductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
                //print_r($listaproductos);   
            ?>
            <!-- Convertimos el array $listaproductos en un $producto-->
            <!--Hacemos que nos muestre cada producto -->
            <?php foreach($listaproductos as $producto){  ?>
            
                <div class="col-3">
                    <div class="card">
                        <img class="card-img-top" title="disco" alt="disco" src="img/discos/<?php echo $producto['nombre']  ?>.png">
                            <span> <?php echo $producto['nombre']  ?> </span>
                            <h5 class="card-title"> <?php echo $producto['precio']  ?>€ </h5> 
                            <!--Hacemos un formulario para enviar datos -->
                            <form action="" method="post">
                                <input type="hidden" name="id" id="id" value="<?php echo $producto['id']  ?>">
                                <input type="hidden" name="nombre" id="nombre" value="<?php echo $producto['nombre']  ?>">
                                <input type="hidden" name="precio" id="precio" value="<?php echo $producto['precio']  ?>">

                            </form>    
                    </div>
                </div>     
            <?php }?>
        </div>
        
        <br>
        
    <footer id="piedepagina">
        <nav class="navbar  navbar-expand-lg navbar-dark bg-primary">
             <ul class="navbar-nav mx-auto">
            <p> <b> Autor: Cristian Omar Ponce Almeida </b> </p>
             </ul>
        </nav>      
    </footer>
    </body>
</html>
