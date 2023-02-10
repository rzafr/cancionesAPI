<?php

    require_once './vendor/autoload.php';

    use MongoDB\Client;

    class ConexionBD {

        private static $conexion;

        /**
         * Conecta con la base de datos
         */
        public static function conectar($bd="posts") {
            
            try {
                //CONEXIÓN A MONGODB CLOUD ATLAS. Comentar esta línea para conectar en local.
                $host = "mongodb+srv://admin:GMqeq91lquHBgB91@cluster0.riicpti.mongodb.net/test";
                //$host = "mongodb://root:toor@mongo:27017/"; //MongoDB en Docker
                self::$conexion = (new Client($host))->{$bd};
            } catch (Exception $e){
                echo $e->getMessage();
            }

            return self::$conexion;
        }

        /**
         * Cierra la conexion con la base de datos
         */
        public static function cerrar() {
            self::$conexion = null;
        }


    }

?>