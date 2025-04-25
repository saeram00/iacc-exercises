#!/usr/bin/env python3
# 4. Con ayuda de la lógica del ejercicio 3 examina, ¿Cuál será la definición de variables,
# constantes y operadores matemáticos equivalentes en el lenguaje Python?
from random import randint


def main() -> None:
    variables: dict[str, int] = {letter: randint(0, 100) for letter in "abc"}

    print("En esta iteración:")
    for k, v in variables.items():
        print(f"{k} = {v}")

    result_4: int = (
        (-variables["b"])
        + (variables["b"] ** 2)
        - (variables["a"] * variables["c"]) * ((4 * variables["a"]) + variables["b"])
        - (variables["a"] ** 2)
    )

    print(
        f"4. El resultado de la ecuación 'x = -b + b^2 - a*c*(4*a+b) - a^2' es: {result_4:,}"
    )


if __name__ == "__main__":
    main()
