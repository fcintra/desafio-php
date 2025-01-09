<?php
require_once '../model/employeeModel.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $employeeModel = new EmployeeModel();

    if ($employeeModel->deleteEmployee($id)) {
        header("Location: ../view/dashboard.php");
        exit();
    } else {
        echo "Erro ao excluir o funcionário.";
    }
} else {
    header("Location: dashboard.php");
    exit();
}
?>
