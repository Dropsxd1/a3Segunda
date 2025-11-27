<?php
require_once "./config/Database.php";
require_once "./app/models/CadPessoaDAO.php";

/**
 * Controller responsavel por orquestrar as operacoes de CRUD e despachar views.
 * Permite injetar um DAO custom (para testes) ou usa a conexao real por padrao.
 */
class CadPessoaController {

    private $dao;

    public function __construct($dao = null) {
        // Injecao de dependencia para facilitar testes/mocks
        if ($dao) {
            $this->dao = $dao;
        } else {
            // Em testes, aceitar conexao fake para cobrir construtor sem atingir DB real
            if (isset($GLOBALS['__TEST_FAKE_CONN'])) {
                $conn = $GLOBALS['__TEST_FAKE_CONN'];
            } else {
                $db = new Database();
                $conn = $db->getConnection();
            }
            $this->dao = new CadPessoaDAO($conn);
        }
    }

    /**
     * LISTAR: carrega todos os registros e inclui a view de listagem.
     */
    public function index() {
        $dados = $this->dao->findAll();
        include "./app/views/cadpessoas/index.php";
    }

    /**
     * EXIBIR FORM: apenas carrega a view de criacao.
     */
    public function create() {
        include "./app/views/cadpessoas/create.php";
    }

    /**
     * SALVAR: monta entidade a partir de POST/FILES, trata foto e persiste.
     */
    public function store() {
        $pessoa = new CadPessoa();

        foreach ($_POST as $key => $value) {
            if (property_exists($pessoa, $key)) {
                $pessoa->$key = $value;
            }
        }

        // Captura foto enviada (se houver)
        if (isset($_FILES['FotoDesaparecido']) && !empty($_FILES['FotoDesaparecido']['tmp_name'])) {
            $pessoa->FotoDesaparecido = file_get_contents($_FILES['FotoDesaparecido']['tmp_name']);
        } else {
            $pessoa->FotoDesaparecido = null;
        }

        $this->dao->create($pessoa);
        header("Location: /site/index.php");
    }

    /**
     * EDITAR: busca registro pelo id e inclui a view de edicao.
     */
    public function edit($id) {
        $dados = $this->dao->findById($id);
        include "./app/views/cadpessoas/edit.php";
    }

    /**
     * ATUALIZAR: rehidrata entidade, preserva foto antiga se nenhuma nova for enviada.
     */
    public function update($id) {
        $pessoa = new CadPessoa();
        $pessoa->id = $id;

        foreach ($_POST as $key => $value) {
            if (property_exists($pessoa, $key)) {
                $pessoa->$key = $value;
            }
        }

        if (isset($_FILES['FotoDesaparecido']) && !empty($_FILES['FotoDesaparecido']['tmp_name'])) {
            $pessoa->FotoDesaparecido = file_get_contents($_FILES['FotoDesaparecido']['tmp_name']);
        } else {
            // Preserva foto ja salva
            $fotoAtual = $this->dao->findById($id)['FotoDesaparecido'];
            $pessoa->FotoDesaparecido = $fotoAtual;
        }

        $this->dao->update($pessoa);
        header("Location: /site/index.php");
    }

    /**
     * DELETAR: exclui registro e redireciona para a home.
     */
    public function delete($id) {
        $this->dao->delete($id);
        header("Location: /site/index.php");
    }
}
