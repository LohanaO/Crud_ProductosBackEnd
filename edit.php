<?php

try {

    $dbname='crud_productos';
    $user='root'; 
    $password='';
    $dsn = "mysql:host=localhost;dbname=$dbname";
    $dbh = new PDO($dsn, $user, $password);
  } catch (PDOException $e){
    echo $e->getMessage();
  
  } 

  if(count($_POST) > 0){
    
    // Prepare
    
    $consulta = $dbh->prepare("UPDATE productos
    SET nombre=:nombre,descripcion=:descripcion,imagen=:imagen,precio=:precio 
    WHERE id=:id");
    
    // Bind
    
    $consulta->bindValue(':nombre', $_POST['nombre']);
    $consulta->bindValue(':descripcion', $_POST['descripcion']);
    $consulta->bindValue(':imagen', null);
    $consulta->bindValue(':precio', $_POST['precio']);
    $consulta->bindValue(':id', $_POST['id']);
    
    // Excecute
    $consulta->execute();
    header("Location:index.php");
  }
      else{
  
  
  $consulta = $dbh->prepare("SELECT * FROM productos WHERE id=:id");
  
  //Bind
  $consulta->bindValue(':id',$_GET['id']);
  // Ejecutamos

  $consulta->execute();
  $producto= $consulta->fetch();



  
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
    <h1>Actualización de Produto</h1>
    <a href="index.php"> <button type="button" class="btn btn-success">Volver</button></a>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value=<?=$producto['id']?>>
  <div class="mb-3">
    <label for="nombre" class="form-label">Nombre:</label>
    <input type="text" class="form-control" id="nombre" name="nombre" value="<?=$producto['nombre']?>" >  
  </div>
  <div class="mb-3">
    <label for="descripcion" class="form-label">descripción:</label>
    <textarea class="form-control"  id="descripcion" name="descripcion" ><?=$producto['descripcion']?></textarea>
  </div>
  <div class="mb-3">
    <label for="imagen" class="form-label">Imagen:</label>
    <input type="file" class="form-control" id="imagen" name="imagen">
  </div>
  <div class="mb-3">
    <label for="precio" class="form-label">Precio:</label>
    <input type="number" step=".01" class="form-control" id="precio" name="precio" value=<?=$producto['precio']?>>  
  </div>
  <button type="submit" class="btn btn-primary">Editar Producto</button>
</form>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> 
</body>
</html>