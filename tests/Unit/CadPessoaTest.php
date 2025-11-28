<?php

use PHPUnit\Framework\TestCase;

/**
 * Teste basico de DTO para garantir que propriedades podem ser atribuidas.
 */
class CadPessoaTest extends TestCase
{
    public function testDefaultPropertiesExist()
    {
        $pessoa = new CadPessoa();
        $pessoa->NomeDesaparecido = 'Teste';
        $pessoa->CEPDesaparecido = '00000000';

        $this->assertSame('Teste', $pessoa->NomeDesaparecido);
        $this->assertSame('00000000', $pessoa->CEPDesaparecido);
    }
}
