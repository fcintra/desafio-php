<?php
session_start();

require_once '../model/employeeModel.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = trim($_POST['nome']);
    $cpf = preg_replace('/[^0-9]/', '', $_POST['cpf']);
    $rg = trim($_POST['rg']);
    $email = trim($_POST['email']);
    $id_empresa = $_POST['id_empresa'];
    $salario = $_POST['salario'];
    $data_entrada = $_POST['data_entrada']; 

    if (empty($nome) || empty($cpf) || empty($rg) || empty($email) || empty($id_empresa) || empty($data_entrada)) {
        $_SESSION['error_message'] = 'Todos os campos são obrigatórios.';
        header("Location: ../view/create_employee.php");
        exit();
    }

    $employeeModel = new EmployeeModel();

    $bonificacao = 0;
    $data_entrada_timestamp = strtotime($data_entrada);
    $anos_empresa = floor((time() - $data_entrada_timestamp) / (365 * 60 * 60 * 24));

    if ($anos_empresa > 5) {
        $bonificacao = 0.20 * $salario;
    } elseif ($anos_empresa > 1) {
        $bonificacao = 0.10 * $salario;
    }

    if ($employeeModel->createEmployee($nome, $cpf, $rg, $email, $id_empresa, $salario, $bonificacao, $data_entrada)) {
        $_SESSION['success_message'] = 'Funcionário cadastrado com sucesso!';
        header("Location: ../view/dashboard.php");
        exit();
    } else {
        $_SESSION['error_message'] = 'Erro ao cadastrar o funcionário. Tente novamente.';
        header("Location: ../view/create_employee.php");
        exit();
    }
}
?>
