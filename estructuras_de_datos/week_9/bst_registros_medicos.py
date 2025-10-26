from dataclasses import dataclass
from datetime import datetime
from enum import auto, Enum, unique
from typing import Self

type Nodo = NodoArbol | None


class NodoArbol:
    """
    Esta clase representa un nodo dentro del árbol binario que
    contiene un registro de historal médico.

    Consta de tres campos o atributos:
    valor: RegistroMedico = Representa el tipo de datos que
    almacena el árbol. En este caso, se trata de una 'dataclass' interna
    compuesta por cuatro campos: 'paciente', 'medico', 'fecha_consulta'
    y 'motivo_consulta'.
    left: Nodo | None = Es la referencia al hijo izquierdo del nodo.
    Puede ser de tipo Nodo o None.
    right: Nodo | None = Es la referencia al hijo derecho del nodo.
    Puede ser de tipo Nodo o None.

    Se utiliza la sobrecarga de los operadores de relación
    (<, >, <=, >=) para comparar el campo 'valor' con el campo
    'valor' de otras instancias de la clase 'NodoArbol', para hacer
    comparaciones de forma directa, sin tener que acceder al atributo
    'valor' en cada comparación.

    En el caso de la dataclass 'RegistroMedico', al hacer comparaciones
    en base a este campo, las comparaciones se realizan por cada campo
    de la dataclass en el orden en el cual fueron declaradas al definir
    la clase interna, lo que significa que primero se comparan los
    campos 'paciente', seguido de 'medico', luego 'fecha_consulta' y
    finalmente 'motivo_consulta'.
    """

    @dataclass(order=True, kw_only=True)
    class RegistroMedico:
        """
        Los parámetros pasados al decorador 'dataclass' permiten
        modificar un poco el comportamiento de la clase. El parámetro
        'order' permite que se generen automáticamente funciones de
        sobrecarga de operadores para las operaciones de comparación
        (<, >, <=, >=), las cuales son usadas después por la clase
        contenedora 'NodoArbol' en sus propias sobrecargas de operadores
        de comparación. El parámtro 'kw_only' indica que los parámetros
        pasados a la función constructora (__init__) deben ser pasados
        obligatoriamente por nombre. En este caso se hace así para que
        la clase pueda ser instanciada a partir de diccionarios que
        contengan como clave los nombres de los campos, con sus valores
        siendo los valores deseados, incluso permitiendo el uso de
        '**kwargs' para la instaciación, facilitando mucho más el uso
        de la clase interna.
        """

        paciente: str
        medico: str
        fecha_consulta: datetime
        motivo_consulta: str

    def __init__(self, **valor) -> None:
        self.left: Nodo = None
        self.right: Nodo = None
        self.valor = self.RegistroMedico(**valor)

    def __str__(self) -> str:
        return "\n".join(
            (
                "\n",
                f"Nodo con valor: {self.valor}",
                (
                    f"Valor hijo izquierdo: {self.left.valor}"
                    if self.left
                    else "Sin hijo izquierdo."
                ),
                (
                    f"Valor hijo derecho: {self.right.valor}"
                    if self.right
                    else "Sin hijo derecho."
                ),
            )
        )

    def __gt__(self, other: Self) -> bool:
        return self.valor > other.valor

    def __lt__(self, other: Self) -> bool:
        return self.valor < other.valor

    def __ge__(self, other: Self) -> bool:
        return self > other or self.valor == other.valor

    def __le__(self, other: Self) -> bool:
        return self < other or self.valor == other.valor


