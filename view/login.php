<?php
session_start();

if (isset($_SESSION['error_message'])) {
    echo '<p class="error-message">' . $_SESSION['error_message'] . '</p>';
    unset($_SESSION['error_message']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="../controller/login_process.php" method="POST">
            <div class="input-group">
                <label for="login">Email:</label>
                <input type="email" id="login" name="login" required>
            </div>
            <div class="input-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <button type="submit" class="btn">Entrar</button>
        </form>
    </div>
</body>
</html>