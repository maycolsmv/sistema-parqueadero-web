<?php 
include_once "conexion.php"; //con este método se llama el archivo conexión
if (isset($_POST['submit'])) {// isset valida si hay algún valor
    //recoger valores del form user
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false; //Acá hace un if ternario
    $document = isset($_POST['document']) ? $_POST['document'] : false;
    $parquederoId = empty($_POST['parkingId']) ? 0 : $_POST['parkingId'];
    $tipo = empty($_POST['vehicle']) ? '' : $_POST['vehicle'];
    $placa = empty($_POST['placa']) ? "0" : $_POST['placa'];
    $user = isset($_POST['user']) ? $_POST['user'] : false;
    $contra = isset($_POST['password']) ? md5($_POST['password']) : false;
    $role = $_POST['role'] ?? 1;


    //array errores
    $errores = [];// Forma de asignar un array

    
    //validar los datos
    //val nombre
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre)) {//Validación si no esta vacío, si no es numerico y si no tiene caracteres especiales
        $nombre_validado = true;
    }else{
        $nombre_validado = false;
        $errores['nombre'] ="El nombre no es valido";// Llena el array con el key nombre si viene vacío
    }

    //val id
    if(!empty($document)) {
        $id_validado = true;
    }else{
        $id_validado = false;
       $errores['document'] ="El id no es valido";
    }

    switch ($_POST['role']) {
        case '1':
            //val nombre parqueadero
            if($parquederoId == "0" || $parquederoId != "") {
                $parkingId_validado = true;
            }else{
                $parkingId_validado = false;
                $errores['nombre_parqueadero'] ="El nombre del parqueadero no es valido";
            }
            break;
        case '2':
            //val tipo 
            if(!empty($tipo)) {
                $tipo_validado = true;
            }else{
                $tipo_validado = false;
                $errores['vehicle'] ="El tipo no es valido";
            }
            break;
        default:
            # code...
            break;
    }

    //val placa
    if($placa == "0" || $placa != "") {
        $placa_validado = true;
    }else{
        $placa_validado = false;
       $errores['placa'] ="La placa no es valido";
    }

    //val user
    if(!empty($user) && !is_numeric($user) && !preg_match("/[0-9]/",$user)) {
        $user_validado = true;
    }else{
        $user_validado = false;
       $errores['user'] ="El user no es valido";
    }

    //val contra
    if(!empty($contra)) {
        $contra_validado = true;
    }else{
        $contra_validado = false;
        $errores['contra'] ="La contra no es valido";
    }


    $guardar_user = false;

    if(count($errores) == 0){// Valida que el array de errores este vación para poder almacenar
        $guardar_user = true;
        //Método el cual nos permite almacenar información en la db
        $sentencia = $bd->prepare("INSERT INTO usuarios(name,document,tp_vehicle,place,user,password,rol_id,parking_id) VALUES (?,?,?,?,?,?,?,?);");
        $resultado = $sentencia->execute([$nombre,$document,$tipo,$placa,$user,$contra,$role,$parquederoId]);
        if ($resultado){
            unset($_SESSION['errors']);//Función que permite borrar la sesiones
            $_SESSION['create'] = 'Usuario creado con éxito';
            header("Location: index.php");   
        }else {            
            $_SESSION['create'] = 'Error de conexión';
            exit;
        }        
    }else{       
        unset($_SESSION['create']);         
        $_SESSION['errors'] = $errores;//Se crea una sesión para mostrar los errores en la vista
        header("Location: registrar/crear_user.php");// Se direcciona a la vista
    }
}