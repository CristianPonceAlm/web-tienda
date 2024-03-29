<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tienda virtual</title>
        <!--Insertamos nuestro css -->
        <link rel="stylesheet" type="text/css" href="../css/estilo.css">
        <!--Vinculamos boostrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        
    </head>
    <body>
        <?php
                //Iniciamos la sesión
                //session_start();

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
                  <li class="nav-item active"> <a class="nav-link" href="indexnormal.php">Discos </a> </li>
                  <li class="nav-item"><a class="nav-link" href="masvendido.php"> Lo + Vendido </a></li>
                  <li class="nav-item"><a class="nav-link" href="perfil.php"> Perfil </a></li>
                  <li class="nav-item"><a class="nav-link" href="mostrarcarro.php"> Mostrar carro </a></li>
                  <li class="nav-item"><a class="nav-link" href="logout.php"> Cerrar sesión </a></li>
              </ul>
         </div> <!-- navbar-collapse.// -->
       </nav>
       
