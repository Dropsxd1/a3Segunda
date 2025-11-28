<?php
require_once "app/controllers/CadPessoaController.php";

$controller = new CadPessoaController();

$action = $_GET['action'] ?? 'index';
$id = $_GET['id'] ?? null;

switch ($action) {
    case 'create': $controller->create(); break;
    case 'store': $controller->store(); break;
    case 'edit': $controller->edit($id); break;
    case 'update': $controller->update($id); break;
    case 'delete': $controller->delete($id); break;
    default: $controller->index(); break;
}
