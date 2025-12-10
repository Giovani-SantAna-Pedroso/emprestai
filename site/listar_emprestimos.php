<?php include 'conexao.php'; include 'cabecalho.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-hand-holding me-2"></i>Itens Emprestados</h2>
    <a href="listar_itens.php" class="btn btn-outline-primary">Ver Disponíveis</a>
</div>

<?php if(isset($_GET['status'])): ?>
    
    <?php if($_GET['status'] == 'sucesso'): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <strong>Devolução Confirmada!</strong> O item retornou ao estoque e já está disponível.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if($_GET['status'] == 'erro'): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i><strong>Erro:</strong> <?php echo htmlspecialchars($_GET['msg']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

<?php endif; ?>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Item</th>
                    <th>Membro</th>
                    <th>Retirado em</th>
                    <th>Prazo Limite</th>
                    <th>Situação</th>
                    <th class="text-end pe-3">Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Busca empréstimos ativos
                $sql = "SELECT e.codigo_emprestimo, e.data_emprestimo, e.data_prevista_dev, 
                               i.nome_item, i.codigo_item, 
                               m.nome_completo 
                        FROM emprestimos e
                        JOIN itens i ON e.codigo_item = i.codigo_item
                        JOIN membros m ON e.codigo_membro = m.codigo_membro
                        WHERE e.status_emprestimo = 'Ativo'
                        ORDER BY e.data_prevista_dev ASC";
                
                $stmt = $pdo->query($sql);

                if($stmt->rowCount() > 0){
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $hoje = date('Y-m-d');
                        $prazo = $row['data_prevista_dev'];
                        
                        // Verifica atraso
                        if ($hoje > $prazo) {
                            $status_badge = "<span class='badge bg-danger rounded-pill'>Atrasado</span>";
                            $linha_class = "table-danger"; 
                        } else {
                            $status_badge = "<span class='badge bg-success rounded-pill'>No Prazo</span>";
                            $linha_class = "";
                        }

                        echo "<tr class='$linha_class'>";
                        echo "<td class='fw-bold'>" . $row['nome_item'] . "</td>";
                        echo "<td>" . $row['nome_completo'] . "</td>";
                        echo "<td>" . date('d/m/Y', strtotime($row['data_emprestimo'])) . "</td>";
                        echo "<td>" . date('d/m/Y', strtotime($prazo)) . "</td>";
                        echo "<td>" . $status_badge . "</td>";
                        
                        // Botão de Devolução (Sem o aviso de confirmação agora)
                        echo "<td class='text-end pe-3'>
                                <a href='processar_devolucao.php?id_emprestimo=" . $row['codigo_emprestimo'] . "&id_item=" . $row['codigo_item'] . "' 
                                   class='btn btn-sm btn-outline-danger'>
                                   <i class='fas fa-check-square me-1'></i> Devolver
                                </a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center py-5 text-muted'><i class='fas fa-check-circle fa-2x mb-3'></i><br>Nenhum item emprestado no momento.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'rodape.php'; ?>