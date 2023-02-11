<?php

    class VistaLogin {

        /**
         * Muestra el formulario de login y un mensaje si se le pasa
         */
        public static function mostrarFormularioLogin($mensaje) {

            include("./vistas/cabecera.php");

?>

            <nav class="nav border-bottom py-4 d-flex align-items-center">
                <div class="col-2">
                    <img src="./vistas/img/logo.png" alt="" width="120px" height="60px">
                </div>
                <div class="col-6 d-flex justify-content-center">   
                    <h3>TUS CANCIONES FAVORITAS</h3>
                </div>
            </nav>


            <div class='row mb-5'>
                <div class='col-4 mt-5 mx-auto'>
                    <h4>Acceso a la plataforma</h4>
                    <p class='text-danger'><?= $mensaje; ?></p>
                    <form action='enrutador.php' method='post'>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name='email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name='password' class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <input type='hidden' name='accion' value='checkLogin'>
                    <button type="submit" class="btn btn-outline-info">Acceder</button>
                    </form>
                </div>
            </div>

<?php

            include("./vistas/pie.php");
        }

    }

?>