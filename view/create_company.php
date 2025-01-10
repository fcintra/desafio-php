

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Nova Empresa</title>
    <link rel="stylesheet" href="../css/create_company.css">
</head>
<body>
    <div class="create-company-container">
        <h2>Cadastrar Nova Empresa</h2>

        <form action="../controller/createCompanyController.php" method="POST">
            <div class="input-group">
                <label for="nome_empresa">Nome da Empresa:</label>
                <input type="text" id="nome_empresa" name="nome_empresa" required>
            </div>
            <button type="submit" class="btn">Cadastrar Empresa</button>
        </form>
    </div>
</body>
</html>
