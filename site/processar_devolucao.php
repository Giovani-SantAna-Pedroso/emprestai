<?php
include 'conexao.php';

if (isset($_GET['id_emprestimo']) && isset($_GET['id_item'])) {
    $id_emprestimo = $_GET['id_emprestimo'];
    $id_item = $_GET['id_item'];

    try {
        $pdo->beginTransaction();

        // 1. Finalizar o Empréstimo (Define data de entrega e status Concluído)
        $sqlEmp = "UPDATE emprestimos 
                   SET data_efetiva_dev = NOW(), status_emprestimo = 'Concluído' 
                   WHERE codigo_emprestimo = :id_emp";
        $stmtEmp = $pdo->prepare($sqlEmp);
        $stmtEmp->execute([':id_emp' => $id_emprestimo]);

        // 2. Liberar o Item (Volta para status Disponível)
        $sqlItem = "UPDATE itens SET status_item = 'Disponível' WHERE codigo_item = :id_item";
        $stmtItem = $pdo->prepare($sqlItem);
        $stmtItem->execute([':id_item' => $id_item]);

        $pdo->commit();

        // SUCESSO: Redireciona para a lista com o aviso na URL
        header("Location: listar_emprestimos.php?status=sucesso");
        exit;

    } catch (Exception $e) {
        $pdo->rollBack();
        // ERRO: Redireciona com a mensagem de erro
        $msg = urlencode($e->getMessage());
        header("Location: listar_emprestimos.php?status=erro&msg=$msg");
        exit;
    }
} else {
    // Se tentar acessar direto sem ID, volta para a lista
    header("Location: listar_emprestimos.php");
    exit;
}
?>