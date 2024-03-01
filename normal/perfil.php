<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tienda virtual - Carro</title>
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
            //Recogemos el nombre del usuario logeado
                $nombreusuario=$_SESSION['nameclient'];
            //Recogemos el email del usuario logeado en ese momento para usarlo en la consulta
                $emailusuario=$_SESSION['emailclient'];
            //Consulta para recoger los datos de ese usuario
                $consultausuariologeado= $conexion-> query("SELECT * FROM clientes where email='$emailusuario'");

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
                  <li class="nav-item active"> <a class="nav-link" href="indexnormal.php">Discos </a> </li>
                  <li class="nav-item"><a class="nav-link" href="masvendido.php"> Lo + Vendido </a></li>
                  <li class="nav-item"><a class="nav-link" href="perfil.php"> Perfil </a></li>
                  <li class="nav-item"><a class="nav-link" href="mostrarcarro.php"> Mostrar carro </a></li>
                  <li class="nav-item"><a class="nav-link" href="logout.php"> Cerrar sesión </a></li>
              </ul>
         </div> <!-- navbar-collapse.// -->
       </nav>
       
        <br><br>
            
       <!--Creamos una tabla mostrar los datos de el usuario logeado *CAMBIAR ESTILO* -->
            <div id="masventas" >
                <table border="5" style="text-align: center;">
                    <tr>
                        <td><b>Email</b></td>
                        <td><b>Nombre</b></td>
                        <td><b>Apellidos</b></td>
                        <td><b>Dirección</b></td>
                        <td> </td>
                    </tr>
                <?php    
                         while($usuario=$consultausuariologeado->fetch_object()){
                         ?>
                         <tr>
                         <form method="post" action="modificarusuarioactual.php">
                             <td><?=$usuario->email ?> </td>
                             <td><?=$usuario->nombrecliente ?> </td> 
                             <td><?=$usuario->apellidocliente ?> </td>
                             <td><?=$usuario->direccion ?> </td>
                            <!--Mantenemos los datos en hidden para luego procesar que disco es el que modifica -->
                                <input type="hidden" name="useremail" value="<?=$usuario->email ?>" >
                                <input type="hidden" name="usernombre" value="<?=$usuario->nombrecliente ?> " >
                                <input type="hidden" name="userapellido" value="<?=$usuario->apellidocliente ?>" >
                                <input type="hidden" name="usercontrasena" value="<?=$usuario->contrasena ?>" >
                                <input type="hidden" name="userdireccion" value="<?=$usuario->direccion ?>" >

                            <td> <input type="submit" value="Editar"> </td>  
                         
                         </tr>
                         <?php
                         }
                         ?>
                </table>
            </div>
            
        </div>    
        
        <?php
            //Incluimos el pie de pagina
            include 'templatesnormal/pie.php';
        ?>
        
       