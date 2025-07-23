<?php

namespace semana_9;

/**
 * La siguiente clase representa un objeto validador de usuarios, el cual solo
 * necesita ser instanciado una vez, ya que el mismo objeto será utilizado cada
 * vez que se vaya a registrar un usuario nuevo, llevando a cabo todas las
 * operaciones de validación con sus propios métodos internos.
 */

class ValidadorUsuarios
{

    // Definimos como constante el largo válido de los nombres de usuario.
    private const USUARIO_LARGO_VALIDO = 8;

    /**
     * Se define un arreglo que contiene a todos los usuarios registrados, el
     * cual se actualizará con cada usuario válido nuevo. Se utiliza la palabra
     * reservada 'static' para que dicho arreglo sea almacenado en la memoria
     * 'stack', y para que solo haya una copia de dicho arreglo en memoria, el
     * cual será compartido por todas las instancias de esta clase a lo largo
     * del programa.
     * 
     * Iniciará vacío, pero a medida que se agreguen usuarios, irá incrementando
     * su tamaño, independiente de cuantas instancias de la clase sean creadas.
     */

    private static array $usuarios_registrados = [];

    /**
     * Se define una propiedad que corresponde al nombre de usuario que se
     * evaluará.
     */

    private string $nuevo_usuario;

    /**
     * El constructor de la clase. Toma como argumento una cadena que
     * corresponde a el nombre del nuevo usuario que se desea registrar.
     */

    public function __construct(string $nombre)
    {
        $this->nuevo_usuario = $nombre;
    }

    /**
     * El método '__toString' es una sobrecarga de este método mágico, que se
     * usa para representar las instancias de esta clase como objetos de tipo
     * cadena cuando por ejemplo son usados con 'echo' o 'print', sin necesidad
     * de llamar al método 'getter'.
     */

    public function __toString(): string
    {
        return $this->nuevo_usuario;
    }

    /**
     * Se definen los métodos 'getter' y 'setter' de la propiedad
     * 'nuevo_usuario', de forma que se pueda obtener el usuario que se está
     * validando actualmente y cambiarlo para validar a otro usuario sin
     * necesidad de instanciar un nuevo objeto de esta clase.
     */

    public function get_nuevo_usuario(): string
    {
        return $this->nuevo_usuario;
    }

    public function set_nuevo_usuario(string $nombre): void
    {
        if (usuario_existe($nombre))
            echo "Ya existe un usuario con nombre: '{$nombre}'." . PHP_EOL;
        else
            $this->nuevo_usuario = $nombre;
    }

    /**
     * El siguiente método verifica si el nombre de usuario ingresado como
     * argumento ya existe en el arreglo indexado de nombres de usuario, retornando
     * un valor booleano si se cumple dicha condición.
     */

    private function usuario_existe(string $username): bool
    {
        return in_array($username, self::$usuarios_registrados);
    }

    /**
     * Método para evaluar el largo del nombre de usuario. Toma como argumento
     * un entero correspondiente al largo en caracteres del nombre de usuario,
     * y retorna un booleano indicando si cumple el largo válido.
     */

    private function largo_usuario_valido(int $username): bool
    {
        return $username === self::USUARIO_LARGO_VALIDO;
    }

    /**
     * El siguiente método evalúa si el nombre de usuario inicia con un caracter
     * en minúscula, tomando como argumento la cadena de nombre de usuario, y
     * retornado un booleano indicando si se cumple la condición.
     */

    private function usuario_inicia_minus(string $username): bool
    {
        return preg_match('#^[[:lower:]].+#', $username) ? true : false;
    }

    /**
     * El siguiente método evalúa si el nombre de usuario finaliza con un caracter
     * especial, tomando como argumento la cadena de nombre de usuario, y retornado
     * un booleano indicando si se cumple la condición.
     */

    private function usuario_finaliza_esp(string $username): bool
    {
        return preg_match('#.+[[:punct:]]$#', $username) ? true : false;
    }

    /**
     * El siguiente método evalúa el nombre de usuario ingresado utilizando las
     * funciones anteriores para evaluar si se cumplen todas las condiciones.
     */

    private function usuario_valido(string $username): bool
    {
        return (
            ! self::usuario_existe($username)
            && self::largo_usuario_valido(strlen($username))
            && self::usuario_inicia_minus($username)
            && self::usuario_finaliza_esp($username)
        );
    }

    /**
     * El siguiente método valida el nombre de usuario nuevo, y de pasar las
     * pruebas, es agregado al arreglo 'usuarios_registrados'.
     */

    public function registrar_usuario(): void
    {
        $usuario = $this->get_nuevo_usuario();
        if (self::usuario_valido($usuario)) {
            array_push(self::$usuarios_registrados, $usuario);
            echo "Se ha agregado el usuario nuevo: {$usuario}." . PHP_EOL;
        } else
            echo "El nombre de usuario: '{$usuario}' es inválido." . PHP_EOL;
    }

    /**
     * El siguiente método retorna la cantidad de usuarios válidos que han
     * sido registrados por objetos de esta clase.
     */

    public function total_usuarios_registrados(): int
    {
        return count(self::$usuarios_registrados);
    }

}