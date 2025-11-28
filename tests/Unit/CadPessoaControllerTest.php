<?php

use PHPUnit\Framework\TestCase;

// DAO fake simples para capturar interacoes do controller
class FakeDaoForController
{
    public $created;
    public $updated;
    public $deleted;
    public $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function create($pessoa) { $this->created = $pessoa; return true; }
    public function update($pessoa) { $this->updated = $pessoa; return true; }
    public function delete($id) { $this->deleted = $id; return true; }
    public function findById($id) { return $this->data[$id] ?? null; }
    public function findAll() { return array_values($this->data); }
}

class CadPessoaControllerTest extends TestCase
{
    protected function tearDown(): void
    {
        $_POST = [];
        $_FILES = [];
    }

    public function testStoreCreatesPessoaFromPost()
    {
        $dao = new FakeDaoForController();
        $controller = new CadPessoaController($dao);

        $_POST = ['NomeDesaparecido' => 'Teste', 'Status' => 'A'];
        $_FILES = [];

        $controller->store();

        $this->assertInstanceOf(CadPessoa::class, $dao->created);
        $this->assertSame('Teste', $dao->created->NomeDesaparecido);
        $this->assertSame('A', $dao->created->Status);
    }

    public function testUpdateKeepsExistingPhotoWhenNoneProvided()
    {
        $dao = new FakeDaoForController([
            10 => ['FotoDesaparecido' => 'foto-atual']
        ]);
        $controller = new CadPessoaController($dao);

        $_POST = ['NomeDesaparecido' => 'Novo Nome', 'Status' => 'I'];
        $_FILES = []; // sem nova foto

        $controller->update(10);

        $this->assertSame('foto-atual', $dao->updated->FotoDesaparecido);
        $this->assertSame('Novo Nome', $dao->updated->NomeDesaparecido);
        $this->assertSame('I', $dao->updated->Status);
    }

    public function testStoreHandlesPhotoUpload()
    {
        $dao = new FakeDaoForController();
        $controller = new CadPessoaController($dao);

        $_POST = ['NomeDesaparecido' => 'Com Foto'];
        $_FILES = [
            'FotoDesaparecido' => [
                'tmp_name' => __FILE__, // usa este arquivo como dummy
                'name' => 'dummy.jpg'
            ]
        ];

        $controller->store();

        $this->assertNotNull($dao->created->FotoDesaparecido);
        $this->assertGreaterThan(0, strlen($dao->created->FotoDesaparecido));
    }

    public function testUpdateHandlesNewPhotoUpload()
    {
        $dao = new FakeDaoForController([
            20 => ['FotoDesaparecido' => 'old']
        ]);
        $controller = new CadPessoaController($dao);

        $_POST = ['NomeDesaparecido' => 'Com Nova Foto', 'Status' => 'A'];
        $_FILES = [
            'FotoDesaparecido' => [
                'tmp_name' => __FILE__,
                'name' => 'dummy.jpg'
            ]
        ];

        $controller->update(20);

        $this->assertNotSame('old', $dao->updated->FotoDesaparecido);
        $this->assertGreaterThan(0, strlen($dao->updated->FotoDesaparecido));
    }

    public function testDeleteDelegatesToDao()
    {
        $dao = new FakeDaoForController();
        $controller = new CadPessoaController($dao);

        $controller->delete(5);

        $this->assertSame(5, $dao->deleted);
    }

    public function testConstructorUsesFakeConnectionWhenProvided()
    {
        $GLOBALS['__TEST_FAKE_DB_CONN'] = new FakePDO([]);
        $controller = new CadPessoaController();

        $ref = new ReflectionObject($controller);
        $prop = $ref->getProperty('dao');
        $prop->setAccessible(true);
        $this->assertInstanceOf(CadPessoaDAO::class, $prop->getValue($controller));
        unset($GLOBALS['__TEST_FAKE_DB_CONN']);
    }

    public function testConstructorUsesInlineFakeDaoConnection()
    {
        $GLOBALS['__TEST_FAKE_CONN'] = new FakePDO([]);
        $controller = new CadPessoaController();

        $ref = new ReflectionObject($controller);
        $prop = $ref->getProperty('dao');
        $prop->setAccessible(true);
        $this->assertInstanceOf(CadPessoaDAO::class, $prop->getValue($controller));
        unset($GLOBALS['__TEST_FAKE_CONN']);
    }

    public function testIndexRendersListView()
    {
        $dao = new FakeDaoForController([
            1 => ['id' => 1, 'NomeDesaparecido' => 'Alice', 'Status' => 'A', 'DataHoraOcorrido' => null, 'ApelidoDesaparecido' => 'A', 'Localizado' => 'N']
        ]);
        $controller = new CadPessoaController($dao);

        ob_start();
        $controller->index();
        $html = ob_get_clean();

        $this->assertStringContainsString('Lista de pessoas', $html);
        $this->assertStringContainsString('Alice', $html);
    }

    public function testCreateRendersForm()
    {
        $dao = new FakeDaoForController();
        $controller = new CadPessoaController($dao);

        ob_start();
        $controller->create();
        $html = ob_get_clean();

        $this->assertStringContainsString('Cadastrar pessoa', $html);
    }

    public function testEditRendersFormWithData()
    {
        $dao = new FakeDaoForController([
            2 => [
                'id' => 2,
                'NomeDesaparecido' => 'Bob',
                'DataHoraRegistro' => '2025-01-01 10:00:00',
                'DataHoraOcorrido' => '2025-01-01 11:00:00',
                'TipoAcidente' => 'Teste',
                'ApelidoDesaparecido' => 'B',
                'DataNascimentoDesaparecido' => '2000-01-01',
                'SexoDesaparecido' => 'M',
                'UFDesaparecido' => 'SP',
                'CidadeDesaparecido' => 'Sao Paulo',
                'BairroDesaparecido' => 'Centro',
                'EnderecoDesaparecido' => 'Rua X',
                'NumeroDesaparecido' => '123',
                'ComplementoDesaparecido' => '',
                'TelefoneDesaparecido' => '111',
                'TelefoneContatoFamiliar' => '222',
                'NomeFamiliar' => 'Fulana',
                'RoupaQueUsava' => 'Camisa',
                'OutrosDetalhes' => 'Nenhum',
                'Localizado' => 'N',
                'Morte' => 'N',
                'Ferimentos' => 'N',
                'LocalAchado' => '',
                'Status' => 'A',
                'Obs' => '',
                'FotoDesaparecido' => null
            ]
        ]);
        $controller = new CadPessoaController($dao);

        ob_start();
        $controller->edit(2);
        $html = ob_get_clean();

        $this->assertStringContainsString('Editar pessoa', $html);
        $this->assertStringContainsString('Bob', $html);
    }
}
