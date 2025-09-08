<?php 
    #incluye el header
    require 'includes/app.php';
    incluirTemplates('header');
    $db = conectarDB();

    $errores=[];
    $email = '';
    $password = '';
    if($_SERVER["REQUEST_METHOD"] === 'POST'){
        $email = mysqli_real_escape_string( $db, filter_var($_POST["email"], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string( $db, $_POST["password"]);
    }

    if( !$email ){
        $errores[]="Correo Electrónico no Valido";
    }
    if( !$password ){
        $errores[]="Contraseña no valida";
    }
    if( empty($errores) ){
        $query = "SELECT * FROM usuarios WHERE email = '{$email}';";
        $resultado = mysqli_query( $db, $query );
        if($resultado->num_rows){
            
            $usuario = mysqli_fetch_assoc( $resultado );
            $auth = password_verify( $password, $usuario["password"]);
            if( $auth ){
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['usuario'] = $usuario['email'];

                header('Location: /admin');
            }else{
                $email = $usuario["email"];
                $errores[] = "El password es incorrecto";
            }
        }else{
            $errores[] = "El email no existe";
        }
    }
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <?php foreach( $errores as $error):  ?>
            <div class="alerta error">
                <?php echo $error?>     
            </div>
        <?php endforeach; ?>
        <form method="POST" class="formulario" >
            <fieldset>
                <legend>E-mail y Password</legend>
                <label for="email">E-mail</label>
                <input type="email" placeholder="Tu Email" name="email" value="">

                <label for="password">Password</label>
                <input type="password" placeholder="Tu Password" name="password">
            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </main>
<?php 
    incluirTemplates('footer');
?>