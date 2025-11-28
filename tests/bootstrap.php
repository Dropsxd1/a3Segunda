<?php
// Bootstrap de testes: define base do projeto e carrega dependencias centrais.
define('BASE_PATH', __DIR__ . '/..');

require_once BASE_PATH . '/config/Database.php';
require_once BASE_PATH . '/app/models/CadPessoa.php';
require_once BASE_PATH . '/app/models/CadPessoaDAO.php';
require_once BASE_PATH . '/app/controllers/CadPessoaController.php';
