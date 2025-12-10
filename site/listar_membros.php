<?php 
// ESSAS DUAS LINHAS SÃO ESSENCIAIS PARA FUNCIONAR
include 'conexao.php'; 
include 'cabecalho.php'; 
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-users me-2"></i>Membros da Comunidade</h2>
    <a href="cadastro_membro.php" class="btn btn-primary"><i class="fas fa-user-plus me-2"></i>Novo Membro</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">Nome Completo</th>
                    <th>CPF</th>
                    <th>Contato</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // RF04 - Gestão de Membros
                $sql = "SELECT * FROM membros ORDER BY nome_completo ASC";
                
                // O erro acontecia aqui porque o $pdo não existia
                $stmt = $pdo->query($sql);

                if($stmt->rowCount() > 0){
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        
                        // Formatação visual do Status
                        if($row['status_membro'] == 'Ativo'){
                            $badge = "<span class='badge bg-success bg-opacity-10 text-success border border-success'>Ativo</span>";
                        } else {
                            $badge = "<span class='badge bg-danger bg-opacity-10 text-danger border border-danger'>Bloqueado</span>";
                        }
                        
                        // Lógica do plano (Oculta)
                        // $plano = ($row['tipo_plano'] == 101) ? "Básico" : "Premium";

                        echo "<tr>";
                        echo "<td class='ps-4 fw-bold'>" . $row['nome_completo'] . "</td>";
                        echo "<td>" . $row['cpf'] . "</td>";
                        echo "<td><i class='far fa-envelope text-muted me-1'></i> " . $row['email'] . "<br><small class='text-muted'><i class='fas fa-phone me-1'></i> " . $row['telefone'] . "</small></td>";
                        
                        // Coluna Plano (Oculta)
                        // echo "<td>" . $plano . "</td>";
                        
                        echo "<td>" . $badge . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center py-4 text-muted'>Nenhum membro cadastrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'rodape.php'; ?>