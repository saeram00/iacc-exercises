from enum import auto, Enum, unique

type Nodo = NodoArbol | None


class NodoArbol:
    """
    Esta clase representa un nodo dentro del árbol binario.

    Consta de tres campos o atributos:
    valor: int = Representa el tipo de datos que almacena el árbol.
    Puede ser de cualquier tipo, pero en este caso, se utiliza un tipo
    entero.
    left: Nodo | None = Es la referencia al hijo izquierdo del nodo.
    Puede ser de tipo Nodo o None.
    right: Nodo | None = Es la referencia al hijo derecho del nodo.
    Puede ser de tipo Nodo o None.

    Se utiliza la sobrecarga de los operadores de relación
    (<, >, <=, >=) para comparar el campo valor con otros datos de tipo
    entero, para hacer comparaciones de forma directa, sin tener que
    acceder al atributo valor en cada comparación.
    """

    def __init__(self, valor: int) -> None:
        self.valor: int = valor
        self.left: Nodo = None
        self.right: Nodo = None

    def __str__(self) -> str:
        return "\n".join(
            (
                "\n",
                f"Nodo con valor: {self.valor}",
                f"Valor hijo izquierdo: {self.left.valor}"
                if self.left
                else "Sin hijo izquierdo.",
                f"Valor hijo derecho: {self.right.valor}"
                if self.right
                else "Sin hijo derecho.",
            )
        )

    def __gt__(self, other: int) -> bool:
        return self.valor > other

    def __lt__(self, other: int) -> bool:
        return self.valor < other

    def __ge__(self, other: int) -> bool:
        return self > other or self.valor == other

    def __le__(self, other: int) -> bool:
        return self < other or self.valor == other


class ArbolBinarioRuta:
    """
    Clase que representa un árbol binario.

    Se compone de cero (0) o más elementos de tipo Nodo, los cuales
    están ordenados de forma que se crea un árbol binario de búsqueda
    (BST o 'Binary Search Tree'), donde los nodos a la izquierda del
    padre siempre serán menores a éste, y los nodos a la derecha siempre
    serán mayores.

    Implementa métodos para buscar elementos dentro del árbol según el
    valor de su atributo 'valor', para insertar nuevos nodos en el
    lugar correspondiente manteniendo el órden y la integridad de las
    referencias a los nodos hijos de los nodos existentes, para eliminar
    nodos según el valor del atributo 'valor' también asegurándose de
    mantener la integridad de las referencias, y finalmente, métodos que
    sirven para recorrer e imprimir todos los nodos del árbol en tres
    formas de recorrido distintas: pre-orden (raíz, izquierda, derecha),
    inorden (izquierda, raíz, derecha) y post-orden (izquierda, derecha,
    raíz).
    """

    def __init__(self) -> None:
        self.raiz: Nodo = None

    def _buscar_interno(self, objetivo: int, origen: Nodo) -> NodoArbol | None:
        if origen is None or origen.valor == objetivo:
            return origen
        if objetivo < origen:
            return self._buscar_interno(objetivo=objetivo, origen=origen.left)
        return self._buscar_interno(objetivo=objetivo, origen=origen.right)

    def buscar_ruta(self, objetivo: int) -> NodoArbol | None:
        """
        Este método llama al método interno '_buscar_interno', el cual
        busca el Nodo cuyo atributo 'valor' corresponda con el parámetro
        'objetivo' que se le pase, retornando el Nodo que lo contenga si
        este existe dentro del árbol, o None si no se encuentra.
        """

        return self._buscar_interno(objetivo=objetivo, origen=self.raiz)

    def _insertar_interno(self, valor: int, origen: NodoArbol) -> None:
        if valor < origen:
            if origen.left is None:
                origen.left = NodoArbol(valor=valor)
            else:
                self._insertar_interno(valor=valor, origen=origen.left)
        elif valor > origen:
            if origen.right is None:
                origen.right = NodoArbol(valor=valor)
            else:
                self._insertar_interno(valor=valor, origen=origen.right)

    def insertar_ruta(self, valor: int) -> None:
        """
        Este método llama al método interno '_inserar_interno', el cual
        recorre de manera recursiva el árbol, buscando el lugar correcto
        donde crear un nuevo Nodo que contenga el valor que se desea
        agregar al árbol. El método se asegura de mantener tanto el
        órden de los nodos, como la integridad de las referencias a los
        nodos hijos.
        """

        if self.raiz is None:
            self.raiz = NodoArbol(valor=valor)
        else:
            self._insertar_interno(valor=valor, origen=self.raiz)

    def _buscar_valor_minimo(self, nodo: NodoArbol) -> int:
        actual: NodoArbol = nodo
        while actual.left:
            actual = actual.left
        return actual.valor

    def _eliminar_interno(self, valor: int, origen: Nodo) -> NodoArbol | None:
        if origen is None:
            return origen
        if valor < origen:
            origen.left = self._eliminar_interno(valor=valor, origen=origen.left)
        elif valor > origen:
            origen.right = self._eliminar_interno(valor=valor, origen=origen.right)
        else:
            if origen.left is None:
                return origen.right
            elif origen.right is None:
                return origen.left
            origen.valor = self._buscar_valor_minimo(nodo=origen.right)
            origen.right = self._eliminar_interno(
                valor=origen.valor, origen=origen.right
            )
            return origen

    def eliminar_ruta(self, valor: int) -> bool:
        """
        Este método llama a el método interno '_eliminar_interno',
        el cual busca de manera recursiva el nodo que contenga el valor
        pasado como argumento y lo elimina del árbol, reemplazandolo con
        su sucesor directo, es decir, el nodo con el siguiente valor más
        alto dentro del árbol.

        Si la operación de eliminación se completa con éxito, retorna
        True, y si no, retorna False.
        """

        self.raiz = self._eliminar_interno(valor=valor, origen=self.raiz)
        return True if self.raiz else False

    def _recorrer_pre_orden(self, origen: Nodo) -> None:
        if origen:
            print(origen)
            self._recorrer_pre_orden(origen=origen.left)
            self._recorrer_pre_orden(origen=origen.right)

    def _recorrer_in_orden(self, origen: Nodo) -> None:
        if origen:
            self._recorrer_in_orden(origen=origen.left)
            print(origen)
            self._recorrer_in_orden(origen=origen.right)

    def _recorrer_post_orden(self, origen: Nodo) -> None:
        if origen:
            self._recorrer_post_orden(origen=origen.left)
            self._recorrer_post_orden(origen=origen.right)
            print(origen)

    @unique
    class ModoRecorrido(Enum):
        PRE_ORDEN = auto()
        IN_ORDEN = auto()
        POST_ORDEN = auto()

    def recorrer_arbol(self, modo: ModoRecorrido = ModoRecorrido.IN_ORDEN) -> None:
        match modo:
            case self.ModoRecorrido.PRE_ORDEN:
                self._recorrer_pre_orden(self.raiz)
            case self.ModoRecorrido.IN_ORDEN:
                self._recorrer_in_orden(self.raiz)
            case self.ModoRecorrido.POST_ORDEN:
                self._recorrer_post_orden(self.raiz)
