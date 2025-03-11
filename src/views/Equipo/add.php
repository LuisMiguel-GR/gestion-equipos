<head>
    <title>Añadir equipo nuevo</title>
</head>
<body>
    <h1>Añadir equipo</h1>

    <form id="formEquipo" action="/equipos/add" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <br><br>

        <label for="ciudad">Ciudad:</label>
        <input type="text" name="ciudad" id="ciudad">
        <br><br>

        <label for="deporte">Deporte:</label>
        <select name="deporte" id="deporte">
            <?php foreach ($deportes as $deporte): ?>
                <option value="<?php echo $deporte["id"]; ?>">
                    <?php echo $deporte["nombre"]; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <label for="fecha_creacion">Fecha:</label>
        <input type="date" name="fecha_creacion" id="fecha_creacion">
        <br><br>

        <button type="submit">Añadir equipo</button>
    </form>
    <hr>
    <a href="/equipos/list"><button>Volver al listado de equipos</button></a>
    <?php include "base.php"; ?>
</body>
</html>