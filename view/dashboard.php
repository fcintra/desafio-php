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
            <a href="cadastrar_empresa.php" class="btn">Cadastrar Nova Empresa</a>
            <a href="cadastrar_funcionario.php" class="btn">Cadastrar Novo Funcionário</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
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
                            echo $funcionario['bonificacao'] > 0.20 * $funcionario['salario'] ? 'red' : 
                            ($funcionario['bonificacao'] > 0.10 * $funcionario['salario'] ? 'blue' : '');
                        ?>">
                        <td><?= htmlspecialchars($funcionario['nome']) ?></td>
                        <td><?= htmlspecialchars($funcionario['cpf']) ?></td>
                        <td><?= htmlspecialchars($funcionario['email']) ?></td>
                        <td><?= date('d/m/Y', strtotime($funcionario['data_cadastro'])) ?></td>
                        <td>R$ <?= number_format($funcionario['salario'], 2, ',', '.') ?></td>
                        <td>R$ <?= number_format($funcionario['bonificacao'], 2, ',', '.') ?></td>
                        <td>
                            <a href="editar.php?id=<?= $funcionario['id_funcionario'] ?>">Editar</a> |
                            <a href="excluir.php?id=<?= $funcionario['id_funcionario'] ?>">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
