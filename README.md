# a3Segunda
Projeto A3 de Segunda-Feira


PROJETO: FMP (Find Missing People)
OBJETIVO: Sistema Web para Divulgar Pessoas Desaparecidas por Acidentes ou Desastres Naturais
LINGUAGEM: PHP + JS
MODELAGEM: MVC
ORIENTAÇÃO: O.O Orientado a Objeto
BANCO DE DADOS: MYSQL
HTML + CSS
FRAMEWORK: VSCODE


Estrutura MVC do Projeto

/app
   /config
       Database.php
   /models
       CadPessoa.php
       CadPessoaDAO.php
   /controllers
       CadPessoaController.php
   /views
       /cadpessoas
           index.php
           create.php
           edit.php
           show.php
/public
   index.php





Estrutura do Banco de Dados
NOME DO BD: FMP
Tabelas do BD
Nome da Tabela: CadPessoas

CREATE TABLE CadPessoas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    DataHoraRegistro TIMESTAMP,
    DataHoraOcorrido DATE,
    TipoAcidente VARCHAR(255),
    NomeDesaparecido VARCHAR(200),
    ApelidoDesaparecido VARCHAR(150),
    DataNascimentoDesaparecido DATE,
    SexoDesaparecido VARCHAR(3),
    UFDesaparecido VARCHAR(2),
    CidadeDesaparecido VARCHAR(250),
    BairroDesaparecido VARCHAR(250),
    EnderecoDesaparecido VARCHAR(250),
    NumeroDesaparecido VARCHAR(10),
    ComplementoDesaparecido VARCHAR(250),
    TelefoneDesaparecido VARCHAR(50),
    TelefoneContatoFamiliar VARCHAR(50),
    NomeFamiliar VARCHAR(250),
    RoupaQueUsava VARCHAR(250),
    OutrosDetalhes VARCHAR(250),
    Localizado VARCHAR(1),
    Morte VARCHAR(1),
    Ferimentos VARCHAR(1),
    LocalAchado VARCHAR(250),
    Status VARCHAR(1),
    Obs VARCHAR(255),
    FotoDesaparecido BLOB
);





