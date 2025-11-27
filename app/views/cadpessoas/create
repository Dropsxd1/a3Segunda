<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>FMP - Cadastrar Pessoa</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<div class="page">
    <!-- Topbar com retorno ao painel e acao rapida -->
    <header class="topbar">
        <div class="brand">FMP <span>Find Missing People</span></div>
        <div class="actions-row">
            <a class="btn btn-ghost" href="index3.php">Painel</a>
            <a class="btn" href="?action=create">Cadastrar</a>
        </div>
    </header>
    <main class="container">
        <!-- Hero contextualiza e oferece CTA de salvar/voltar -->
        <section class="hero hero-compact">
            <div>
                <p class="eyebrow">Cadastro</p>
                <h1>Cadastrar pessoa desaparecida</h1>
                <p class="lead">Preencha os dados essenciais para publicar um novo registro.</p>
                <div class="hero-actions">
                    <a class="btn" href="?action=store" onclick="event.preventDefault(); document.querySelector('form').requestSubmit();">Salvar rapido</a>
            <a class="btn btn-ghost" href="index3.php">Voltar para painel</a>
                </div>
            </div>
            <div class="stats-grid">
                <div class="stat-box">
                    <p class="stat-label">Status</p>
                    <p class="stat-value">Novo</p>
                </div>
            </div>
        </section>

        <!-- Formulario principal em grid responsivo -->
        <div class="card form-card">
            <div class="card-head">
                <div>
                    <p class="eyebrow">Formulario</p>
                    <h2>Dados do desaparecido</h2>
                </div>
            </div>
            <form action="?action=store" method="POST" enctype="multipart/form-data">
                <div class="form-grid">
                    <div>
                        <label>Data/Hora do Registro</label>
                        <input type="datetime-local" name="DataHoraRegistro">
                    </div>
                    <div>
                        <label>Data/Hora do Ocorrido</label>
                        <input type="datetime-local" name="DataHoraOcorrido">
                    </div>
                    <div>
                        <label>Tipo de Acidente</label>
                        <input type="text" name="TipoAcidente" placeholder="Ex.: acidente, afogamento...">
                    </div>
                    <div>
                        <label>Nome</label>
                        <input type="text" name="NomeDesaparecido" required>
                    </div>
                    <div>
                        <label>Apelido</label>
                        <input type="text" name="ApelidoDesaparecido">
                    </div>
                    <div>
                        <label>Data de Nascimento</label>
                        <input type="date" name="DataNascimentoDesaparecido">
                    </div>
                    <div>
                        <label>CEP</label>
                        <input type="text" name="CEPDesaparecido" placeholder="00000-000" maxlength="9">
                    </div>
                    <div>
                        <label>Sexo</label>
                        <select name="SexoDesaparecido">
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                            <option value="O">Outro</option>
                        </select>
                    </div>
                    <div>
                        <label>UF</label>
                        <input type="text" name="UFDesaparecido" maxlength="2" placeholder="SP">
                    </div>
                    <div>
                        <label>Cidade</label>
                        <input type="text" name="CidadeDesaparecido">
                    </div>
                    <div>
                        <label>Bairro</label>
                        <input type="text" name="BairroDesaparecido">
                    </div>
                    <div>
                        <label>Endereco</label>
                        <input type="text" name="EnderecoDesaparecido">
                    </div>
                    <div>
                        <label>Numero</label>
                        <input type="text" name="NumeroDesaparecido">
                    </div>
                    <div>
                        <label>Complemento</label>
                        <input type="text" name="ComplementoDesaparecido">
                    </div>
                    <div>
                        <label>Telefone do Desaparecido</label>
                        <input type="text" name="TelefoneDesaparecido">
                    </div>
                    <div>
                        <label>Telefone do Familiar</label>
                        <input type="text" name="TelefoneContatoFamiliar">
                    </div>
                    <div>
                        <label>Nome do Familiar</label>
                        <input type="text" name="NomeFamiliar">
                    </div>
                    <div>
                        <label>Roupa que usava</label>
                        <input type="text" name="RoupaQueUsava">
                    </div>
                    <div>
                        <label>Outros detalhes</label>
                        <input type="text" name="OutrosDetalhes">
                    </div>
                    <div>
                        <label>Localizado</label>
                        <select name="Localizado">
                            <option value="S">Sim</option>
                            <option value="N">Nao</option>
                        </select>
                    </div>
                    <div>
                        <label>Morte</label>
                        <select name="Morte">
                            <option value="S">Sim</option>
                            <option value="N">Nao</option>
                        </select>
                    </div>
                    <div>
                        <label>Ferimentos</label>
                        <select name="Ferimentos">
                            <option value="S">Sim</option>
                            <option value="N">Nao</option>
                        </select>
                    </div>
                    <div>
                        <label>Local onde foi achado</label>
                        <input type="text" name="LocalAchado">
                    </div>
                    <div>
                        <label>Status</label>
                        <select name="Status">
                            <option value="A">Ativo</option>
                            <option value="I">Inativo</option>
                        </select>
                    </div>
                    <div>
                        <label>Observacoes</label>
                        <input type="text" name="Obs">
                    </div>
                    <div>
                        <label>Foto</label>
                        <input type="file" name="FotoDesaparecido">
                    </div>
                </div>
                <div class="form-actions">
                    <button class="btn" type="submit">Salvar</button>
                    <a class="btn btn-ghost" href="index3.php">Cancelar</a>
                </div>
            </form>
        </div>
    </main>
</div>
<script>
(function() {
    // ViaCEP: ao sair do CEP, preenche logradouro/bairro/cidade/UF/complemento
    const cepInput = document.querySelector('input[name="CEPDesaparecido"]');
    if (!cepInput) return;

    const enderecoInput = document.querySelector('input[name="EnderecoDesaparecido"]');
    const bairroInput = document.querySelector('input[name="BairroDesaparecido"]');
    const cidadeInput = document.querySelector('input[name="CidadeDesaparecido"]');
    const ufInput = document.querySelector('input[name="UFDesaparecido"]');
    const complementoInput = document.querySelector('input[name="ComplementoDesaparecido"]');

    const limparCampos = () => {
        [enderecoInput, bairroInput, cidadeInput, ufInput, complementoInput].forEach(el => { if (el) el.value = ''; });
    };

    cepInput.addEventListener('blur', () => {
        const cep = (cepInput.value || '').replace(/\D/g, '');
        if (cep.length !== 8) return;

        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(resp => resp.ok ? resp.json() : Promise.reject())
            .then(data => {
                if (data.erro) return;
                if (enderecoInput) enderecoInput.value = data.logradouro || '';
                if (bairroInput) bairroInput.value = data.bairro || '';
                if (cidadeInput) cidadeInput.value = data.localidade || '';
                if (ufInput) ufInput.value = data.uf || '';
                if (complementoInput) complementoInput.value = data.complemento || '';
            })
            .catch(() => limparCampos());
    });
})();
</script>
</body>
</html>
