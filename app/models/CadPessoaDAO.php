<?php
require_once "CadPessoa.php";

/**
 * DAO para CRUD na tabela CadPessoas.
 * Isola SQL e conversao de entidade para parametros de PDO.
 */
class CadPessoaDAO {

    private $conn;
    private $table = "CadPessoas";

    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Insere novo registro a partir da entidade.
     */
    public function create(CadPessoa $pessoa) {
        $sql = "INSERT INTO {$this->table} 
        (DataHoraRegistro, DataHoraOcorrido, TipoAcidente, NomeDesaparecido, ApelidoDesaparecido, 
        DataNascimentoDesaparecido, SexoDesaparecido, UFDesaparecido, CidadeDesaparecido, 
        BairroDesaparecido, EnderecoDesaparecido, NumeroDesaparecido, ComplementoDesaparecido, 
        TelefoneDesaparecido, TelefoneContatoFamiliar, NomeFamiliar, RoupaQueUsava, 
        OutrosDetalhes, Localizado, Morte, Ferimentos, LocalAchado, Status, Obs, FotoDesaparecido)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $pessoa->DataHoraRegistro,
            $pessoa->DataHoraOcorrido,
            $pessoa->TipoAcidente,
            $pessoa->NomeDesaparecido,
            $pessoa->ApelidoDesaparecido,
            $pessoa->DataNascimentoDesaparecido,
            $pessoa->SexoDesaparecido,
            $pessoa->UFDesaparecido,
            $pessoa->CidadeDesaparecido,
            $pessoa->BairroDesaparecido,
            $pessoa->EnderecoDesaparecido,
            $pessoa->NumeroDesaparecido,
            $pessoa->ComplementoDesaparecido,
            $pessoa->TelefoneDesaparecido,
            $pessoa->TelefoneContatoFamiliar,
            $pessoa->NomeFamiliar,
            $pessoa->RoupaQueUsava,
            $pessoa->OutrosDetalhes,
            $pessoa->Localizado,
            $pessoa->Morte,
            $pessoa->Ferimentos,
            $pessoa->LocalAchado,
            $pessoa->Status,
            $pessoa->Obs,
            $pessoa->FotoDesaparecido
        ]);
    }

    /**
     * Retorna todos os registros ordenados por id desc.
     */
    public function findAll() {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Busca unico registro por id.
     */
    public function findById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Atualiza campos do registro existente.
     */
    public function update(CadPessoa $pessoa) {
        $sql = "UPDATE {$this->table} SET
            DataHoraRegistro = ?, DataHoraOcorrido = ?, TipoAcidente = ?, NomeDesaparecido = ?,
            ApelidoDesaparecido = ?, DataNascimentoDesaparecido = ?, SexoDesaparecido = ?, 
            UFDesaparecido = ?, CidadeDesaparecido = ?, BairroDesaparecido = ?, 
            EnderecoDesaparecido = ?, NumeroDesaparecido = ?, ComplementoDesaparecido = ?, 
            TelefoneDesaparecido = ?, TelefoneContatoFamiliar = ?, NomeFamiliar = ?, 
            RoupaQueUsava = ?, OutrosDetalhes = ?, Localizado = ?, Morte = ?, Ferimentos = ?, 
            LocalAchado = ?, Status = ?, Obs = ?, FotoDesaparecido = ?
        WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $pessoa->DataHoraRegistro,
            $pessoa->DataHoraOcorrido,
            $pessoa->TipoAcidente,
            $pessoa->NomeDesaparecido,
            $pessoa->ApelidoDesaparecido,
            $pessoa->DataNascimentoDesaparecido,
            $pessoa->SexoDesaparecido,
            $pessoa->UFDesaparecido,
            $pessoa->CidadeDesaparecido,
            $pessoa->BairroDesaparecido,
            $pessoa->EnderecoDesaparecido,
            $pessoa->NumeroDesaparecido,
            $pessoa->ComplementoDesaparecido,
            $pessoa->TelefoneDesaparecido,
            $pessoa->TelefoneContatoFamiliar,
            $pessoa->NomeFamiliar,
            $pessoa->RoupaQueUsava,
            $pessoa->OutrosDetalhes,
            $pessoa->Localizado,
            $pessoa->Morte,
            $pessoa->Ferimentos,
            $pessoa->LocalAchado,
            $pessoa->Status,
            $pessoa->Obs,
            $pessoa->FotoDesaparecido,
            $pessoa->id
        ]);
    }

    /**
     * Remove registro pelo id.
     */
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
