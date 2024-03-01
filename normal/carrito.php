<?php
    //Iniciamos una sesión
    session_start();

    $mensaje="";
    //Comprobamos si el botón de añadir al carrito se pulsó
    if(isset($_POST['btnAccion'])){
        switch($_POST['btnAccion']){
            case 'Agregar':
                $id=$_POST['id'];
                $nombre=$_POST['nombre'];
                $precio=$_POST['precio'];
                $cantidad=$_POST['cantidad'];
                //echo "OK ID: ".$id;


            //Comprobamos sino tiene nada la variable de session
                if(!isset($_SESSION['carrito'])){
                    
                    $producto=array(
                        'id'=>$id,
                        'nombre'=>$nombre,
                        'precio'=>$precio,
                        'cantidad'=>$cantidad
                    );
                    $_SESSION['carrito'][0]=$producto;
                }else{
                    //Para evitar que añadamos mas de 1 producto de un mismo id
                    $idproductos= array_column($_SESSION['carrito'], "id");
                    if(in_array($id, $idproductos)){
                        echo "<script> alert('El producto ya ha sido añadido')</script>";
                    }else{
                        $numeroproductos=count($_SESSION['carrito']);
                        $producto=array(
                            'id'=>$id,
                            'nombre'=>$nombre,
                            'precio'=>$precio,
                            'cantidad'=>$cantidad
                        );
                        $_SESSION['carrito'][$numeroproductos]=$producto;
                    }
                }
                //$mensaje=print_r($_SESSION,true);
            break;    
            case "Eliminar":
                //Almacenamos el id
                $id=$_POST['id'];
                foreach($_SESSION['carrito'] as $indice=>$producto){
                    if($producto['id']==$id){
                        //Comprobamos si el id seleccionado ya existia, pues lo borramos con unset
                        unset($_SESSION['carrito'][$indice]);
                        //Al borrar un indice se recolocan los posteriores
                        array_values($_SESSION['carrito']);
                        //echo "<script> alert('Borrado') </script>";
                    }
                }
            break;
            case "Comprar":
                //Almacenamos los datos a insertar en la tabla "detallesdepedidos" y update la tabla "discos" para reducirle el stock
                foreach($_SESSION['carrito'] as $producto ){
                    $cantidadelegida=$producto['cantidad'];
                    $idactual=$producto['id'];
                    $actualizar=$pdo->prepare("UPDATE `discos` SET `stock`= stock-$cantidadelegida , `numeroventas` = numeroventas + $cantidadelegida WHERE id='$idactual'");
                    //Ejecutamos la el update
                    $actualizar->execute();
                    
                }
                //Recogemos el nombre del usuario logeado para usarlo en la consulta
                    $emailactual=$_SESSION['emailclient'];
                //Recoger el total del pedido 
                    $totalpedido=$_POST['preciototal'];
                    //echo $totalpedido;
                //Fecha actual
                    $fechaactual= date("Y-n-d");
                    //echo $fechaactual;   
                //INSERT DENTRO DE TABLA PEDIDO CON EL EMAILCLIENTEACTUAL CON EL TOTALPEDIDO Y CON LA FECHAACTUAL
                    $insertpedido=$pdo->prepare("INSERT INTO `pedidos`(`emailcliente`, `totalpedido`, `fechapedido`) VALUES ('$emailactual','$totalpedido','$fechaactual')");
                    //Ejecutamos el insert
                    $insertpedido->execute();
                //Almacenamos el último id introducido en el insert de pedidos
                $idlastpedido=$pdo->lastInsertId();  
                foreach($_SESSION['carrito'] as $indice=>$producto){
                    $idproductodetalles=$producto['id'];//Id del disco
                    $preciodetalles=$producto['precio'];//Precio del producto
                    $cantidaddetalles=$producto['cantidad'];//Cantidad del producto
                    $insertdetalles=$pdo->prepare("INSERT INTO `detallesdepedidos`(`idpedido`, `iddisco`, `cantidad`, `precio`) VALUES ('$idlastpedido','$idproductodetalles','$cantidaddetalles','$preciodetalles')");
                    //Ejecutamos el insert
                    $insertdetalles->execute();
                }
                //AL FINAL DEL TODO HACEMOS UN UNSET DE TODO
                unset($_SESSION['carrito']);
            ?>
                <!--Hacemos un alert para que vea que el pedido se ha procesado correctamente -->
                <div class="alert alert-success">
                    Pedido realizado.
                    <br>
                    
                </div>
            <?php
            break;
                
        }       
    }   
?>

