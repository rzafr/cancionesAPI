<?php
    class UsuarioBD {

        /**
         * Comprueba en la base de datos que el usuario existe y su password es correcto
         */
        public static function chequearLogin($email, $password, &$usuarioOBJ) {
            $conexion = ConexionBD::conectar();
            
            $coleccion = $conexion->usuarios;

            $usuario = $coleccion->findOne(['email' => $email, 'password' => $password]);

            $usuarioOBJ = new Usuario($usuario['email'], $usuario['password']);
            $usuarioOBJ->setId($usuario['id']);

            // Si no me devuelve ninguna fila el password es incorrecto o el usuario no existe
            if ($usuario == null) {
                return 0;
            } else {
                // Usuario existe y password correcto 
                ConexionBD::cerrar();
                return 1;
            }
        }

    }

?>