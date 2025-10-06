from datetime import datetime
from enum import IntEnum, unique
from typing import ClassVar, Self


type Nodo = NodoTarea | None


@unique
class Prioridad(IntEnum):
    """
    Utilizamos un tipo enumerado para representar distintos grados
    de prioridad que pueden tomar las tareas, ya que serán valores
    constantes a los que todas las tareas pueden acceder y para fines
    de su ordenamiento es necesario realizar comparación entre éstas,
    motivo por el que se uso la sub-clase 'IntEnum', que permite la
    comparación con tipos numéricos enteros en caso de ser necesario
    eventualmente (en la implementación actual de este ejercicio no
    sería necesario en estricto rigor, pero esto lo asemeja a los
    tipos enumerados de otros lenguajes como C o Java).
    """

    BAJA = 0
    MEDIA = 1
    ALTA = 2
    CRITICA = 3

    def __str__(self) -> str:
        return f"{self.name}"


class NodoTarea:
    """
    Clase que representa cada tarea pendiente a realizar.

    Campos:
    titulo: El nombre de la tarea.
    requerimientos: Una lista con los requerimientos para cada tarea.
    prioridad: Un tipo enumerado que representa el grado de urgencia
    relativo de la tarea en cuestión.
    fecha_limite: Un objeto de tipo 'datetime' representando la fecha
    de entrega o término de plazo para la tarea.

    Dentro de la clase se utiliza la sobrecarga de operadores
    relacionales ('<', '<=', '>', '>=') de forma que los nodos puedan
    ser comparados unos a otros en base a los valores de sus
    respectivos campos 'prioridad' y 'fecha_limite', lo que representa
    un grado de urgencia relativo en base al cual poder ordenar los
    nodos dentro de una lista doblemente enlazada.
    """

    def __init__(
        self,
        titulo: str,
        requerimientos: list[str],
        prioridad: Prioridad,
        fecha_limite: datetime,
    ):
        self.titulo = titulo.lower()
        self.requerimientos = [req.lower() for req in requerimientos]
        self.__prioridad = prioridad
        self.__fecha_limite = fecha_limite
        self.siguiente: Nodo = None
        self.anterior: Nodo = None

    def __str__(self) -> str:
        return "\n".join(
            (
                "\n[",
                f"\tTarea: '{self.titulo.capitalize()}'",
                f"\tRequerimientos: '{' '.join(self.requerimientos)}'",
                f"\tPrioridad: '{self.__prioridad}'",
                f"\tFecha límite: '{self.__fecha_limite.strftime('%A, %x, %X')}'",
                "],",
            )
        )

    def __gt__(self, other: Self) -> bool:
        if self.__prioridad > other.__prioridad:
            return True
        elif self.__prioridad == other.__prioridad:
            return self.__fecha_limite < other.__fecha_limite
        return False

    def __lt__(self, other: Self) -> bool:
        if self.__prioridad < other.__prioridad:
            return True
        elif self.__prioridad == other.__prioridad:
            return self.__fecha_limite > other.__fecha_limite
        return False

    def __ge__(self, other: Self) -> bool:
        return self > other or (
            self.__prioridad == other.__prioridad
            and self.__fecha_limite == other.__fecha_limite
        )

    def __le__(self, other: Self) -> bool:
        return self < other or (
            self.__prioridad == other.__prioridad
            and self.__fecha_limite == other.__fecha_limite
        )


