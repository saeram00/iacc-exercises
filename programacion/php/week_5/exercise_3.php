<?php

// Importamos el código del archivo 'ejercicio_1.php'.
require('exercise_1.php');

// Creamos un alias para no tener que escribir todo el espacio de nombres.
use semana_5\ejercicio_1 as ej1;

// Tipo enumerado que representa todos los días de la semana de forma
// compatible con uno de los formatos de los objetos 'DateTimeImmutable'.

enum DiaSemana: int
{
    case Lunes     = 1;
    case Martes    = 2;
    case Miercoles = 3;
    case Jueves    = 4;
    case Viernes   = 5;
    case Sabado    = 6;
    case Domingo   = 7;

    function nombre(): string
    {
        return match ($this) {
            DiaSemana::Lunes     => 'lunes',
            DiaSemana::Martes    => 'martes',
            DiaSemana::Miercoles => 'miércoles',
            DiaSemana::Jueves    => 'jueves',
            DiaSemana::Viernes   => 'viernes',
            DiaSemana::Sabado    => 'sábado',
            DiaSemana::Domingo   => 'domingo',
        };
    }
}

/* La siguiente función extrae el día de la semana correspondiente a cada
 * reserva en base al día numérico registrado en el objeto DateTimeImmutable
 * del campo 'fecha' de cada reservación, retornando un entero que representa
 * cada día de la semana compatible para comparar con los valores especificados
 * en el tipo enumerado 'DiaSemana'.
 */

function dia_semana_from_fecha(DateTimeImmutable $fecha): int
{
    return (int) $fecha->format('N');
}

/* Esta función permite filtrar el arreglo de reservaciones de forma que se
 * retorne un arreglo que solo tenga las reservas que cumplen con la condición
 * que su día de la semana coincida con el día específicado como segundo
 * argumento, el cual es uno de los valores admitidos por el tipo enumerado
 * DiaSemana.
 */

function reservas_dia_semana(array &$reservas, DiaSemana $dia_semana): array
{
    $resultado = [];
    foreach ($reservas as $reserva) {
        $dia_extraido = dia_semana_from_fecha($reserva['fecha']);
        if ($dia_semana->value === $dia_extraido)
            array_push($resultado, $reserva);
    }

    return $resultado;
}

/* La siguiente función permite determinar la cantidad de comensales que
 * han reservado para un día específico.
 */

function cantidad_comensales_dia(array &$reservas_dia): int
{
    $resultado = 0;
    foreach ($reservas_dia as $reserva)
        $resultado += $reserva['comensales'];

    return $resultado;
}

/* Esta función permite determinar la cantidad de comensales que han reservado
 * en un área específica del restaurant, sin tomar en cuenta si son reservas
 * del mismo día de la semana.
 */

function cantidad_comensales_area(array &$reservas, ej1\AreaReserva $area): int
{
    $resultado = 0;
    foreach ($reservas as $reserva)
        if ($area === $reserva['area'])
            $resultado += $reserva['comensales'];

    return $resultado;
}

/* Usamos el mismo arreglo del ejercicio 1 como base, agregando un par de
 * entradas más. Para los campos 'fecha', 'area' y 'menu_especial' es
 * necesario escribir el prefijo que indique que las estructuras base
 * se encuentran en el espacio de nombres del ejercicio 1.
 */

function run(): void
{
    $reservaciones = [
        [
            'nombre'        => 'Mauricio Peñas',
            'telefono'      => '9 2674 8180',
            'comensales'    => 2,
            'fecha'         => ej1\procesar_fecha('16-05-2025 19:40'),
            'area'          => ej1\AreaReserva::Salon,
            'menu_especial' => ej1\MenuEspecial::Aniversario,
        ],

        [
            'nombre'        => 'Daniela Soto',
            'telefono'      => '9 5818 1479',
            'comensales'    => 4,
            'fecha'         => ej1\procesar_fecha('20-05-2025 18:30'),
            'area'          => ej1\AreaReserva::Terraza,
            'menu_especial' => ej1\MenuEspecial::Cumpleanios,
        ],

        [
            'nombre'        => 'Gerardo Cienfuegos',
            'telefono'      => '9 7918 6379',
            'comensales'    => 3,
            'fecha'         => ej1\procesar_fecha('17-05-2025 13:00'),
            'area'          => ej1\AreaReserva::Comedor,
            'menu_especial' => ej1\MenuEspecial::Graduacion,
        ],

        [
            'nombre'        => 'Laura Henriquez',
            'telefono'      => '9 5477 1669',
            'comensales'    => 4,
            'fecha'         => ej1\procesar_fecha('20-05-2025 14:00'),
            'area'          => ej1\AreaReserva::Comedor,
            'menu_especial' => ej1\MenuEspecial::SinMenu,
        ],

        [
            'nombre'        => 'Julio Merino',
            'telefono'      => '9 4177 7619',
            'comensales'    => 2,
            'fecha'         => ej1\procesar_fecha('17-05-2025 20:15'),
            'area'          => ej1\AreaReserva::Salon,
            'menu_especial' => ej1\MenuEspecial::Aniversario,
        ],

        [
            'nombre'        => 'Alejandro Rivera',
            'telefono'      => '9 1914 4389',
            'comensales'    => 4,
            'fecha'         => ej1\procesar_fecha('16-05-2025 17:40'),
            'area'          => ej1\AreaReserva::Terraza,
            'menu_especial' => ej1\MenuEspecial::SinMenu,
        ],
    ];

    // Seleccionar reservaciones para cada día de la semana. Habría que
    // reemplazar el segundo argumento por el día que se desea revisar,
    // dentro de los valores admitidos por el tipo enumerado DiaSemana.
    $dia_buscado = DiaSemana::Martes;
    $ejemplo_reservas = reservas_dia_semana($reservaciones, $dia_buscado);
    $cantidad_reservas = count($ejemplo_reservas);

    // Mostrar las reservas del día en formato legible para humanos.
    print_r($ejemplo_reservas);

    // Mostrar cantidad de reservas para un día específicado.
    echo (
        "Para el día {$dia_buscado->nombre()} hay {$cantidad_reservas} " . (
            $cantidad_reservas === 1 ? 'reserva' : 'reservas'
        ) . '.' . PHP_EOL
    );

    // Mostrar cantidad de comensales para dicho día.
    $comensales_dia = cantidad_comensales_dia($ejemplo_reservas);
    echo "La cantidad de comensales para el día {$dia_buscado->nombre()} " . (
        $comensales_dia === 1 ? 'es' : 'son'
    ) . " {$comensales_dia}." . PHP_EOL;

    // Mostrar cantidad de comensales para cada área del restaurant.
    echo 'La cantidad de comensales por área son:' . PHP_EOL;
    foreach (ej1\AreaReserva::cases() as $area_buscada) {
        $comensales_area = cantidad_comensales_area(
            $reservaciones,
            $area_buscada
        );
        echo "\t- {$area_buscada->a_string()}: {$comensales_area}" . PHP_EOL;
    }
}

run();
