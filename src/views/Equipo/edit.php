<head>
    <title>Editar equipo</title>
</head>
<body>
    <h1>Editar equipo</h1>

    <form id="formEquipo" action="/equipos/update/<?= $equipo->getId(); ?>" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?= $equipo->getNombre(); ?>" >
        <br><br>

        <label for="ciudad">Ciudad:</label>
        <input type="text" name="ciudad" id="ciudad" value="<?= $equipo->getCiudad(); ?>">
        <br><br>

        <label for="deporte">Deporte:</label>
        <select name="deporte" id="deporte">
            <?php foreach ($deportes as $deporte): ?>
                <option value="<?php echo $deporte["id"]; ?>" 
                    <?php echo isset($equipo) && $equipo->getDeporte() == $deporte["id"] ? "selected" : ""; ?>>
                    <?php echo $deporte["nombre"]; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br><br>

        <?php if(!empty($jugadores)): ?>
            <label for="capitan">Capitan:</label>
            <select name="capitan" id="capitan">
                <option value="">Sin capitan</option>
                <?php foreach ($jugadores as $jugador): ?>
                    <option value="<?= $jugador->getId() ?>" 
                        <?= $jugador->getId() == $equipo->getCapitan() ? 'selected' : '' ?>
                    >
                        <?= $jugador->getNumero() ." - ". $jugador->getNombre(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>
        <?php endif; ?>

        <label for="fecha_creacion">Fecha:</label>
        <input type="date" name="fecha_creacion" id="fecha_creacion" value="<?= $equipo->getFechaCreacion(); ?>"><br><br>

        <button type="submit">Actualizar equipo</button>
    </form>
    <br><br>

    <form id="formJugador" action="/jugadores/new" method="POST">
        <input type="hidden" name="equipo_id" value="<?= $equipo->getId(); ?>">
        <button type="submit">Crear jugador</button>
    </form>

    <table border="1" style="border-collapse: collapse">
        <thead>
            <tr>
                <th>Capitan</th>
                <th>Numero</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($jugadores)): ?>
                <?php foreach ($jugadores as $jugador): ?>
                    <tr>
                        <td><?php if($equipo->getCapitan() == $jugador->getId()) echo "X";?></td>
                        <td><?php echo $jugador->getNumero(); ?></td>
                        <td><?php echo $jugador->getNombre(); ?></td>
                        <td>
                            <a href="/jugadores/edit/<?php echo $jugador->getId(); ?>"><button>Editar</button></a>
                            <a href="/jugadores/delete/<?php echo $jugador->getId(); ?>"  class="botonBorrarJugador" data-id="<?php echo $jugador->getId(); ?>">
                                <button>Borrar</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Todavia no tiene jugadores</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <hr>
    <a href="/equipos/list"><button>Volver al listado de equipos</button></a>
    <?php include "base.php"; ?>
</body>
</html>