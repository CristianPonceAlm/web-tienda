<?php
$servidor="mysql:dbname=" .BD.";host=".SERVIDOR;
try{
    $pdo= new PDO($servidor,USUARIO,PASSWORD,
            array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8")
            );
    //Esto es para mostrar si se conecta o no
    //echo "<script>alert('Conectado...') </script>";        
    
}catch(PDOException $e){
    echo "<script>alert('Error de conexión...') </script>"; 
}


