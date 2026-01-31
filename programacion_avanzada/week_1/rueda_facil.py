from random import randint


def generar_carritos_aleatorios(cantidad_clientes: int) -> list[int]:
    return [randint(1, 15) for _ in range(cantidad_clientes)]


def calcular_precio_ccompra(cantidad: int) -> int:
    MENOR, MEDIO, MAYOR = 35, 40, 45

    if cantidad <= 0:
        return -1

    if 0 < cantidad < 5:
        return cantidad * MENOR * 1_000
    elif 5 <= cantidad <= 10:
        return cantidad * MEDIO * 1_000
    elif cantidad > 10:
        return cantidad * MAYOR * 1_000


def main() -> None:
    cantidad_clientes = int(input("Ingrese la cantidad de clientes:\n> "))
    compras_dia = generar_carritos_aleatorios(cantidad_clientes)
    print(f"Carritos de compra registrados durante el día: {compras_dia}.")
    valor_carrito = tuple(calcular_precio_ccompra(compra) for compra in compras_dia)
    print(f"El monto total de cada carrito registrado es: {valor_carrito}.")
    ganancias_dia = sum(valor_carrito)
    print(f"La ganancia total del día fueron ${ganancias_dia:,}.")


if __name__ == "__main__":
    main()
