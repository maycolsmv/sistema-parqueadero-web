<?php
    include_once "../conexion.php";

    $sentencia = $bd->query("select * from roles");
    $roles = $sentencia->fetchAll(PDO::FETCH_OBJ);

    $sentencia = $bd->query("select * from parqueaderos  group by description order by id asc");
    $parqueaderos = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <title>Crear Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
    <div class="text-center"><h1>Crear Cuenta De Usuario<h1></div>
            
    <?php if(isset($_SESSION['errors'])):?>
        <div class="alert alert-danger" role="alert">
            <?php 
                foreach($_SESSION['errors'] as $error):
                    echo $error . '<br>';
                endforeach;        
            ?>
        </div>
    <?php endif; ?>
    <form action="../recoger_user.php" method="POST">
        <h4><label for="">Rol - (Debe seleccionar un ROL)</label></h4>
        <select class="form-select" name="role" id="rol" aria-label="Default select example">
            <option selected>--Seleccione--</option>
            <?php foreach($roles as $rol) : ?>
                <option value="<?= $rol->id ?>"><?= $rol->description ?></option>        
            <?php endforeach; ?>
        </select><br>
        <div id="content">
            <h4><label for="">Nombre:</label></h4>        
            <input type="text"  placeholder="Usuario" name="nombre" class="form-control" required><br>

            <h4><label for="">N° Identificación:</label></h4>
            <input type="number"  placeholder="ID" name="document" class="form-control" required><br>
            
            <div id="admin">
                <h4><label for="">Establecimiento</label></h4>
                <select class="form-select" name="parkingId" aria-label="Default select example">
                    <option selected>--Seleccione--</option>
                    <?php foreach($parqueaderos as $parking) : ?>
                        <option value="<?= $parking->id ?>"><?= $parking->description ?></option>        
                    <?php endforeach ?>
                </select><br>
            </div>
            
            <div id="user">
                <h4><label> Tipo de vehículo:</label></h4>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="vehicle" id="flexRadioDefault1" value="carro">
                    <label class="form-check-label" for="flexRadioDefault1">
                    Carro
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="vehicle" id="flexRadioDefault2" value="moto">
                    <label class="form-check-label" for="flexRadioDefault2">
                    Moto
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="vehicle" id="bicicleta" value="bicicleta">
                    <label class="form-check-label " for="flexRadioDefault3">
                    Bicicleta
                    </label>
                </div>
        
                <h4><label for=""  class="label-bicicle">Placa:</label></h4>
                <input type="text" id="placa" name="placa" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();">  
            </div>
                                    
            
            <h4><label for="exampleInputEmail1" class="form-label" name="user"><b>Usuario:</b></label></h4>
            <input type="text" class="form-control" id="exampleInputText" placeholder="Usuario" name="user" required>
            

            <div class="mb-3">
                <h4><label for="exampleInputPassword1" class="form-label"><b>Contraseña:</b></label></h4>
                <input type="password" class="form-control"  placeholder="Contraseña" name="password" required>
            </div>


            <input type="submit" name="submit" class="btn btn-primary mb-3" value="Crear">
        </div>         

    </form>
    </div>
    <script>
        $(function(){
            $('#content').hide();   
            $('#admin').hide();
            $('#user').hide()                                   
            $('#rol').change(function(){
                switch($('#rol').val()) {
                    case '1':
                        $('#content').show();    
                        $('#admin').show();
                        $('#user').hide();
                        break;
                    case '2':
                        $('#content').show();
                        $('#admin').hide();    
                        $('#user').show();
                        break;
                    default:
                    $('#content').hide();   
                    $('#admin').hide();
                    $('#user').hide();
                }               
            })
            

            $('input:radio[name="vehicle"]').change(function() {
                if ($(this).val() == 'bicicleta') {                      
                    $('#placa').hide();
                    $('.label-bicicle').hide();                      
                } else {
                    $('#placa').show();
                    $('.label-bicicle').show();
                }
            });
        });

    </script>
</body>
</html>