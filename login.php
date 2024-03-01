<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tienda virtual- Login</title>
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
                //Hacemos una consulta con la tabla de la base de datos para consultar todos los emails y ver si el introducido existe o no
                $consultaemail= $conexion-> query("SELECT email FROM clientes");
                
                //Recogemos el correo y la contraseña pasados por parametros
                if(isset($_POST['email'])){
                    $correo=$_POST['email'];
                    $clave=$_POST['contrasena'];
                    //Consulta a la base de datos para comprobar si el email que estamos introduciendo existe en la base de datos sino crearlo
                    $consultexisteemail= $conexion-> query("SELECT `email` FROM `clientes` where email='$correo'");
                    //Consulta para comprobar que la contraseña sea correcta del usuario introducido
                    $consultacontrasena= $conexion-> query("SELECT `contrasena` FROM `clientes` where contrasena='$clave' and email='$correo'");
                    //Consulta para saber el nombre del email logeadoy el tipo para redirigir a uno u otro index
                    $consultausuariologeado=$conexion-> query("SELECT `nombrecliente`,`tipo` FROM `clientes` where email='$correo'");
                    //print_r($consultausuariologeado);
                    //Recorremos el objeto tipo $consultatipo y lo almacenamos en una variable para poder procesarla y saber que tipo es
                    while($cliente = $consultausuariologeado->fetch_object()){
                        //Recogemos el resultado de la consulta y mostramos los dos datos que necesitamos
                        $nombrecliente= $cliente->nombrecliente;
                        $tipocliente= $cliente->tipo;
                    }
                    //Almacenamos el $nombrecliente en una variable de sesion
                    if(isset($nombrecliente)){
                    $_SESSION['nameclient']=$nombrecliente;
                    //Almacenamos el $emailintroducido en una variable de sesión para los cambios de perfil.php
                    $_SESSION['emailclient']=$correo;
                    }
                    //Si el numero de la consulta es 1 pues pasamos a la comprobación de la contraseña y si es cero mostramos un error
                    $row_cnt_user = $consultexisteemail->num_rows;
                    $row_cont_pass= $consultacontrasena->num_rows;
                    /*if ($row_cnt_user==0)
                    {
                        echo "¡Error el usuario introducido no existe! <br>";
                    }else{
                        echo "Usuario correcto <br>";
                        //Comprobacion de la contraseña*/
                        if ($row_cont_pass==0)
                            {
                                //echo "¡Error la contraseña es incorrecta! <br>";
                            }else{
                                //echo "Contraseña correcta <br>";
                                //Depende de que tipo de usuario sea lo redireccionamos a uno u otro
                                if($tipocliente=="Normal"){
                                    header("Location: normal/indexnormal.php"); 
                                }else{
                                    header("Location: admin/indexadmin.php");
                                }
                            }
                    }
                //}
                
                
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
                 <!-- <li class="nav-item"><a class="nav-link" href="masvendido.php"> Lo + Vendido </a></li>
                  <li class="nav-item"><a class="nav-link" href="login.php"> Perfil </a></li>
                  <li class="nav-item"><a class="nav-link" href="carro.php"> Carro </a></li> 
                  <li class="nav-item"><a class="nav-link" href="logout.php"> Cerrar sesión </a></li> -->
              </ul>
         </div> <!-- navbar-collapse.// -->
       </nav>
       
        <br><br>
        <div id="login">
            <!--Formulario para el logeo con la base de datos --> 
            <form method="post" action="login.php">
                <?php 
                    //VALIDACION DE LOS DATOS INTRODUCIDOS EN EL LOGIN
                    if(isset($_POST['email'])){
                        $emailintroducido= $_POST['email'];
                        $passintroducida=$_POST['contrasena'];
                    //Declaramos un array para mostrar los errores en el
                        $campos= array();
                    //Comprobamos que el email contenga un @ en el campo, usamos 3 iguales para que sea una comprobacion estricta
                            if($emailintroducido == "" || strpos($emailintroducido, "@") === false ){
                                array_push($campos, "Ingresa un correo electrónico válido.");
                            }else{
                                //Comprobamos que el email exista
                                    if ($row_cnt_user==0){
                                        array_push($campos,"El email no existe");
                                    }
                            }
                    //Comprobamos si la contraseña esta vacia o es menor a 6
                            if($passintroducida == "" || strlen($passintroducida) < 6){
                                array_push($campos, "El campo contraseña no puede estar vacio o ser menor que 6 de longitud.");
                            }else{
                                //Comprobamos que la contraseña sea correcta
                                if ($row_cont_pass==0){
                                    array_push($campos,"La contraseña es incorrecta");
                                }
                            }
                     
                    //Comprobamos si existe algun error, lo muestra sino nada
                            if(count($campos) > 0){
                               echo "<div class='error'>";
                               for($i = 0; $i < count($campos); $i++ ){
                                   echo "<li>".$campos[$i];
                               }
                            }else{
                                   echo "<div class='correcto'>
                                            Datos correctos";
                               }
                            //echo "</div>";
                            }
                    
                    
                
                
                ?>
                <p>*E-mail <input type="text" name="email"> </p>  
                <p>*Contraseña <input type="password" name="contrasena"> </p> 
                <input type="submit" class="btn btn-success" value="Login" > 
                
            </form>
            <!--Botón de redirección a register.php para registrar un nuevo usuario --> 
            <form method="post" action="register.php">
                <p class="sugerirregistro">Si aún no tiene un usuario. ¡ Registrate ya! <input type="submit" class="btn btn-success" value="Crear cuenta" >  </p> 
            </form> 
            </div>
        </div>
        
        <!--Trozo del footer -->
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
