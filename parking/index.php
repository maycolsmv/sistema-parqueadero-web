<?php session_start();?>
<!DOCTYPE HTML>
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <title>Login</title>
    
</head>
<body>
    
    <div class="container ">
        <div class="row mt-3">
        <div class="col-4"></div>
            <div class="col-4">
                <?php                
                if(isset($_SESSION['create']) || isset($_SESSION['create-admin'])): 
                    $message = isset($_SESSION['create']) ? $_SESSION['create'] : $_SESSION['create-admin'];
                    ?>
                    <div class="alert alert-success" id="alert-success" role="alert">
                        <?php
                    echo $message;                
                endif;
                ?>
                </div>
                <?php if(isset($_SESSION['message-login'])):?>
                    <div class="alert alert-danger" role="alert">
                        <?php 
                            echo $_SESSION['message-login'];
                        ?>
                    </div>
                <?php endif; ?>
                <h1><p class="text-center">Iniciar sesion</p></h1>
            
                <form action="access.php" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label" name="Usuario"><b>Usuario:</b></label>
                        <input type="text" class="form-control" id="exampleInputText" name="user" placeholder="Usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label"><b>Contraseña:</b></label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Contraseña" required>
                    </div>
                    <input type="hidden" name="action" value="login">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Ingresar</button>
                    </div>
                </form>
                <div class="text-center mt-3">                    
                    
                    <a href="registrar/crear_user.php">
                        <button type="button" class="btn btn-light">Crear Usuario</button> 
                    </a>
                    
                </div>
            </div>
        </div>
    </div>
    <script>
        setTimeout(function() {
            $('#alert-success').fadeOut();
        },3000);
    </script>
</body>