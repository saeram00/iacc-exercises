<?php require 'vista/header.php' ?>
<h1>Editar</h1>
<hr>
<form action="">
    <?php foreach ($dato as $key => $value): ?>
        <?php foreach ($value as $va): ?>
            <label for="">Nombre</label><br>
            <input type="text" name="nombre" value="<?php echo $va['nombre'] ?>"><br>
            <label for="">Asistencia</label><br>
            <input type="text" name="asistencia" value="<?php echo $va['asistencia'] ?>"><br>
            <input type="hidden" name="id" value="<?php echo $va['id'] ?>">
            <input type="submit" name="btn" value="Actualizar">
        <?php endforeach ?>
    <?php endforeach ?>
    <input type="hidden" name="m" value="actualizar">
</form>
<?php require 'vista/footer.php' ?>