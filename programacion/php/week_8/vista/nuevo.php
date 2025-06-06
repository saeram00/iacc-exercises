<?php require 'vista/header.php' ?>
<h1>Nuevo</h1>
<hr>
<form action="">
    <label for="">Nombre</label><br>
    <input type="text" name="nombre"><br>
    <label for="">Asistencia</label><br>
    <input type="text" name="asistencia"><br>
    <input type="submit" name="btn">
    <input type="hidden" name="m" value="guardar">
</form>
<?php require 'vista/footer.php' ?>
