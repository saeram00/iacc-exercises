<?php

namespace ejercicio_2;

// Definimos las longitudes mínimas y máximas como constantes.
const NOMBRE_LONG_MIN = 6;
const NOMBRE_LONG_MAX = 10;
const PASSWD_LONG_MAX = 8;

/* Esta función compara el número que se le pasa como argumento, que
 * corresponde al largo de la cadena de nombre de usuario, con las constantes
 * NOMBRE_LONG_MAX y NOMBRE_LONG_MIN, retornando un booleano que indica si
 * dicho número se encuentra entre ambos valores (de forma inclusiva).
 */

function nombre_usuario_largo_valido(int $largo_nombre_usuario): bool
{
    return (
        (NOMBRE_LONG_MIN <= $largo_nombre_usuario)
        && ($largo_nombre_usuario <= NOMBRE_LONG_MAX)
    );
}

// Lo mismo que la función anterior, pero para el largo de la contraseña,
// usando la constante PASSWD_LONG_MAX en su lugar.

function passwd_largo_valido(int $largo_passwd): bool
{
    return $largo_passwd <= PASSWD_LONG_MAX;
}

/* Esta función intenta validar que el nombre de usuario comienza con una
 * letra a través de expresiones regulares.
 */

function nombre_usuario_inicia_letra(string $nombre_usuario): bool
{
    return preg_match('#^[[:alpha:]].+#', $nombre_usuario) ? true : false;
}

/* Esta función intenta validar que el nombre de usuario termine con una
 * letra a través de expresiones regulares.
 */

function nombre_usuario_termina_letra(string $nombre_usuario): bool
{
    return preg_match('#.+[[:alpha:]]$#', $nombre_usuario) ? true : false;
}

/* Esta función determina si el nombre de usuario contiene algún caracter
 * numérico.
 */

function nombre_usuario_contiene_numero(string $nombre_usuario): bool
{
    return strpbrk($nombre_usuario, '0123456789') ? true : false;
}

/* Esta función determina si la contraseña comienza con una letra mayúscula
 * a través de expresiones regulares.
 */

function passwd_inicia_mayus(string $passwd): bool
{
    return preg_match('#^[[:upper:]].+#', $passwd) ? true : false;
}

/* La siguiente función evalúa si la contraseña contiene alguno de los
 * siguientes caracteres especiales: #$%&.
 */

function passwd_contiene_especial(string $passwd): bool
{
    return strpbrk($passwd, '#$%&') ? true : false;
}

/* Esta función evalúa el nombre de usuario usando las funciones anteriores
 * correspondientes, retornando un booleano en base a las condiciones
 * cumplidas.
 */

function nombre_usuario_valido(string $nombre_usuario): bool
{
    return (
        nombre_usuario_inicia_letra($nombre_usuario)
        && nombre_usuario_termina_letra($nombre_usuario)
        && nombre_usuario_largo_valido(strlen($nombre_usuario))
        && nombre_usuario_contiene_numero($nombre_usuario)
    );
}

/* Esta función evalúa si la contraseña de usuario es válida utilizando
 * las funciones anteriores correspondientes, retornando un booleano en
 * base a las condiciones cumplidas.
 */

function passwd_valida(string $passwd): bool
{
    return (
        passwd_inicia_mayus($passwd)
        && passwd_largo_valido(strlen($passwd))
        && passwd_contiene_especial($passwd)
    );
}

// Función para mostrar en consola si el nombre de usuario es válido.

function validar_nombre_usuario(string $nombre_usuario): void
{
    echo (
        nombre_usuario_valido($nombre_usuario)
        ? 'Nombre de usuario válido.' . PHP_EOL
        : 'Nombre de usuario inválido.' . PHP_EOL
    );
}

// Función para mostrar en consola si la contraseña es válida.

function validar_passwd(string $passwd): void
{
    echo (
        passwd_valida($passwd)
        ? 'Contraseña válida.' . PHP_EOL
        : 'Contraseña inválida.' . PHP_EOL
    );
}

// Función principal, sirve como punto de entrada y llama a todas las otras
// funciones.

function run(): void
{
    $usuario_valido = 'ejemplo1a';
    $passwd_valida = 'Secure#';

    validar_nombre_usuario($usuario_valido);
    validar_passwd($passwd_valida);

    $usuario_invalido = '3samuxx';
    $passwd_invalida = 'buena_passwd_lol';

    validar_nombre_usuario($usuario_invalido);
    validar_passwd($passwd_invalida);
}

run();
