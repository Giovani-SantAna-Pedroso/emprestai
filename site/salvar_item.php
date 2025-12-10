<?php
include 'conexao.php';

$nome = $_POST['nome_item'];
$descricao = $_POST['descricao_item'];
$categoria = $_POST['codigo_categoria'];
$doador = $_POST['codigo_doador'];
$valor = $_POST['valor_reposicao'];

// Aplicação da Regra RN04/RN08: Alto Valor > R$ 500,00
$alto_valor = ($valor > 500.00) ? 1 : 0;
$status = "Disponível";

try {
    $sql = "INSERT INTO itens (nome_item, descricao_item, codigo_categoria, codigo_doador, status_item, valor_reposicao, alto_valor) 
            VALUES (:nome, :desc, :cat, :doador, :status, :valor, :alto)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $nome,
        ':desc' => $descricao,
        ':cat' => $categoria,
        ':doador' => $doador,
        ':status' => $status,
        ':valor' => $valor,
        ':alto' => $alto_valor
    ]);

    // SUCESSO: Redireciona para o formulário com a barra verde
    header("Location: cadastro_item.php?status=sucesso");
    exit;

} catch(PDOException $e) {
    // ERRO: Redireciona com a mensagem de erro
    $msg = urlencode($e->getMessage());
    header("Location: cadastro_item.php?status=erro&msg=$msg");
    exit;
}
?>