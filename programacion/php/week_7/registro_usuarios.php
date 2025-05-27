<?php

namespace semana_7;

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

function run(): void
{
    $pacientes_bbdd = [];
    agregar_nuevo_paciente($pacientes_bbdd, $_POST);
    echo 'Paciente registrado con éxito.';
}

run();
