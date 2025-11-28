<?php
require_once "./config/Database.php";
require_once "./app/models/CadPessoaDAO.php";

$db = new Database();
$conn = $db->getConnection();
$dao = new CadPessoaDAO($conn);

// Busca registros e monta contadores rapidos para o hero
$desaparecidos = $dao->findAll();
$total = count($desaparecidos ?? []);
$ativos = 0;
$localizados = 0;
foreach ($desaparecidos as $p) {
    if (($p['Status'] ?? '') === 'A') { $ativos++; }
    if (($p['Localizado'] ?? '') === 'S') { $localizados++; }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>FMP - Find Missing People</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
<div class="page">
    <!-- Barra superior com acoes principais -->
    <header class="topbar">
        <div class="brand">FMP <span>Find Missing People</span></div>
        <div class="actions-row">
            <a class="btn btn-ghost" href="index3.php">Painel</a>
            <a class="btn" href="index3.php?action=create">+ Registrar</a>
        </div>
    </header>

    <main class="container">
        <!-- Hero com chamada, CTA e estatisticas -->
        <section class="hero">
            <div>
                <p class="eyebrow">Plataforma colaborativa</p>
                <h1>Encontre e compartilhe informacoes</h1>
                <p class="lead">Acompanhe pessoas desaparecidas, registre novos casos e mantenha a comunidade informada.</p>
                <div class="hero-actions">
                    <a class="btn" href="index3.php?action=create">Registrar desaparecimento</a>
                    <a class="btn btn-ghost" href="#lista">Ver lista</a>
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

        <!-- Lista principal com cards e modais de detalhes -->
        <section id="lista" class="card">
            <div class="card-head">
                <div>
                    <p class="eyebrow">Registros recentes</p>
                    <h2>Pessoas desaparecidas</h2>
                    <p class="lead">Clique em um card para ver detalhes completos.</p>
                </div>
                <a class="btn" href="index3.php?action=create">+ Nova pessoa</a>
            </div>

            <?php if (!empty($desaparecidos)): ?>
                <div class="people-grid">
                    <?php foreach ($desaparecidos as $index => $pessoa): ?>
                        <?php
                            $fotoSrc = !empty($pessoa['FotoDesaparecido'])
                                ? 'data:image/jpeg;base64,' . base64_encode($pessoa['FotoDesaparecido'])
                                : 'uploads/default.jpg';

                            $idade = '-';
                            if (!empty($pessoa['DataNascimentoDesaparecido'])) {
                                $nascimento = new DateTime($pessoa['DataNascimentoDesaparecido']);
                                $hoje = new DateTime();
                                $idade = $hoje->diff($nascimento)->y . ' anos';
                            }

                            $ocorrido = !empty($pessoa['DataHoraOcorrido']) ? date('d/m/Y H:i', strtotime($pessoa['DataHoraOcorrido'])) : 'Sem data informada';
                            $statusLabel = ($pessoa['Status'] ?? '') === 'A' ? 'Ativo' : 'Inativo';
                            $statusClass = ($pessoa['Status'] ?? '') === 'A' ? 'pill-green' : 'pill-amber';
                            $localizadoLabel = ($pessoa['Localizado'] ?? '') === 'S' ? 'Localizado' : 'Em aberto';
                            $localizadoClass = ($pessoa['Localizado'] ?? '') === 'S' ? 'pill-green' : 'pill-gray';
                            $cidadeUf = trim(($pessoa['CidadeDesaparecido'] ?? '') . (!empty($pessoa['UFDesaparecido']) ? ' / ' . $pessoa['UFDesaparecido'] : ''));
                        ?>
                        <div class="person-card" onclick="openModal(<?= $index ?>)">
                            <div class="person-photo" style="background-image:url('<?= htmlspecialchars($fotoSrc, ENT_QUOTES, 'UTF-8') ?>');"></div>
                            <div class="person-body">
                                <div class="person-top">
                                    <h3><?= htmlspecialchars($pessoa['NomeDesaparecido'] ?? '', ENT_QUOTES, 'UTF-8') ?></h3>
                                    <span class="pill <?= $statusClass ?>"><?= $statusLabel ?></span>
                                </div>
                                <p class="meta"><?= htmlspecialchars($cidadeUf ?: 'Local nao informado', ENT_QUOTES, 'UTF-8') ?></p>
                                <div class="chips">
                                    <span class="chip">Idade: <?= htmlspecialchars($idade, ENT_QUOTES, 'UTF-8') ?></span>
                                    <span class="chip">Ocorrido: <?= htmlspecialchars($ocorrido, ENT_QUOTES, 'UTF-8') ?></span>
                                    <span class="chip"><?= $localizadoLabel ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Modal de detalhes com info estruturada -->
                        <div id="modal-<?= $index ?>" class="modal">
                            <div class="modal-card">
                                <span class="modal-close" onclick="closeModal(<?= $index ?>)">&times;</span>
                                <div class="modal-content">
                                    <div class="modal-photo">
                                        <img src="<?= htmlspecialchars($fotoSrc, ENT_QUOTES, 'UTF-8') ?>" alt="Foto de <?= htmlspecialchars($pessoa['NomeDesaparecido'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
                                    </div>
                                    <div class="modal-body">
                                        <p class="eyebrow">Detalhes</p>
                                        <h3><?= htmlspecialchars($pessoa['NomeDesaparecido'] ?? '', ENT_QUOTES, 'UTF-8') ?></h3>
                                        <p class="meta"><?= htmlspecialchars($cidadeUf ?: 'Local nao informado', ENT_QUOTES, 'UTF-8') ?></p>
                                        <div class="chips" style="margin-top:8px;">
                                            <span class="pill <?= $statusClass ?>"><?= $statusLabel ?></span>
                                            <span class="pill <?= $localizadoClass ?>"><?= $localizadoLabel ?></span>
                                        </div>
                                        <div class="info-grid">
                                            <div class="info-item">
                                                <strong>Apelido</strong>
                                                <div><?= htmlspecialchars($pessoa['ApelidoDesaparecido'] ?? '-', ENT_QUOTES, 'UTF-8') ?></div>
                                            </div>
                                            <div class="info-item">
                                                <strong>Idade</strong>
                                                <div><?= htmlspecialchars($idade, ENT_QUOTES, 'UTF-8') ?></div>
                                            </div>
                                            <div class="info-item">
                                                <strong>Data/Hora do ocorrido</strong>
                                                <div><?= htmlspecialchars($ocorrido, ENT_QUOTES, 'UTF-8') ?></div>
                                            </div>
                                            <div class="info-item">
                                                <strong>Endereco</strong>
                                                <div><?= htmlspecialchars($pessoa['EnderecoDesaparecido'] ?? '-', ENT_QUOTES, 'UTF-8') ?></div>
                                            </div>
                                            <div class="info-item">
                                                <strong>Bairro</strong>
                                                <div><?= htmlspecialchars($pessoa['BairroDesaparecido'] ?? '-', ENT_QUOTES, 'UTF-8') ?></div>
                                            </div>
                                            <div class="info-item">
                                                <strong>Cidade/UF</strong>
                                                <div><?= htmlspecialchars($cidadeUf ?: '-', ENT_QUOTES, 'UTF-8') ?></div>
                                            </div>
                                            <div class="info-item">
                                                <strong>Telefone</strong>
                                                <div><?= htmlspecialchars($pessoa['TelefoneDesaparecido'] ?? '-', ENT_QUOTES, 'UTF-8') ?></div>
                                            </div>
                                            <div class="info-item">
                                                <strong>Familiar</strong>
                                                <div><?= htmlspecialchars($pessoa['NomeFamiliar'] ?? '-', ENT_QUOTES, 'UTF-8') ?></div>
                                            </div>
                                            <div class="info-item">
                                                <strong>Contato do familiar</strong>
                                                <div><?= htmlspecialchars($pessoa['TelefoneContatoFamiliar'] ?? '-', ENT_QUOTES, 'UTF-8') ?></div>
                                            </div>
                                            <div class="info-item">
                                                <strong>Tipo de acidente</strong>
                                                <div><?= htmlspecialchars($pessoa['TipoAcidente'] ?? '-', ENT_QUOTES, 'UTF-8') ?></div>
                                            </div>
                                            <div class="info-item">
                                                <strong>Roupa que usava</strong>
                                                <div><?= htmlspecialchars($pessoa['RoupaQueUsava'] ?? '-', ENT_QUOTES, 'UTF-8') ?></div>
                                            </div>
                                            <div class="info-item">
                                                <strong>Outros detalhes</strong>
                                                <div><?= htmlspecialchars($pessoa['OutrosDetalhes'] ?? '-', ENT_QUOTES, 'UTF-8') ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="notice-empty">Nenhum registro ainda. Comece cadastrando o primeiro desaparecido.</div>
            <?php endif; ?>
        </section>
    </main>
</div>

<script>
// Controla abertura/fechamento dos modais de detalhes
function openModal(index) {
    const el = document.getElementById('modal-' + index);
    if (el) el.style.display = 'block';
}
function closeModal(index) {
    const el = document.getElementById('modal-' + index);
    if (el) el.style.display = 'none';
}
window.addEventListener('click', function(event) {
    document.querySelectorAll('.modal').forEach(function(modal) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});
window.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        document.querySelectorAll('.modal').forEach(function(modal) { modal.style.display = 'none'; });
    }
});
</script>
</body>
</html>
