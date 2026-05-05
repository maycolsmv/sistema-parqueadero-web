<?php 
include_once "conexion.php";
if ((!isset($_SESSION['login'])) || (isset($_SESSION['login-admin']))){
  header("Location: index.php");
}

$description = isset($_POST['parking-name']) ? $_POST['parking-name'] : '';

$sentencia = $bd->query("SELECT p.description, p.type_vehicle, count(p.space) as cantidad, location 
                          from parqueaderos AS p, usuarios AS u WHERE p.type_vehicle = u.tp_vehicle AND  u.id = '".trim($_SESSION['user-id'])."' AND p.user_id = 0
                          group BY p.description order BY p.id ASC ");
$parkings = $sentencia->fetchAll(PDO::FETCH_OBJ);


$sentencia = $bd->query("SELECT p.id, p.description, p.type_vehicle,p.piso, p.space 
                          from parqueaderos AS p, usuarios AS u 
                          WHERE p.type_vehicle = u.tp_vehicle AND u.id = '".trim($_SESSION['user-id'])."'
                          AND p.description = '".$description."' AND p.user_id = 0
                          order BY p.id ASC");
$availability = $sentencia->fetchAll(PDO::FETCH_OBJ);

$sql = $bd->query("SELECT user_id FROM parqueaderos WHERE user_id = '".trim($_SESSION['user-id'])."'");
$validateAvailability = $sql->fetchAll(PDO::FETCH_OBJ);

$sql = $bd->query("SELECT * FROM parqueaderos WHERE user_id = '".trim($_SESSION['user-id'])."'");
$information = $sql->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Usuario</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="javascript:void(0)">Parking</a>
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
<?php if(!$validateAvailability): ?>
  <h1 class="mt-3">Disponiblidad para uso de su vehìculo</h1>
  <table class="table mt-3">
    <thead>
      <tr>
        <th scope="col">Nombre parqueadero</th>
        <th scope="col">Tipo Vehìculo</th>
        <th scope="col">Cantidad</th>
        <th scope="col">Ubicación</th>            
        <th>Acciòn</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($parkings as $parking): ?>
        <tr>
          <td><?= $parking->description ?></td>
          <td><?= $parking->type_vehicle ?></td>
          <td><?= $parking->cantidad ?></td>
          <td><?= $parking->location ?></td>        
          <td>
          <form action="usuario.php" method="POST">
              <input type="hidden" name="parking-name" value="<?= $parking->description ?>">
              <button type="sumbit" id="show-table-two" class="btn btn-success">Consultar</button>          
          </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <hr>
  <h1>Debe seleccionar el lugar donde desea parquear</h1>
  <form action="access.php" method="POST">
    <table class="table mt-3" >
      <thead>
        <tr>
          <th scope="col">Tipo Vehìculo</th>
          <th scope="col">Piso</th>
          <th scope="col">Lugar</th>
          <th scope="col">Acción</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($availability as $available): ?>
          <tr>
            <td><?= $available->type_vehicle ?></td>
            <td><?= $available->piso ?></td>
            <td><?= $available->space ?></td>
            <td>
              <input type="submit" name="submit" class="btn btn-warning mb-3" id="ocupar" value="Ocupar">
            </td>                        
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php if ($availability): ?>
      <input type="hidden" name="parking-id" value="<?= $available->id ?>">
      <input type="hidden" name="space" value="<?= "piso-$available->piso-space-$available->space" ?>">
      <input type="hidden" name="action" value="save_space_user" >
    <?php endif; ?>
  </form>
<?php else: ?>
  <h1>Información</h1>
  <hr>
  <table class="table mt-3" >
      <thead>
        <tr>
          <th scope="col">Nombre parqueadero</th>
          <th scope="col">Ubicación</th>
          <th scope="col">Tipo de vehículo</th>
          <th scope="col">Piso</th>
          <th scope="col">Lugar</th>
          <th scope="col">Acción</th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td><?= $information[0]->description ?></td>
            <td><?= $information[0]->location ?></td>
            <td><?= $information[0]->type_vehicle ?></td>
            <td><?= $information[0]->piso ?></td>
            <td><?= $information[0]->space ?></td>
            <td>
              <form action="access.php" method="POST">
                <input type="hidden" name="action" value="update_availability" >
                <input type="hidden" name="parking-id" value="<?= $information[0]->id ?>">
                <input type="submit" name="submit" class="btn btn-danger mb-3" value="Desocupar">
              </form>              
            </td>                        
          </tr>
      </tbody>
    </table>
<?php endif; ?>
</body>
</html>