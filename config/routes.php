<?php
return [
    ["GET",     "index",                "IndexController->index"],

    // Rutas equipo
    ["GET",     "equipos/list",         "EquipoController->index"],
    ["GET",     "equipos/new",          "EquipoController->mostrarFormulario"],
    ["POST",    "equipos/add",          "EquipoController->addEquipo"],
    ["GET",     "equipos/edit/@id",     "EquipoController->editEquipo"],
    ["POST",    "equipos/update/@id",   "EquipoController->updateEquipo"],
    ["GET",     "equipos/delete/@id",   "EquipoController->deleteEquipo"],

    // Rutas jugador
    ["POST",    "jugadores/new",           "JugadorController->mostrarFormulario"],
    ["POST",    "jugadores/add",           "JugadorController->addJugador"],
    ["GET",     "jugadores/edit/@id",      "JugadorController->editJugador"],
    ["POST",    "jugadores/update/@id",    "JugadorController->updateJugador"],
    ["GET",     "jugadores/delete/@id",    "JugadorController->deleteJugador"],
];