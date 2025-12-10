<?php
include 'conexao.php';

$nome = $_POST['nome_completo'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$plano = $_POST['tipo_plano'];

try {
    $sql = "INSERT INTO membros (nome_completo, cpf, email, telefone, senha_hash, tipo_plano, status_membro) 
            VALUES (:nome, :cpf, :email, :tel, :senha, :plano, 'Ativo')";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nome' => $nome, 
        ':cpf' => $cpf, 
        ':email' => $email, 
        ':tel' => $telefone, 
        ':senha' => $senha, 
        ':plano' => $plano
    ]);

    // SUCESSO: Redireciona para o formulário com aviso de sucesso
    header("Location: cadastro_membro.php?status=sucesso");
    exit;

} catch(PDOException $e) {
    // ERRO: Redireciona com aviso de erro e a mensagem
    $erro = urlencode($e->getMessage());
    header("Location: cadastro_membro.php?status=erro&msg=$erro");
    exit;
}
?>