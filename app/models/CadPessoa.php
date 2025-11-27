<?php
/**
 * Entidade de pessoa desaparecida. Usada como DTO entre camadas.
 */
class CadPessoa {
    // Identificador
    public $id;
    // Datas
    public $DataHoraRegistro;
    public $DataHoraOcorrido;
    // Evento
    public $TipoAcidente;
    // Dados pessoais
    public $NomeDesaparecido;
    public $ApelidoDesaparecido;
    public $DataNascimentoDesaparecido;
    public $SexoDesaparecido;
    // Localizacao
    public $UFDesaparecido;
    public $CidadeDesaparecido;
    public $BairroDesaparecido;
    public $EnderecoDesaparecido;
    public $NumeroDesaparecido;
    public $ComplementoDesaparecido;
    public $CEPDesaparecido;
    // Contatos
    public $TelefoneDesaparecido;
    public $TelefoneContatoFamiliar;
    public $NomeFamiliar;
    // Informacoes adicionais
    public $RoupaQueUsava;
    public $OutrosDetalhes;
    // Status/achados
    public $Localizado;
    public $Morte;
    public $Ferimentos;
    public $LocalAchado;
    public $Status;
    public $Obs;
    // Foto binaria (blob)
    public $FotoDesaparecido;
}
