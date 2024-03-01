<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tienda virtual- Registro</title>
        <!--Insertamos nuestro css -->
        <link rel="stylesheet" type="text/css" href="css/estilo.css">
        <!--Vinculamos boostrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        
    </head>
    <body>
        <?php
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
            //Comprobar que haya introducido datos
            if(isset($_POST['email'])){
            //Almacenamos el email introducido por el formulario en una variable
                $emailint=$_POST['email'];
            //Almacenamos el resto de variables para el registro
                $nombreint=$_POST['nombre'];
                $apellidosint=$_POST['apellidos'];
                $direccionint=$_POST['direccion'];
                $contrasenaint=$_POST['contrasena'];
                $tipodefecto="Normal";
            //Comprobamos que el email no exista
                $consultaemail= $conexion-> query("SELECT `email` FROM `clientes` where email='$emailint'");
            //Determinamos el resultado de la consulta
                $row_cnt = $consultaemail->num_rows;
                if ($row_cnt>0)
                {
                    echo "¡Error ya existe una cuenta con ese email! <br>";
                }else{
                    echo "No existe ningun registro con ese dni <br>";
            //Hacemos la consulta para la inserccion de los datos
                $crear= $conexion->query("INSERT INTO `clientes`(`email`, `nombrecliente`, `apellidocliente`, `contrasena`, `direccion`, `tipo`) VALUES ('$emailint','$nombreint','$apellidosint','$contrasenaint','$direccionint','$tipodefecto')");
            //Ejecutamos el insert
                    if(mysqli_query($conexion, $crear)){
                        echo "¡Error, registro no creado!";
                    }else{
                        echo "Registro creado";
                        header("Location: index.php"); 
                    }
                }          
            }else{
    
            }
            
        ?>
        
        <div id="logo">
            <img src="img/logo.png">  
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
        <div id="login">
             <!--Formulario para el logeo con la base de datos --> 
             <form method="post" action="register.php">

                 <td>*Introduzca un E-mail <input type="text" name="email"> </td> <br> <br>
                 <td>*Introduzca su nombre <input type="text" name="nombre"> </td> <br> <br>
                 <td>*Introduzca sus apellidos <input type="text" name="apellidos"> </td> <br> <br>
                 <td>*Introduzca su dirección <input type="text" name="direccion"> </td> <br> <br>
                 <td>*Introduzca una contraseña <input type="password" name="contrasena"> </td> <br> <br>
                 <td><input type="submit" class="btn btn-success" value="Registrar" > </td>
             </form>
         </div>
                <br><br>     
        
    </body>
</html>
