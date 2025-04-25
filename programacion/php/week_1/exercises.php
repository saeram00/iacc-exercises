<?php
/* Inicializamos arreglos tipo hashmap (arreglo asociativo) donde la llave
 *  es el tipo de variable, y el valor es la definición del tipo en cuestión,
 *  para luego pasar estos arreglos a PHP para mostrarlos como contenido
 *  insertado dentro de HTML.
 */

// Escalares se refiere a variables que solo tienen 1 valor determinado en un momento dado.
$escalares = array(
    "Enteros" => "Números sin parte decimal con signo, es decir, positivos o negativos.",
    "Floats" => "Números con parte decimal con signo, es decir, positivos o negativos.",
    "Cadenas" => "Secuencias de caracteres que forman palabras en cualquier lenguaje.",
    "Booleanos" => "Representación de dos estados de verdad de una proposición: verdadero (true) o falso (false) son sus únicos valores posibles.",
);

// Las variables compuestas son aquellas que pueden contener más de un valor en un momento dado.
$compuestas = array(
    "Arrays (Arreglos)" => "Representa un conjunto de elementos contiguos en memoria que tienen algún tipo de asociación. En lenguajes de bajo nivel todos sus elementos suelen ser del mismo tipo.",
    "Object" => "Representa una instancia de una clase. Es la base de la POO, y pueden ser usados para representar cualquier elemento que el desarrollador necesite.",
    "Callable (Invocable)" => "Representa objetos que pueden ser invocados para ejecutar código, en otras palabras, funciones o métodos si se trata de funciones dentro de una clase.",
    "Iterable" => "Representa un objeto sobre el que puede iterarse, es decir, objetos que al ser sometidos a bucles, retornan elementos de si por cada iteración del bucle.",
);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semana 1 - IACC</title>
</head>

<body>
    <header>
        <a href="../index.php"><button type="button">Back to index</button></a>
    </header>

    <label>Variables escalares (simples):</label>
    <p>Escalares se refiere a variables que solo tienen 1 valor determinado en un momento dado.</p>
    <ul>
        <?php foreach ($escalares as $key => $value): ?>
            <li><?= "{$key}: {$value}"; ?></li>
        <?php endforeach; ?>
    </ul>

    <label>Variables compuestas:</label>
    <p>Las variables compuestas son aquellas que pueden contener más de un valor en un momento dado.</p>
    <ul>
        <?php foreach ($compuestas as $key => $value): ?>
            <li><?= "{$key}: {$value}"; ?></li>
        <?php endforeach; ?>
    </ul>
</body>

</html>