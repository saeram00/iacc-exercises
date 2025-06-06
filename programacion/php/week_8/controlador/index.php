<?php

/**
 * Este código corresponde a la implementación del Controlador del diseño MVC.
 * Se encarga de tomar las solicitudes provenientes de la Vista, y realizar
 * las operaciones solicitadas utilizando el Modelo para comunicarse con la
 * base de datos y completar las solicitudes.
 * 
 * En su mayoría, el flujo de ejecución de cada método se puede resumir en
 * instanciar un objeto de la clase Modelo, que contine dentro de sí una
 * conexión a la base de datos, y a través de esa conexión completar las
 * solicitudes provenientes de la Vista.
 */

require_once('modelo/index.php');

class ModeloControlador
{
    private $modelo;

    public function __construct()
    {
        $this->modelo = new Modelo();
    }

    // Mostrar.
    public function index(): void
    {
        $producto = new Modelo();
        $dato = $producto->mostrar('asistencia', '1');
        require_once('vista/index.php');
    }

    // Insertar.
    public function nuevo(): void
    {
        require_once('vista/nuevo.php');
    }

    public function guardar(): void
    {
        $nombre = $_REQUEST['nombre'];
        $asistencia = $_REQUEST['asistencia'];
        $data = "'{$nombre}', '{$asistencia}'";
        $empleado = new Modelo();
        $dato = $empleado->insertar('empleados', $data);
        header('location:' . URLSITE);
    }

    // Actualizar.
    public function editar(): void
    {
        $id = $_REQUEST['id'];
        $empleado = new Modelo();
        $dato = $empleado->mostrar('empleados', 'id=' . $id);
        require_once('vista/editar.php');
    }

    public function actualizar(): void
    {
        $id = $_REQUEST['id'];
        $nombre = $_REQUEST['nombre'];
        $asistencia = $_REQUEST['asistencia'];
        $data = "nombre='{$nombre}', asistencia='{$asistencia}'";
        $condicion = 'id=' . $id;
        $empleado = new Modelo();
        $dato = $empleado->actualizar('empleados', $data, $condicion);
        header('location:' . URLSITE);
    }

    // Eliminar.
    public function eliminar(): void
    {
        $id = $_REQUEST['id'];
        $condicion = 'id=' . $id;
        $empleado = new Modelo();
        $dato = $empleado->eliminar('empleados', $condicion);
        header('location:' . URLSITE);
    }
}
