<?php

namespace semana_7;

// Constantes para validar largo establecido de caracteres para cada campo.
const LARGO_USUARIO_MAX = 10;
const LARGO_PASSWD_MIN  = 8;

function largo_usuario_valido(int $largo_username): bool
{
    return $largo_username <= LARGO_USUARIO_MAX;
}

function usuario_es_mayus(string $username): bool
{
    return preg_match('#^[[:upper:]].+$#', $username) ? true : false;
}

function largo_passwd_valido(int $largo_passwd): bool
{
    return $largo_passwd >= LARGO_PASSWD_MIN;
}

function passwd_es_minus(string $passwd): bool
{
    return preg_match('#^[[:lower:]].+$#', $passwd) ? true : false;
}

function usuario_valido(string $username): bool
{
    return (
        largo_usuario_valido(strlen($username))
        && usuario_es_mayus($username)
    );
}

function passwd_valido(string $passwd): bool
{
    return (
        largo_passwd_valido(strlen($passwd))
        && passwd_es_minus($passwd)
    );
}

function validar_usuario(string $username): void
{
    echo (
        usuario_valido($username)
        ? 'Nombre de usuario válido.' . PHP_EOL
        : 'Nombre de usuario inválido.' . PHP_EOL
    );
}

function validar_passwd(string $passwd): void
{
    echo (
        passwd_valido($passwd)
        ? 'Contraseña válida.' . PHP_EOL
        : 'Contraseña inválida.' . PHP_EOL
    );
}

/**
 * En este caso, la función 'run' toma los datos provenientes del formulario
 * 'form_acceso_personal', que envía los datos solicitados a través del método
 * HTTP POST, por lo que se debe usar la variable superglobal '_POST' de PHP
 * para acceder a los datos ingresados en el formulario. Luego dichos datos son
 * procesados por las funciones presentes en este archivo para validarlos.
 */
function run(): void
{
    validar_usuario($_POST['username']);
    validar_passwd($_POST['passwd']);
}

run();
