<?php

    class PostBD {

        /**
         * Inserta un post en la base de datos
         */
        public static function insertPost($post) {
            $conexion = ConexionBD::conectar();

            // Hacer el autoincrement
            // Ordeno por id y me quedo con el mayor
            $postMayor = $conexion->posts->findOne(
                [],
                [
                    'sort' => ['id' => -1],
                ]);
            if (isset($postMayor))
                $idValue = $postMayor['id'];
            else
                $idValue = 0;


            // Colleccion posts
            $conexion->posts->insertOne([
                'id' => intVal($idValue + 1),
                'id_usuario' => $post->getId_usuario(),
                'titulo' => $post->getTitulo(),
                'imagen' => $post->getImagen(),
                'fecha' => $post->getFecha(),
                'texto' => $post->getTexto()
            ]);

            ConexionBD::cerrar();
        }


        /**
         * Devuelve de la base de datos todos los posts
         */
        public static function getPosts() {
            $conexion = ConexionBD::conectar();

            $coleccion = $conexion->posts;

            $cursor = $coleccion->find(
                [],
                [
                    'sort' => ['fecha' => -1],
                ]);

            // Crear los objetos para devolverlos (MVC), Mongo me devuelve array asociativo
            $posts = array();
            foreach($cursor as $post) {
               $post_OBJ = new Post($post['id_usuario'], $post['titulo'], $post['imagen'], $post['fecha'], $post['texto']);
               array_push($posts, $post_OBJ);
            }

            // Si no me devuelve nada no hay posts
            if ($cursor == null) {
                return 0;
            } else {
                // Hay posts
                ConexionBD::cerrar();
                return $posts;
            }
        }
    }

?>