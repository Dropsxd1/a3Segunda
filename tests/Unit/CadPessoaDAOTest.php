<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../helpers/FakePDO.php';

/**
 * Testes do DAO usando FakePDO para simular banco sem dependencias externas.
 */
class CadPessoaDAOTest extends TestCase
{
    public function testFindAllReturnsAllRows()
    {
        $data = [
            ['id' => 1, 'NomeDesaparecido' => 'A'],
            ['id' => 2, 'NomeDesaparecido' => 'B'],
        ];
        $pdo = new FakePDO($data);
        $dao = new CadPessoaDAO($pdo);

        $rows = $dao->findAll();

        $this->assertCount(2, $rows);
        $this->assertSame('A', $rows[0]['NomeDesaparecido']);
    }

    public function testFindByIdReturnsCorrectRow()
    {
        $data = [
            ['id' => 10, 'NomeDesaparecido' => 'Fulano'],
            ['id' => 11, 'NomeDesaparecido' => 'Beltrano'],
        ];
        $pdo = new FakePDO($data);
        $dao = new CadPessoaDAO($pdo);

        $row = $dao->findById(11);

        $this->assertNotFalse($row);
        $this->assertSame('Beltrano', $row['NomeDesaparecido']);
    }

    public function testCreateUpdateDeleteReturnTrue()
    {
        $pdo = new FakePDO([]);
        $dao = new CadPessoaDAO($pdo);

        $pessoa = new CadPessoa();
        $pessoa->NomeDesaparecido = 'Novo';

        // Inserts/updates/deletes retornam true no fake para sinalizar sucesso
        $this->assertTrue($dao->create($pessoa));
        $this->assertTrue($dao->update($pessoa));
        $this->assertTrue($dao->delete(1));
    }
}
