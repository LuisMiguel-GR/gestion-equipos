<?php
return [
    ["GET",     "index",                "IndexController->index"],
    ["GET",     "equipos/list",         "EquipoController->index"],
    ["GET",     "equipos/new",          "EquipoController->mostrarFormulario"],
    ["POST",    "equipos/add",          "EquipoController->addEquipo"],
    ["GET",     "equipos/edit/@id",     "EquipoController->editEquipo"],
    ["POST",    "equipos/update/@id",   "EquipoController->updateEquipo"],
    ["GET",     "equipos/delete/@id",   "EquipoController->deleteEquipo"],
];