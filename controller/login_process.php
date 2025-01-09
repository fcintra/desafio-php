<?php
require_once '../model/userModel.php';  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    if (!empty($login) && !empty($senha)) {
        $userModel = new UserModel();
        $result = $userModel->validateUser($login, $senha);  
        if ($result) {
            header('Location: ../view/dashboard.php');
            exit;
        } 
        session_start();
        $_SESSION['error_message'] = 'Usuário ou senha inválidos!';
        header('Location: ../view/login.php');
        exit;
        
    }
      
    session_start();
    $_SESSION['error_message'] = 'Por favor, preencha todos os campos!';
    header('Location: ../view/login.php');
    exit;
    
}

header('Location: ../view/login.php');
exit;   

?>
