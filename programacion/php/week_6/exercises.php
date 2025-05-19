<?php

namespace semana_6;

/* Para el caso propuesto por la empresa, las funciones integradas strtoupper
 * y strtolower son las más adecuadas, específicamente la función strtoupper
 * permite convertir cualquier cadena de texto a su equivalente con caracteres
 * en mayúsculas, por lo que será la usada para cumplir los requerimientos del
 * caso.
 */

function ejercicio_1(array &$nombres_usuarios): void
{
    echo 'Ejercicio 1: Uso de strtoupper.' . PHP_EOL;
    foreach ($nombres_usuarios as $nombre) {
        $nombre_mayus = strtoupper($nombre);
        echo "Nombre original: {$nombre}\nNombre procesado: {$nombre_mayus}" . PHP_EOL;
    }
}

/* Relativo al ejercicio 2, la siguiente función aplica las funciones
 * 'count_chars', 'substr' y 'strlen' a los nombres de usuario del arreglo
 * de entrada.
 */

function ejercicio_2(array &$nombres_usuarios): void
{
    foreach ($nombres_usuarios as $nombre) {
        echo "Ahora evaluando 'count_chars' y 'chr' en: \"{$nombre}\"" . PHP_EOL;
        foreach (count_chars($nombre, 1) as $i => $val)
            echo (
                "Había {$val} " . ($val === 1 ? 'instancia' : 'instancias')
                . ' de "' . chr($i) . '" en el nombre.' . PHP_EOL
            );
        echo "Ahora evaluando 'substr' en: \"{$nombre}\"" . PHP_EOL;
        $offset = 3;
        $largo_subcadena = 4;
        $subcadena = substr($nombre, $offset, $largo_subcadena);
        echo "Subcadena de largo {$largo_subcadena} desde la posición {$offset}: {$subcadena}" . PHP_EOL;
        echo "Ahora evaluando 'strlen' en: \"{$nombre}\"" . PHP_EOL;
        $largo_nombre = strlen($nombre);
        echo "Largo en caracteres de \"{$nombre}\": {$largo_nombre}" . PHP_EOL;
    }
}

/* La siguiente función sirve para ilustrar los usos de las funciones nativas
 * 'trim', 'ltrim' y 'rtrim'.
 */

function ejercicio_3(array &$nombres_usuarios): void
{
    foreach ($nombres_usuarios as $nombre) {
        $nuevo_nombre = '11111' . $nombre . '11111';
        $ltrim_ret = ltrim($nuevo_nombre, '1');
        $rtrim_ret = rtrim($nuevo_nombre, '1');
        $trim_ret = trim($nuevo_nombre, '1');
        echo "Resultado 'ltrim': {$ltrim_ret}" . PHP_EOL;
        echo "Resultado 'rtrim': {$rtrim_ret}" . PHP_EOL;
        echo "Resultado 'trim': {$trim_ret}" . PHP_EOL;
    }
}

function run(): void
{
    $nombre_usuarios_original = [
        'usuario_ejemplo',
        'miauricio',
        'gast24',
        'jupyter5',
        'Apollo11',
        'cachuPin601',
        'Terreneitor',
        'el_jetapartia69',
    ];

    ejercicio_1($nombre_usuarios_original);
    ejercicio_2($nombre_usuarios_original);
    ejercicio_3($nombre_usuarios_original);
}

run();
