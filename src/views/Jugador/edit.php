<head>
    <title>Editar jugador</title>
</head>
<body>
    <h1>Editar jugador</h1>

    <form id="formJugador" action="/jugadores/update/<?= $jugador->getId(); ?>" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?= $jugador->getNombre(); ?>" >
        <br><br>

        <label for="numero">Numero:</label>
        <input type="text" name="numero" id="numero" value="<?= $jugador->getNumero(); ?>">
        <br><br>

        <button type="submit">Actualizar jugador</button>
    </form>
    <br><br>

    <a href="/equipos/edit/<?= $idEquipo; ?>"><button>Volver al equipo</button></a>
    <?php include "base.php"; ?>
</body>
</html>