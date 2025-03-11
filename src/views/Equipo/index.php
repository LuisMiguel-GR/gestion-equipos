<head>
    <title>Lista equipos</title>
</head>
<body>
    <h1>Lista de equipos</h1>
    <ul>
        <?php foreach ($equipos as $equipo): ?>
            <li>
                <?php  echo $equipo->getNombre(); ?>
                <a href="/equipos/edit/<?php echo $equipo->getId(); ?>"><button>Editar</button></a>
                <a href="/equipos/delete/<?php echo $equipo->getId(); ?>"  class="botonBorrarEquipo" data-id="<?php echo $equipo->getId(); ?>"><button>Borrar</button></a>
            </li>
            <br>
        <?php endforeach; ?>
    </ul>
    <a href="/equipos/new"><button>Añadir nuevo equipo</button></a>
    <?php include "base.php"; ?>
</body>
</html>