<?php

namespace semana_8;

/**
 * Constantes para el manejo de la base de datos. Creé un nuevo usuario dentro
 * del servidor MySQL que solo tiene los permisos necesarios para realizar las
 * acciones requeridas por este programa como medida de seguridad básica, ya
 * que no es recomendado usar el usuario 'root'.
 */

const HOST = 'localhost';
const SQL_DB = 'asistencia';
const SQL_USER = 'amat';
const SQL_PASSWD = '';

// La URL base del sitio.
const URLSITE = 'http://localhost/registro/';
