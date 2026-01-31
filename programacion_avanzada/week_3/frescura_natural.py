import sys


class Inventario:
    def __init__(self, existencias: dict[str, int]) -> None:
        self._frutas: int = existencias["frutas"]
        self._verduras: int = existencias["verduras"]

    @property
    def frutas(self) -> int:
        "Cantidad de frutas disponibles."
        return self._frutas

    @frutas.setter
    def frutas(self, cantidad: int) -> None:
        if cantidad < 0:
            raise ValueError("La cantidad no puede ser negativa.")
        self._frutas = cantidad

    @property
    def verduras(self) -> int:
        "Cantidad de verduras disponibles."
        return self._verduras

    @verduras.setter
    def verduras(self, cantidad: int) -> None:
        if cantidad < 0:
            raise ValueError("La cantidad no puede ser negativa.")
        self._verduras = cantidad

    def registrar_ventas(self, ventas: dict[str, int]) -> None:
        if ventas["frutas"] > self.frutas or ventas["verduras"] > self.verduras:
            raise ValueError(
                "La cantidad vendida no puede ser mayor a la cantidad en inventario."
            )
        self.frutas -= ventas["frutas"]
        self.verduras -= ventas["verduras"]


def consultar_existencias() -> dict[str, int]:
    print("Ingrese la cantidad de frutas y verduras en inventario.")
    existencias: dict[str, int] = dict.fromkeys(("frutas", "verduras"), 0)
    while True:
        try:
            existencias["frutas"] = int(input("Frutas: "))
            existencias["verduras"] = int(input("Verduras: "))
            # Verificar que ninguno de los valores ingresados sea menor a 0.
            if any(val for val in existencias.values() if val < 0):
                raise ValueError("Cantidad ingresada es menor que 0.")
        except ValueError as ve:
            print(
                f"Error con la cantidad ingresada: {ve}",
                "Ingrese un número entero positivo o 0.",
                file=sys.stderr,
            )
        else:
            return existencias


def consultar_ventas() -> dict[str, int]:
    print("Ingrese la cantidad de frutas y verduras vendidos durante el día.")
    ventas: dict[str, int] = dict.fromkeys(("frutas", "verduras"), 0)
    while True:
        try:
            ventas["frutas"] = int(input("Frutas: "))
            ventas["verduras"] = int(input("Verduras: "))
            # Verificar que ninguno de los valores ingresados sea menor a 0.
            if any(val for val in ventas.values() if val < 0):
                raise ValueError("Cantidad ingresada es menor que 0.")
        except ValueError as ve:
            print(
                f"Error con la cantidad ingresada: {ve}",
                "Ingrese un número entero positivo o 0.",
                file=sys.stderr,
            )
        else:
            return ventas


def main() -> None:
    try:
        existencias = consultar_existencias()
        inventario = Inventario(existencias)
        ventas = consultar_ventas()
        while True:
            try:
                inventario.registrar_ventas(ventas)
            except ValueError as ve:
                print(f"Error encontrado al registrar venta: {ve}", file=sys.stderr)
                ventas = consultar_ventas()
            else:
                print(
                    "La cantidad de frutas y verduras en inventario al finalizar el día es:",
                    f"Frutas: {inventario.frutas}",
                    f"Verduras: {inventario.verduras}",
                    sep="\n",
                )
                break
    except KeyboardInterrupt:
        print("\n", "Programa cancelado.", sep="", file=sys.stderr)
        sys.exit(1)
    else:
        print("Programa finalizado.")
        sys.exit()


if __name__ == "__main__":
    main()