class BSTRegistrosMedicos:
    """
    Clase que representa un árbol binario de registros médicos.

    Se compone de cero (0) o más elementos de tipo Nodo, los cuales
    están ordenados de forma que se crea un árbol binario de búsqueda
    (BST o 'Binary Search Tree'), donde los nodos a la izquierda del
    padre siempre serán menores a éste, y los nodos a la derecha siempre
    serán mayores.

    Implementa métodos para buscar registros dentro del árbol según el
    valor de los campos de la clase dentro de su atributo 'valor', para
    insertar nuevos nodos en el lugar correspondiente manteniendo el
    órden y la integridad de las referencias a los nodos hijos de los
    nodos existentes, para eliminar nodos según el valor los campos de
    la clase dentro de su atributo 'valor' también asegurándose de
    mantener la integridad de las referencias, y finalmente, métodos que
    sirven para recorrer e imprimir todos los nodos del árbol en tres
    formas de recorrido distintas: pre-orden (raíz, izquierda, derecha),
    inorden (izquierda, raíz, derecha) y post-orden (izquierda, derecha,
    raíz).
    """

    def __init__(self) -> None:
        self.raiz: Nodo = None

    def __buscar_interno(
        self, objetivo: NodoArbol.RegistroMedico, origen: Nodo
    ) -> NodoArbol | None:
        if origen is None or origen.valor == objetivo:
            return origen
        if objetivo < origen.valor:
            return self.__buscar_interno(objetivo=objetivo, origen=origen.left)
        return self.__buscar_interno(objetivo=objetivo, origen=origen.right)

    def buscar_registro(self, **objetivo) -> NodoArbol | None:
        """
        Este método llama al método interno '__buscar_interno', el cual
        busca el Nodo cuyo atributo 'valor' corresponda con el parámetro
        'objetivo' que se le pase, retornando el Nodo que lo contenga si
        este existe dentro del árbol, o None si no se encuentra.
        """

        objetivo = NodoArbol.RegistroMedico(**objetivo)
        return self.__buscar_interno(objetivo=objetivo, origen=self.raiz)

    def __insertar_interno(
        self, valor: NodoArbol.RegistroMedico, origen: NodoArbol
    ) -> None:
        if valor < origen.valor:
            if origen.left is None:
                origen.left = NodoArbol(valor=valor)
            else:
                self.__insertar_interno(valor=valor, origen=origen.left)
        elif valor > origen.valor:
            if origen.right is None:
                origen.right = NodoArbol(valor=valor)
            else:
                self.__insertar_interno(valor=valor, origen=origen.right)

    def insertar_registro(self, **valor) -> None:
        """
        Este método llama al método interno '__inserar_interno', el cual
        recorre de manera recursiva el árbol, buscando el lugar correcto
        donde crear un nuevo Nodo que contenga el valor que se desea
        agregar al árbol. El método se asegura de mantener tanto el
        órden de los nodos, como la integridad de las referencias a los
        nodos hijos.
        """

        if self.raiz is None:
            self.raiz = NodoArbol(valor=valor)
        else:
            valor = NodoArbol.RegistroMedico(**valor)
            self.__insertar_interno(valor=valor, origen=self.raiz)

    def __buscar_valor_minimo(self, nodo: NodoArbol) -> NodoArbol.RegistroMedico:
        actual: NodoArbol = nodo
        while actual.left:
            actual = actual.left
        return actual.valor

    def __eliminar_interno(
        self, valor: NodoArbol.RegistroMedico, origen: Nodo
    ) -> NodoArbol | None:
        if origen is None:
            return origen
        if valor < origen.valor:
            origen.left = self.__eliminar_interno(valor=valor, origen=origen.left)
        elif valor > origen.valor:
            origen.right = self.__eliminar_interno(valor=valor, origen=origen.right)
        else:
            if origen.left is None:
                return origen.right
            elif origen.right is None:
                return origen.left
            origen.valor = self.__buscar_valor_minimo(nodo=origen.right)
            origen.right = self.__eliminar_interno(
                valor=origen.valor, origen=origen.right
            )
            return origen

    def eliminar_registro(self, **valor) -> bool:
        """
        Este método llama a el método interno '__eliminar_interno',
        el cual busca de manera recursiva el nodo que contenga el valor
        pasado como argumento y lo elimina del árbol, reemplazandolo con
        su sucesor directo, es decir, el nodo con el siguiente valor más
        alto dentro del árbol.

        Si la operación de eliminación se completa con éxito, retorna
        True, y si no, retorna False.
        """

        valor = NodoArbol.RegistroMedico(**valor)
        self.raiz = self.__eliminar_interno(valor=valor, origen=self.raiz)
        return True if self.raiz else False

    def __recorrer_pre_orden(self, origen: Nodo) -> None:
        if origen:
            print(origen)
            self.__recorrer_pre_orden(origen=origen.left)
            self.__recorrer_pre_orden(origen=origen.right)

    def __recorrer_in_orden(self, origen: Nodo) -> None:
        if origen:
            self.__recorrer_in_orden(origen=origen.left)
            print(origen)
            self.__recorrer_in_orden(origen=origen.right)

    def __recorrer_post_orden(self, origen: Nodo) -> None:
        if origen:
            self.__recorrer_post_orden(origen=origen.left)
            self.__recorrer_post_orden(origen=origen.right)
            print(origen)

    @unique
    class ModoRecorrido(Enum):
        PRE_ORDEN = auto()
        IN_ORDEN = auto()
        POST_ORDEN = auto()

    def recorrer_arbol(self, modo: ModoRecorrido = ModoRecorrido.IN_ORDEN) -> None:
        match modo:
            case self.ModoRecorrido.PRE_ORDEN:
                self.__recorrer_pre_orden(self.raiz)
            case self.ModoRecorrido.IN_ORDEN:
                self.__recorrer_in_orden(self.raiz)
            case self.ModoRecorrido.POST_ORDEN:
                self.__recorrer_post_orden(self.raiz)
