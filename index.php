<?php

require_once "controller/template.controller.php";
require_once "controller/usuarios.controller.php";
require_once "controller/categorias.controller.php";
require_once "controller/produtos.controller.php";
require_once "controller/clientes.controller.php";
require_once "controller/vendas.controller.php";

require_once "models/usuarios.model.php";
require_once "models/categorias.model.php";
require_once "models/produtos.model.php";
require_once "models/clientes.model.php";
require_once "models/vendas.model.php";



$template = new ControllerTemplate();
$template -> ctrTemplate();

