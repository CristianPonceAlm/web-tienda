<?php
    //Incluimos los ficheros de conexion pdo
    include '../global/config.php';
    include '../global/conexion.php';
    include 'carrito.php';
    include 'templatesnormal/cabecera.php';
?>
<br>
<h3> LISTA DEL CARRITO </h3>
<?php if(!empty($_SESSION['carrito'])){ ?>


<table class="table table-light table-bordered" >
    <tbody>
        <tr>
            <th width="40%"> Descripción </th>
            <th width="15%" class="text-center"> Cantidad </th>
            <th width="20%" class="text-center"> Precio </th>
            <th width="20%" class="text-center"> Total </th>
            <th width="5%"> -- </th>
        </tr>
        <!--Creamos una variable total para que este al iniciar en 0 -->
        <?php $total=0; ?>
        <!--Listamos todos los productos de la variable de sesion carrito -->
        <?php foreach($_SESSION['carrito'] as $indice=>$producto){ ?>
        <tr>
            <td width="40%"> <?php echo $producto['nombre']?> </td>
            <td width="15%" class="text-center"> <?php echo $producto['cantidad']?> </td>
            <td width="20%" class="text-center"> <?php echo $producto['precio']?> </td>
            <td width="20%" class="text-center"> <?php echo number_format($producto['precio']*$producto['cantidad'])?> </td>
            <td width="5%"> 
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?php echo $producto['id'];  ?>">
                    <button class="btn btn-danger" type="submit" name="btnAccion" value="Eliminar"> Eliminar </button> </td>
                </form>
        </tr>
        <!--Vamos incrementando el total final -->
        <?php $total=$total+($producto['precio']*$producto['cantidad']); ?>
        <?php } ?>
        
        <tr>
            <td colspan="3" align="right"> <h3> Total </h3> </td>
            <td align="right"> <h3> <?php echo number_format($total,2);?> € </h3></td>
        </tr>
        <tr>
            <form action="" method="post">
                <!--Almacenamos el total final de la compra en una input hidden para enviarlo al formulario -->
                <input type="hidden" name="preciototal" value="<?php echo number_format($total,2);?>">
                <td colspan="5" align="right"> <button class="btn btn-success" type="submit" name="btnAccion" value="Comprar" > Comprar </button> </td>
            </form>
        </tr>
        
        
    </tbody>
</table>
<?php }else{?>
<div class="alert alert-primary">
    No hay productos en el carro...
</div> 

<?php } ?>




<?php
    //Incluimos el pie de pagina
    include 'templatesnormal/pie.php';
?>