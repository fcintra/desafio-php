<?php
require_once '../model/employeeModel.php';

$employeeModel = new EmployeeModel();
$funcionarios = $employeeModel->getAllEmployees();



?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Funcionários Cadastrados</h2>

        <div class="action-buttons">
            <a href="create_company.php" class="btn">Cadastrar Nova Empresa</a>
            <a href="create_employee.php" class="btn">Cadastrar Novo Funcionário</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>RG</th>
                    <th>Email</th>
                    <th>Data Cadastro</th>
                    <th>Salário</th>
                    <th>Bonificação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
               <?php foreach ($funcionarios as $funcionario): ?>
            <tr style="background-color: 
               <?php 
                    $data_cadastro = strtotime($funcionario['data_cadastro']);
                    $anos_empresa = floor((time() - $data_cadastro) / (365 * 60 * 60 * 24));

                    if ($anos_empresa > 5) {
                        echo '#ffcccc';
                    } elseif ($anos_empresa > 1) {
                        echo '#cce5ff';
                    }
                ?>

                ;">
                
                <td><?= htmlspecialchars($funcionario['nome']) ?></td>
                <td><?= htmlspecialchars($funcionario['cpf']) ?></td>
                <td><?= htmlspecialchars($funcionario['rg']) ?></td>
                <td><?= htmlspecialchars($funcionario['email']) ?></td>
                <td><?= date('d/m/Y', strtotime($funcionario['data_cadastro'])) ?></td>
                <td>R$ <?= number_format($funcionario['salario'], 2, ',', '.') ?></td>
                <td>R$ <?= number_format($funcionario['bonificacao'], 2, ',', '.') ?></td>
                <td>
                    <a href="employeeEdit.php?id=<?= $funcionario['id_funcionario'] ?>">Editar</a> |
                    <a href="../controller/deleteEmployee.php?id=<?= $funcionario['id_funcionario'] ?>">Excluir</a>
                </td>
                <?php endforeach; ?>
            </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
