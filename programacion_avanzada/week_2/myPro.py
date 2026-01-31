from math import pi


def obtener_cantidad_licensias() -> int:
    print(
        "=" * 70,
        "Ingrese la cantidad de licensias a comprar:",
        "=" * 70,
        sep="\n",
    )
    cantidad_licensias: int = 0
    while cantidad_licensias < 1:
        try:
            cantidad_licensias = int(input("> "))
            if cantidad_licensias < 1:
                raise ValueError
        except ValueError:
            print("Debe ingresar un número entero mayor a 0.")
    else:
        return cantidad_licensias


def calcular_descuento(cantidad_licensias: int) -> float:
    PRECIO_BASE = 50

    if 1 <= cantidad_licensias < 3:
        return float(cantidad_licensias * PRECIO_BASE)
    elif 3 <= cantidad_licensias < 5:
        return float((PRECIO_BASE * 0.8) * cantidad_licensias)  # 20% de descuento.
    elif cantidad_licensias >= 5:
        return float((PRECIO_BASE * 0.7) * cantidad_licensias)  # 30% de descuento.


def obtener_radio_esfera() -> float:
    print(
        "=" * 70,
        "Ingrese el radio de la esfera:",
        "=" * 70,
        sep="\n",
    )
    radio: float = -1.0
    while radio < 0:
        try:
            radio = float(input("> "))
            if radio < 0:
                raise ValueError
        except ValueError:
            print("Debe ingresar un valor numérico mayor a 0.")
    else:
        return radio


def volumen_esfera(radio: float) -> float:
    return (4 / 3) * pi * (pow(radio, 3))


def opcion_usuario() -> int:
    print(
        "=" * 70,
        "Por favor, escoja una opción (1-3):",
        "1 -> Calcular el descuento de la compra de licensias de software.",
        "2 -> Calcular el volumen de una esfera.",
        "3 -> Salir.",
        "=" * 70,
        sep="\n",
    )
    opcion: int = 0
    while not 1 <= opcion <= 3:
        try:
            opcion = int(input("> "))
            if not 1 <= opcion <= 3:
                raise ValueError
        except ValueError:
            print("Debe ingresar un número entero entre 1 y 3.")
    else:
        return opcion


def main() -> None:
    while True:
        opcion = opcion_usuario()
        match opcion:
            case 1:
                cantidad_licensias = obtener_cantidad_licensias()
                precio_con_descuento = calcular_descuento(cantidad_licensias)
                print(
                    "El precio final de las licensias con los descuentos aplicados es:",
                    f"${precio_con_descuento:.2f}.",
                )
            case 2:
                radio = obtener_radio_esfera()
                volumen = volumen_esfera(radio)
                print(f"El volumen de la esfera de {radio=} es {volumen:.2f}.")
            case 3:
                print("Cerrando programa.")
                break


if __name__ == "__main__":
    main()
