<?php

/**
 * Importomos los archivos necesarios para la ejecución del programa.
 */
require_once('registro_usuario.php');
require_once('facturar_productos.php');

use semana_9\CarritoCompras as Carrito;
use semana_9\ValidadorUsuarios as Usuario;

/**
 * La función run será el punto de entrada al programa, donde se instanciaran
 * los objetos de las clases 'ValidadorUsuarios' y 'CarritoCompras' para llevar
 * a cabo la ejecución del programa.
 */

function run(): void
{
    $usuario = new Usuario('ejemplo#');
    $usuario->registrar_usuario();
    $carrito = new Carrito($usuario);
    $carrito_compras = $carrito->generar_carrito();
    $cantidad_total = $carrito->get_cantidad_articulos();
    echo $carrito->get_usuario() . PHP_EOL;
    echo "La cantidad de artículos en este carrito es: {$cantidad_total}." . PHP_EOL;
    echo 'Los artículos en carrito en esta iteración son:' . PHP_EOL;
    foreach ($carrito_compras as $articulo => $cantidad)
        echo "\t- {$articulo}: {$cantidad}" . PHP_EOL;

    $precios_por_cantidad = $carrito->calcular_precio_articulos($carrito_compras);
    echo 'Los precios de cada conjunto de artículos son:' . PHP_EOL;
    foreach ($precios_por_cantidad as $articulo => $precio) {
        $precio = number_format($precio, 2);
        echo "\t- {$articulo}: \${$precio}" . PHP_EOL;
    }

    $monto_total = $carrito->calcular_precio_total($precios_por_cantidad);
    $monto_total_f = number_format($monto_total, 2);
    echo "El monto total a pagar son \${$monto_total_f}." . PHP_EOL;
}

run();