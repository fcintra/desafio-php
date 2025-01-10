<?php
session_start();

require_once '../model/companyModel.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_empresa = trim($_POST['nome_empresa']);
    
    if (empty($nome_empresa)) {
        $_SESSION['error_message'] = 'O nome da empresa é obrigatório.';
        header("Location: ../view/create_company.php");
        exit();
    }

    $companyModel = new CompanyModel();

    if ($companyModel->createCompany($nome_empresa)) {
        header("Location: ../view/dashboard.php");
        exit();
    } else {
        $_SESSION['error_message'] = 'Erro ao cadastrar a empresa. Tente novamente.';
    }

    header("Location: ../view/create_company.php");
    exit();
}
?>
