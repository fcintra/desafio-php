<?php
require_once '../model/employeeModel.php';

$employeeModel = new EmployeeModel();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $employee = $employeeModel->getEmployeeById($id);
} else {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $rg = $_POST['rg']; 
    $email = $_POST['email'];
    $salario = $_POST['salario'];
    $data_cadastro = $_POST['data_cadastro'];

    if ($employeeModel->updateEmployee($id, $nome, $cpf, $rg, $email, $salario, $data_cadastro)) {
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Erro ao atualizar o funcionário.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Funcionário</title>
    <link rel="stylesheet" href="../css/employee_edit.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Editar Funcionário</h2>

        <?php if (isset($error)): ?>
            <p class="error-message"><?= $error ?></p>
        <?php endif; ?>

        <form action="employeeEdit.php?id=<?= $id ?>" method="POST" class="employee-form">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($employee['nome']) ?>" required>
            </div>

            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" value="<?= htmlspecialchars($employee['cpf']) ?>" required>
            </div>

            <div class="form-group">
                <label for="rg">RG:</label>
                <input type="text" id="rg" name="rg" value="<?= htmlspecialchars($employee['rg']) ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($employee['email']) ?>" required>
            </div>

            <div class="form-group">
                <label for="salario">Salário:</label>
                <input type="number" id="salario" name="salario" value="<?= htmlspecialchars($employee['salario']) ?>" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="data_cadastro">Data de Cadastro:</label>
                <input type="date" id="data_cadastro" name="data_cadastro" value="<?= htmlspecialchars($employee['data_cadastro']) ?>" required>
            </div>

            <button type="submit" class="btn-submit">Atualizar Funcionário</button>
        </form>

        <a href="dashboard.php" class="btn-back">Voltar</a>
    </div>
</body>
</html>
