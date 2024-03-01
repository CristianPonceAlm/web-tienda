<?php
    //Incluimos los ficheros de conexion pdo
    include '../global/config.php';
    include '../global/conexion.php';
    include 'carrito.php';
    include 'templatesnormal/cabecera.php';
?>

<div class="row">
            <?php
                //Recogemos la busqueda
                if(isset($_POST['nombrebuscar'])){
                    $busqueda=$_POST['nombrebuscar'];
                    $sentencia=$pdo->prepare("SELECT * FROM discos where nombre LIKE '%$busqueda%'");
                    //Ejecutamos la sentencia SQL
                    $sentencia->execute();
                    $listaproductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
                    //print_r($listaproductos);   
                
            ?>
            <!-- Convertimos el array $listaproductos en un $producto-->
            <?php foreach($listaproductos as $producto){  ?>
                <div class="col-4">
                    <div class="card">
                        <img class="card-img-top" title="disco" alt="disco" src="../img/discos/<?php echo $producto['nombre']  ?>.png">
                            <span> <?php echo $producto['nombre']  ?> </span>
                            <h5 class="card-title"> <?php echo $producto['precio']  ?>€ </h5> 
                            <!--Hacemos un formulario para enviar datos -->
                            <form action="" method="post">
                                <input type="hidden" name="id" id="id" value="<?php echo $producto['id']  ?>">
                                <input type="hidden" name="nombre" id="nombre" value="<?php echo $producto['nombre']  ?>">
                                <input type="hidden" name="precio" id="precio" value="<?php echo $producto['precio']  ?>">
                                Introduce cantidad: <input type="number" name="cantidad" id="cantidad" value="0">
                            
                                <button class="btn btn-primary" name="btnAccion" value="Agregar" type="submit">
                                Agregar al carro    
                                </button> 
                            </form>    
                    </div>
                </div>     
                <?php }}?>
            
            <!--Hacemos que nos muestre cada producto -->
            
        </div>
        
        
        <?php
            //Incluimos el pie de pagina
            include 'templatesnormal/pie.php';
        ?>
        