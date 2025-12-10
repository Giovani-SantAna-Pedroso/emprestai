<?php include 'conexao.php'; include 'cabecalho.php'; ?>

<?php if(isset($_GET['status'])): ?>
    
    <?php if($_GET['status'] == 'sucesso'): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <strong>Sucesso!</strong> Item cadastrado corretamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if($_GET['status'] == 'erro'): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Erro ao cadastrar:</strong> <?php echo isset($_GET['msg']) ? htmlspecialchars($_GET['msg']) : 'Erro desconhecido.'; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

<?php endif; ?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-success text-white py-3">
                <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Novo Item no Acervo</h4>
            </div>
            <div class="card-body p-4">
                <form action="salvar_item.php" method="POST">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nome do Item</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-box"></i></span>
                            <input type="text" name="nome_item" class="form-control" placeholder="Ex: Furadeira Bosch 500W" required maxlength="50">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Descrição Detalhada</label>
                        <textarea name="descricao_item" class="form-control" rows="2" placeholder="Detalhes, marca, modelo ou acessórios inclusos..." maxlength="200"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Categoria</label>
                            <select name="codigo_categoria" class="form-select" required>
                                <option value="" selected disabled>Selecione...</option>
                                <?php
                                $sql = $pdo->query("SELECT * FROM categorias ORDER BY nome_categoria ASC");
                                while($linha = $sql->fetch(PDO::FETCH_ASSOC)){
                                    echo "<option value='".$linha['codigo_categoria']."'>".$linha['nome_categoria']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Valor de Reposição</label>
                            <div class="input-group">
                                <span class="input-group-text">R$</span>
                                <input type="number" step="0.01" name="valor_reposicao" class="form-control" placeholder="0,00" required>
                            </div>
                            <div class="form-text text-muted">Acima de R$ 500,00 será "Alto Valor".</div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Doador Original</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-hand-holding-heart"></i></span>
                            <select name="codigo_doador" class="form-select" required>
                                <option value="" selected disabled>Quem doou este item?</option>
                                <?php
                                $sql = $pdo->query("SELECT * FROM doadores ORDER BY nome_doador ASC");
                                while($linha = $sql->fetch(PDO::FETCH_ASSOC)){
                                    echo "<option value='".$linha['codigo_doador']."'>".$linha['nome_doador']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="listar_itens.php" class="btn btn-outline-secondary me-md-2">Cancelar</a>
                        <button type="submit" class="btn btn-success btn-lg px-5">
                            <i class="fas fa-save me-2"></i>Salvar Item
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'rodape.php'; ?>