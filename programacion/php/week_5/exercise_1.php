<?php

namespace semana_5\ejercicio_1;

// Para especificar el tipo de retorno de una función definida por mi.
use DateTimeImmutable;

// Considerando que el restaurant se encuentra en Barranquilla, Colombia,
// se configura dicha zona horaria para el resto del programa en formato IANA.
date_default_timezone_set('America/Bogota');

// Para mantener consistencia, se usará un formato de fechas constante a lo
// largo del programa. El formato usado será 'día-mes-año hora:minutos'.
const FORMATO_FECHA_RESERVA = '!d-m-Y G:i';

/* Para representar las diferentes áreas del restaurant, usaré un tipo
 * enumerado con tres valores constantes como sus miembros. Será de un tipo
 * enumerado respaldado, es decir, cada caso del tipo enumerado se puede
 * correlacionar con un valor del tipo especificado, en este caso, un entero.
 * Esto permite que su serialización y deserialización sea mucho más simple
 * cuando se traspase el arreglo de reservas hacia o desde una base de datos,
 * sea relacional (SQL) o no relacional (NoSQL).
 */

enum AreaReserva: int
{
    case Comedor = 0;
    case Salon   = 1;
    case Terraza = 2;
}

/* Se hace lo mismo con los menús especiales, un tipo enumerado respaldado en
 * un tipo entero, por las mismas razones que el tipo enumerado de las
 * reservas.
 */

enum MenuEspecial: int
{
    case SinMenu     = 0;
    case Aniversario = 1;
    case Boda        = 2;
    case Cumpleanios = 3;
    case Graduacion  = 4;
}

/* Creo una función para procesar las fechas de reserva según el formato
 * constante definido anteriormente, creando un objeto de la clase
 * DateTimeImmutable para manejar mejor operaciones de fechas.
 */

function procesar_fecha(string $fecha): DateTimeImmutable | false
{
    return date_create_immutable_from_format(FORMATO_FECHA_RESERVA, $fecha);
}

/* Las reservaciones necesitan los campos:
 *  - nombre
 *  - teléfono
 *  - cantidad de comensales
 *  - fecha y hora de la reserva
 *  - área de reserva
 *  - menú especial
 * Se puede lograr con arreglos multidimensionales, tanto indexados como
 * asociativos, pero para que se vea más ordenado y sea más intuitivo iterarlo,
 * usaré para estos ejercicios una mezcla de ambos, haciendo en el nivel
 * exterior un arreglo indexado, donde cada índice corresponderá a una reserva
 * distinta, y dicho índice apuntará a su propio arreglo asociativo, donde cada
 * llave será uno de los campos necesarios por la reservación, y su valor será
 * el valor que corresponda según la llave (en PHP, en realidad, todos los
 * arreglos son asociativos, al ser implementaciones de un mapeo ordenado, pero
 * queda al programador decidir si los usará como indexados o asociativos, tipo
 * diccionario).
 * 
 * Para efectos de este ejercicio, se llenará el arreglo con valores
 * inventados.
 */

// Usar '[]' es una abreviación del constructor 'Array()'.
$reservaciones = [
    [
        'nombre'        => 'Mauricio Peñas',
        'telefono'      => '9 2674 8180',
        'comensales'    => 2,
        'fecha'         => procesar_fecha('16-05-2025 19:40'),
        'area'          => AreaReserva::Salon,
        'menu_especial' => MenuEspecial::Aniversario,
    ],

    [
        'nombre'        => 'Daniela Soto',
        'telefono'      => '9 5818 1479',
        'comensales'    => 4,
        'fecha'         => procesar_fecha('20-05-2025 18:30'),
        'area'          => AreaReserva::Terraza,
        'menu_especial' => MenuEspecial::Cumpleanios,
    ],

    [
        'nombre'        => 'Gerardo Cienfuegos',
        'telefono'      => '9 7918 6379',
        'comensales'    => 3,
        'fecha'         => procesar_fecha('17-05-2025 13:00'),
        'area'          => AreaReserva::Comedor,
        'menu_especial' => MenuEspecial::Graduacion,
    ],
];
