<?php
    class ControladorLogin {

        /**
         * Muestra el formulario de login
         */
        public static function mostrarFormularioLogin() {
            VistaLogin::mostrarFormularioLogin("");
        }

        /**
         * Muestra si se produce un error en el formulario de login
         */
        public static function mostrarFormularioLoginError() {
            VistaLogin::mostrarFormularioLogin("Error de login, prueba otra vez");
        }

        /**
         * Comprueba si el email y la password existen, obtiene el token y lo mete en la sesion
         */
        public static function chequearLogin($email, $password) {

            // Lanzamos peticion a la API para comprobar usuario y obtener su token
            require_once('vendor/autoload.php');
            $client = new GuzzleHttp\Client();

            // AQUI HAY QUE CAMBIAR LA IP---------------------------------------------------------------


            $response = $client->request('POST', 'http://172.25.96.1:3000/api/login', [
            'body' => '{ "email" : "'.$email.'", "password" : "'.$password.'" }',
            'headers' => [ 'Content-Type' => 'application/json' ]
            ]);

            $responsePHP = json_decode($response->getBody(), true);

            // Si hay error de login, mostramos mensaje de error
            if ($responsePHP == "Email o password incorrectos") {
                echo "<script>window.location='enrutador.php?accion=error';</script>";
            // Si el login es correcto, metemos el token en la sesion
            } else {
                $_SESSION['token'] = $responsePHP;
                echo "<script>window.location='enrutador.php?accion=mostrarCanciones';</script>";
            }

        }

    }

?>