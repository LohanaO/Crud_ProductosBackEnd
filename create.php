<?php
if(count($_POST) > 0){//$_SERVER['REQUEST_METHOD']=="POST"
try {

    $dbname='crud_productos';
    $user='root'; 
    $password='';
    $dsn = "mysql:host=localhost;dbname=$dbname";
    $dbh = new PDO($dsn, $user, $password);
  } catch (PDOException $e){
    echo $e->getMessage();
  
  } 
  
  $consulta = $dbh->prepare("INSERT INTO productos(nombre, descripcion, imagen, precio)
   VALUES (:nombre, :descripcion, :imagen, :precio);");
  
  //Bind

  $consulta->bindValue(':nombre',$_POST['nombre']);
  $consulta->bindValue(':descripcion',$_POST['descripcion']);
  $consulta->bindValue(':imagen',null);
  $consulta->bindValue(':precio',$_POST['precio']);
  
  // Ejecutamos

  $consulta->execute();
  header("Location:index.php");
  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Creación de Producto</title>
</head>
<body>
    <h1>Creacion de producto</h1>
    <a href="index.php"> <button type="button" class="btn btn-success">Volver</button></a>
    <form method="POST" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="nombre" class="form-label">Nombre:</label>
    <input type="text" class="form-control" id="nombre" name="nombre" >  
  </div>
  <div class="mb-3">
    <label for="descripcion" class="form-label">descripción:</label>
    <textarea class="form-control"  id="descripcion" name="descripcion"></textarea>
  </div>
  <div class="mb-3">
    <label for="imagen" class="form-label">Imagen:</label>
    <input type="file" class="form-control" id="imagen" name="imagen" >
  </div>
  <div class="mb-3">
    <label for="precio" class="form-label">Precio:</label>
    <input type="number" step=".01" class="form-control" id="precio" name="precio" >  
  </div>
  <button type="submit" class="btn btn-primary">Cargar Producto</button>
</form>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> 
</body>
</html>