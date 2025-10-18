"""
Código para ejercicios semana 7.

Creación de grafos.

Para efectos de desarrollar la actividad de forma eficiente, se utilizará la librería externa `networkx`,
para la creación e instanciación de objetos de la clase `Graph`.

Primero se importan las librerías necesarias.
"""

import networkx as nx

# Para la representación de la asignación de recursos, podremos utilizar un grafo
# donde los nodos puedan ser tanto desarrolladores como dependencias del proyecto.

recursos = nx.Graph()

# Se agregan nodos y aristas con su respectiva ponderación, debido a que este es un grafo ponderado. Para esto se puede
# pasar a la función 'add_weighted_edge_from' una tupla con los primeros dos elementos siendo los nodos y el tercer
# elemento de la tupla es un valor numérico que representa la ponderación de la arista dentro del grafo.
aristas: list[tuple[str, str, float]] = [
    ("Gabriel Hernández", "NodeJs", 0.5),
    ("Ricardo Martínez", "Docker", 0.4),
    ("Ana María Costa", "HTMLX", 0.8),
    ("María Alcaraz", "NodeJs", 0.5),
    ("Ignacio Heinmann", "Java", 0.8),
    ("Constanza Rubio", "Java", 0.9),
]

recursos.add_weighted_edges_from(aristas)

# Mostramos el grafo para su visualización con la función 'draw'.
nx.draw(recursos, pos=nx.circular_layout(recursos))
