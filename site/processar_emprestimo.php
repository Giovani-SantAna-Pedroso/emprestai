<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo_item = $_POST['codigo_item'];
    $codigo_membro = $_POST['codigo_membro'];
    $data_prevista = $_POST['data_prevista'];

    try {
        $pdo->beginTransaction();

        // 1. Validar Regra RN01 (Limite de 5 itens)
        $sqlCheck = "SELECT COUNT(*) FROM emprestimos WHERE codigo_membro = :membro AND status_emprestimo = 'Ativo'";
        $stmtCheck = $pdo->prepare($sqlCheck);
        $stmtCheck->execute([':membro' => $codigo_membro]);
        
        if ($stmtCheck->fetchColumn() >= 5) {
            $pdo->rollBack();
            // ERRO DE REGRA: Volta para o formulário avisando do limite
            header("Location: realizar_emprestimo.php?id=$codigo_item&status=erro_limite");
            exit;
        }

        // 2. Registrar Empréstimo
        $sqlInsert = "INSERT INTO emprestimos (codigo_item, codigo_membro, data_prevista_dev, status_emprestimo) 
                      VALUES (:item, :membro, :data, 'Ativo')";
        $stmtInsert = $pdo->prepare($sqlInsert);
        $stmtInsert->execute([':item' => $codigo_item, ':membro' => $codigo_membro, ':data' => $data_prevista]);

        // 3. Atualizar Item
        $sqlUpdate = "UPDATE itens SET status_item = 'Emprestado' WHERE codigo_item = :item";
        $stmtUpdate = $pdo->prepare($sqlUpdate);
        $stmtUpdate->execute([':item' => $codigo_item]);

        $pdo->commit();

        // SUCESSO: Vai para a LISTA DE ITENS com mensagem verde
        header("Location: listar_itens.php?status=sucesso");
        exit;

    } catch (Exception $e) {
        $pdo->rollBack();
        // ERRO DE SISTEMA: Volta para o formulário com a mensagem técnica
        $msg = urlencode($e->getMessage());
        header("Location: realizar_emprestimo.php?id=$codigo_item&status=erro_sistema&msg=$msg");
        exit;
    }
} else {
    header("Location: listar_itens.php");
    exit;
}
?>