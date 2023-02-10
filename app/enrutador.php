<?php session_start();

    // AUTOLOAD
    function autocarga($clase){ 
        $ruta = "./controladores/$clase.php"; 
        if (file_exists($ruta)){ 
          include_once $ruta; 
        }

        $ruta = "./modelos/$clase.php"; 
        if (file_exists($ruta)){ 
            include_once $ruta; 
        }

        $ruta = "./vistas/$clase.php"; 
        if (file_exists($ruta)){ 
            include_once $ruta; 
        }
    }

    spl_autoload_register("autocarga");


    // Funcion para filtrar los campos del formulario
    function filtrado($datos){
        $datos = trim($datos); // Elimina espacios antes y despues de los datos
        $datos = stripslashes($datos); // Elimina backslashes \
        $datos = htmlspecialchars($datos); // Traduce caracteres especiales en entidades HTML
        return $datos;
    }

    if ($_REQUEST) {
        if (isset($_REQUEST['accion'])) {

            // Inicio - formulacio login
            if ($_REQUEST['accion'] == "inicio") {
                ControladorLogin::mostrarFormularioLogin();
            }

            // CheckLogin
            if ($_REQUEST['accion'] == "checkLogin") {
                $email = filtrado($_REQUEST['email']);
                $password = filtrado($_REQUEST['password']);
                ControladorLogin::chequearLogin($email, $password);
            }

            // Inicio - error de login
            if ($_REQUEST['accion'] == "error") {
                ControladorLogin::mostrarFormularioLoginError();
            }

            // Cerrar sesion
            if ($_REQUEST['accion'] == "destruirSesion") {
                session_destroy();
                echo "<script>window.location='enrutador.php?accion=inicio'</script>";
            }
            
            // Mostrar canciones
            if ($_REQUEST['accion'] == "mostrarCanciones") {
                ControladorCancion::mostrarCanciones();
            }

            // Mostrar 10 canciones mas valoradas y ordenadas
            if ($_REQUEST['accion'] == "masValoradas") {
                ControladorCancion::mostrarCancionesMasValoradas();
            }

        }

        // Valorar canciones
        if (isset($_REQUEST['valoracion'])) {
            $id = filtrado($_REQUEST['id']);
            if (isset($_REQUEST['valor'])) {
                $valoracion = filtrado($_REQUEST['valor']);
                ControladorCancion::valorarCancion($id, $valoracion);
            } else {
                ControladorCancion::mostrarCanciones();
            }
        }

        // Valorar canciones mas valoradas
        if (isset($_REQUEST['valoracionTop'])) {
            $id = filtrado($_REQUEST['id']);
            if (isset($_REQUEST['valor'])) {
                $valoracion = filtrado($_REQUEST['valor']);
                ControladorCancion::valorarCancionTop($id, $valoracion);
            } else {
                ControladorCancion::mostrarCancionesMasValoradas();
            }
        }

    }

?>