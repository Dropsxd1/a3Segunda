<?php

/**
 * Encapsula a conexao com MySQL via PDO.
 * Ajuste host/db/user/pass conforme ambiente.
 */
class Database {
    private $host = "localhost";
    private $db = "fmp";
    private $user = "root";
    private $pass = "";

    /**
     * Abre conexao PDO com erro em modo excecao e charset UTF-8.
     * Em caso de falha, encerra a execucao com mensagem de erro.
     */
    public function getConnection() {
        // Em testes, permita injetar conexao fake para evitar dependencias externas
        if (isset($GLOBALS['__TEST_FAKE_DB_CONN'])) {
            return $GLOBALS['__TEST_FAKE_DB_CONN'];
        }
        try {
            $conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("SET NAMES utf8");
            return $conn;
        } catch (PDOException $e) {
            die("Erro: " . $e->getMessage());
        }
    }
}
