<?php
// Usamos un espacio de nombres para compartimentalizar.
namespace ejercicio_1 {

    /* Para organizar el código, utilizaremos un arreglo asociativo como hashmap
     * entre el nombre del artículo y el precio unitario. Cabe decir que los
     * artículos presentados aquí son solo ilustrativos, para comprobar la
     * funcionalidad del programa. Para optimizar el rendimiento, dicho arreglo
     * será definido como una constante.
     */

    const PRECIOS_UNITARIOS_USD = array(
        "taladro"   => 50,
        "martillo"  => 20,
        "lavadora"  => 65,
        "secadora"  => 60,
        "cocina"    => 80,
        "laptop"    => 300,
        "telefono"  => 600,
        "computadora"   => 1000,
        "playstation"   => 800,
        "comida_perro"  => 30,
        "comida_gato"   => 25,
    );

    /* Definimos el monto mínimo para aplicar descuento como una constante,
     * al igual que el porcentaje del descuento (20%) y el porcentaje de
     * impuestos agregado a cada artículo (15%).
     */

    const MINIMO_DESCUENTO  = 200;
    const PORC_DESCUENTO    = 0.8;
    const PORC_IMPUESTO     = 1.15;

    /* Función para calcular el precio de cada conjunto de artículos, con
     * impuestos. Toma como argumento un arreglo donde las llaves son los
     * artículos en cuestión, y los valores la cantidad de esos artículos
     * que se llevan. Retorna otro arreglo donde las llaves son los artículos
     * y los valores son el precio unitario multiplicado por el porcentaje de
     * impuestos PORC_IMPUESTO y multiplicado por la cantidad especificada en
     * el arreglo de entrada.
     */

    function calcular_precio_articulos(array $cantidad_articulos): array
    {
        $precios_segun_cantidad = array();
        foreach ($cantidad_articulos as $articulo => $cantidad)
            array_push(
                $precios_segun_cantidad,
                (PRECIOS_UNITARIOS_USD[$articulo] * PORC_IMPUESTO) * $cantidad
            );

        return array_combine(
            array_keys($cantidad_articulos),
            $precios_segun_cantidad
        );
    }

    /* Función que calcula el precio total de la compra, sin descuentos. Toma
     * como argumentos un arreglo donde las llaves son los artículos, y sus
     * valores son los precios por cantidad más impuestos. El valor retornado
     * será redondeado al segundo decimal hacia arriba.
     */

    function calcular_precio_total(array $precios_por_cantidad): float
    {
        return round(
            array_sum(array_values($precios_por_cantidad)),
            2,
            PHP_ROUND_HALF_UP
        );
    }

    /* Determina si el valor final de la compra amerita descuento. Toma como
     * argumento el valor total, y retorna un booleano que indica si se
     * aplica descuento o no.
     */

    function requiere_descuento(float $total_venta): bool
    {
        return $total_venta > MINIMO_DESCUENTO;
    }

    /* Función que aplica el descuento necesario. Toma como argumento el total
     * de la venta, y le multiplica el porcentaje de descuento. Al ser el
     * parámetro "total_venta" un parámetro por referencia, se modifica el
     * valor del parámetro mismo, ya que se modifica el valor almacenado en
     * esa dirección de memoria, por lo que no se necesita retornar nada.
     */

    function aplicar_descuento(float &$total_venta): void
    {
        $total_venta = round($total_venta * PORC_DESCUENTO, 2, PHP_ROUND_HALF_UP);
    }

    /* Creamos una función que genere un arreglo con un carrito de compras
     * ficticio y aleatorio para cada ejecución del programa, solo para probar
     * la funcionalidad. El arreglo será un arreglo asociativo cuyas llaves
     * serán creadas en base a un arreglo de entrada, cuyo valor por defecto
     * será la constante PRECIOS_UNITARIOS_USD, usando solo un número aleatorio
     * de elementos de dicho arreglo, y los valores serán números aleatorios
     * creados con la función random_int, a fin de simular un carro de compras
     * para hacer cálculos.
     */

    function generar_carrito(array $inventario = PRECIOS_UNITARIOS_USD): array
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
        // de artículos.
        $carro_articulos = array_flip($carro_articulos);
        foreach (array_keys($carro_articulos) as $key)
            $carro_articulos[$key] = random_int(1, count($carro_articulos));

        return $carro_articulos;
    }

    // La función main será el punto de entrada del programa, aún si PHP no
    // lo necesita realmente.
    function main(): void
    {
        $carrito_compras = generar_carrito();
        echo "Los artículos en carrito en esta iteración son:\n";
        foreach ($carrito_compras as $articulo => $cantidad)
            echo "\t- {$articulo}: {$cantidad}\n";

        $precios_por_cantidad = calcular_precio_articulos($carrito_compras);
        echo "Los precios de cada conjunto de artículos son:\n";
        foreach ($precios_por_cantidad as $articulo => $precio)
            echo "\t- {$articulo}: \${$precio}\n";

        $monto_final = calcular_precio_total($precios_por_cantidad);
        $mensaje_descuento = "El monto total son \${$monto_final}. ";
        if (requiere_descuento($monto_final)) {
            echo $mensaje_descuento . "Se aplica descuento (20%).\n";
            aplicar_descuento($monto_final);
        } else
            echo $mensaje_descuento . "No se aplica descuento.\n";

        echo "El monto final a pagar son \${$monto_final}.\n";
    }

    main();
}
