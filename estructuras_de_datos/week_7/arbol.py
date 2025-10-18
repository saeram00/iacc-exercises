"""
Resolución ejercicios semana 7 ramo de estructuras de datos.

Código para implementar una estructura de árbol.

Para este ejercicio se utilizará la librería externa `treelib`, debido a sus optimizaciones y API
de fácil uso para operaciones relacionadas con árboles.

Primero se importan las librerías que serán utilizadas. En este caso, solo será `treelib`
para la instanciación y manipulación de los árboles y nodos dentro de éstos.
"""

from treelib.tree import Tree

"""
Ahora se procede a la creación del árbol "Proyectos".

Dicho árbol tiene como objetivo la asignación de recursos dentro de la empresa para llevar a cabo distintos
proyectos según la disponibilidad de los desarrolladores y las habilidades requeridas para cada proyecto.  

El árbol se estructurará de manera que desde la raíz surjan los proyectos en cuestión, y cada nodo hijo de
la raíz tenga como padre el nodo `proyectos` (la raíz del árbol), con un identificador único para cada uno,
que permitirá identificarlos dentro del árbol, y desde cada nodo `proyecto` surjan nodos `habilidades-{sufijo}`
y `desarrolladores-{sufijo}`, que servirán de raíz para sus sub-árboles respectivos, facilitando su análisis.
El `{sufijo}` en el identificador será alguna sigla que permita diferenciar los proyectos. Para cada proyecto
distinto, se crearán constantes con el valor de `habilidades-{sufijo}` y `desarrolladores-{sufijo}`, de forma
que sea más fácil referenciarlos en operaciones de búsqueda.
"""

proyectos_t = Tree(
    identifier="proyectos"
)  # El sufijo "_t" indica que se trata de un árbol, para diferenciarlo de otras variables.
proyectos_t.create_node("Proyectos", "proyectos")  # El nodo raíz del árbol.

# Ahora se instancian los nodos 'proyecto', cada uno con una etiqueta diferenciadora, es decir, el nombre del proyecto.
proyectos_t.create_node("Portal Web", "portal_web", parent="proyectos")

# Se crean las constantes para representar las habilidades y desarrolladores para cada proyecto como cadenas únicas.
HABILIDADES_PW: str = "habilidades-pw"
DESARROLLADORES_PW: str = "desarrolladores-pw"

proyectos_t.create_node("Habilidades", HABILIDADES_PW, parent="portal_web")
proyectos_t.create_node("Desarrolladores", DESARROLLADORES_PW, parent="portal_web")

# Desde aquí se pueden agregar habilidades o desarrolladores como nodos hijo del nodo correspondiente. A continuación ejecutaré algunos ejemplos.
proyectos_t.create_node("Docker", "docker", parent=HABILIDADES_PW)
proyectos_t.create_node("NextJs", "nextjs", parent=HABILIDADES_PW)
proyectos_t.create_node("VueJs", "vuejs", parent=HABILIDADES_PW)
proyectos_t.create_node("Golang", "golang", parent=HABILIDADES_PW)

# Lo mismo para desarrolladores.
proyectos_t.create_node("Hernán Ortiz", "hernan_ortiz", parent=DESARROLLADORES_PW)
proyectos_t.create_node(
    "Macarena Hidalgo", "macarena_hidalgo", parent=DESARROLLADORES_PW
)
proyectos_t.create_node("Francisco Soto", "francisco_soto", parent=DESARROLLADORES_PW)

# Una vez hecho esto, se puede visualizar el árbol con el método `show` de los objetos de clase `Tree`.
proyectos_t.show()
