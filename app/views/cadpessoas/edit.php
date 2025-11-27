<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>FMP - Editar Pessoa</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<div class="page">
    <!-- Topbar com retorno ao painel e acao de salvar -->
    <header class="topbar">
        <div class="brand">FMP <span>Find Missing People</span></div>
        <div class="actions-row">
            <a class="btn btn-ghost" href="index3.php">Painel</a>
            <a class="btn" href="?action=update&id=<?= $dados['id'] ?>" onclick="event.preventDefault(); document.querySelector('form').requestSubmit();">Salvar</a>
        </div>
    </header>
    <main class="container">
        <!-- Hero contextualiza registro em edicao e mostra stats -->
        <section class="hero hero-compact">
            <div>
                <p class="eyebrow">Edicao</p>
                <h1>Editar pessoa #<?= $dados['id'] ?></h1>
                <p class="lead">Revise e atualize os dados do registro selecionado.</p>
                <div class="hero-actions">
                    <a class="btn" href="?action=update&id=<?= $dados['id'] ?>" onclick="event.preventDefault(); document.querySelector('form').requestSubmit();">Atualizar</a>
            <a class="btn btn-ghost" href="index3.php">Voltar para painel</a>
                </div>
            </div>
            <div class="stats-grid">
                <div class="stat-box">
                    <p class="stat-label">Registro</p>
                    <p class="stat-value">#<?= $dados['id'] ?></p>
                </div>
                <div class="stat-box">
                    <p class="stat-label">Status</p>
                    <p class="stat-value"><?= $dados['Status'] === 'A' ? 'Ativo' : 'Inativo' ?></p>
                </div>
            </div>
        </section>

        <!-- Formulario em grid responsivo com dados preenchidos -->
        <div class="card form-card">
            <div class="card-head">
                <div>
                    <p class="eyebrow">Formulario</p>
                    <h2>Dados do desaparecido</h2>
                </div>
            </div>
            <form action="?action=update&id=<?= $dados['id'] ?>" method="POST" enctype="multipart/form-data">
                <div class="form-grid">
                    <div>
                        <label>Data/Hora Registro</label>
                        <input type="datetime-local" name="DataHoraRegistro" value="<?= date('Y-m-d\\TH:i', strtotime($dados['DataHoraRegistro'])) ?>">
                    </div>
                    <div>
                        <label>Data/Hora Ocorrido</label>
                        <input type="datetime-local" name="DataHoraOcorrido" value="<?= date('Y-m-d\\TH:i', strtotime($dados['DataHoraOcorrido'])) ?>">
                    </div>
                    <div>
                        <label>Tipo de Acidente</label>
                        <input type="text" name="TipoAcidente" value="<?= $dados['TipoAcidente'] ?>">
                    </div>
                    <div>
                        <label>Nome</label>
                        <input type="text" name="NomeDesaparecido" value="<?= $dados['NomeDesaparecido'] ?>" required>
                    </div>
                    <div>
                        <label>Apelido</label>
                        <input type="text" name="ApelidoDesaparecido" value="<?= $dados['ApelidoDesaparecido'] ?>">
                    </div>
                    <div>
                        <label>Data de Nascimento</label>
                        <input type="date" name="DataNascimentoDesaparecido" value="<?= $dados['DataNascimentoDesaparecido'] ?>">
                    </div>
                    <div>
                        <label>CEP</label>
                        <input type="text" name="CEPDesaparecido" value="<?= $dados['CEPDesaparecido'] ?? '' ?>" placeholder="00000-000" maxlength="9">
                    </div>
                    <div>
                        <label>Sexo</label>
                        <select name="SexoDesaparecido">
                            <option value="M" <?= $dados['SexoDesaparecido']=='M'?'selected':'' ?>>Masculino</option>
                            <option value="F" <?= $dados['SexoDesaparecido']=='F'?'selected':'' ?>>Feminino</option>
                            <option value="O" <?= $dados['SexoDesaparecido']=='O'?'selected':'' ?>>Outro</option>
                        </select>
                    </div>
                    <div>
                        <label>UF</label>
                        <input type="text" name="UFDesaparecido" value="<?= $dados['UFDesaparecido'] ?>" maxlength="2">
                    </div>
                    <div>
                        <label>Cidade</label>
                        <input type="text" name="CidadeDesaparecido" value="<?= $dados['CidadeDesaparecido'] ?>">
                    </div>
                    <div>
                        <label>Bairro</label>
                        <input type="text" name="BairroDesaparecido" value="<?= $dados['BairroDesaparecido'] ?>">
                    </div>
                    <div>
                        <label>Endereco</label>
                        <input type="text" name="EnderecoDesaparecido" value="<?= $dados['EnderecoDesaparecido'] ?>">
                    </div>
                    <div>
                        <label>Numero</label>
                        <input type="text" name="NumeroDesaparecido" value="<?= $dados['NumeroDesaparecido'] ?>">
                    </div>
                    <div>
                        <label>Complemento</label>
                        <input type="text" name="ComplementoDesaparecido" value="<?= $dados['ComplementoDesaparecido'] ?>">
                    </div>
                    <div>
                        <label>Telefone do Desaparecido</label>
                        <input type="text" name="TelefoneDesaparecido" value="<?= $dados['TelefoneDesaparecido'] ?>">
                    </div>
                    <div>
                        <label>Telefone do Familiar</label>
                        <input type="text" name="TelefoneContatoFamiliar" value="<?= $dados['TelefoneContatoFamiliar'] ?>">
                    </div>
                    <div>
                        <label>Nome do Familiar</label>
                        <input type="text" name="NomeFamiliar" value="<?= $dados['NomeFamiliar'] ?>">
                    </div>
                    <div>
                        <label>Roupa que usava</label>
                        <input type="text" name="RoupaQueUsava" value="<?= $dados['RoupaQueUsava'] ?>">
                    </div>
                    <div>
                        <label>Outros detalhes</label>
                        <input type="text" name="OutrosDetalhes" value="<?= $dados['OutrosDetalhes'] ?>">
                    </div>
                    <div>
                        <label>Localizado</label>
                        <select name="Localizado">
                            <option value="S" <?= $dados['Localizado']=='S'?'selected':'' ?>>Sim</option>
                            <option value="N" <?= $dados['Localizado']=='N'?'selected':'' ?>>Nao</option>
                        </select>
                    </div>
                    <div>
                        <label>Morte</label>
                        <select name="Morte">
                            <option value="S" <?= $dados['Morte']=='S'?'selected':'' ?>>Sim</option>
                            <option value="N" <?= $dados['Morte']=='N'?'selected':'' ?>>Nao</option>
                        </select>
                    </div>
                    <div>
                        <label>Ferimentos</label>
                        <select name="Ferimentos">
                            <option value="S" <?= $dados['Ferimentos']=='S'?'selected':'' ?>>Sim</option>
                            <option value="N" <?= $dados['Ferimentos']=='N'?'selected':'' ?>>Nao</option>
                        </select>
                    </div>
                    <div>
                        <label>Local onde foi achado</label>
                        <input type="text" name="LocalAchado" value="<?= $dados['LocalAchado'] ?>">
                    </div>
                    <div>
                        <label>Status</label>
                        <select name="Status">
                            <option value="A" <?= $dados['Status']=='A'?'selected':'' ?>>Ativo</option>
                            <option value="I" <?= $dados['Status']=='I'?'selected':'' ?>>Inativo</option>
                        </select>
                    </div>
                    <div>
                        <label>Observacoes</label>
                        <input type="text" name="Obs" value="<?= $dados['Obs'] ?>">
                    </div>
                    <div>
                        <label>Foto atual</label>
                        <?php if ($dados['FotoDesaparecido']): ?>
                            <div class="thumb"><img src="data:image/jpeg;base64,<?= base64_encode($dados['FotoDesaparecido']) ?>" alt="Foto atual"></div>
                        <?php else: ?>
                            <div class="meta">Sem foto</div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label>Alterar foto</label>
                        <input type="file" name="FotoDesaparecido">
                    </div>
                </div>
                <div class="form-actions">
                    <button class="btn" type="submit">Atualizar</button>
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
