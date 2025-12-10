<?php 
include 'conexao.php'; 
include 'cabecalho.php'; 
?> 
<?php if(isset($_GET['status'])): ?>
    
    <?php if($_GET['status'] == 'erro_limite'): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm my-3" role="alert">
            <i class="fas fa-hand-paper me-2"></i>
            <strong>Operação Bloqueada (RN01):</strong> Este membro já possui 5 empréstimos ativos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if($_GET['status'] == 'erro_sistema'): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm my-3" role="alert">
            <i class="fas fa-bug me-2"></i><strong>Erro Técnico:</strong> <?php echo htmlspecialchars($_GET['msg']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

<?php endif; ?>

<?php
// CONTINUAÇÃO DA LÓGICA PHP
// Verifica se veio o ID do item na URL
if(!isset($_GET['id'])) {
    echo "<div class='container mt-4'><div class='alert alert-danger'>Item não especificado. <a href='listar_itens.php'>Voltar</a></div></div>";
    include 'rodape.php';
    exit;
}

$id_item = $_GET['id'];

// Busca dados do item e sua categoria
$sqlItem = "SELECT i.*, c.nome_categoria 
            FROM itens i 
            JOIN categorias c ON i.codigo_categoria = c.codigo_categoria 
            WHERE i.codigo_item = :id";
$stmt = $pdo->prepare($sqlItem);
$stmt->execute([':id' => $id_item]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$item) {
    echo "<div class='container mt-4'><div class='alert alert-danger'>Item não encontrado.</div></div>";
    include 'rodape.php';
    exit;
}

// LÓGICA DA REGRA DE NEGÓCIO RN02
$dias_emprestimo = 7;
if($item['nome_categoria'] == 'Eletrônicos' || $item['nome_categoria'] == 'Equipamentos Especiais') {
    $dias_emprestimo = 3;
}

$data_hoje = date('Y-m-d');
$data_devolucao = date('Y-m-d', strtotime("+$dias_emprestimo days"));
?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white py-3">
                <h4 class="mb-0"><i class="fas fa-calendar-check me-2"></i>Finalizar Empréstimo</h4>
            </div>
            <div class="card-body p-4">
                
                <div class="d-flex align-items-center mb-4 p-3 bg-light rounded">
                    <div class="me-3 text-primary">
                        <i class="fas fa-box-open fa-3x"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 text-dark"><?php echo $item['nome_item']; ?></h5>
                        <span class="badge bg-secondary"><?php echo $item['nome_categoria']; ?></span>
                        <span class="text-muted ms-2 small">Valor Reposição: R$ <?php echo number_format($item['valor_reposicao'], 2, ',', '.'); ?></span>
                    </div>
                </div>

                <form action="processar_emprestimo.php" method="POST">
                    <input type="hidden" name="codigo_item" value="<?php echo $item['codigo_item']; ?>">
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Selecionar Membro</label>
                        <select name="codigo_membro" class="form-select form-select-lg" required>
                            <option value="">Escolha um membro...</option>
                            <?php
                            $sqlMembros = $pdo->query("SELECT * FROM membros WHERE status_membro = 'Ativo'");
                            while($membro = $sqlMembros->fetch(PDO::FETCH_ASSOC)){
                                echo "<option value='".$membro['codigo_membro']."'>".$membro['nome_completo']." (CPF: ".$membro['cpf'].")</option>";
                            }
                            ?>
                        </select>
                        <div class="form-text">Apenas membros com status 'Ativo' são listados.</div>
                    </div>

                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                        <i class="fas fa-clock fa-2x me-3"></i>
                        <div>
                            <strong>Regra de Devolução: </strong>
                            <div class="small">Categoria: <em><?php echo $item['nome_categoria']; ?></em></div>
                            <div class="mt-1">
                                Prazo: <strong><?php echo $dias_emprestimo; ?> dias</strong> &bull; 
                                Devolver até: <strong class="text-danger"><?php echo date('d/m/Y', strtotime($data_devolucao)); ?></strong>
                            </div>
                        </div>
                    </div>
                    
                    <input type="hidden" name="data_prevista" value="<?php echo $data_devolucao; ?>">

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="fas fa-check-circle me-2"></i>Confirmar Empréstimo
                        </button>
                        <a href="listar_itens.php" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'rodape.php'; ?>