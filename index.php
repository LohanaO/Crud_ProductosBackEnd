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

$buscar= $_GET['buscar']?? '';
if($buscar){
$consulta = $dbh->prepare("SELECT * FROM productos WHERE  nombre LIKE :buscar");
$consulta->bindValue(':buscar', "%$buscar%");
} else{
  $consulta = $dbh->prepare("SELECT * FROM productos");
}
// Ejecutamos
$consulta->execute();
$productos= $consulta->fetchAll();

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
    <title>Crud de Productos</title>
</head>
<body>
    <h1>CRUD de Productos</h1>
    <form method="GET" class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Celular a Buscar" aria-label="Recipient's username" aria-describedby="button-addon2" name="buscar">
      <button class="btn btn-info type="submit" id="button-addon2">buscar</button>
    </form>

    <a href="create.php"> <button type="button" class="btn btn-success">crear  producto</button></a>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">nombre</th>
      <th scope="col">descripción</th>
      <th scope="col">Imagen</th>
      <th scope="col">Precio</th>
      <th scope="col">Fecha</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach ($productos as $i => $producto) {?>
        
    
    <tr>
      <th scope="row"><?=$i+1?></th>
      <td><?=$producto['nombre']?></td>
      <td><?=$producto['descripcion']?></td>
      <td><?=$producto['imagen']?></td>
      <td><?=$producto['precio']?></td>
      <td><?=$producto['fecha_creacion']?></td>
      <td>
                    <form action="edit.php" >
                        <input type="hidden" name="id" value=<?=$producto['id']?>>
                        <button type="submit" class="btn btn-sm  btn-primary">Editar</button>
                    </form>

                    <form action="delete.php" method="POST">
                        <input type="hidden" name="id" value=<?=$producto['id']?>>
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                   </form>
    </td>
      
    </tr>
    <?php   } ?>
  </tbody>
</table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script> 
</body>
</html>