<?php 
include_once "conexion.php";
if ((!isset($_SESSION['login'])) || (isset($_SESSION['login-user'])) ){
  header("Location: index.php");
}

$sentencia = $bd->query("SELECT  p.type_vehicle, p.piso, p.`space`, p.user_id , u.name, u.id 
FROM parqueaderos AS p , usuarios AS u WHERE u.id = '".trim($_SESSION['user-id'])." '
and u.parking_id = p.id_parking  ");
$vista = $sentencia->fetchAll(PDO::FETCH_OBJ);

/*$sentencia = $bd->query("SELECT p.description, p.type_vehicle, p.piso,
                        p.`space`, p.user_id , u.name,  u.rol_id, u.parking_id FROM parqueaderos AS p , usuarios AS u
                        WHERE u.rol_id = 1 AND u.parking_id = u.rol_id     and p.description = 'Parqueadero 2'");
$admins = $sentencia->fetchAll(PDO::FETCH_OBJ);*/


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Administrador</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Parking</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">

        <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">Bienvenid@: <?= strtoupper($_SESSION['user-name']) ?></a>
        </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="access.php" method="POST">
      <input type="hidden" name="action" value="logout">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Salir</button>
    </form>
  </div>
</nav>

<table class="table mt-3">
  <thead>
    <tr>
      <th scope="col">Tipo de vehiculo</th>
      <th scope="col">Piso</th>
      <th scope="col">Lugar</th>
      <th scope="col">Usuario usando lugar</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($vista as $admin): ?>
        <tr>
          <td><?= $admin->type_vehicle ?></td>
          <td><?= $admin->piso ?></td>
          <td><?= $admin->space ?></td>
          <td><?= $admin->user_id  ?></td>        
        </tr>
        
      <?php endforeach; ?>
  </tbody>
</table>
 
</body>
</html>