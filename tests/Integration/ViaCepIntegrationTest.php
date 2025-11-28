<?php

use PHPUnit\Framework\TestCase;

/**
 * Teste de integracao simples chamando a API publica ViaCEP.
 * Depende de rede; se nao houver acesso, falhara informando a falta de resposta.
 */
class ViaCepIntegrationTest extends TestCase
{
    public function testViaCepReturnsAddressData()
    {
        $cep = '01001000'; // Praça da Sé
        $url = "https://viacep.com.br/ws/{$cep}/json/";

        $json = @file_get_contents($url);
        $this->assertNotFalse($json, 'Nao foi possivel chamar a API ViaCEP');

        $data = json_decode($json, true);
        $this->assertIsArray($data);
        $this->assertSame('01001-000', $data['cep']);
        $this->assertSame('Praça da Sé', $data['logradouro']);
        $this->assertSame('São Paulo', $data['localidade']);
    }
}