class ListaTareas:
    """
    Clase que implementa una lista doblemente enlazada para almacenar
    y ordenar tareas en función de su grado de urgencia.

    Cuenta con métodos para agregar, eliminar, ordenar y mostrar todas
    las tareas (nodos) de la lista.

    La función para ordenar se invoca automáticamente cada vez que se agrega
    una nueva tarea, de forma que la lista siempre se encuentre ordenada
    de forma descendiente de acuerdo al grado de urgencia de las tareas. Es
    decir, la tarea más urgente está al inicio y la menos urgente al final.
    """

    __CAPACIDAD_MAXIMA: ClassVar[int] = 10

    def __init__(self):
        self._inicio: Nodo = None
        self._fin: Nodo = None
        self.cantidad_nodos: int = 0

    def __str__(self) -> str:
        return "\n".join(
            (
                "\nListado de tareas",
                f"Más urgente: {self._inicio}",
                f"Pendientes: {self.cantidad_nodos}",
            )
        )

    def __lista_esta_llena(self) -> bool:
        return self.cantidad_nodos == self.__CAPACIDAD_MAXIMA

    def __lista_esta_vacia(self) -> bool:
        return self.cantidad_nodos == 0

    def __ordenar_lista(self) -> None:
        """
        Se ordena la lista de tareas en función de la urgencia de éstas, determinada
        por los valores de los campos 'prioridad' y 'fecha_limite' de cada una.
        Se utilizará el algoritmo de 'Insertion Sort', ya que funciona muy bien
        con este tipo de estructuras, siendo menos intenso en recursos aún si
        aumenta de tamaño.
        """

        if self.__lista_esta_vacia() or self._inicio.siguiente is None:
            # Si la lista está vacía, o solo tiene 1 nodo, no hay nada que ordenar.
            return

        actual: Nodo = self._inicio.siguiente
        while actual:  # Es lo mismo que 'while actual is not None'.
            siguiente: Nodo = actual.siguiente  # Se guarda la referencia ahora.
            mover: Nodo = actual.anterior
            # El nodo 'mover' servirá de referencia para ordenar.

            # Se desconecta el nodo actual de su posición para moverlo cuando sea necesario.
            if actual.anterior:
                actual.anterior.siguiente = actual.siguiente
            if actual.siguiente:
                actual.siguiente.anterior = actual.anterior
            else:
                # En caso de ser el último nodo, se actualiza el nodo final.
                self._fin = actual.anterior

            # Se busca la posición correcta recorriendo hacia atrás.
            while mover is not None and actual > mover:
                mover = mover.anterior

            # Al encontrar la posición correcta, se inserta el nodo actual
            # según corresponda.
            if mover is None:
                # Se inserta al inicio.
                actual.siguiente = self._inicio
                self._inicio.anterior = actual
                actual.anterior = None
                self._inicio = actual
            else:
                # Insertamos después de 'mover'.
                actual.siguiente = mover.siguiente
                if mover.siguiente:
                    mover.siguiente.anterior = actual
                else:
                    self._fin = actual  # Se inserta al final.
                mover.siguiente = actual
                actual.anterior = mover

            actual = siguiente  # Continúa el bucle.

    def agregar_tarea(self, nueva_tarea: NodoTarea) -> None:
        if self.__lista_esta_llena():
            print("Capacidad máxima de tareas almacenadas. No se pueden agregar más.")
            return

        if self._inicio is None:
            self._inicio = nueva_tarea
            self._fin = nueva_tarea
        else:
            nueva_tarea.anterior = self._fin
            self._fin.siguiente = nueva_tarea
            self._fin = nueva_tarea
        self.cantidad_nodos += 1
        self.__ordenar_lista()

    def eliminar_tarea(self, titulo: str) -> bool:
        if self.__lista_esta_vacia():
            print("No hay tareas actualmente. No se puede eliminar nada.")
            return False

        titulo = titulo.lower()
        actual: Nodo = self._inicio
        while actual:
            if actual.titulo == titulo:
                if actual.anterior is not None:
                    actual.anterior.siguiente = actual.siguiente
                else:
                    self._inicio = actual.siguiente

                if actual.siguiente is not None:
                    actual.siguiente.anterior = actual.anterior
                else:
                    self._fin = actual.anterior

                self.cantidad_nodos -= 1
                return True
            actual = actual.siguiente
        return False

    def mostrar_tareas(self) -> None:
        if self.__lista_esta_vacia():
            print("No hay tareas pendientes.")
            return

        print("Listado de tareas en órden descendiente según urgencia:")
        actual: Nodo = self._inicio
        while actual:
            print(actual)
            actual = actual.siguiente
