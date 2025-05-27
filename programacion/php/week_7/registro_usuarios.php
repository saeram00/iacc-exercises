<?php

namespace semana_7;

/**
 * Esta función simplemente simula la acción de ingresar los datos de paciente
 * ingresados por el formulario correspondiente a una base de datos ficticia.
 * En este caso, solo agrega los datos en forma de arreglo asociativo a un
 * arreglo indexado general. Los datos son tomados desde la función 'run'.
 */
function agregar_nuevo_paciente(array &$bbdd, array $datos): void
{
    $datos_pacientes = [
        'nombre'          => $datos['nombre'],
        'apellido'        => $datos['apellido'],
        'rut'             => $datos['rut'],
        'sexo'            => $datos['sexo'],
        'direccion'       => $datos['direccion'],
        'telefono'        => $datos['telefono'],
        'correo'          => $datos['correo'],
        'motivo_consulta' => $datos['consulta'],
    ];

    array_push($bbdd, $datos_pacientes);
}

/**
 * En este caso, los datos necesarios para registrar un paciente nuevo son
 * tomados desde el formulario 'form_registro_pacientes', que tiene múltiples
 * campos determinados para cada dato necesario. Luego, estos datos son
 * registrados a través de la variable superglobal '_POST' de PHP, que contiene
 * todos los datos enviados desde el formulario a través del método POST de
 * HTTP en forma de un arreglo asociativo donde las llaves son el atributo
 * 'name' de las etiquetas 'input' del formulario, para su fácil identificación
 * y acceso.
 */
function run(): void
{
    $pacientes_bbdd = [];
    agregar_nuevo_paciente($pacientes_bbdd, $_POST);
    echo 'Paciente registrado con éxito.';
}

run();
