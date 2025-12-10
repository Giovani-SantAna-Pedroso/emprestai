<?php 
include 'conexao.php';
include 'cabecalho.php'; // Inclui o visual novo

// (Consultas SQL permanecem iguais...)
$total_itens = $pdo->query("SELECT COUNT(*) FROM itens")->fetchColumn();
$itens_emprestados = $pdo->query("SELECT COUNT(*) FROM itens WHERE status_item = 'Emprestado'")->fetchColumn();
$itens_disponiveis = $total_itens - $itens_emprestados;
$total_membros = $pdo->query("SELECT COUNT(*) FROM membros WHERE status_membro = 'Ativo'")->fetchColumn();
?>

<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-light">Painel de Controle</h2>
        <p class="text-muted">Visão geral do acervo e operações.</p>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100 border-start border-4 border-primary">
            <div class="card-body">
                <h6 class="text-muted text-uppercase mb-2">Total Acervo</h6>
                <h2 class="display-4 fw-bold text-primary"><?php echo $total_itens; ?></h2>
                <i class="fas fa-boxes text-muted float-end mt-n4 opacity-25 fa-2x"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100 border-start border-4 border-success">
            <div class="card-body">
                <h6 class="text-muted text-uppercase mb-2">Disponíveis</h6>
                <h2 class="display-4 fw-bold text-success"><?php echo $itens_disponiveis; ?></h2>
                <i class="fas fa-check-circle text-muted float-end mt-n4 opacity-25 fa-2x"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100 border-start border-4 border-warning">
            <div class="card-body">
                <h6 class="text-muted text-uppercase mb-2">Emprestados</h6>
                <h2 class="display-4 fw-bold text-warning"><?php echo $itens_emprestados; ?></h2>
                <i class="fas fa-hand-holding text-muted float-end mt-n4 opacity-25 fa-2x"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100 border-start border-4 border-info">
            <div class="card-body">
                <h6 class="text-muted text-uppercase mb-2">Membros Ativos</h6>
                <h2 class="display-4 fw-bold text-info"><?php echo $total_membros; ?></h2>
                <i class="fas fa-users text-muted float-end mt-n4 opacity-25 fa-2x"></i>
            </div>
        </div>
    </div>
</div>

<h4 class="mb-3">Acesso Rápido</h4>
<div class="row g-4">
    <div class="col-md-6 col-lg-3">
        <a href="listar_itens.php" class="text-decoration-none">
            <div class="card card-hover border-0 shadow-sm text-center p-4 h-100">
                <div class="card-body">
                    <i class="fas fa-search fa-3x text-primary mb-3"></i>
                    <h5 class="card-title text-dark">Consultar / Emprestar</h5>
                    <p class="card-text text-muted small">Buscar itens e realizar check-out.</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-6 col-lg-3">
        <a href="listar_emprestimos.php" class="text-decoration-none">
            <div class="card card-hover border-0 shadow-sm text-center p-4 h-100">
                <div class="card-body">
                    <i class="fas fa-undo-alt fa-3x text-danger mb-3"></i>
                    <h5 class="card-title text-dark">Receber Devolução</h5>
                    <p class="card-text text-muted small">Registrar retorno de itens.</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-6 col-lg-3">
        <a href="cadastro_item.php" class="text-decoration-none">
            <div class="card card-hover border-0 shadow-sm text-center p-4 h-100">
                <div class="card-body">
                    <i class="fas fa-plus-circle fa-3x text-success mb-3"></i>
                    <h5 class="card-title text-dark">Novo Item</h5>
                    <p class="card-text text-muted small">Cadastrar equipamento no acervo.</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-6 col-lg-3">
        <a href="relatorios.php" class="text-decoration-none">
            <div class="card card-hover border-0 shadow-sm text-center p-4 h-100">
                <div class="card-body">
                    <i class="fas fa-chart-pie fa-3x text-info mb-3"></i>
                    <h5 class="card-title text-dark">Relatórios</h5>
                    <p class="card-text text-muted small">Histórico e estatísticas.</p>
                </div>
            </div>
        </a>
    </div>
</div>

<?php include 'rodape.php'; ?>