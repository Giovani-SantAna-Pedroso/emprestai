<?php include 'conexao.php'; include 'cabecalho.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-boxes me-2"></i>Itens Disponíveis</h2>
    <a href="cadastro_item.php" class="btn btn-success">
        <i class="fas fa-plus me-2"></i>Novo Item
    </a>
</div>

<?php if(isset($_GET['status'])): ?>
    
    <?php if($_GET['status'] == 'sucesso'): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <strong>Sucesso!</strong> A operação foi realizada corretamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if($_GET['status'] == 'erro'): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Erro:</strong> <?php echo isset($_GET['msg']) ? htmlspecialchars($_GET['msg']) : 'Ocorreu um problema.'; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

<?php endif; ?>
<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover table-striped align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th class="ps-3">Item</th>
                    <th>Categoria</th>
                    <th>Status</th>
                    <th>Valor Reposição</th>
                    <th class="text-end pe-3">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Busca itens disponíveis com suas categorias
                $sql = "SELECT i.*, c.nome_categoria 
                        FROM itens i 
                        JOIN categorias c ON i.codigo_categoria = c.codigo_categoria 
                        WHERE i.status_item = 'Disponível'
                        ORDER BY i.nome_item ASC";
                
                $stmt = $pdo->query($sql);

                if($stmt->rowCount() > 0){
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr>";
                        
                        // Coluna Item (com badge de Alto Valor se necessário)
                        echo "<td class='ps-3 fw-bold'>" . $row['nome_item'];
                        if($row['alto_valor']) {
                            echo " <span class='badge bg-warning text-dark ms-2'><i class='fas fa-star me-1'></i>Alto Valor</span>";
                        }
                        echo "</td>";
                        
                        echo "<td>" . $row['nome_categoria'] . "</td>";
                        
                        // Status (sempre verde aqui pois a query filtra 'Disponível')
                        echo "<td><span class='badge bg-success bg-opacity-75'>Disponível</span></td>";
                        
                        echo "<td>R$ " . number_format($row['valor_reposicao'], 2, ',', '.') . "</td>";
                        
                        // Botão de Emprestar
                        echo "<td class='text-end pe-3'>
                                <a href='realizar_emprestimo.php?id=" . $row['codigo_item'] . "' class='btn btn-sm btn-primary'>
                                    Emprestar <i class='fas fa-arrow-right ms-1'></i>
                                </a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center py-5 text-muted'>
                            <i class='fas fa-box-open fa-3x mb-3'></i><br>
                            Nenhum item disponível no momento.
                          </td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'rodape.php'; ?>