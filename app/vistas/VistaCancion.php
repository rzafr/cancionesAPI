<?php

    class VistaCancion {

        /**
         * Muestra todas las canciones
         */
        public static function mostrarCanciones() {

            include("./vistas/cabecera.php");

?>

            <nav class="nav border-bottom mb-5 py-4 d-flex justify-content-center align-items-center">
                <div class="col-2">
                    <a href="enrutador.php?accion=mostrarCanciones" class="nav-link">
                        <img src="./vistas/img/logo.png" alt="" width="120px" height="60px">
                    </a>
                </div>
                <div class="col-6 d-flex justify-content-center">   
                    <h3>TUS CANCIONES FAVORITAS</h3>
                </div>
                <div class="col-2">
                    <a href="enrutador.php?accion=masValoradas" class="nav-link">Mas valoradas</a>
                </div>
                <div class="col-2">
                    <a href="enrutador.php?accion=destruirSesion" class="nav-link">Cerrar sesion</a>
                </div>
            </nav>

<?php

            // Llamamos a la API para mostrar todas las canciones

            require_once('vendor/autoload.php');

            $client = new GuzzleHttp\Client();

            $response = $client->request('GET', 'http://54.89.136.11:3000/api/song', [
            'headers' => [ 'Authorization' => $_SESSION['token'] ]
            ]);

            $canciones = json_decode($response->getBody());

            echo '<div class="row">';
                echo '<div class="col  mb-3 d-flex justify-content-center">';
                    echo '<h3>Listado completo</h3>';
                echo "</div>";
            echo "</div>";

            echo '<div class="row">';
            echo '<div class="col">';
                echo "<table class='table table-hover'>";
                echo "<thead>";
                    echo "<tr>";
                        echo "<th>Titulo</th>
                            <th>Grupo</th>
                            <th>Duracion</th>
                            <th>Year</th>
                            <th>Genero</th>
                            <th>Valoracion</th>
                            <th colspan='2'></th>";
                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                    foreach($canciones as $cancion) {
                        echo "<tr>";
                            echo "<td>".$cancion->title."</td>
                                <td>".$cancion->performer."</td>
                                <td>".$cancion->duration." seg</td>
                                <td>".$cancion->year."</td>
                                <td>".$cancion->genre."</td>
                                <td>".$cancion->rate."</td>
                                <td>
                                    <form action='enrutador.php' method='post'>";
                                    echo "<p class='clasificacion'>
                                            <input id='".$cancion->_id."1' type='radio' name='valor' value='5'>
                                            <label for='".$cancion->_id."1'>★</label>
                                            <input id='".$cancion->_id."2' type='radio' name='valor' value='4'>
                                            <label for='".$cancion->_id."2'>★</label>
                                            <input id='".$cancion->_id."3' type='radio' name='valor' value='3'>
                                            <label for='".$cancion->_id."3'>★</label>
                                            <input id='".$cancion->_id."4' type='radio' name='valor' value='2'>
                                            <label for='".$cancion->_id."4'>★</label>
                                            <input id='".$cancion->_id."5' type='radio' name='valor' value='1'>
                                            <label for='".$cancion->_id."5'>★</label>
                                        </p>";
                                echo "</td>
                                <td>
                                    <input type='hidden' name='id' value='".$cancion->_id."'>
                                    <input type='submit' name='valoracion' value='Valorar' class='form-control btn btn-outline-info'>
                                    </form>
                                </td>";
                        echo "</tr>";

                    }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
                echo "</div>";

            include("./vistas/pie.php");
            
        }


        /**
         * Muestra las 10 canciones mas valoradas y ordenadas
         */
        public static function mostrarCancionesMasValoradas() {

            include("./vistas/cabecera.php");

?>

            <nav class="nav border-bottom mb-5 py-4 d-flex justify-content-center align-items-center">
                <div class="col-2">
                    <a href="enrutador.php?accion=mostrarCanciones" class="nav-link">
                        <img src="./vistas/img/logo.png" alt="" width="120px" height="60px">
                    </a>
                </div>
                <div class="col-6 d-flex justify-content-center">   
                    <h3>TUS CANCIONES FAVORITAS</h3>
                </div>
                <div class="col-1">
                    
                </div>
                <div class="col-1">
                    <a href="enrutador.php?accion=mostrarCanciones" class="nav-link">Inicio</a>
                </div>
                <div class="col-2">
                    <a href="enrutador.php?accion=destruirSesion" class="nav-link">Cerrar sesion</a>
                </div>
            </nav>

<?php

            // Llamamos a la API para mostrar las 10 canciones mas valoradas y ordenadas

            require_once('vendor/autoload.php');

            $client = new GuzzleHttp\Client();

            $response = $client->request('GET', 'http://54.89.136.11:3000/api/song/ranking/toprated', [
            'headers' => [ 'Authorization' => $_SESSION['token'] ]
            ]);

            $canciones = json_decode($response->getBody());

            echo '<div class="row">';
                echo '<div class="col  mb-3 d-flex justify-content-center">';
                    echo '<h3>Las mas valoradas</h3>';
                echo "</div>";
            echo "</div>";

            echo '<div class="row">';
            echo '<div class="col">';
                echo "<table class='table table-hover'>";
                echo "<thead>";
                    echo "<tr>";
                        echo "<th>Top</th>
                            <th>Titulo</th>
                            <th>Grupo</th>
                            <th>Duracion</th>
                            <th>Year</th>
                            <th>Genero</th>
                            <th>Valoracion</th>
                            <th colspan='2'></th>";
                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                    foreach($canciones as $key => $cancion) {
                        echo "<tr>";
                            echo "<td>".($key + 1)."</td>
                                <td>".$cancion->title."</td>
                                <td>".$cancion->performer."</td>
                                <td>".$cancion->duration." seg</td>
                                <td>".$cancion->year."</td>
                                <td>".$cancion->genre."</td>
                                <td>".$cancion->rate."</td>
                                <td>
                                    <form action='enrutador.php' method='post'>";
                                    echo "<p class='clasificacion'>
                                            <input id='".$cancion->_id."1' type='radio' name='valor' value='5'>
                                            <label for='".$cancion->_id."1'>★</label>
                                            <input id='".$cancion->_id."2' type='radio' name='valor' value='4'>
                                            <label for='".$cancion->_id."2'>★</label>
                                            <input id='".$cancion->_id."3' type='radio' name='valor' value='3'>
                                            <label for='".$cancion->_id."3'>★</label>
                                            <input id='".$cancion->_id."4' type='radio' name='valor' value='2'>
                                            <label for='".$cancion->_id."4'>★</label>
                                            <input id='".$cancion->_id."5' type='radio' name='valor' value='1'>
                                            <label for='".$cancion->_id."5'>★</label>
                                        </p>";
                                echo "</td>
                                <td>
                                    <input type='hidden' name='id' value='".$cancion->_id."'>
                                    <input type='submit' name='valoracionTop' value='Valorar' class='form-control btn btn-outline-info'>
                                    </form>
                                </td>";
                        echo "</tr>";

                    }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
                echo "</div>";

            include("./vistas/pie.php");
            
        }

    }

?>
