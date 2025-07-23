<?php require 'vista/header.php' ?>
<a href="index.php?m=nuevo">Nuevo</a>
<table border="1">
    <tr>
        <td>Id</td>
        <td>Nombre</td>
        <td>Asistencia</td>
        <td>Acción</td>
    </tr>
    <?php
    foreach ($dato as $key => $value) {
        foreach ($value as $va) {
            echo "<tr><td>{$va['id']}</td><td>{$va['nombre']}</td><td>S./{$va['asistencia']}</td>";
            echo "<td><a href='index.php?m=editar&id={$va['id']}'>Actualizar</a>";
            echo "<td><a href='index.php?m=eliminar&id={$va['id']}'>Eliminar</a>";
            echo '</tr>';
        }
    }
    ?>
</table>
<?php require 'vista/footer.php' ?>
