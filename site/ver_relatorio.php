<?php 
include 'conexao.php'; 

// Recebe os filtros
$tipo = $_GET['tipo'] ?? 'historico';
$inicio = $_GET['data_inicio'] ?? date('Y-m-01');
$fim = $_GET['data_fim'] ?? date('Y-m-d');

// Título dinâmico
$titulos = [
    'historico' => 'Histórico de Empréstimos',
    'atrasados' => 'Relatório de Atrasos',
    'populares' => 'Ranking de Itens Mais Populares'
];
$titulo_atual = $titulos[$tipo];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?php echo $titulo_atual; ?> - Emprestaí</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Esconde os botões na hora de imprimir no papel */
        @media print {
            .no-print { display: none !important; }
            .card { border: none !important; shadow: none !important; }
        }
        body { background-color: #fff; padding: 20px; }
    </style>
</head>
<body>

<div class="container">
    
    <div class="text-center mb-4">
        <h2>Emprestaí - Sistema de Acervo</h2>
        <h4 class="text-muted"><?php echo $titulo_atual; ?></h4>
        <p>Período: <?php echo date('d/m/Y', strtotime($inicio)); ?> até <?php echo date('d/m/Y', strtotime($fim)); ?></p>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <?php if($tipo == 'historico'): ?>
                <tr>
                    <th>Item</th>
                    <th>Membro</th>
                    <th>Data Saída</th>
                    <th>Data Devolução</th>
                    <th>Status</th>
                </tr>
            <?php elseif($tipo == 'atrasados'): ?>
                 <tr>
                    <th>Item</th>
                    <th>Membro</th>
                    <th>Era para devolver em</th>
                    <th>Dias de Atraso</th>
                </tr>
            <?php elseif($tipo == 'populares'): ?>
                 <tr>
                    <th>Item</th>
                    <th>Categoria</th>
                    <th>Total de Empréstimos</th>
                </tr>
            <?php endif; ?>
        </thead>
        <tbody>
            <?php
            // LÓGICA DE BUSCA BASEADA NO TIPO
            if($tipo == 'historico') {
                $sql = "SELECT e.*, i.nome_item, m.nome_completo 
                        FROM emprestimos e
                        JOIN itens i ON e.codigo_item = i.codigo_item
                        JOIN membros m ON e.codigo_membro = m.codigo_membro
                        WHERE e.data_emprestimo BETWEEN :inicio AND :fim
                        ORDER BY e.data_emprestimo DESC";
                $stmt = $pdo->prepare($sql);
                // Adicionamos as horas para pegar o dia inteiro
                $stmt->execute([':inicio' => $inicio . ' 00:00:00', ':fim' => $fim . ' 23:59:59']);

                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    // Se já devolveu, mostra a data, senão mostra traço
                    $data_dev = $row['data_efetiva_dev'] ? date('d/m/Y', strtotime($row['data_efetiva_dev'])) : '-';
                    echo "<tr>
                            <td>{$row['nome_item']}</td>
                            <td>{$row['nome_completo']}</td>
                            <td>".date('d/m/Y', strtotime($row['data_emprestimo']))."</td>
                            <td>{$data_dev}</td>
                            <td>{$row['status_emprestimo']}</td>
                          </tr>";
                }
            } 
            elseif($tipo == 'atrasados') {
                $sql = "SELECT e.*, i.nome_item, m.nome_completo 
                        FROM emprestimos e
                        JOIN itens i ON e.codigo_item = i.codigo_item
                        JOIN membros m ON e.codigo_membro = m.codigo_membro
                        WHERE e.status_emprestimo = 'Ativo' 
                        AND e.data_prevista_dev < CURDATE()";
                $stmt = $pdo->query($sql);

                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $dias_atraso = (strtotime(date('Y-m-d')) - strtotime($row['data_prevista_dev'])) / 86400;
                    echo "<tr>
                            <td>{$row['nome_item']}</td>
                            <td>{$row['nome_completo']}</td>
                            <td>".date('d/m/Y', strtotime($row['data_prevista_dev']))."</td>
                            <td class='text-danger fw-bold'>".floor($dias_atraso)." dias</td>
                          </tr>";
                }
            }
            elseif($tipo == 'populares') {
                // Conta quantas vezes cada item aparece na tabela empréstimos
                $sql = "SELECT i.nome_item, c.nome_categoria, COUNT(e.codigo_item) as total
                        FROM emprestimos e
                        JOIN itens i ON e.codigo_item = i.codigo_item
                        JOIN categorias c ON i.codigo_categoria = c.codigo_categoria
                        WHERE e.data_emprestimo BETWEEN :inicio AND :fim
                        GROUP BY e.codigo_item
                        ORDER BY total DESC";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([':inicio' => $inicio . ' 00:00:00', ':fim' => $fim . ' 23:59:59']);

                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    echo "<tr>
                            <td>{$row['nome_item']}</td>
                            <td>{$row['nome_categoria']}</td>
                            <td class='fw-bold'>{$row['total']} vezes</td>
                          </tr>";
                }
            }
            ?>
        </tbody>
    </table>

    <div class="text-center mt-4 no-print">
        <button onclick="window.print()" class="btn btn-success btn-lg me-2">🖨️ Imprimir</button>
        <button onclick="window.close()" class="btn btn-secondary btn-lg">Fechar</button>
    </div>

</div>
</body>
</html>