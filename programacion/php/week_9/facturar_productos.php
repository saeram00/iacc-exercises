<?php

namespace semana_9;

/**
 * Importamos el archivo que contiene la clase 'ValidadorUsuarios', para luego
 * crear un alias a la clase para que sea de más fácil acceso.
 */
require_once('registro_usuario.php');

use semana_9\ValidadorUsuarios as Usuario;

/**
 * Para representar las categorías de productos, se utilizará un tipo
 * enumerado, respaldado por enteros.
 */

enum Categoria: int
{
    case Fruta   = 0;
    case Verdura = 1;
    case Carne   = 2;
    case Lacteo  = 3;
    case Bebida  = 4;

    public function a_cadena(): string
    {
        return match ($this) {
            static::Fruta   => 'fruta',
            static::Verdura => 'verdura',
            static::Carne   => 'carne',
            static::Lacteo  => 'lácteo',
            static::Bebida  => 'bebida',
        };
    }
}

/**
 * La siguiente clase corresponde a un objeto 'carrito de compras', el cual
 * está asociado a un usuario específico, y permite calcular el valor total de
 * la compra de hasta 10 artículos, tomando en cuenta el precio unitario de
 * cada uno.
 */

class CarritoCompras
{

    /**
     * Para organizar el código, utilizaremos un arreglo asociativo como hash
     * table entre el nombre del artículo que estará asociado a otro arreglo
     * asociativo que contenga como primer elemento el precio unitario del
     * artículo y como segundo elemento la categoría a la que pertenece,
     * representado por un tipo enumerado 'Categoria'.
     * Cabe decir que los artículos presentados aquí son solo ilustrativos,
     * para comprobar la funcionalidad del programa. Para optimizar el
     * rendimiento, dicho arreglo será definido como una constante, por lo que
     * será compartido por todas las instancias de esta clase.
     */

    private const PRECIOS_UNITARIOS = [
        'tomate'    => ['precio' => 5, 'categoría' => Categoria::Fruta],
        'manzana'   => ['precio' => 2, 'categoría' => Categoria::Fruta],
        'lechuga'   => ['precio' => 6, 'categoría' => Categoria::Verdura],
        'zanahoria' => ['precio' => 5, 'categoría' => Categoria::Verdura],
        'vacuno'    => ['precio' => 8, 'categoría' => Categoria::Carne],
        'piña'      => ['precio' => 8, 'categoría' => Categoria::Fruta],
        'pollo'     => ['precio' => 6, 'categoría' => Categoria::Carne],
        'leche'     => ['precio' => 2, 'categoría' => Categoria::Lacteo],
        'yoghurt'   => ['precio' => 3, 'categoría' => Categoria::Lacteo],
        'coca-cola' => ['precio' => 5, 'categoría' => Categoria::Bebida],
        'fanta'     => ['precio' => 4, 'categoría' => Categoria::Bebida],
        'cerdo'     => ['precio' => 5, 'categoría' => Categoria::Carne],
    ];

    /**
     * Constante que representa la cantidad máxima de artículos permitidos
     * en un carrito. Al ser constante, será compartida por tadas las instancias
     * de esta clase.
     */
    private const MAX_ARTICULOS = 10;

    /**
     * El usuario al cual será asociada cada instancia de 'CarritoCompras'.
     * Al no ser declarado como constante ni 'static', cada carrito tendrá su
     * propio usuario asociado. El modificador 'readonly' establece que la
     * propiedad no podrá ser editada una vez inicializada la propiedad.
     */
    private readonly Usuario $usuario;

    /**
     * Esta propiedad almacena la cantidad de artículos totales presentes en
     * el carrito de compras como variable de solo lectura.
     */
    private readonly int $cantidad_articulos;

    /**
     * El método constructor tomará como argumento una instancia de la clase
     * 'ValidadorUsuarios' (alias 'Usuario'), la cuál será asignada a la
     * propiedad 'usuario' de la clase 'CarritoCompras'.
     */

    public function __construct(Usuario $cliente)
    {
        $this->usuario = $cliente;
    }

    // Se crea el método 'getter' para la propiedad 'usuario'.

    public function get_usuario(): string
    {
        return "Dueño del carrito: {$this->usuario}";
    }

    // Se crea el método 'getter' para la propiedad 'cantidad_articulos'.

    public function get_cantidad_articulos(): int
    {
        return $this->cantidad_articulos;
    }

    /**
     * Método para calcular el precio de cada conjunto de artículos.
     * Toma como argumento un arreglo donde las llaves son los artículos en
     * cuestión, y los valores la cantidad de esos artículos que se llevan.
     * Retorna otro arreglo donde las llaves son los artículos y los valores
     * son el precio unitario multiplicado por la cantidad especificada en el
     * arreglo de entrada.
     */

    public function calcular_precio_articulos(array $cantidad_articulos): array
    {
        $precios_segun_cantidad = [];
        foreach ($cantidad_articulos as $articulo => $cantidad)
            array_push(
                $precios_segun_cantidad,
                (self::PRECIOS_UNITARIOS[$articulo]['precio'] * $cantidad)
            );

        return array_combine(
            array_keys($cantidad_articulos),
            $precios_segun_cantidad
        );
    }

    /**
     * Método que calcula el precio total de la compra. Toma como argumentos
     * un arreglo donde las llaves son los artículos, y sus valores son los
     * precios por cantidad más impuestos. El valor retornado será redondeado
     * al segundo decimal hacia arriba.
     */

    public function calcular_precio_total(array $precios_por_cantidad): float
    {
        return round(
            array_sum(array_values($precios_por_cantidad)),
            2,
            PHP_ROUND_HALF_UP
        );
    }

    /**
     * Creamos un método que genere un arreglo con un carrito de compras
     * ficticio y aleatorio para cada ejecución del programa, solo para probar
     * la funcionalidad. El arreglo será un arreglo asociativo cuyas llaves
     * serán creadas en base a un arreglo de entrada, cuyo valor por defecto
     * será la constante PRECIOS_UNITARIOS, usando solo un número aleatorio
     * de elementos de dicho arreglo, y los valores serán números aleatorios
     * creados con la función random_int, a fin de simular un carro de compras
     * para hacer cálculos. Se tendrá en cuenta el límite de artículos
     * establecido de 10 artículos por carrito.
     */

    public function generar_carrito(array $inventario = self::PRECIOS_UNITARIOS): array
    {
        // Creamos un grupo aleatorio de artículos.
        $carro_articulos = array_rand(
            $inventario,
            random_int(1, count($inventario) / 2)
        );

        // Si solo se escoge un artículo, será de tipo string. En dicho caso
        // se convierte a arreglo.
        if (is_string($carro_articulos))
            $carro_articulos = array($carro_articulos);

        // Convertimos a arreglo asociativo con cantidades pseudo-aleatorias
        // de artículos, teniendo en cuenta el límite de la constante
        // 'MAX_ARTICULOS'.
        $carro_articulos = array_flip($carro_articulos);
        do {
            foreach (array_keys($carro_articulos) as $key)
                $carro_articulos[$key] = random_int(1, count($carro_articulos));
        } while (array_sum(array_values($carro_articulos)) > self::MAX_ARTICULOS);

        $this->cantidad_articulos = array_sum(array_values($carro_articulos));

        return $carro_articulos;
    }

}