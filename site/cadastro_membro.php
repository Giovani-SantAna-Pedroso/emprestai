<?php 
// 1. Inclusões Obrigatórias (Conexão e Visual do Topo)
include 'conexao.php'; 
include 'cabecalho.php'; 
?>

<?php if(isset($_GET['status'])): ?>
    
    <?php if($_GET['status'] == 'sucesso'): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i><strong>Sucesso!</strong> Membro cadastrado corretamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if($_GET['status'] == 'erro'): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i><strong>Erro ao cadastrar:</strong> 
            <?php echo isset($_GET['msg']) ? htmlspecialchars($_GET['msg']) : 'Ocorreu um problema.'; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

<?php endif; ?>
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white py-3">
                <h4 class="mb-0"><i class="fas fa-user-plus me-2"></i>Cadastro de Novo Membro</h4>
            </div>

            <div class="card-body p-4">
                <form action="salvar_membro.php" method="POST">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nome Completo</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" name="nome_completo" class="form-control" placeholder="Ex: João da Silva" required maxlength="100">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">CPF</label>
                            <input type="text" name="cpf" class="form-control" placeholder="000.000.000-00" required maxlength="14">
                            <div class="form-text">Apenas números ou com pontuação.</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Telefone/Celular</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="text" name="telefone" class="form-control" placeholder="(11) 99999-9999" required maxlength="20">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">E-mail</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="email@exemplo.com" required maxlength="100">
                        </div>
                    </div>

                    <div class="row">
					<div class="mb-4">
                        <label class="form-label fw-bold">Senha de Acesso</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" name="senha" class="form-control" placeholder="******" required>
                        </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold">Senha de Acesso</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" name="senha" class="form-control" placeholder="******" required>
                        </div>
                    </div>

                    <input type="hidden" name="tipo_plano" value="101">

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="listar_membros.php" class="btn btn-outline-secondary me-md-2">Cancelar</a>
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            <i class="fas fa-check me-2"></i>Cadastrar Membro
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'rodape.php'; ?>