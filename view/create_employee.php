<?php
session_start();
require_once '../model/employeeModel.php';

$employeeModel = new EmployeeModel();
$companies = $employeeModel->getAllCompanies();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Funcionário</title>
    <link rel="stylesheet" href="../css/create_employee.css">
</head>
<body>
    <div class="create-employee-container">
        <h2>Cadastrar Novo Funcionário</h2>

        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="error-message">
                <?= $_SESSION['error_message']; ?>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <form action="../controller/createEmployeeController.php" method="POST">
            <div class="input-group">
                <label for="nome">Nome do Funcionário:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="input-group">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" maxlength="11" pattern="\d{11}" title="Digite 11 números para o CPF" required>
            </div>
            <div class="input-group">
                <label for="rg">RG:</label>
                <input type="text" id="rg" name="rg" maxlength="9" pattern="\d{9}" title="Digite no máximo 9 números para o RG" required>
            </div>
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="id_empresa">Empresa:</label>
                <select id="id_empresa" name="id_empresa" required>
                    <option value="">Selecione a empresa</option>
                    <?php foreach ($companies as $company): ?>
                        <option value="<?= $company['id_empresa'] ?>"><?= $company['nome'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="input-group">
                <label for="salario">Salário:</label>
                <input type="number" step="0.01" id="salario" name="salario" max="99999999.99" title="Digite até 10 números para o salário" required>
            </div>
            <div class="input-group">
                <label for="data_entrada">Data de Entrada:</label>
                <input type="date" id="data_entrada" name="data_entrada" required>
            </div>
            <button type="submit" class="btn">Cadastrar Funcionário</button>
        </form>
    </div>
</body>
</html>
