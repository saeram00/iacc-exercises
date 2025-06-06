<?php

/**
 * En este caso, este es el archivo base el cual sirve como punto de partida
 * para el resto de la aplicación. Primero importa el código del archivo
 * 'config.php', donde se establecieron las constantes para comunicarse con
 * la base de datos y la ruta base de la aplicación. Luego se importa la clase
 * 'ModeloControlador', que es la que representa al Controlador del modelo MVC
 * y por lo tanto es la que se encarga de la comunciación entre el Modelo y la
 * Vista.
 * 
 * El código siguiente consulta el arreglo correspondiente al método HTTP GET,
 * para determinar qué acción tomar según la decisión del usuario.
 */

require_once('config.php');
require_once('controlador/index.php');

if (isset($_GET['m'])) {
    $metodo = $_GET['m'];
    if (method_exists(ModeloControlador, $metodo))
        ModeloControlador::{$metodo}();
} else
    ModeloControlador::index();
