def factorial_recursivo(numero: int) -> int:
    if numero == 1 or numero == 0:
        return 1
    elif numero >= 2:
        return numero * factorial_recursivo(numero - 1)


def main() -> None:
    numero = int(input("Ingrese el número de que desea conocer el factorial:\n> "))
    factorial = factorial_recursivo(numero)
    print(f"{factorial=}")


if __name__ == "__main__":
    main()
