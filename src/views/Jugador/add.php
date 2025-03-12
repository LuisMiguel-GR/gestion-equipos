<head>
    <title>Añadir jugador</title>
</head>
<body>
    <h1>Añadir jugador</h1>

    <form id="formJugador" action="/jugadores/add" method="POST">
        <input type="hidden" name="equipo_id" value="<?php echo $equipo->getId(); ?>">

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre">
        <br><br>

        <label for="numero">Numero:</label>
        <input type="text" name="numero" id="numero">
        <br><br>

        <button type="submit">Añadir jugador</button>
    </form>
    <hr>
    <a href="/equipos/edit/<?php echo $equipo->getId(); ?>"><button>Volver al equipo</button></a>
    <?php include "base.php"; ?>
</body>
</html>
