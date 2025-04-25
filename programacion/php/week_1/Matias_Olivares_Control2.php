<?php
/* 1: Construye un ejemplo en PHP que distinga las variables escalares y compuestas. Utilice
 * comentarios para dar la explicación.
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

echo "Escalares se refiere a variables que solo tienen 1 valor determinado en un momento dado.\n";
foreach ($escalares as $key => $value)
    echo "{$key}: {$value}\n";
echo "\n";

echo "Las variables compuestas son aquellas que pueden contener más de un valor en un momento dado.\n";
foreach ($compuestas as $key => $value)
    echo "{$key}: {$value}\n";
echo "\n";

/* 2: Codifica en PHP para resolver la ecuación: A = 2(ab + ac + bc). Para ello, utilice valores
 *  para A, B, C a su criterio.
 */

$vars = array(
    "a" => random_int(0, 100),
    "b" => random_int(0, 100),
    "c" => random_int(0, 100),
);

echo "Para esta iteración:\n";
foreach ($vars as $key => $value)
    echo "{$key} = {$value}\n";

$result_2 = 2 * (($vars["a"] * $vars["b"]) + ($vars["a"] * $vars["c"]) + ($vars["b"] * $vars["c"]));
echo "2. El resultado de la ecuación 'A = 2(ab + bc + ac)' es: {$result_2}.\n";

/* 3: PHP maneja jerarquía y precedencia de los operadores, a través de la representación de
 * la ecuación de: x= -b + b^2 – a*c* (4*a+b) – a^2. Explica ¿cuál debe ser el manejo
 * adecuado de la jerarquía y precedencia? Codifica el ejercicio en PHP.
 */

$vars = array(
    "a" => random_int(0, 100),
    "b" => random_int(0, 100),
    "c" => random_int(0, 100),
);

echo "Para esta iteración:\n";
foreach ($vars as $key => $value)
    echo "{$key} = {$value}\n";

$result_3 = (-$vars["b"]) + ($vars["b"] ** 2) - ($vars["a"] * $vars["c"]) * ((4 * $vars["a"]) + $vars["b"]) - ($vars["a"] ** 2);

/* Para el caso presentado, se debe tener en cuenta que la precedencia de los
 * operadores aritméticos es la misma que en la aritmética ordinaria, es decir,
 * las operaciones siguen el orden determinado por la regla onomástica PAPOMUDAS,
 * que significa:
 * 1. PA = PAréntesis: primero se evalúan las operaciones que se encuentran
 *         entre paréntesis.
 * 2. PO = POtencias: después se evalúan las potencias presentes en la ecuación.
 * 3. MUD = MUltiplicación y División: seguido a eso, se evalúan las
 *         multiplicaciones y divisiones.
 * 4. AS = Adición y Sustracción: finalmente se evalúan las sumas y restas.
 * En el ejemplo anterior, utilicé paréntesis para ilustrar de forma explícita
 * la forma en que se evaluarían dichas expresiones, a pesar de que el
 * intérprete de PHP la interpretaría de esa forma automáticamente.
 */
echo "3. El resultado de la ecuación 'x = -b + b^2 - a*c*(4*a+b) - a^2' es: {$result_3}\n";
