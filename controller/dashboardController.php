<?php
require_once '../models/funcionarioModel.php';

function carregarDashboard() {
    $funcionarios = getFuncionarios();
    
    foreach ($funcionarios as &$funcionario) {
        $bonificacao = calcularBonificacao($funcionario['data_cadastro'], $funcionario['salario']);
        $funcionario['bonificacao'] = $bonificacao;
    }

    require_once '../views/dashboard.php';
}
?>
