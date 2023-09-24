<?php
session_start();
include 'config.php';
ini_set('error_reporting',0);

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php //nombre de la red social ?> Registro</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href=""><b>Facebook</b> 2</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Regístrate en Facebook 2</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="nombre" class="form-control" placeholder="Nombre completo" value="<?php echo $_POST['nombre']; ?>" required>
        <span class="glyphicon glyphicon-star form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" name="correo" class="form-control" placeholder="Email" value="<?php echo $_POST['correo']; ?>" required>  
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="usuario" class="form-control" placeholder="Usuario" value="<?php echo $_POST['usuario']; ?>" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="contrasena" class="form-control" placeholder="Contraseña" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="repcontrasena" class="form-control" placeholder="Confirme la contraseña" required>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-10">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="check" required> Acepto los <a href="#">términos y condiciones</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" name="registrar" class="btn btn-primary btn-block btn-flat">Registrarme</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <?php
      if(isset($_POST['registrar'])){
        $nombre = mysqli_real_escape_string($conexion,$_POST['nombre']);
        $correo = mysqli_real_escape_string($conexion,$_POST['correo']);
        $usuario = mysqli_real_escape_string($conexion,$_POST['usuario']);
        $contrasena = mysqli_real_escape_string($conexion,$_POST['contrasena']);
        $repcontrasena = mysqli_real_escape_string($conexion,$_POST['repcontrasena']);

        $comprobarusuario = mysqli_num_rows(mysqli_query($conexion, "SELECT nombre_de_usuario FROM user WHERE nombre_de_usuario = '$usuario'"));
        $comprobarcorreo = mysqli_num_rows(mysqli_query($conexion, "SELECT correo_electronico FROM user WHERE correo_electronico = '$correo'"));
        
        
        if($comprobarusuario >= 1) { ?>
        <br>
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            El nombre de usuario está en uso, por favor escoja otro
        </div>
        <?php
        } else{
          if($comprobarcorreo >= 1) { ?>
            <br>
            <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              El correo ya está en uso por favor escoja otro o verifique si tiene una cuenta
            </div>
            <?php
          } else{
            if($contrasena != $repcontrasena){?>
              <br>
              <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Las contraseñas no coinciden
              </div>
              <?php
            } else{
              $insertar = mysqli_query($conexion, "INSERT INTO user (nombre_completo, nombre_de_usuario, correo_electronico, contrasena, fecha_registro) VALUES ('$nombre','$usuario','$correo','$contrasena',NOW())");
            }
            if($insertar){?>
              <br>
              <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Se ha registrado correctamente
              </div>
              <?php
            }
          }
        }
      }
        
    ?>
    <br>
    <a href="login.php" class="text-center">Tengo actualmente una cuenta</a>
  </div>
</div>
<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>