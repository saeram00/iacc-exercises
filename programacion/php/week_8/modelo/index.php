<?php

/**
 * El código correspondiente al Modelo de la arquitectura MVC. Este código
 * hace uso del paradigma de Programación Orientada a Objetos para
 * representar el objeto Modelo. Esta clase implementa un método constructor
 * que inicializa instancias del modelo, y métodos para realizar las
 * operaciones SQL básicas en la base de datos MySQL, que son:
 *  - Insertar
 *  - Mostrar
 *  - Actualizar
 *  - Eliminar
 */

use mysqli;

use semana_8 as s8;

class Modelo
{
    private $Modelo;
    private $db;

    /**
     * El método constructor de la clase Modelo, encargado de inicializar
     * objetos de esta clase. No toma argumentos, y crea una conexión a la
     * base de datos a través de la extensión 'mysqli' de PHP, utilizando
     * las constantes definidas en el archivo 'config.php'.
     */
    public function __construct()
    {
        $this->Modelo = [];
        $this->db = @new mysqli(s8\HOST, s8\SQL_USER, s8\SQL_PASSWD, s8\SQL_DB);
    }

    /**
     * El método 'insertar' se encarga de enviar la instrucción 'INSERT' a la
     * base de datos, para ingresar nuevos datos a la base de datos, sea de
     * asistencia o de un empleado nuevo, dependiendo de la tabla en la que se
     * desee insertar pasada como primer argumento, siendo el segundo argumento
     * los datos en cuestión a ser insertados.
     * Retorna un valor booleano correspondiente a si la operación se llevó a
     * cabo con éxito o no.
     */
    public function insertar(string $tabla, string $data): bool
    {
        $consulta = "INSERT INTO {$tabla} VALUES (null, {$data});";
        $resultado = $this->db->query($consulta);
        return ($resultado) ? true : false;
    }

    /**
     * El método 'mostrar' se encarga de las operaciones 'SELECT' de la base
     * de datos, tomando como primer argumento la tabla de donde se quiere
     * buscar información, y como segundo argumento una condición que sirve
     * como filtro.
     * Retorna un arreglo con la información solicitada.
     */
    public function mostrar(string $tabla, string $condicion): array
    {
        $consulta = "SELECT * FROM {$tabla} WHERE {$condicion};";
        $resultado = $this->db->query($consulta);
        while ($fila = $resultado->fetch_assoc())
            $this->personas[] = $fila;
        return $this->personas;
    }

    /**
     * El método 'actualizar' permite modificar registros dentro de la tabla
     * seleccionada como primer argumento a través del comando SQL 'UPDATE'.
     * El segundo argumento corresponde al valor del registro de la tabla que
     * será modificado, mientras que el tercer argumento corresponde a una
     * condición para escoger los registros exactos que serán modificados.
     * Retorna un valor booleano correspondiente a si la operación se llevó a
     * cabo con éxito o no.
     */
    public function actualizar(string $tabla, string $data, string $condicion): bool
    {
        $consulta = "UPDATE {$tabla} SET {$data} WHERE {$condicion};";
        $resultado = $this->db->query($consulta);
        return ($resultado) ? true : false;
    }

    /**
     * El método 'eliminar' se encarga de las operaciones de borrado dentro de
     * las tablas de la base de datos a través de la instrucción 'DELETE' de
     * SQL. Toma como primer argumento la tabla donde se encuentra el registro
     * que se desea eliminar, y como segundo argumento una condición que sirve
     * como filtro para eliminar solo los registros precisos.
     * Retorna un valor booleano correspondiente a si la operación se llevó a
     * cabo con éxito o no.
     */
    public function eliminar(string $tabla, string $condicion): bool
    {
        $eliminar = "DELETE FROM {$tabla} WHERE {$condicion};";
        $resultado = $this->db->query($eliminar);
        return ($resultado) ? true : false;
    }
}