<?php

    class ControladorCancion {

        /**
         * Muestra todas las canciones
         */
        public static function mostrarCanciones() {            
            VistaCancion::mostrarCanciones();
        }

        /**
         * Muestra las 10 canciones mas valoradas
         */
        public static function mostrarCancionesMasValoradas() {            
            VistaCancion::mostrarCancionesMasValoradas();
        }

        /**
         * Envia la valoracion junto con el token y se modifica en la BBDD
         */
        public static function valorarCancion($id, $valoracion) {
            require_once('vendor/autoload.php');

            $client = new GuzzleHttp\Client();

            $client->request('PUT', 'http://54.89.136.11:3000/api/song/' . $id, [
                'body' => '{ "rate" : "'.$valoracion.'" }',
                'headers' => [
                    'Content-Type' => 'application/json', 
                    'Authorization' => $_SESSION['token'] ]
            ]);

            // $response = $client->request('PUT', 'http://172.25.96.1:3000/api/song/' . $id, [
            //     'body' => '{ "rate" : "'.$valoracion.'" }',
            //     'headers' => [
            //         'Content-Type' => 'application/json', 
            //         'Authorization' => $_SESSION['token'] ]
            // ]);

            VistaCancion::mostrarCanciones();
        }

        /**
         * Envia la valoracion junto con el token y se modifica en la BBDD
         */
        public static function valorarCancionTop($id, $valoracion) {
            require_once('vendor/autoload.php');

            $client = new GuzzleHttp\Client();

            $client->request('PUT', 'http://54.89.136.11:3000/api/song/' . $id, [
                'body' => '{ "rate" : "'.$valoracion.'" }',
                'headers' => [
                    'Content-Type' => 'application/json', 
                    'Authorization' => $_SESSION['token'] ]
            ]);

            // $response = $client->request('PUT', 'http://172.25.96.1:3000/api/song/' . $id, [
            //     'body' => '{ "rate" : "'.$valoracion.'" }',
            //     'headers' => [
            //         'Content-Type' => 'application/json', 
            //         'Authorization' => $_SESSION['token'] ]
            // ]);

            VistaCancion::mostrarCancionesMasValoradas();
        }
        
    }

?>