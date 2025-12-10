<?php include 'conexao.php'; include 'cabecalho.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-dark text-white py-3">
                <h4 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Gerador de Relatórios</h4>
            </div>
            <div class="card-body p-4">
                
                <form action="ver_relatorio.php" method="GET" target="_blank">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Tipo de Relatório</label>
                        <select name="tipo" class="form-select form-select-lg" required>
                            <option value="historico">📜 Histórico de Empréstimos</option>
                            <option value="atrasados">⚠️ Itens Atualmente Atrasados</option>
                            <option value="populares">⭐ Itens Mais Populares</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Data Início</label>
                            <input type="date" name="data_inicio" class="form-control" value="<?php echo date('Y-m-01'); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Data Fim</label>
                            <input type="date" name="data_fim" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                    </div>

                    <div class="alert alert-info mt-3">
                        <i class="fas fa-info-circle me-2"></i>
                        O relatório será gerado em uma nova aba pronta para impressão.
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-print me-2"></i>Gerar Relatório
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'rodape.php'; ?>