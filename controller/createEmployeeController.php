<?php
session_start();

require_once '../model/employeeModel.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = htmlspecialchars(trim($_POST['nome']));
    $cpf = preg_replace('/[^0-9]/', '', $_POST['cpf']);
    $rg = htmlspecialchars(trim($_POST['rg']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $id_empresa = filter_var($_POST['id_empresa'], FILTER_VALIDATE_INT);
    $salario = round(filter_var($_POST['salario'], FILTER_VALIDATE_FLOAT), 10);
    $data_entrada = htmlspecialchars($_POST['data_entrada']);

    if (empty($nome) || empty($cpf) || empty($rg) || empty($email) || empty($id_empresa) || empty($data_entrada)) {
        $_SESSION['error_message'] = 'Todos os campos são obrigatórios.';
        header("Location: ../view/create_employee.php");
        exit();
    }

    $employeeModel = new EmployeeModel();

    try {
        if ($employeeModel->createEmployee($nome, $cpf, $rg, $email, $id_empresa, $salario, 0, $data_entrada)) {
            $_SESSION['success_message'] = 'Funcionário cadastrado com sucesso!';
            header("Location: ../view/dashboard.php");
            exit();
        } else {
            $_SESSION['error_message'] = 'Erro ao cadastrar o funcionário. Tente novamente.';
            header("Location: ../view/create_employee.php");
            exit();
        }
    } catch (Exception $e) {
        error_log("Erro no cadastro do funcionário: " . $e->getMessage());
        $_SESSION['error_message'] = 'Erro ao processar sua solicitação. Por favor, tente novamente.';
        header("Location: ../view/create_employee.php");
        exit();
    }
}
?>
