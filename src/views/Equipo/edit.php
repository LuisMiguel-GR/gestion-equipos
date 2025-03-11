<head>
    <title>Editar equipo</title>
</head>
<body>
    <h1>Editar equipo</h1>

    <form id="formEquipo" action="/equipos/update/<?= $equipo["id"]; ?>" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?= $equipo["nombre"]; ?>" >
        <br><br>

        <label for="ciudad">Ciudad:</label>
        <input type="text" name="ciudad" id="ciudad" value="<?= $equipo["ciudad"]; ?>">
        <br><br>

        <label for="deporte">Deporte:</label>
        <select name="deporte" id="deporte">
            <?php foreach ($deportes as $deporte): ?>
                <option value="<?php echo $deporte["id"]; ?>" 
                    <?php echo isset($equipo) && $equipo['deporte'] == $deporte["id"] ? "selected" : ""; ?>>
                    <?php echo $deporte["nombre"]; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label for="fecha_creacion">Fecha:</label>
        <input type="date" name="fecha_creacion" id="fecha_creacion" value="<?= $equipo["fecha_creacion"]; ?>"><br><br>

        <button type="submit">Actualizar</button>
    </form>
    <br><br>
    <a href="/equipos/list">Volver al listado de equipos</a>
    <?php include "base.php"; ?>
</body>
</html>