<?php

    class Post {

        private $id;
        private $id_usuario;
        private $titulo;
        private $imagen;
        private $fecha;
        private $texto;

        /**
         * Constructor con todo menos el id
         */
        public function __construct($id_usuario="", $titulo="", $imagen="", $fecha="", $texto="") {
            $this->id_usuario = $id_usuario;
            $this->titulo = $titulo;
            $this->imagen = $imagen;
            $this->fecha = $fecha;
            $this->texto = $texto;
        }

        /**
         * Get the value of id
         */ 
        public function getId() {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id) {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of id_usuario
         */ 
        public function getId_usuario() {
                return $this->id_usuario;
        }

        /**
         * Set the value of id_usuario
         *
         * @return  self
         */ 
        public function setId_usuario($id_usuario) {
                $this->id_usuario = $id_usuario;

                return $this;
        }

        /**
         * Get the value of titulo
         */ 
        public function getTitulo() {
                return $this->titulo;
        }

        /**
         * Set the value of titulo
         *
         * @return  self
         */ 
        public function setTitulo($titulo) {
                $this->titulo = $titulo;

                return $this;
        }

        /**
         * Get the value of imagen
         */ 
        public function getImagen() {
                return $this->imagen;
        }

        /**
         * Set the value of imagen
         *
         * @return  self
         */ 
        public function setImagen($imagen) {
                $this->imagen = $imagen;

                return $this;
        }

        /**
         * Get the value of fecha
         */ 
        public function getFecha() {
                return $this->fecha;
        }

        /**
         * Set the value of fecha
         *
         * @return  self
         */ 
        public function setFecha($fecha) {
                $this->fecha = $fecha;

                return $this;
        }

        /**
         * Get the value of texto
         */ 
        public function getTexto() {
                return $this->texto;
        }

        /**
         * Set the value of texto
         *
         * @return  self
         */ 
        public function setTexto($texto) {
                $this->texto = $texto;

                return $this;
        }

    }

?>