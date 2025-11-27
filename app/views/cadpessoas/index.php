<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>FMP - Painel de Pessoas</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<div class="page">
    <!-- Topbar fixa com acesso a home e atalho de novo cadastro -->
    <header class="topbar">
        <div class="brand">FMP <span>Find Missing People</span></div>
        <div class="actions-row">
            <a class="btn btn-ghost" href="index.php">Home</a>
            <a class="btn" href="?action=create">+ Nova pessoa</a>
        </div>
    </header>
    <main class="container">
        <?php
            $total = count($dados ?? []);
            $ativos = 0;
            $localizados = 0;
            foreach ($dados as $d) {
                if (($d['Status'] ?? '') === 'A') { $ativos++; }
                if (($d['Localizado'] ?? '') === 'S') { $localizados++; }
            }
        ?>
        <!-- Hero do painel com CTA e estatisticas resumidas -->
        <section class="hero hero-compact">
            <div>
                <p class="eyebrow">Painel</p>
                <h1>Administracao de cadastros</h1>
                <p class="lead">Controle os registros e mantenha as informacoes sempre atualizadas.</p>
                <div class="hero-actions">
                    <a class="btn" href="?action=create">Cadastrar novo</a>
                    <a class="btn btn-ghost" href="../index.php">Voltar para home</a>
                </div>
            </div>
            <div class="stats-grid">
                <div class="stat-box">
                    <p class="stat-label">Total</p>
                    <p class="stat-value"><?= $total ?></p>
                </div>
                <div class="stat-box">
                    <p class="stat-label">Ativos</p>
                    <p class="stat-value"><?= $ativos ?></p>
                </div>
                <div class="stat-box">
                    <p class="stat-label">Localizados</p>
                    <p class="stat-value"><?= $localizados ?></p>
                </div>
            </div>
        </section>

        <!-- Tabela principal com lista de pessoas e acoes -->
        <div class="card">
            <div class="card-head">
                <div>
                    <p class="eyebrow">Registros</p>
                    <h2>Lista de pessoas</h2>
                    <p class="lead">Edite, acompanhe status e exclua quando necessario.</p>
                </div>
                <a class="btn" href="?action=create">+ Nova pessoa</a>
            </div>
            <div class="table-wrapper">
                <?php if (!empty($dados)): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Ocorrido</th>
                                <th>Status</th>
                                <th class="actions">Acoes</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dados as $d): ?>
                                <?php
                                    $statusLabel = ($d['Status'] ?? '') === 'A' ? 'Ativo' : 'Inativo';
                                    $statusTone = ($d['Status'] ?? '') === 'A' ? 'success' : 'muted';
                                    $dataOcorrido = $d['DataHoraOcorrido'] ? date('d/m/Y H:i', strtotime($d['DataHoraOcorrido'])) : '-';
                                ?>
                                <tr>
                                    <td>#<?= $d['id'] ?></td>
                                    <td>
                                        <strong><?= $d['NomeDesaparecido'] ?></strong><br>
                                        <span class="meta">Apelido: <?= $d['ApelidoDesaparecido'] ?></span>
                                    </td>
                                    <td><?= $dataOcorrido ?></td>
                                    <td><span class="badge badge-<?= $statusTone ?>"><?= $statusLabel ?></span></td>
                                    <td class="actions">
                                        <div class="actions-row">
                                            <a class="btn btn-quiet" href="?action=edit&id=<?= $d['id'] ?>">Editar</a>
                                            <a class="btn btn-ghost" href="?action=delete&id=<?= $d['id'] ?>" onclick="return confirm('Excluir este registro?')">Excluir</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="notice-empty">Nenhum registro encontrado.</div>
                <?php endif; ?>
            </div>
        </div>
    </main>
</div>
</body>
</html>
