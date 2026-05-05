<?php
include_once "conexion.php";

$action = $_POST['action'];

switch ($action) {
    case 'login':
        $user = trim($_POST['user']);
        $password = trim($_POST['password']);

        $sentencia = $bd->query("select * from usuarios where user = '".$user."' and password = '".md5($password)."'");
        $user = $sentencia->fetchAll(PDO::FETCH_OBJ);
       
        if (!empty($user)) {
            unset($_SESSION['create']);
            unset($_SESSION['message-login']);
            $_SESSION['login'] = true;  
                      
            if ($user[0]->rol_id == 1){
                $_SESSION['user-id'] = $user[0]->id;
                $_SESSION['user-name'] = $user[0]->name;
                unset($_SESSION['login-user']);
                $_SESSION['login-admin'] = true;
            } else {
                $_SESSION['user-id'] = $user[0]->id;
                $_SESSION['user-name'] = $user[0]->name;
                unset($_SESSION['login-admin']);
                $_SESSION['login-user'] = true;
            }
            
            $view = ($user[0]->rol_id == 1) ? 'administrador.php' : 'usuario.php'; 
            header("Location: " . $view );
        } else {
            $_SESSION['message-login'] = "Usuario o contraseña invalidas.";
            header("Location: index.php");
        }
        break;
    case 'logout':
            unset($_SESSION['login']);
            unset($_SESSION['login-admin']);
            unset($_SESSION['login-user']);
            header("Location: index.php");
            break;
    case 'save_space_user':
        $space = $_POST['space'];
        $parkingId = $_POST['parking-id'];
        $userId = $_SESSION['user-id'] ?? 1;
        if ($userId){
            $sql = $bd->prepare("UPDATE usuarios as u,parqueaderos as p SET u.parking_id = ?, p.user_id = ? where u.id = ? and p.id = ?");
            $reponse = $sql->execute([$parkingId, $userId, $userId, $parkingId]);
            
            if ($reponse){
                header("Location: usuario.php");
            }else {

            }
        
        }else {
            echo 'Error';
        }
        break;
    case 'update_availability':
        $parkingId = $_POST['parking-id'];

        if($parkingId){
            $updateParking = $bd->prepare("UPDATE parqueaderos as p, usuarios as u SET p.user_id = ?, u.parking_id = ? where p.id = ?");
            $reponse = $updateParking->execute([0, 0, $parkingId]);

            header("Location: usuario.php");
        }
        break;
    default:
        # code...
        break;
}

