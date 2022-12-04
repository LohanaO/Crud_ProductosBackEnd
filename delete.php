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
  
  $consulta = $dbh->prepare("DELETE FROM productos
   WHERE (id=:id);");
  
  //Bind

  $consulta->bindValue(':id',$_POST['id']);
 
  
  // Ejecutamos

  $consulta->execute();
  header("Location:index.php");
  

?>